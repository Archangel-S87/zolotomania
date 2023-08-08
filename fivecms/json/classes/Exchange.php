<?php

/*
 * Класс определяет и подключает нужные типы для синхронизации. Содержит только общие моды.
 * Для изменения логики синхронизации смотри соответствующий класс типа в папке classes
 * Для работы нужна базовая авторизация на сервере!
 *
 * Примеры:
 *  http://site.ru/fivecms/json/1c_exchange.php?type=catalog?mode=check_auth
 *
 * Основные моды:
 *  check_auth - проверяет авторизацию на сервере, выдаёт название сессии и её id. Последующие
 *      запросы производить с cookies вида session_name: session_id.
 *  init - подготавливает временный каталог (удаляет старые файлы и папки). Выдаёт возможность
 *      сервера работать с архивами zip и максимальный размер загружаемого файла в байтах.
 *  file - загружает прикреплённый файл на сервер. Должен быть метод POST!
 *      Обязательный параметр filename=<имя файла> с расширением. Если расширение zip после
 *      загрузки файл будет разархивирован.
 *
 * Моды могут быть добавлены и/или модифицорованы. Смотри класс типа!
 */

require_once 'api/Fivecms.php';


class Exchange extends Fivecms
{
    /**
     * Хранит список предупреждений
     * @var array
     */
    protected static $warning = [];

    /**
     * Максимальное число предупреждений
     * @var int
     */
    protected static $max_warning_count = 15;

    /**
     * Режим отладки
     * @var array|bool
     */
    protected static $debug = true;

    /**
     * Базовые методы
     * @var array
     */
    protected static $base_mods = ['check_auth', 'init', 'file'];

    /**
     * Текущий запрос
     * @var Exchange
     */
    protected static $request_exchange;

    /**
     * Что синхранизируем
     * @var array
     */
    private $types = ['sales', 'catalog', 'users', 'report'];

    /**
     * Что делаем
     * @var array
     */
    protected $mods = [];

    /**
     * Вызваный мод синхронизации
     * @var string
     */
    private $mode_name;

    /**
     * Вызваный класс синхронизации
     * @var self
     */
    private $type;

    /**
     * Название вызванного класса
     * @var string
     */
    private $type_name;

    /**
     * Каталог для хранения временных файлов
     * @var string
     */
    protected $temp_dir = 'temp';

    /**
     * Максимальный размер файла для загрузки
     * @var string
     */
    private $file_limit = '100M';

    /**
     * Разрешённые типы файлов
     * @var array
     */
    protected $allowed_file_types = ['json', 'zip', 'jpg', 'jpeg', 'png'];


    /**
     * Добавляет строку предупреждения в ответ
     * @param string $message
     */
    public static function add_warning(string $message)
    {
        self::$warning[] = $message;
        if (count(self::$warning) >= self::$max_warning_count) {
            self::error('The current operation is interrupted. Warning limit exceeded.', 403);
        }
    }

    /**
     * Отправляет ответ клиенту в формате json
     * @param array $request |string
     * @return void
     */
    public static function response($request = [])
    {
        header('Content-Type: application/json; charset=utf-8');

        $default = ['success' => true];

        if (!is_array($request)) $request = ['message' => $request];
        $request = array_merge($default, $request);

        if (self::$warning) $request['warning'] = self::$warning;

        if (self::$debug) {
            $request['debug'] = self::print_debug();
            self::print_log($request);
        }

        print json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Формирует информацию для отладки
     * @return array
     */
    protected static function print_debug() {
        $memory = memory_get_usage(true) - self::$debug['start_memory'];
        $time = microtime(true) - self::$debug['start_time'];

        if ($time < 10) {
            $time = @round($time, 4) . ' s';
        } else {
            $time = sprintf('%02d:%02d:%02d', $time / 3600, ($time % 3600) / 60, ($time % 3600) % 60);
        }

        return [
            'memory' => self::return_size($memory),
            'time' => $time
        ];
    }

    /**
     * Пишет ответ сервера в файл лога
     * @param $response mixed
     */
    private static function print_log($response)
    {
        // Не пишем базовые моды в лог
        if (in_array(self::$request_exchange->mode_name, ['check_auth', 'init'])) return;

        $filename = self::$request_exchange->temp_dir . 'log.txt';

        $data = [];
        if (file_exists($filename)) {
            $data = json_decode(file_get_contents($filename), true) ?: [];
        }

        while (count($data) > 50) {
            array_shift($data);
        }

        parse_str($_SERVER['QUERY_STRING'], $request);
        $response = array_merge($request, $response);

        $data[date('Y-m-d H:i:s')] = $response;
        $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($filename, $data);
    }

    /**
     * Отправляет клиенту ошибку в формате json. Останавливает выполнение скрипта
     * @param $message
     * @param int $code
     */
    public static function error($message, $code = 404)
    {
        http_response_code($code);
        self::response(['success' => false, 'code' => $code, 'error' => $message]);
        exit;
    }

    public static function error_read_file($file, Exception $exception)
    {
        $file = basename($file);
        self::error("При чтении файла $file произошла ошибка " . $exception->getMessage());
    }

    /**
     * @param $val
     * @return int|string
     */
    public static function return_bytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        $val = intval($val);

        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }

    /**
     * @param $size
     * @return string
     */
    public static function return_size($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }


    public function __construct()
    {
        if (self::$debug) {
            error_reporting(E_ALL);
            ini_set('display_startup_errors', 1);
            ini_set('display_errors', '1');

            self::$debug = [
                'start_memory' => memory_get_usage(),
                'start_time' => microtime(true)
            ];
        }

        parent::__construct();

        $this->mods = array_merge(self::$base_mods, $this->mods);
        $this->temp_dir = JSON_DIR . $this->temp_dir . '/';

        // Устанавливает временную папку для типов
        if (get_class($this) != self::class) {
            $folder = str_replace(self::class, '', get_class($this));
            $this->temp_dir .= strtolower($folder) . '/';
        }
    }

