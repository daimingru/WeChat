<?php
namespace Home\Controller;
use Think\Controller;
class WeChatController extends Controller {
    public function index(){
      $data = array(
            array(
             "title" => "关于单板吉他是什么意思详解？",
             "desc" => "单板吉他一般是指面单吉他，即吉他的面板是由一整块实木切割成若干",
             "img" => "https://www.aparesse.com/Public/images/1.jpg",
             "src" => '../article/article?id=1',
             "time" => '2017-08-23'
            ),
            array(
             "title" => "最易上手吉他弹唱超精选",
             "desc" => "这是一书仅适合于新手、初级水平的吉他爱好者书谱",
             "img" => "https://www.aparesse.com/Public/images/2.jpg",
             "src" => '../article/article?id=1',
             "time" => '2017-08-04'
            ),
            array(
             "title" => "吉他谱反复记号的作用以及看法",
             "desc" => "他谱中我们经常会看到最下面表格中的那些",
             "img" => "https://www.aparesse.com/Public/images/1.jpg",
             "src" => '../article/article?id=1',
             "time" => '2017-08-02'
            ),
      );
      $this->ajaxReturn($data);
    }
}
