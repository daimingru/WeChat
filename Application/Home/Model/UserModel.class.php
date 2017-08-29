<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class UserModel extends BaseModel {

  public function saveInfo($userinfo,$code){
      $appID = 'wx4c9e5b7490b9edee';
      $AppSecret = 'd13a53d06c90ea288d90881bae6ce942';
      $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appID.'&secret='.$AppSecret.'&js_code='.$code.'&grant_type=authorization_code';
      $data = $this -> getCurl($url);
      $userinfo = "'"+$userinfo+"'";
      $data = json_decode($data,true);
      $userinfo = json_decode($userinfo);
      return $userinfo;
      exit();
      //$userinfo['openid'] = $data['openid'];
      if($data['openid']){
      $sql  = 'SELECT * FROM __PREFIX__user where openid ="'.$data['openid'].'"';
      $rs 	= $this->query($sql);
        if(!$rs){
          $User = M("user"); // 实例化User对象
          $User->add($userinfo);
        }
        $User['status'] = 200;
        $User['msg'] = 'success';
      }else{
        $User['status'] = 31001;
        $User['msg'] = '用户未同意授权';
      }
      return $User;
  }

  function getCurl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close ($ch);
    return $result;
  }

}
