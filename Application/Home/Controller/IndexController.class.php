<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\WeChat;

class IndexController extends Controller {

    public function index(){
        $foo = new WeChat();
        $WeChat = $foo->getSignPackage('wx7fde6fb244527847','e61d08e0555fdd397d2c2111d685bc18');
        $this->assign("selectStatus", $WeChat);
        $this->display("index/index");
    }

    //后台登录
    public function admin(){
        $this->display("admin/login/index");
    }

    public function column(){
        $this->display("column/column_y");
    }

}
