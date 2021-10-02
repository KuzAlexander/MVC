<?php
namespace ishop;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1); // режим разработки
        } else {
            error_reporting(0); // режим продакшен
        }
        set_exception_handler([$this, 'execptionHandler']);       
    }

    public function execptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | 
        Файл: {$file} | Строка: {$line}\n================\n", 3, ROOT . '/tmp/errors.log'); // логирует ошибку и отправляет в файл
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404)
    {
        http_response_code($responce); // отправляет заголовок с кодом 404
        if ($responce == 404 && !DEBUG) { // если 404 код и отладка выключена
            require WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }
}