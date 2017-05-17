<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-25
 * Time: 上午9:45
 */
namespace base;
class Model{
    private static $_model = null;
    public $db;
    private $config = null;
    private function __construct()
    {
        $config = $this->getConfig();
        $dsn = $config['dbms'].":host=".$config['host'].';dbname='.$config['dbname'];
        $this->db = new \PDO($dsn,$config['username'],$config['passwd']);
        $this->db->query('set names utf8');
    }

    public static function getModel(){
        if(is_null(self::$_model)){
            self::$_model = new self();
        }
        return self::$_model;
    }

    public function getConfig(){
        if(is_null($this->config)){
            $configs = require(__DIR__."/../config.php");
            $this->config = $configs['db'];
        }
        return $this->config;
    }

    public function find($sql){
        $stm = $this->db->query($sql);
        return $stm->fetch();
    }

    public function findAll($sql){
        $stm = $this->db->query($sql);
        return $stm->fetchAll();
    }

    public function exec($sql){
        $num = $this->db->exec($sql);
        return $num;
    }
}