<?php
//1. 定义命名空间
namespace Core;

//3. 引入空间类元素
use \PDO;
use \PDOException;

//2. 定义类
class Dao
{
    //连接参数
    private $type;
    private $host;
    private $port;
    private $user;
    private $password;
    private $dbname;
    private $charset;

    private $pdo;

    //构造方法
    public function __construct($con)
    {
        $this->type = isset($con['type']) ? $con['type'] : 'mysql';
        $this->host = isset($con['host']) ? $con['host'] : 'localhost';
        $this->port = isset($con['port']) ? $con['port'] : '3306';
        $this->user = isset($con['user']) ? $con['user'] : 'root';
        $this->password = isset($con['password']) ? $con['password'] : '123456';
        $this->dbname = isset($con['dbname']) ? $con['dbname'] : '';
        $this->charset = isset($con['charset']) ? $con['charset'] : 'utf8';

        //实例化PDO对象
        try{
            $this->pdo = new PDO("{$this->type}:host={$this->host};dbname={$this->dbname};charset={$this->charset}", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            //在线上环境中, 一般将错误保存到日志中, 为了方便, 我们直接打印
            echo '数据库连接失败'.'<br>';
            echo '错误信息:'.$e->getMessage().'<br>';
            exit;
        }

        //var_dump($this->pdo);
    }
    //读操作

    //写操作
    /**
     * 执行数据库的写操作(Insert/Update/Delete)
     * @param  [string] $sql [需要执行的sql语句]
     * @return [mix]      [受此语句影响的行数]
     */
    public function exec($sql)
    {
        try{
            $rs = $this->pdo->exec($sql);
        }catch(PDOException $e){
            echo "数据库写入失败!".'<br>';
            echo "出错的sql语句:".$sql.'<br>';
            echo '出错信息:'.$e->getMessage().'<br>';
            exit;
        }

        return $rs;
    }

    /**
     * 执行数据库读取操作(Select)
     * 执行sql语句, 返回所有记录(二维数组)
     * @param  [string] $sql [需要执行的sql语句]
     * @return [type]      [description]
     */
    public function getAll($sql)
    {
        try{
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "数据库读取失败!".'<br>';
            echo "出错的sql语句:".$sql.'<br>';
            echo '出错信息:'.$e->getMessage().'<br>';
            exit;
        }
    }

    /**
     * 执行sql语句, 返回一行记录(一维数组)
     * @param  [string] $sql [需要执行的sql语句]
     * @return [type]      [description]
     */
    public function getRow($sql)
    {
        try{
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "数据库读取失败!".'<br>';
            echo "出错的sql语句:".$sql.'<br>';
            echo '出错信息:'.$e->getMessage().'<br>';
            exit;
        }
    }
}
