<?php
namespace App;

class MainController
{
    protected $view;
    protected $model;

    public function __construct()
    {
        $this->view  = new View();
        $this->model = new MainModel();
    }

    public function redirect($to)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$to);
    }
}