<?php
//定义命名空间
namespace Core;

//1. 定义初始化类
class App
{
    //初始化路径常量
    public static function initDir()
    {
        /*
        $str = str_replace('\\', '/', __DIR__); // D:/ICFrame/Core
        str_replace('Core', '', $str); //D:/ICFrame/
        */
       define('ROOT_DIR',str_replace('Core', '', str_replace('\\', '/', __DIR__))); //D:/ICFrame/
       define('APP_DIR', ROOT_DIR.'App/'); //D:/ICFrame/App/
       define('CONFIG_DIR', ROOT_DIR.'Config/'); //D:/ICFrame/Config/
       define('CORE_DIR', ROOT_DIR.'Core/'); //D:/ICFrame/Core/
       define('PUBLIC_DIR', ROOT_DIR.'Public/'); //D:/ICFrame/Public/
       define('UPLOAD_DIR', ROOT_DIR.'Upload/'); //D:/ICFrame/Upload/
       define('VENDOR_DIR', ROOT_DIR.'Vendor/'); //D:/ICFrame/Vendor/

    }
    //初始化字符集
    public static function initCharset()
    {
        header('Content-type:text/html;charset=utf-8');
    }

    //初始化配置文件
    public static function initConfig()
    {
        //全局化
        global $config;
        //加载配置选项
        $config = include CONFIG_DIR.'config.php';

        //var_dump($config);
    }

    //解析URL
    public static function initURL()
    {
        //解析p/m/a参数
        $p = isset($_GET['p']) ? $_GET['p'] : 'Home';
        $m = isset($_GET['m']) ? $_GET['m'] : 'Index';
        $a = isset($_GET['a']) ? $_GET['a'] : 'index';

        //全局化
        define('PLAT', $p);
        define('MODULE', $m);
        define('ACTION', $a);
    }

    //请求分发
    public static function initDispatch()
    {
        //引入控制器类文件
        //include APP_DIR.PLAT."/Controller/".MODULE."Controller.class.php";

        //带命名空间
        // \App\Home\Controller\IndexController
        $c = '\App\\'.PLAT.'\Controller\\'.MODULE.'Controller';
        //var_dump($c);exit;
        //实例化控制器对象
        $controller = new $c;

        $a = ACTION;
        //调用index方法
        $controller->$a();
    }

    //定义一个静态方法做为自动加载
    public static function load($class_name)
    {
        //var_dump($class_name);
        $file = str_replace('\\','/', $class_name);// App/Home/Controller/IndexController
        //echo $file;exit;
        //拼接路径
        $file_path = ROOT_DIR.$file.'.class.php'; // D:/ICFrame/App/Home/Controller/IndexController.class.php
        if (file_exists($file_path)){
            include $file_path;
        }
    }

    public static function initAutoload()
    {
        spl_autoload_register('self::load');
    }

    public static function run()
    {
        self::initCharset();
        self::initDir();
        self::initConfig();
        self::initAutoload();
        self::initURL();
        self::initDispatch();
        //echo '欢迎使用ICFrame';
    }
}