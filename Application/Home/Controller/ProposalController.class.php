<?php
namespace Home\Controller;
use Think\Controller;
class ProposalController extends Controller {

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
