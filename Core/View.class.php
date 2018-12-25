<?php
//1. 定义命名空间
namespace Core;

//2. 定义类
class View
{
    //定义一个属性
    private $smarty;

    public function __construct()
    {
        //1. 引入smarty类文件
        include VENDOR_DIR.'smarty/Smarty.class.php';
        //2. 实例化smarty对象
        $this->smarty = new \Smarty;

        //根据控制器判断目录是否存在
        $dir = APP_DIR.PLAT.'/View/'.MODULE;
        if (!is_dir($dir)){
            //不存在就创建
            mkdir($dir);
        }
        //var_dump($this->smarty);
        //3. 设置相关属性
        $this->smarty->setTemplateDir($dir);
        $this->smarty->setCompileDir(APP_DIR.PLAT.'/View_c');
    }

    public function my_assign($name, $value)
    {
        $this->smarty->assign($name, $value);
    }

    public function my_display($file)
    {
        $this->smarty->display($file);
    }
}