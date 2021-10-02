<?php

namespace ishop;

class App 
{
    public static $app; // свойство через которое будем получать доступ к параметрам

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/'); // что ищет пользователь
        session_start(); // стартуем сессию
        self::$app = Registry::instance(); // в $app содержится объект нашего реестра
        $this->getParams();
        new ErrorHandler(); // создадим объект класса обработки ошибок
        Router::dispatch($query); // передаем запрос маршрутизатору
    }

    protected function getParams() // метод возвращает все настройки из params.php
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }
}