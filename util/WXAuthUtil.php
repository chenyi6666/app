<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-29
 * Time: 下午8:03
 */
namespace util;

class WXAuthUtil{
    private $app_id = 'wx24d4cc7718b38a4e';
    function doAuth(){
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->app_id.
        "&redirect_uri=REDIRECT_URI".
        "&response_type=code".
        "&scope=SCOPE#wechat_redirect";
    }
}