<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午8:43
 */

function autolaod($class){
    $arr = explode("\\",$class);
    $path = __DIR__.'/'.implode("/",$arr).'.php';
    if(is_file($path)){
        include $path;
    }
}
spl_autoload_register("autolaod");