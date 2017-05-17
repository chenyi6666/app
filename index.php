<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午8:41
 */
header("Content-type:text/html;charset=UTF-8");
ini_set('display_errors',1);
require __DIR__."/autoload.php";
$route= new \Route();
$route->transfer();
