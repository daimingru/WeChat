<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class RecommendModel extends BaseModel {
  //首页文章
  public function getIndexlist(){
      $sql  = 'SELECT id, title, time, img, content FROM __PREFIX__recommend ';
      $rs 	= $this->query($sql);
      foreach ($rs as $key => $value) {
        $rs[$key]['content'] = mb_substr($value['content'],0,35);
        $rs[$key]['src'] = '../article/article?id='.$value['id'];
      }
      return $rs;
  }
}
