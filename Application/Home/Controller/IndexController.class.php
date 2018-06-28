<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\WeChat;

class IndexController extends Controller {

    public function index(){
        $foo = new WeChat();
        $WeChat = $foo->getSignPackage();
        var_dump($WeChat);
        exit();
        $this->assign("selectStatus", $WeChat);
        $this->display("index/index");
    }

    //后台登录
    public function admin(){
        $this->display("admin/login/index");
    }

    public function column(){
        $foo = new WeChat();
        $WeChat = $foo->getSignPackage();
        var_dump($WeChat);
        $this->assign("selectStatus", $WeChat);
        $this->display("index/index");
    }

}
