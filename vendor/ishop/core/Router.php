<?php
namespace ishop;

class Router 
{
    protected static $routes = []; // таблица маршрутров
    protected static $route = []; // текущий маршрут

    public static function add($regexp, $route = []) // $regexp - шаблон регулярного выражения
    {
        self::$routes[$regexp] = $route;
    }
   
    public static function getRouters()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) { // Проверим, есть ли у нас класс с именем $controller
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action'; // название метода 
                if (method_exists($controllerObject, $action)) { // Проверим есть ли метод в объекте, если есть, то вызовем
                    $controllerObject->$action(); 
                    $controllerObject->getView();
                } else {  // Если метода нет, то выбросим исключение
                    throw new \Exception("Метод $controller::$action не найден", 404);
                }
            } else {  // Если класса нет, то выбросим исключение 
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        } else {
            throw new \Exception('Страница не найдена', 404); // Выбросим исключение если страница не найдена
        }
    }
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v) { // сорханяем только элементы со строковым ключем
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) { // если экшен пустой, то присвоем значение index
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true; 
            }
        }
        return false;
    }

    // вид CamelCase контроллера
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name))); // Приводим строку page-name к PageName
    }

    // вид camelCase экшена
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url) { // не пуста ли строка $url
            $params = explode('&', $url, 2); // разбить $url на массив из 2 элементов (разграничитель &)
            if (false === strpos($params[0], '=')) { // если в строке $params[0] нет '='
                return trim($params[0], '/'); // обрежим конечный слеш
            } else {
                return '';
            }
        }
    }
}