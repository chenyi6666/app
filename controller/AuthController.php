<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 17-4-24
 * Time: 下午11:47
 */
namespace controller;
use base\Controller;
use base\Model;

class AuthController extends Controller{
    protected $app_id = 'wx6939dce2e3b5faca';
    protected $app_secret = 'd0953b621ae32a581398671b98ffced6';
    public function getCode(){
        $back_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?r=auth/getToken';
        $code_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->app_id.
            "&redirect_uri=".urlencode($back_url).
            "&response_type=code".
            "&scope=snsapi_userinfo#wechat_redirect";
        header("location:{$code_url}");
    }

    public function getToken(){
        $code = htmlentities($_GET['code'],ENT_QUOTES);
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->app_id.
        "&secret=".$this->app_secret.
        "&code={$code}&grant_type=authorization_code ";
        $return = @file_get_contents($token_url);
        if($return){
            $return = json_decode($return);
            $open_id = addslashes($return->openid);
            $user = Model::getModel()->find("select * from user where open_id = '$open_id'");
            if(!$user){
                Model::getModel()->exec("insert into user (open_id) values ('$open_id')");
            }
            $_SESSION['user_id'] = $open_id;
            $this->redirect($_COOKIE['refer']);
        }
    }
}
