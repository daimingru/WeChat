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
    $data['comment'] = $this -> textEncode($data['comment']);
    $data['comment'] = $data['comment'] ? 0 : $comment;
    $data['create_time'] = date('Y:m:d H:i:s',time());
    $data['z'] = 0;
    $User = M("proposal");
    if($data['comment']){
      // $rs = $User->add($data);
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
    $status['comment'] = $this -> textEncode($comment).'1';
    return $status;
  }

  //获取最热3条建议
  public function getProposal($page){
    $data = array();
    $sql  = 'SELECT nickName,avatarUrl,comment,__PREFIX__proposal.create_time,z,__PREFIX__proposal.id,__PREFIX__attitude.proposal_status
            FROM (__PREFIX__user INNER JOIN __PREFIX__proposal ON __PREFIX__user.id = __PREFIX__proposal.userid and __PREFIX__proposal.flag = 1 and __PREFIX__proposal.z > 0)
            LEFT JOIN __PREFIX__attitude ON __PREFIX__proposal.id = __PREFIX__attitude.proposal_id ORDER BY z desc LIMIT 3';
    $rs 	= $this->query($sql);
    if($rs){
      $data['top'] = $rs;
      $data['new'] = $this -> getNewProposal($page,count($data['top']));
      $data['status'] = 200;
    }else{
      $data['new'] = $this -> getNewProposal($page,count($data['top']));
      $data['status'] = 200;
    }

    return $data;
  }

  //获取最新建议
  public function getNewProposal($page,$length){
    $data = array();
    $page = ( $page - 1 ) * 10;
    $rs = array();
    if( $length >= 3 ){

      $length = 3;
      $sql  = 'SELECT id from __PREFIX__proposal ORDER BY z desc LIMIT '.$length;
      $rs 	= $this->query($sql);
      foreach ($rs as $key => $value) {
        $rs[$key] = $value['id'];
      }

      $sqlNew = 'SELECT nickName,avatarUrl,comment,__PREFIX__proposal.create_time,z,__PREFIX__proposal.id,__PREFIX__attitude.proposal_status
          from (__PREFIX__user INNER JOIN __PREFIX__proposal ON __PREFIX__user.id = __PREFIX__proposal.userid and __PREFIX__proposal.flag = 1 and __PREFIX__proposal.id not in ('.join(',',$rs).'))
          LEFT JOIN __PREFIX__attitude ON __PREFIX__proposal.id = __PREFIX__attitude.proposal_id
          ORDER BY __PREFIX__proposal.create_time desc LIMIT '.$page.',10';

    }elseif( $length == 0 ){

      $sqlNew = 'SELECT nickName,avatarUrl,comment,__PREFIX__proposal.create_time,z,__PREFIX__proposal.id,__PREFIX__attitude.proposal_status
          from (__PREFIX__user INNER JOIN __PREFIX__proposal ON __PREFIX__user.id = __PREFIX__proposal.userid and __PREFIX__proposal.flag = 1 )
          LEFT JOIN __PREFIX__attitude ON __PREFIX__proposal.id = __PREFIX__attitude.proposal_id
          ORDER BY __PREFIX__proposal.create_time desc LIMIT '.$page.',10';

    }else{

      $sql  = 'SELECT id from __PREFIX__proposal ORDER BY z desc LIMIT '.$length;
      $rs 	= $this->query($sql);
      foreach ($rs as $key => $value) {
        $rs[$key] = $value['id'];
      }

      $sqlNew = 'SELECT nickName,avatarUrl,comment,__PREFIX__proposal.create_time,z,__PREFIX__proposal.id,__PREFIX__attitude.proposal_status
          from (__PREFIX__user INNER JOIN __PREFIX__proposal ON __PREFIX__user.id = __PREFIX__proposal.userid and __PREFIX__proposal.flag = 1 and __PREFIX__proposal.id not in ('.join(',',$rs).'))
          LEFT JOIN __PREFIX__attitude ON __PREFIX__proposal.id = __PREFIX__attitude.proposal_id
          ORDER BY __PREFIX__proposal.create_time desc LIMIT '.$page.',10';

    }

    $rs 	= $this->query($sqlNew);


    return $rs;
  }

  //反馈建议点赞
  public function zProposal($id){
    $data = array();
    $rs = array();
    $User = M("attitude");
    $Article = M("proposal");
    $proposal_status = $User->where('proposal_id='.$id)->getField('proposal_status');
    if( $proposal_status != null ){

      $data['proposal_status'] = $proposal_status ? 0 : 1;
      $data['create_time'] = date('Y:m:d H:i:s',time());
      $rs = $User->where('proposal_id='.$id)->save($data); // 根据条件更新记录
      if($rs){

        if(!$proposal_status){
          $Article->where('id='.$id)->setInc('z');
        }else{
          $Article->where('id='.$id)->setDec('z');
        }
        $data['status'] = 200;
      }else{
        $data['status'] = 31404;
        $data['msg'] = '服务器未知错误';
      }
    }else{
      $data['user_id'] = S('userId');
      $data['proposal_id'] = $id;
      $data['proposal_status'] = 1;
      $data['create_time'] = date('Y:m:d H:i:s',time());
      $rs = $User->add($data,array(),true);
      if($rs){
        $data['status'] = 200;
        $Article->where('id='.$id)->setInc('z',1);
      }else{
        $data['status'] = 31404;
        $data['msg'] = '服务器未知错误';
      }
    }

    return $data;
  }

}
