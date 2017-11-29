<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $this->assign("selectStatus", "index");
      $this->display("column/column_y");
    }

    //后台登录
    public function admin(){
      $this->display("admin/login/index");
    }

    public function column(){
      $this->display("column/column_y");
    }

}
