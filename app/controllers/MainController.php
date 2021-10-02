<?php

namespace app\controllers;

use \RedBeanPHP\R;
use \ishop\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = R::findAll('test'); // получить статьи из БД (Статья1 и Статья2)
        // debug($posts);
        // debug($this->route);
        // echo __METHOD__;
        $this->setMeta('Главная страница', 'Описание', 'Ключевики');

        $name = 'John';
        $age = 30;
        $names = ['Andrey', 'Jane', 'Mike'];
        $cache = Cache::instance();
        // $cache->set('test', $names);
        $cache->delete('test');
        $data = $cache->get('test');
        if (!$data) {
            $cache->set('test', $names);
        }
        debug($data);
        $this->set(compact('name', 'age', 'names', 'posts'));
    }
}