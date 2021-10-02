<?php
namespace ishop;

class Registry
{
    use TSingletone;

    public static $properties = []; // складываем все свойства

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value; // складываем в массив ключи и значения
    }

    public function getProperty($name)
    {
        if (isset(self::$properties[$name])) { // проверяем если сушествует свойство, то его возвращаем
            return self::$properties[$name];
        }
        return null;
    }

    public function getProperties() // метод для дебага, будет возвращать все свойства (массив)
    {
        return self::$properties;
    }
}