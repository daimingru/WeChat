<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class UserModel extends BaseModel {
  //曲谱列表
  public function saveInfo($userinfo,$code){
      var_dump($userinfo);
      var_dump($code);
      exit();
      $sql  = 'INSERT INTO __PREFIX__user (`nikeName`, `gender`, `province`, `city`, `avatarUrl`, `country`, `language`) VALUES ('', '', '', '', '')';
      $rs 	= $this->query($sql);
      $data['data'] = $rs;
      return $data;
  }

}
