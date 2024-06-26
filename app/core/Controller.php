<?php
class Controller
{
    public function model($model)
    {
        if (file_exists(_DIR_ROOT . "/app/Models/" . $model . ".php")) {
            require_once(_DIR_ROOT . "/app/Models/" . $model . ".php");
            if (class_exists($model)) {
                return new $model;
            }
        }
        return false;
    }

    public function render($view, $data = [])
    {
        extract($data);

        if (file_exists(_DIR_ROOT . "/app/Views/" . $view . ".php")) {
            require_once(_DIR_ROOT . "/app/Views/" . $view . ".php");
        }
    }
}
