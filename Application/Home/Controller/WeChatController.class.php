<?php
namespace Home\Controller;
use Think\Controller;
class WeChatController extends Controller {
    public function index(){
      $orderId = I("orderId");
      $rejectionRemarks = I("rejectionRemarks");
      $data['status']  = $orderId;
      $data['content'] = $rejectionRemarks;
      $this->ajaxReturn($data);
    }
}
