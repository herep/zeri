<?php
//定义命名空间
namespace App\Home\Controller;

//引入空间的类元素
use \Core\Controller;

//定义Index控制器类
class IndexController extends Controller
{
    public function index()
    {
        echo "欢迎使用ICFrame框架!";
    }

}