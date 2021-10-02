<?php

namespace ishop\base;

class View
{
    public $route; 
    public $controller; 
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = []; 
    public $meta = []; 

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) { // явяляется ли $data массивом
            extract($data); // извлекаем переменные из $data, теперь они доступны в виде или шаблоне
        }
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php"; // путь до файла вида
        if (is_file($viewFile)) { // если файл существует
            ob_start();
            require_once $viewFile; // подключаем файл
            $content = ob_get_clean();
        } else {
            throw new \Exception("Не найден вид {$viewFile}", 500); // выбрасываем исключение
        }

        if (false !== $this->layout) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php"; // путь до файла шаблона
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Не найден шаблон {$this->layout}", 500);
            }
        }
    }

    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $output;
    }

}