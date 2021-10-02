<?php

namespace ishop\base;

abstract class Controller
{
    public $route; // маршрут
    public $controller; 
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = []; // данные которые будем передавать из контроллера в вид
    public $meta = ['title' => '', 'desc' => '', 'keywords' => '']; // мета данные: тайтл, дескрипшен и кейвордс

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta); // создали обьект вида
        $viewObject->render($this->data); // вызвали метод рендер у обьекта вида
    }
    
    public function set($data) 
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}