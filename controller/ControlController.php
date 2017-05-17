<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午11:47
 */
namespace controller;
use base\BackendController;
use base\Controller;
use base\Model;

class ControlController extends BackendController{
    public function getControl()
    {
        $control_id = intval($_GET['control_id']);
        $sql = "select * from remote_control where id = {$control_id}";
        $control = Model::getModel()->find($sql);
        echo $control['html'];
    }

    public function publish(){
        $key = htmlentities($_GET['command'],ENT_QUOTES);
        $type = htmlentities($_GET['type'],ENT_QUOTES);
        $command = 'mosquitto_pub -t remote -h 192.168.43.159 -m "{\"remote\":\"'.$type.'\",\"key\":\"'.$key.'\"}"';
        exec($command);
        echo $key;
    }
}
