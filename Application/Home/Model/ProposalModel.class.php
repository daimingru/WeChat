<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class ProposalModel extends BaseModel {

  //保存用户建议
  public function saveProposal($comment){
    $data = array();
    $rs = array();
    $status = array();
    $data['userid'] = S('userId');
    $data['comment'] = $this -> sensitiveWords($comment);
    $data['comment'] = $data['comment'] ? 0 : $comment;
    $data['create_time'] = date('Y:m:d H:i:s',time());
    $data['z'] = 0;
    $User = M("proposal");
    if($data['comment']){
      $rs = $User->add($data);
      if(!$rs){
        $status['status'] = 39001;
        $status['msg'] = '请不要乱搞';
      }else{
        $status['status'] = 200;
        $status['data'] = $data;
        $status['msg'] = '发表成功';
      }
    }else{
      $status['status'] = 39002;
      $status['msg'] = '请删除敏感词汇咯';
    }

    return $status;
  }

  //获取最3条建议
  public function getProposal($page){
    $data = array();
    $sql  = 'SELECT nickName,avatarUrl,comment,create_time,z,__PREFIX__proposal.id FROM __PREFIX__user INNER JOIN __PREFIX__proposal ON __PREFIX__user.id = __PREFIX__proposal.userid and __PREFIX__proposal.flag = 1  ORDER BY z desc LIMIT 3';
    $rs 	= $this->query($sql);
    if($rs){
      $data['top'] = $rs;
      $data['new'] = $this -> getNewProposal($page);
      $data['status'] = 200;
    }else{
      $data['status'] = 31404;
    }

    return $data;
  }

  //获取最新建议
  public function getNewProposal($page){
    $data = array();
    $page = ( $page - 1 ) * 10;
    $sql  = 'SELECT id from __PREFIX__proposal ORDER BY z desc LIMIT 3';
    $rs 	= $this->query($sql);

    foreach ($rs as $key => $value) {
      $rs[$key] = $value['id'];
    }

    $sql = 'SELECT nickName,avatarUrl,comment,create_time,z,__PREFIX__proposal.id from guitar_user INNER JOIN guitar_proposal ON __PREFIX__user.id = guitar_proposal.userid and __PREFIX__proposal.flag = 1 and __PREFIX__proposal.id not in ('.join(',',$rs).') ORDER BY create_time desc LIMIT '.$page.',10';
    $rs 	= $this->query($sql);

    return $rs;
  }

  //反馈建议点赞
  public function zProposal($id){
    $data = array();
    $Article = M("proposal");
    $Article->where('id='.$id)->setInc('z',1);
    if($Article){
      $data['status'] == 200;
    }else{
      $data['status'] == 31404;
    }
    return $data;
  }

}
