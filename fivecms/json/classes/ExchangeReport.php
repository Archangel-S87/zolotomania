<?php

/*
 * Сбор информации о выгруженых товарах
 */

class ExchangeReport extends Exchange
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    protected $mods = ['get'];

    private $research_products = [];


    public function __construct()
    {
        parent::__construct();

        if (!is_dir($this->temp_dir)) {
            mkdir($this->temp_dir);
        }
    }

    /**
     * Создаёт файл отчёта о выгрузке
     */
    protected function get()
    {
        $image_dir = $this->config->original_images_dir;
        $filename = $this->temp_dir . 'report.json';

        $fp = fopen($filename, 'w');
        fwrite($fp, '{');
        fwrite($fp, '"date": "' . date(self::DATE_FORMAT) . '",');
        fwrite($fp, '"variants": [');

        $page = 1;
        $first_variant = true;
        while ($variants = $this->get_variants($page)) {
            foreach ($variants as $variant) {
                if (!$first_variant) fwrite($fp, ',');
                if ($first_variant) $first_variant = false;

                $count_images = 0;
                if (empty($this->research_products[$variant->product_id])) {
                    $this->research_products[$variant->product_id] = $variant->filenames ? explode(',', $variant->filenames) : [];
                    // Считаю количество загруженых файлов
                    foreach ($this->research_products[$variant->product_id] as $img) {
                        if (is_file($image_dir . $img)) $count_images++;
                    }
                    // Записывю количество файлов на диске
                    $this->research_products[$variant->product_id] = $count_images;
                } else {
                    $count_images = $this->research_products[$variant->product_id];
                }

                fwrite($fp, json_encode([
                    'variant_id' => $variant->variant_id,
                    'count_images' => $count_images,
                    'price' => $variant->price
                ]));
            }
            $page++;
        }

        fwrite($fp, "],");

        if (self::$debug) {
            fwrite($fp, '"debug": ' . json_encode(self::print_debug()) . ',');
        }

        fwrite($fp, '"success": true');
        fwrite($fp, '}');

        fclose($fp);

        if (is_file($filename)) {
            header('Content-Type: application/json; charset=utf-8');
            readfile($filename);
            exit;
        }
        self::error('Что-то пошло не так! (');
    }

    /**
     * Возвращает варианты из таблицы
     * @param int $page
     * @return array|bool
     */
    private function get_variants($page = 1)
    {
        $limit = 1000;

        //if ($page > 2) return false;

        $sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page - 1) * $limit, $limit);

        $query = $this->db->placehold("SELECT v.product_id, v.external_id AS variant_id, (SELECT GROUP_CONCAT(filename) FROM __images AS i WHERE v.product_id = i.product_id) AS filenames, v.price FROM __variants AS v WHERE 1 ORDER BY v.id ASC {$sql_limit}");

        $this->db->query($query);

        return $this->db->results();
    }
}
