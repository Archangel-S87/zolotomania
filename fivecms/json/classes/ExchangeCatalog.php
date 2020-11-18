<?php

/*
 * Импорт каталога товаров. Категории и свойства.
 */

require_once JSON_DIR . 'classes/Dictionary.php';
require_once JSON_READER . 'autoload.php';

use pcrov\JsonReader\JsonReader as JsonReader;


class ExchangeCatalog extends Exchange
{
    protected $mods = [
        'import_categories',
        'import_products',
        'import_variants'
    ];

    /**
     * @var Dictionary
     */
    private $dictionary;


    protected function import_categories()
    {
        $is_update = $this->request->get('update') != 'false';

        $this->dictionary = new Dictionary();
        $this->dictionary->read_dictionary('categories');

        if (!$is_update) {
            unset($_SESSION['categories_mapping']);
            foreach ($this->categories->get_categories_tree() as $category) {
                $this->categories->delete_image($category->id);
            }
            $this->db->query('TRUNCATE TABLE __categories');
        }

        $unloaded_categories = []; // Не загруженные категории

        foreach ($this->dictionary->categories as $category) {
            $this->import_category($category, $is_update, $unloaded_categories);
        }

        // Загрузка категорий которые не были загружены
        foreach ($unloaded_categories as $category) {
            $this->import_category($category, $is_update, $unloaded_categories, true);
        }

        if (!$is_update) Exchange::add_warning('Please update the list of products and variants');

        Exchange::response();
    }

    private function import_category($category, $is_update, &$unloaded_categories, $finish = false)
    {
        $new_category = [
            'name' => $category['name'],
            'meta_title' => $category['name'],
            'meta_keywords' => $category['name'],
            'meta_description' => $category['description']
        ];

        if (isset($category['position'])) {
            $new_category['position'] = $category['position'];
        }

        // Есть ли родительская категория?
        if ($category['parent_id']) {
            if ($parent_cat = $this->find_category_id($category['parent_id'])) {
                $new_category['parent_id'] = $parent_cat;
            }
        } else {
            $new_category['parent_id'] = 0;
        }

        // Добавляем изображения к кактегории
        if (isset($category['image'])) {
            $images_dir = $this->config->categories_images_dir;
            $image = basename($category['image']);

            if ($image && is_file($this->temp_dir . $category['image'])) {
                rename($this->temp_dir . $category['image'], $images_dir . $image);
            }

            if (!$image || !is_file($images_dir . $image)) {
                $image = null;
                if ($category_id = $this->find_category_id($category['external_id'])) {
                    $this->categories->delete_image($category_id);
                }
            }

            $new_category['image'] = $image;
        }

        if (isset($new_category['parent_id'])) {

            if ($is_update && $category_id = $this->find_category_id($category['external_id'])) {
                // Обновление категории
                $this->categories->update_category($category_id, $new_category);
            } else {
                $new_category['external_id'] = $category['external_id'];
                $category_id = $this->categories->add_category($new_category);
            }

            $this->dictionary->categories[$category['external_id']]['id'] = $category_id;

            $_SESSION['categories_mapping'][$category['external_id']] = [
                'id' => $category_id,
                'parent_external_id' => $category['parent_id']
            ];

        } elseif ($finish) {
            Exchange::add_warning("Для категории {$category['external_id']} не найдена родительская");
        } else {
            // откладываю импорт на потом
            $unloaded_categories[$category['external_id']] = $category;
        }
    }

    protected function import_products()
    {
        $filename = $this->check_import_file();

        $is_update = $this->request->get('update') != 'false';

        if (!$is_update) {
            unset($_SESSION['features_mapping']);
            unset($_SESSION['brands_mapping']);

            $this->db->query('TRUNCATE TABLE __products');
            $this->db->query('TRUNCATE TABLE __products_categories');
            $this->db->query('TRUNCATE TABLE __features');
            $this->db->query('TRUNCATE TABLE __categories_features');
            $this->db->query('TRUNCATE TABLE __options');
            $this->db->query('TRUNCATE TABLE __images');
            $this->db->query('TRUNCATE TABLE __related_products');

            $originals_dir = $this->config->root_dir . 'files/originals/';
            $products_dir = $this->config->root_dir . 'files/products/';

            $this->clean_dir($originals_dir);
            $this->clean_dir($products_dir);
        }

        $this->dictionary = new Dictionary();
        $this->dictionary->read_dictionary('dictionary');

        $reader = new JsonReader();

        try {
            $reader->open($this->temp_dir . $filename);

            if ($reader->read('products')) {
                $depth = $reader->depth();
                $reader->read();
                do {
                    $this->import_product($reader->value(), $is_update);
                } while ($reader->next() && $reader->depth() > $depth);
            } else {
                Exchange::error('Products not found');
            }
        } catch (Exception $exception) {
            Exchange::error_read_file($filename, $exception);
        }

        $reader->close();

        Exchange::response();
    }

