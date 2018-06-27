<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\WeChat;

class IndexController extends Controller {

    public function index(){

      $foo = WeChat::getSignPackage();
      $this->assign("selectStatus", "index");
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
