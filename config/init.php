<?php
    define('DEBUG', 1); // 1 - ошибки показываются, 0 - скрываются
    define('ROOT', dirname(__DIR__)); // указывает на корень ishop2.loc
    define('WWW', ROOT . '/public'); // указывает на папку public
    define('APP', ROOT . '/app'); // указывает на папку app
    define('CORE', ROOT . '/vendor/ishop/core'); // указывает на папку core
    define('LIBS', ROOT . '/vendor/ishop/core/libs'); // указывает на папку libs
    define('CACHE', ROOT . '/tmp/cache'); // указывает на папку cache
    define('CONF', ROOT . '/config'); // указывает на папку config
    define('LAYOUT', 'default'); // шаблон нашего сайта по умолчанию

    $app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}"; // url главной страницы
    $app_path = preg_replace('#[^/]+$#', '', $app_path); // url без index.php
    $app_path = str_replace('/public/', '', $app_path); // url главной страницы
    define('PATH', $app_path); // url главной страницы
    define('ADMIN', PATH . '/admin'); // путь к админке

    require_once ROOT . '/vendor/autoload.php'; // подключаем автозагрузчик