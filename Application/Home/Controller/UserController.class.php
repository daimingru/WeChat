<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

  //用户收藏
  public function collectorWrite(){
    $id = I('id');
    $type = I('type');
    $m = D('Home/User');
    $data = $m -> collectorWrite($id,$type);
    $this->ajaxReturn($data);
  }

}
