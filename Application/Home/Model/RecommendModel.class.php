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
      $sql  = 'SELECT id, title, time, img, content FROM __PREFIX__recommend ORDER BY id desc';
      $rs 	= $this->query($sql);
      foreach ($rs as $key => $value) {
        $rs[$key]['content'] = mb_substr($value['content'],0,35);
        $rs[$key]['src'] = '../article/article?id='.$value['id'];
      }
      return $rs;
  }

  //文章详情
  public function getArticle($id){
      $data = array();
      $sql  = 'SELECT title, author, time, content FROM __PREFIX__recommend where id ='.$id;
      $rs 	= $this->query($sql);
      $sql  = 'SELECT flag FROM __PREFIX__collect where type = "article" and user_id ='.S('userId').' and score_id ='.$id;
      $rt 	= $this->query($sql);
      $rs[0]['flag'] = 0;
      if($rt[0]['flag']){
        $rs[0]['flag'] = $rt[0]['flag'];
      }
      return $rs[0];
  }

}
