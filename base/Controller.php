<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午11:31
 */
namespace base;

class Controller{
    public $controller;
    public $action;
    public function __construct(){
        $this->beforeAction();
    }
    protected function beforeAction(){
        session_start();
    }

    public function error($msg = '非法操作'){
        echo $msg;
    }

    public function url($action = '',$controller = '',$params = ''){
        if(empty($controller)){
            $params = $action;
            $action = $this->action;
            $controller = $this->controller;
        }else{
            $params = $controller;
            $controller = $this->controller;
        }
        $url = "http://".$_SERVER['HTTP_HOST']."/index.php?r={$controller}/{$action}{$params}";
        return $url;
    }

    public function redirect($url){
        header("location:{$url}");
    }
}