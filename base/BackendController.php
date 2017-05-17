<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午11:31
 */
namespace base;

class BackendController extends Controller {

    protected function beforeAction(){
        parent::beforeAction();
//        if(!isset($_SESSION['user_id'])){
//            $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//            setcookie('refer',$url);
//            header("location:/index.php?r=auth/getCode");
//            exit;
//        }
    }
}