    /**
     * Подключает нужный класс
     * @return bool
     */
    public function start_type()
    {
        $this->type_name = $type = $this->request->get('type');
        if ($type && in_array($type, $this->types)) {
            $class_name = 'Exchange' . ucfirst($type);
            $path = JSON_DIR . 'classes/' . $class_name . '.php';
            if (file_exists($path)) {
                require_once $path;
                $this->type = new $class_name();
                return true;
            } else {
                self::error('Class not defined', 501);
            }
        } else {
            self::error('Type not defined', 501);
        }
        return false;
    }

    /**
     * Запускает нужный экшен
     * @return void
     */
    public function start_mode()
    {
        $mode = $this->mode_name = $this->request->get('mode');
        $type = $this->type;
        self::$request_exchange = $this;
        if ($mode && in_array($mode, $type->mods) && method_exists($type, $mode)) {
            call_user_func([$type, $mode]);
        } else {
            self::error('Mode not defined', 501);
        }
    }

    protected function check_auth()
    {
        $this->response([
            'session_name' => session_name(),
            'session_id' => session_id()
        ]);
    }

    protected function init()
    {
        // Очистка временного каталога
        if (is_dir($this->temp_dir)) {
            $this->del_tree($this->temp_dir);
        }

        $server_size = self::return_bytes(ini_get('post_max_size'));
        if ($this->file_limit) {
            $current_size = self::return_bytes($this->file_limit);
            $size = $server_size < $current_size ? $server_size : $current_size;
        } else {
            $size = $server_size;
        }

        $this->response([
            'zip' => extension_loaded('zip') ? 'yes' : 'no',
            'file_limit' => $size
        ]);
    }

    protected function file()
    {
        $file = $this->request->get('filename');
        $filename = basename($file);

        if (!$eot = $this->check_allowed_file_type($filename)) {
            self::error('File not allowed', 403);
        }

        $is_archive = $eot == 'zip';
        $is_part = false;

        if ($is_archive) {
            // Если архив помещаеи в каталог archive
            $this->temp_dir .= 'archive/';
            // Если архив является частью
            if ($is_part = preg_match('/_part_[\d]+/i', $filename, $matches)) {
                $filename = str_replace($matches[0], '', $filename);
            }
        } elseif (!$is_archive && $eot != 'json') {
            // Если изображение
            $path = explode('/', $file);
            array_pop($path);
            foreach ($path as $dir_name) {
                if (!$dir_name) continue;
                if (stristr($dir_name, '.') !== false) {
                    self::error("Failed path {$file}", 403);
                }
                $this->temp_dir .= $dir_name . '/';
            }
        }

        // Создание каталога если нет
        if (!is_dir($this->temp_dir)) mkdir($this->temp_dir, 0777, true);

        $file = $this->temp_dir . $filename;

        // Распакавать архив из папки temp_dir если он есть
        $unpacking = $this->request->get('unpacking');
        if (!$unpacking || !$is_archive || !file_exists($file)) {

            $input_stream = fopen('php://input', 'rb');
            $output_stream = fopen($file, 'ab');

            if ($input_stream && $output_stream) {
                if (!stream_copy_to_stream($input_stream, $output_stream)) {
                    self::error("Failed to write file {$filename}", 500);
                }
                fclose($input_stream);
                fclose($output_stream);
            } else {
                self::error("Unable to create file {$filename}", 500);
            }

        }

        // распаковка архива
        if ($is_archive) {
            $zip = new ZipArchive;
            if ($zip->open($file) === true) {
                $zip->extractTo(str_replace('archive/', '', $this->temp_dir));
                $zip->close();
            } elseif ($is_part) {
                self::add_warning('Transfer the missing parts of the archive, after which it will be unpacked automatically');
            } else {
                self::error('Unable to read archive', 500);
            }
        }

        $this->response();
    }

    /**
     * Проверяет название файла в запросе
     * @return string
     */
    protected function check_import_file()
    {
        $filename = basename($this->request->get('filename'));

        if (!$this->check_allowed_file_type($filename)) {
            self::error('File not allowed', 415);
        }

        if (stristr($filename, 'import') === false) {
            self::error('File named import* not found');
        }

        if (!file_exists($this->temp_dir . $filename)) {
            self::error("File {$filename} not found");
        }

        return $filename;
    }

    /**
     * @param $filename
     * @return string|bool
     */
    protected function check_allowed_file_type($filename)
    {
        $file = explode('.', $filename);
        $eot = end($file);
        return in_array($eot, $this->allowed_file_types) ? $eot : false;
    }

    /**
     * Рекурсивно удаляет каталог
     * @param $dir
     * @return bool
     */
    protected function del_tree($dir)
    {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                $this->del_tree("$dir/$file");
            } else {
                unlink("$dir/$file");
            }
        }
        return rmdir($dir);
    }

    /**
     * Рекурсивно очищает каталог
     * @param $path
     */
    protected function clean_dir($path)
    {
        $path = rtrim($path, '/') . '/';
        $handle = opendir($path);
        for ($i = 0; false !== ($file = readdir($handle)); $i++)
            if ($file != '.' && $file != '..') {
                $full_path = $path . $file;
                if (is_dir($full_path)) {
                    $this->clean_dir($full_path);
                    rmdir($full_path);
                } else {
                    unlink($full_path);
                }
            }
        closedir($handle);
    }
}
