<?php

namespace ishop;

class Cache
{
    use TSingletone;

    public function set($key, $data, $seconds = 3600)
    {
        if ($seconds) { // если хотим кешировать данные, передали не 0
            $content['data'] = $data; // переданные данные
            $content['end_time'] = time() + $seconds; // конечное время на которое кешируем данные
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
                return true;
            }
            return false;
        }
    }

    public function get($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) { // если файл существует
            $content = unserialize(file_get_contents($file)); // получаем данные из файла
            if (time() <= $content['end_time']) { // не устарели ли кешированные данные
                return $content;
            }
            unlink($file); // если данные устарели удалим файл
        }
        return false; // если файл не существует вернем false
    }

    public function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) { // если файл существует
            unlink($file); // удалим файл
        }
    }
}