<?php
namespace ishop\base;

use ishop\Db;

abstract class Model
{
    public $attributes = []; // массив свойств модели, который будет идентичев полям в базе данных
    public $errors = []; // будем складывать ошибки
    public $rules = []; // для правил валидации данных

    public function __construct()
    {
        Db::instance();
    }
}