    private function import_product($json_product, $is_update)
    {
        $product_id = 0;

        if ($is_update) {
            // Ищем товар
            $this->db->query('SELECT id FROM __products WHERE external_id=?', $json_product['id']);
            $product_id = $this->db->result('id');

            // Удаляем товар
            if ($product_id && isset($json_product['Статус']) && $json_product['Статус'] == 'DELETE') {
                $this->products->delete_product($product_id);
                return;
            }
        }

        // Ид категории
        $category_id = $this->find_category_id($json_product['category_id']);

        $description = $json_product['description'] ?? '';

        $new_product = [
            'name' => $json_product['name'],
            'meta_title' => $json_product['name'],
            'meta_keywords' => $json_product['name'],
            'meta_description' => $description,
            'annotation' => $description,
            'body' => $description,
            'brand_id' => 0
        ];

        if (!$product_id) {
            // Добавляем товар

            $new_product['external_id'] = $json_product['id'];

            $product_id = $this->products->add_product($new_product);

            // Добавляем товар в категории
            if ($category_id) $this->categories->add_product_category($product_id, $category_id);

        } else {
            //Если нашелся товар

            $product_id = $this->products->update_product($product_id, $new_product);

            // Обновляем категорию товара
            if ($category_id && $product_id) {
                $this->db->query('DELETE FROM __products_categories WHERE product_id=?', $product_id);
                $this->categories->add_product_category($product_id, $category_id);
            }

            // Удаляю все прикреплённые изображения
            if (isset($json_product['images'])) {
                $this->db->query('SELECT id FROM __images WHERE product_id=? ORDER BY position', $product_id);
                $img_ids = $this->db->results('id');
                foreach ($img_ids as $img_id) {
                    if ($img_id) $this->products->delete_image($img_id);
                }
            }

        }

        // Добавляем изображения к товару
        if (isset($json_product['images'])) {
            $images_dir = $this->config->original_images_dir;
            if (!$this->settings->oneimages && is_writable($images_dir)) {
                foreach ($json_product['images'] ?? [] as $img) {
                    if (!$img || !is_file($this->temp_dir . $img)) continue;
                    $image = basename($img);
                    rename($this->temp_dir . $img, $images_dir . $image);
                    $this->products->add_image($product_id, $image);
                }
            } else {
                foreach ($json_product['images'] ?? [] as $img) {
                    $image = basename($img);
                    if (!$image || !is_file($images_dir . $image)) {
                        if (!$img || !is_file($this->temp_dir . $img)) continue;
                        rename($this->temp_dir . $img, $images_dir . $image);
                    }
                    $this->products->add_image($product_id, $image);
                }
            }
        }

        // Свойства товара
        foreach ($json_product['properties'] as $property) {

            if (!$property['Раздел'] ?? null) {
                Exchange::add_warning("Товар с id {$json_product['id']}, Раздел свойства не опредён");
                continue;
            }

            $property_name = $this->dictionary->get_section_name_by_id($property['Раздел']);
            if (!$property_name || $property_name == 'brands') continue;

            // Проверка свойства на вариант
            $section = $this->dictionary->get_section_by_name($property_name);
            if (!$section || !empty($section['is_variant'])) continue;

            // Ищу свойство
            $feature_id = $this->get_feature_id($property_name, $section);

            if (!$feature_id || !$category_id) continue;

            // Привязываю категории (и родительские) к свойству если нет привязки в 1с
            if (!$section['binding_categories']['is_binding']) {
                $categories = [$category_id];
                $parent_external_id = $this->find_parent_category_id($json_product['category_id']);
                while ($parent_external_id) {
                    $categories[] = $this->find_category_id($parent_external_id);
                    $parent_external_id = $this->find_parent_category_id($parent_external_id);
                }
                foreach ($categories as $category) {
                    $this->features->add_feature_category($feature_id, $category);
                }
            }

            // Обновляю опции
            $this->db->query('DELETE FROM __options WHERE product_id=? AND feature_id=?', (int)$product_id, (int)$feature_id);
            if ($option_value = $this->get_product_property_by_name($json_product, $property_name)) {
                $this->features->update_option($product_id, $feature_id, $option_value);
            }

        }
    }

