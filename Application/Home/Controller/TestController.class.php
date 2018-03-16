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
    $m = D('Home/User');
    $data = $m -> saveInfo($userinfo,$code);
    $this->ajaxReturn($data);
  }


  //豆瓣电影获取load电影列表
  public function load(){

    $data = file_get_contents('Application/Home/json/douban.json');
    $data = json_decode($data, true);
    $this->ajaxReturn($data);

  }

  //豆瓣电影上拉刷新
  public function up(){

    $data = file_get_contents('Application/Home/json/doubanup.json');
    $data = json_decode($data, true);
    $this->ajaxReturn($data);

  }

  //豆瓣电影下拉加载
  public function down(){

    $userinfo = I('tabId');
    if( $userinfo == 'hot' ){
      $data = file_get_contents('Application/Home/json/doubandown.json');
    }else{
      $data = file_get_contents('Application/Home/json/doubandowna.json');
    }
    $data = json_decode($data, true);
    $this->ajaxReturn($data);

  }

  //豆瓣电影地区刷新
  public function city(){

    $data = file_get_contents('Application/Home/json/doubancity.json');
    $data = json_decode($data, true);
    $this->ajaxReturn($data);

  }

}
