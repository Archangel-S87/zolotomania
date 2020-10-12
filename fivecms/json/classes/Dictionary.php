<?php

/*
 * Справочник 1С
 */


require_once JSON_READER . 'autoload.php';

use pcrov\JsonReader\JsonReader as JsonReader;


class Dictionary
{
    private $file = 'dictionary.json';

    // Свойства товара
    private $all_sections = [];
    private $size = ['is_variant' => 1];
    private $weight = ['not_property' => 1];
    private $shops = ['shops' => [], 'not_property' => 1];

    public $categories = [];


    public function __construct()
    {
        $this->file = JSON_DIR . 'temp/catalog/' . $this->file;

        if (!file_exists($this->file)) {
            Exchange::error('Dictionary not found');
        }
    }

    public function read_dictionary($object)
    {
        $callback = $object == 'dictionary' ? 'add_section' : 'add_category';

        $reader = new JsonReader();

        try {
            $reader->open($this->file);

            if ($reader->read($object)) {
                $depth = $reader->depth();
                $reader->read();
                do {
                    call_user_func_array([$this, $callback], [$reader->name(), $reader->value()]);
                } while ($reader->next() && $reader->depth() > $depth);
            } else return;
        } catch (Exception $exception) {
            Exchange::error_read_file($this->file, $exception);
        }

        $reader->close();
    }

    private function add_section($name, $value)
    {
        if (!property_exists($this, $name)) $this->$name = null;

        if (is_array($this->$name) && !empty($this->$name['not_property'])) return;

        $values = [];
        foreach ($value['Значения'] ?? [] as $val) {
            $values[(string)$val['id']] = (string)$val['name'];
        }

        // Привязка свойств к категориям
        $binding_categories = [
            'add' => [],
            'exclude' => [],
            'is_binding' => false // привязка характеристики приходит с 1с
        ];
        if (isset($value['categories'])) {
            $binding_categories = array_merge($binding_categories, $value['categories']);
            if (!empty($value['categories']['add'])) $binding_categories['is_binding'] = true;
        }

        $property = [
            'external_id' => (string)($value['id'] ?? ''),
            'name' => (string)($value['name'] ?? ''),
            'values' => $values,
        ];

        $this->$name = is_array($this->$name) ? array_merge($this->$name, $property) : $property;

        $this->all_sections[(string)$value['id']] = (string)$name;
    }

    private function add_category($name, $value)
    {
        $this->categories[$value['external_id']] = $value;
    }

    /**
     * Возвращает id раздела по переданому названию
     * @param $section_name string
     * @return string
     */
    public function get_section_id_by_name($section_name)
    {
        $section_id = $this->{$section_name}['external_id'] ?? '';
        if (!$section_id) Exchange::add_warning("Section with name {$section_name} not found");
        return $section_id;
    }

    /**
     * Возвращает название раздела по переданому id
     * @param $section_id
     * @return string
     */
    public function get_section_name_by_id($section_id)
    {
        $name = $this->all_sections[$section_id] ?? '';
        if (!$name) Exchange::add_warning("Section with id {$section_id} not found");
        return $name;
    }

    /**
     * Возвращает раздел по переданому имени
     * @param $name
     * @return mixed
     */
    public function get_section_by_name($name)
    {
        $name = $this->$name ?? '';
        if (!$name) Exchange::add_warning("Section with name {$name} not found");
        return $name;
    }

    /**
     * Возвращает значение свойства по переданому id раздела и id значению
     * @param $section_id string
     * @param $value_id string
     * @return string
     */
    public function get_property_value_by_id($section_id, $value_id)
    {
        if (!$section_id || !$value_id) return '';
        if (!$section = $this->all_sections[$section_id] ?? '') return '';
        return $this->$section['values'][$value_id] ?? '';
    }

    public function read_dictionary_shops()
    {
        $reader = new JsonReader();

        try {
            $reader->open($this->file);

            if ($reader->read('shops')) {
                $depth = $reader->depth();
                $reader->read();
                do {
                    $shop = $reader->value();
                    if (!$id = $shop['id'] ?? '') continue;
                    unset($shop['id']);
                    $this->shops['shops'][$id] = $shop;
                } while ($reader->next() && $reader->depth() > $depth);
            } else return;
        } catch (Exception $exception) {
            Exchange::error_read_file($this->file, $exception);
        }

        $reader->close();
    }

    public function get_shops() {
        return $this->shops['shops'];
    }
}
