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
      $data = json_decode($data,true);
      $userinfo = json_decode($userinfo);
      //
      return $userinfo->{"nickName"};
      exit();
      $User = M("user"); // 实例化User对象
      $userinfo['openid'] = $data['openid'];
      $User->add($userinfo);
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