    /**
     * Возвращает id характеристики по переданому названию
     * Если не найдено добавляет новую характеристику
     * @param $property_name string
     * @param $section array
     * @return string
     */
    private function get_feature_id($property_name, $section)
    {
        $feature_id = $_SESSION['features_mapping'][$property_name] ?? null;
        if ($feature_id) {
            if (empty($section['updated'])) {
                // Обновляю свойство
                $new_feature = [
                    'name' => (string)$section['name'],
                    'in_filter' => (int)$section['in_filter']
                ];
                if (!empty($section['position'])) {
                    $new_feature['position'] = $section['position'];
                }
                $this->features->update_feature($feature_id, $new_feature);
                $section['updated'] = 1;
            }
            return $feature_id;
        }

        $this->db->query('SELECT id FROM __features WHERE name=?', (string)$section['name']);
        if (!$feature_id = $this->db->result('id')) {
            $new_feature = [
                'name' => (string)$section['name'],
                'in_filter' => (int)$section['in_filter']
            ];
            if (!empty($section['position'])) {
                $new_feature['position'] = $section['position'];
            }
            $feature_id = $this->features->add_feature($new_feature);
        }

        $_SESSION['features_mapping'][$property_name] = $feature_id;

        // Привязываю свойство к категориям указаным в секции
        foreach ($section['binding_categories']['add'] as $add_category_id) {
            $add_category_id = (int)$this->find_category_id($add_category_id);
            if (!$add_category = $this->categories->get_category($add_category_id)) continue;
            foreach ($add_category->children as $category_id) {
                $this->features->add_feature_category($feature_id, $category_id);
            }
        }

        // Удаляю привязку свойства от категории
        foreach ($section['binding_categories']['exclude'] as $exclude_category_id) {
            $exclude_category_id = (int)$this->find_category_id($exclude_category_id);
            if (!$exclude_category = $this->categories->get_category($exclude_category_id)) continue;
            foreach ($exclude_category->children as $category_id) {
                $this->db->query("DELETE FROM __categories_features WHERE feature_id=? AND category_id=?", $feature_id, $category_id);
            }
        }

        return $feature_id;
    }

    /**
     * Поиск в свойствах json товара значения свойства по названию свойства
     * @param $json_product array
     * @param $name string
     * @return string
     */
    private function get_product_property_by_name($json_product, $name)
    {
        $section_id = $this->dictionary->get_section_id_by_name($name);
        foreach ($json_product['properties'] as $property) {
            if ($property['Раздел'] == $section_id && $value = $this->dictionary->get_property_value_by_id($property['Раздел'], $property['Значение'])) {
                return $value;
            }
        }
        return '';
    }

    private function find_parent_category_id($external_id)
    {
        if (!$external_id) return '';

        if ($id = $_SESSION['categories_mapping'][$external_id]['parent_external_id'] ?? '') return $id;

        if (!$category_id = $this->find_category_id($external_id)) return '';

        $this->db->query('SELECT external_id FROM __categories WHERE id IN (SELECT parent_id FROM __categories WHERE id=?);', (int)$category_id);
        $id = $this->db->result('external_id') ?: '';

        return $_SESSION['categories_mapping'][$external_id]['parent_external_id'] = $id;
    }

    private function find_category_id($external_id)
    {
        if (!$external_id) return 0;

        if ($id = $_SESSION['categories_mapping'][$external_id]['id'] ?? '') return $id;

        if ($id = $this->dictionary->categories[$external_id]['id'] ?? '') {
            $_SESSION['categories_mapping'][$external_id]['id'] = $id;
            return $id;
        }

        $this->db->query('SELECT id FROM __categories WHERE external_id=?', $external_id);
        $id = $this->db->result('id');

        if ($id) {
            $_SESSION['categories_mapping'][$external_id]['id'] = $id;
            $this->dictionary->categories[$external_id]['id'] = $id;
        }

        return $id ?: 0;
    }

