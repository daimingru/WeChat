<?php
/**
 * User: daimingru
 * Date: 17/8/24
 * Time: 下午17:58
 */
namespace Home\Model;
class RecommendModel extends BaseModel {
    public function getIndexlist(){
        $sql  = 'SELECT id, title, time, img, content FROM __PREFIX__recommend ';
        $rs 	= $this->query($sql);
        foreach ($rs as $key => $value) {
          $value['content'] = mb_substr(strip_tags($value['content']),0,30);
          $value['src'] = '../article/article?id='.$value['id'];
        }
  		  return $rs;
    }
}
