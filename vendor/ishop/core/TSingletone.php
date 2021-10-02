<?php
namespace ishop;

trait TSingletone
{
    private static $instance;

    public static function instance()
    {
        if (self::$instance === null) { // если $instance пуст, то положим в него сам объект
            self::$instance = new self;
        }
        return self::$instance;
    }
}