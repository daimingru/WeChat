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

  //保存用户信息
  public function saveInfo(){
    $userinfo = I('userinfo');
    $code = I('code');
    $m = D('Home/User');
    $data = $m -> saveInfo($userinfo,$code);
    $this->ajaxReturn($data);
  }

  //用户收藏
  public function getCollect(){
    $m = D('Home/User');
    $data = $m -> getCollect($userinfo,$code);
    $this->ajaxReturn($data);
  }

  //用户反馈建议
  public function saveProposal(){
    $m = D('Home/Proposal');
    $comment = I('comment');
    $data = $m -> saveProposal($comment);
    $this->ajaxReturn($data);
  }

  //用户反馈建议
  public function getProposal(){
    $page = I('page');
    $m = D('Home/Proposal');
    $data = $m -> getProposal($page);
    $this->ajaxReturn($data);
  }

}
