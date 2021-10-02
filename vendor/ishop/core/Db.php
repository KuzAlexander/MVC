<?php

namespace ishop;

use \RedBeanPHP\R;

class Db
{
    use TSingletone;

    protected function __construct()
    {
        $db = require_once CONF . '/config_db.php';

        R::setup($db['dsn'], $db['user'], $db['pass']); // подключение к БД
        
        if (!R::testConnection()) { // проверка установленно ли соединение
            throw new \Exception('Нет соединения с БД', 500);
        } 

        R::freeze(true); // запретить изменять базу данных автоматически
        if (DEBUG) {
            R::debug(true, 1); // включим режим отладки
        }
    }

}