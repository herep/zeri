<?php
//1. 定义命名空间
namespace Core;

//2. 定义类
class Controller
{
    //定义一个视图属性
    protected $view;

    public function __construct()
    {
        $this->view = new View;
        //var_dump($this->view);
    }

    protected function success($msg, $url, $time=1)
    {
        echo $msg;
        header("Refresh:{$time};url={$url}");
        exit;
    }

    protected function error($msg, $url, $time=3)
    {
        echo $msg;
        header("Refresh:{$time};url={$url}");
        exit;
    }

    protected function assign($name, $value)
    {
        $this->view->my_assign($name, $value);
    }

    protected function display($file)
    {
        $this->view->my_display($file);
    }
}