<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){

      import('Org.Util.WeChat');
      $foo = new JSSDK();
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
