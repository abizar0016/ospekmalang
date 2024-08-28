<?php

class Controller
{

    public function view($view, $data = [])
    {
        require_once '../public/views/' . $view . '.php';
    }
    public function database($database, $data = [])
    {
        require_once '../public/database/' . $database . '.php';
    }

    public function model($model){
        require_once '../app/models/'. $model . '.php';
        return new $model;
    }
}
