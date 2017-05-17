<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午9:16
 */
class Route{
    protected $request = null;
    protected $delemiter = '/';
    protected $controller;
    protected $action;
    public function __construct()
    {
        $this->request = $_GET['r'];
        if(empty($this->request)){
            $this->to404();
        }
        $this->parseRequest();
    }

    protected function parseRequest(){
        $explode = explode($this->delemiter,$this->request);
        $this->controller = ucfirst(strtolower($explode[0]));
        $this->controller = ucfirst(strtolower($this->controller));
        $this->action = strtolower($explode[1]);
    }

    public function transfer(){
        $controller = 'controller\\'.$this->controller.'Controller';
        $action = $this->action;
        try{
           if(!class_exists($controller)){
                throw new Exception("控制器{$controller}不存在");
           }
           $c = new $controller();
           $c->controller = $this->controller;
           $c->action = $this->action;
           if(!method_exists($c,$action)){
               throw new Exception("操作{$action}不存在");
           }
            $c->$action();
        }catch (Exception $e){
            $this->to404($e->getMessage());
        }


    }

    public function to404($msg = '页面不存在'){
        echo $msg;
    }
}