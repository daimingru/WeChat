<?php
namespace Home\Controller;
use Think\Controller;
class WeChatController extends Controller {
    public function index(){

      $data['status']  = 1;
      $data['content'] = 2;
      $this->ajaxReturn($data);
    }
}
