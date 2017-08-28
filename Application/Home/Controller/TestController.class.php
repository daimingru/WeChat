<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
  //首页推荐
  public function index(){
    $m = D('Home/Recommend');
    $data = $m -> getIndexlist();
    $this->ajaxReturn($data);
  }

  //获取文章详情
  public function getArticle(){
    $id = I('id');
    $m = D('Home/Recommend');
    $data = $m -> getArticle($id);
    $this->ajaxReturn($data);
  }

  //获取吉他谱列表
  public function getScorelist(){
    $id = I('id');
    $m = D('Home/Score');
    $data = $m -> getScorelist($id);
    $this->ajaxReturn($data);
  }

  //获取吉他谱详情
  public function getImg(){
    $id = I('id');
    $data = array();
    $m = D('Home/Score');
    $data = $m -> getScoreDetails($id);
    $this->ajaxReturn($data);
  }

  //保存用户信息
  public function saveInfo(){
    $userinfo = I('userinfo');
    $code = I('code');
    $data = array();
    $data['userinfo']=$userinfo;
    $data['code']=$code;
    // $m = D('Home/User');
    // $data = $m -> saveInfo($userinfo,$code);
    $this->ajaxReturn($data);
  }

}
