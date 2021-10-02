<?php

use ishop\Router;

// default routes
// Админские правила
Router::add('^admin$', ['controller'=>'Main', 'action'=>'index', 'prefix'=>'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'=>'admin']);

// Пользовательские правила
// ^ - начало строки, $ - конец строки. Пустая строка или наш ishop2.loc
Router::add('^$', ['controller'=>'Main', 'action'=>'index']);
// controller, action - ключи в ассоц. массиве. ?...? - не обязательный элемент. [a-z-] - буквы от a до z и еще дефис.
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');