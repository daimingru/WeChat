<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class ScoreModel extends BaseModel {
  //曲谱列表
  public function getScorelist($id){
      $type = '';
      $data = array();
      $data['title'] = '全部';
      $data['data'] = array();
      if($id == 1){
        $data['title'] = '最热';
        $type = 'ORDER BY follow desc';
      }elseif ($id == 2) {
        $data['title'] = '最新';
        $type = 'ORDER BY id desc';
      }
      $sql  = 'SELECT id, name, author FROM __PREFIX__score '.$type;
      $rs 	= $this->query($sql);
      $data['data'] = $rs;
      return $data;
  }
}