    protected function import_variants()
    {
        $filename = $this->check_import_file();

        $is_update = $this->request->get('update') != 'false';

        if (!$is_update) {
            unset($_SESSION['shops']);

            // Удаляю все варианты
            $this->db->query('TRUNCATE TABLE __variants');
            $this->db->query('TRUNCATE TABLE __shops');
        }

        $this->dictionary = new Dictionary();
        $this->dictionary->read_dictionary('dictionary');
        $this->dictionary->read_dictionary_shops();
        $this->update_shops();

        $reader = new JsonReader();

        try {
            $reader->open($this->temp_dir . $filename);

            if ($reader->read('variants')) {

                $depth = $reader->depth();
                $reader->read();

                $old_product_id = null;

                do {
                    $this->import_variant($reader->value(), $old_product_id, $is_update);
                } while ($reader->next() && $reader->depth() > $depth);

            } else {
                Exchange::error('Variants not found');
            }
        } catch (Exception $exception) {
            Exchange::error_read_file($filename, $exception);
        }

        $reader->close();

        Exchange::response();
    }

    private function import_variant($json_variant, &$old_product_id, $is_update)
    {
        $product_1c_id = $json_variant['product_id'] ?? '';
        if (!$product_1c_id) {
            Exchange::add_warning('Empty product product_id');
            return;
        }

        $this->db->query('SELECT id FROM __products WHERE external_id=?', $product_1c_id);
        if (!$product_id = $this->db->result('id')) {
            Exchange::add_warning("Product with product_id {$product_1c_id} not found");
            return;
        }

        if ($is_update && $old_product_id != $product_id) {
            // Удаляю все варианты товара
            $this->db->query('DELETE FROM __variants WHERE product_id=?', $product_id);
            $old_product_id = $product_id;
        }

        // Значения и имя варианта
        $name = [];

        $size = $this->dictionary->get_section_by_name('size');
        $name1 = $this->dictionary->get_property_value_by_id($size['external_id'], $json_variant['size'] ?? null);
        if ($name1) {
            $name1 = ($size['prefix'] ?? '') . " {$name1} " . ($size['suffix'] ?? '');
            $name1 = trim($name1);
            $name[] = $name1;
        }

        $variant = [
            'product_id' => $product_id,
            'sku' => $json_variant['vendor_code'],
            'name' => implode(', ', $name),
            'price' => (float)$json_variant['price'],
            'stock' => $json_variant['count'] ? (int)$json_variant['count'] : NULL,
            'external_id' => $json_variant['variant_id'],
            'name1' => $name1,
            'unit' => 'шт',
            'shop_id' => $this->find_shop_id($json_variant['shop'] ?? ''),
            'reservation' => $json_variant['reservation'] ?? 0
        ];

        $variant_id = $this->variants->add_variant($variant);
        $this->variants->update_variant($variant_id, ['position' => $variant_id]);
    }

    /**
     * Обновляет список магащинов если они есть
     */
    private function update_shops()
    {
        foreach ($this->dictionary->get_shops() as $external_id => $shop) {
            $json_shop = [
                'address' => $shop['address'] ?? '',
                'external_id' => $external_id,
                'city' => $shop['city'] ?? '',
                'name' => $shop['name'] ?? ''
            ];

            $this->db->query('SELECT id FROM __shops WHERE external_id=? LIMIT 1', $external_id);
            if ($id = $this->db->result('id')) {
                $this->db->query("UPDATE __shops SET ?% WHERE id=?", $json_shop, $id);
                $_SESSION['shops'][$external_id]['id'] = $id;
            } else {
                $this->db->query("INSERT INTO __shops SET ?%", $json_shop);
                $_SESSION['shops'][$external_id]['id'] = $this->db->insert_id();
            }
        }
    }

    private function find_shop_id($external_id)
    {
        if (!$external_id) return 0;

        if ($id = $_SESSION['shops'][$external_id]['id'] ?? '') return $id;

        $this->db->query('SELECT id FROM __shops WHERE external_id=? LIMIT 1', $external_id);
        if ($id = $this->db->result('id')) {
            $_SESSION['shops'][$external_id]['id'] = $id;
        }

        return $id ?: 0;
    }
}
