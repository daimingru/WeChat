<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class UserModel extends BaseModel {

  //保存用户信息
  public function saveInfo($userinfo,$code){
      $appID = 'wx4c9e5b7490b9edee';
      $AppSecret = 'd13a53d06c90ea288d90881bae6ce942';
      $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appID.'&secret='.$AppSecret.'&js_code='.$code.'&grant_type=authorization_code';
      $data = $this -> getCurl($url);
      $data = json_decode($data,true);
      if($data['openid']){
        $userinfo = htmlspecialchars_decode($userinfo);
        $userinfo = json_decode($userinfo,true);
        $userinfo['openid'] = $data['openid'];
        $userinfo['date'] = date('Y:m:d H:i',time());
        $sql  = 'SELECT * FROM __PREFIX__user where openid ="'.$data['openid'].'"';
        $rs 	= $this->query($sql);
        $userId = $rs[0]['id'];
        if(!$rs){
          $User = M("user"); // 实例化User对象
          $userId = $User->add($userinfo);
        }
        $User['status'] = 200;
        $User['msg'] = 'success';
        S('userId',$userId);
      }else{
        $User['status'] = 31001;
        $User['msg'] = '用户未同意授权';
      }
      return $User;
  }

  public function getCurl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close ($ch);
    return $result;
  }

  //添加/取消关注
  public function collectorWrite($id,$type){
    $userId = S('userId');
    $data = array();
    $status = array();
    $rs   = $this -> selectCollect($id);
    $User = M("collect");
    if(!$rs){
      $data['user_id'] = $userId;
      $data['score_id'] = $id;
      $data['type'] = $type;
      $data['flag'] = 1;
      $data['create_time'] = date('Y:m:d H:i',time());
      $data = $User->add($data);
      if(!$data){
        $status['status'] = 39001;
        $status['msg'] = '请不要乱搞';
      }else{
        $status['status'] = 200;
        $status['msg'] = 1;
      }
    }else{
      $msg = $User->flag = $rs[0]['flag'] == 1 ? 0 : 1;
      $User = $User->where('user_id='.$userId.' and score_id='.$id)->save($data);
      if(!$User){
        $status['status'] = 39001;
        $status['msg'] = '请不要乱搞';
      }else{
        $status['status'] = 200;
        $status['msg'] = $msg;
      }
    }
    return $status;
  }


  //查看是否有记录
  public function selectCollect($id){
    $sql = 'select * from __PREFIX__collect WHERE user_id = '.$userinfo = S('userId').' and score_id = '.$id;
    $rs  = $this->query($sql);
    if(!$rs){
      return false;
    }
    return $rs;
  }

  //获取收藏
  public function getCollect(){
      $data = array();
      $sql  = 'SELECT score_id, type FROM __PREFIX__collect where flag = 1 and user_id ='.S('userId');
      $rs 	= $this->query($sql);
      if($rs){
        $sql = '';
        $sql1 = '';
        $article = array();
        for($i = 0; $i < count($rs); $i++){
          if ($rs[$i]['type'] == 'score'){
            $sql .= $rs[$i]['score_id'].',';
          }else{
            $sql1 .= $rs[$i]['score_id'].',';
          }
        }
        if($sql != ''){
          $sql = "SELECT id, name, author from __PREFIX__score where id in(".substr($sql, 0, -1).")";
          $data['score']	= $this->query($sql);
        }
        if($sql1 != ''){
          $sql1 = "SELECT * from __PREFIX__recommend where id in(".substr($sql1, 0, -1).")";
          $data['recommend']	= $this->query($sql1);
          foreach ($data['recommend'] as $key => $value) {
            $data['recommend'][$key]['content'] = mb_substr($value['content'],0,35);
            $data['recommend'][$key]['src'] = '../article/article?id='.$value['id'];
          }
        }
      }
      return $data;
  }

}
