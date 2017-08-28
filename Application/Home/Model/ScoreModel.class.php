<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class ScoreModel extends BaseModel {
  //曲谱列表
  public function getScorelist(){
      $sql  = 'SELECT id, name, author FROM __PREFIX__score ';
      $rs 	= $this->query($sql);
      return $rs;
  }
}
