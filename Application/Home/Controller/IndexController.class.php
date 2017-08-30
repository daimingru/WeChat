<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $this->assign("selectStatus", "index");
      $this->display("index/index");
    }

    //后台登录
    public function admin(){
      $this->display("admin/login/index");
    }
}
