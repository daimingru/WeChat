<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
  //首页推荐
  public function index(){
    $m = D('Home/Recommend');
    $data = $m -> getIndexlist();
    $this->ajaxReturn($data);
  }

  //获取文章详情
  public function getArticle(){
    $id = I('id');
    $data = array();
    if($id == 1){
      $data['title'] = '关于单板吉他是什么意思详解';
      $data['author'] = 'Frank';
      $data['time'] = '2017-08-25';
      $data['count'] = '<text>单板吉他是吉他的一种，用整片木头做成。（而合板是用木段旋切成薄单板或由木方刨切成薄木，再用胶粘剂胶合而成的三层或多层的板状材料，通常用奇数层单板，并使相邻层单板的纤维方向互相垂直胶合而成）。合板做的琴都是比较低档的，几百元那些一般都是合板做的，单板琴价格比较高。</text><text>单板吉他分为面单、面侧单和全单。</text><text>1） 面单是指吉他面板是单板；</text><text>2）面侧单是指面板和侧板是单板；</text><text>3）全单是指面板，底板，侧板都是单板；</text><text>4）无论单板还是夹板，面板、侧板与背板都是两拼或者两拼以上黏合而成，这是为了使吉他有更好的稳定性以及易于保养。“两拼”的意思也就是同一块木头，水平切割后，像翻开书那样，翻开之后将两块板拼合而成。</text><text>单板吉他的优点是吉他音质受共鸣箱质量影响，一个好的共鸣箱能使吉他的音色洪亮、纯净，余音袅袅。单板吉他共鸣箱由自然木材制作而成，和人造夹板相比，内部结构自然、紧凑，更能顺应乐器的发声原理，达到更好的共鸣发生效果。</text><text>缺点是由于木头有年轮 整块板的每个部分纹路和构成并不一样 </text><text>所以潮湿或者干燥的时候木头膨胀收缩每个部分系数就不同，它比合板吉他更容易受到天气变化的影响。过度的湿气的侵入，会使吉他膨胀，最常见的，面板会开始隆起（或者膨胀），面板的表面会开始扭曲。在缺角吉他型号上尤其明显。背板在这类情况下同样会隆起（膨胀）并扭曲。从背板前贴头和后贴头部分的凹陷可以证明。相对湿度越高，扭曲的程度越明显。在高湿度的环境下暴露越久，漆面会开始变形。面板的漆水将会有些许起皱。背侧板将会出现许多小孔。当玫瑰木膨胀时，木头上的小孔随之扩大，这使油漆（它不受湿气影响）陷入到这些木孔里。桃花心木琴颈上的油漆也同样会因为这个原因陷进孔里，背侧板也是如此。</text><img src="https://www.aparesse.com/Public/images/article.jpg" />';
    }elseif ($id == 2) {
      $data['title'] = '最易上手吉他弹唱超精选';
      $data['author'] = 'Frank';
      $data['time'] = '2017-08-04';
      $data['count'] = '<text>这是一书仅适合于新手、初级水平的吉他爱好者书谱，因为歌曲编配的非常简单容易上手，初级水平以上的朋友们就不用购买了，谱子编配难度请参考详情里面的实拍图片。本书共精选195首热门流行经典歌曲，并且书中编排了快捷入门教程，方便大家学习使用。</text><img src="https://www.aparesse.com/Public/images/article1.jpg" />';
    }else{
      $data['title'] = '吉他谱反复记号的作用以及看法';
      $data['author'] = 'Frank';
      $data['time'] = '2017-08-18';
      $data['count'] = '<text>吉他谱中我们经常会看到最下面表格中的那些反复标记/记号，其作用是简化歌曲相同部分的段落。也使得在制谱时可以不用多次去记录相同段落的谱子，从而减少工作量，还有一个好处就是可以有效的控制歌曲谱子的页数。反复标记的看法请参考下面表格。</text><img src="https://www.aparesse.com/Public/images/article2.png" />';
    }

    $this->ajaxReturn($data);
  }

  //获取吉他谱列表
  public function getScorelist(){
    $id = I('id');
    $m = D('Home/Score');
    $data = $m -> getScorelist($id);
    $this->ajaxReturn($data);
  }

  //获取吉他谱列表
  public function getImg(){
    $id = I('id');
    $data = array();
    if($id == 1){
      $data['name'] = '《春天里》';
      $data['author'] = '汪峰';
      $data['time'] = '2017-08-23';
      $data['id'] = '1';
      $data['data'] = array();
      $data['data'][0] = 'http://www.aparesse.com/Update/images/guita-1.png';
      $data['data'][1] = 'http://www.aparesse.com/Update/images/guita-2.png';
    }elseif ($id == 2) {
      $data['name'] = '《春风十里》';
      $data['author'] = '鹿先森';
      $data['time'] = '2017-08-20';
      $data['id'] = '1';
      $data['data'] = array();
      $data['data'][0] = 'http://www.aparesse.com/Update/images/cfsl/1.png';
      $data['data'][1] = 'http://www.aparesse.com/Update/images/cfsl/2.png';
    }elseif ($id == 3) {
      $data['name'] = '《刚好遇见你》';
      $data['author'] = '李玉刚';
      $data['time'] = '2017-08-20';
      $data['id'] = '1';
      $data['data'] = array();
      $data['data'][0] = 'http://www.aparesse.com/Update/images/ghyjn/1.png';
      $data['data'][1] = 'http://www.aparesse.com/Update/images/ghyjn/2.png';
    }elseif ($id == 4) {
      $data['name'] = '《天空之城》';
      $data['author'] = '久石让';
      $data['time'] = '2017-08-20';
      $data['id'] = '1';
      $data['data'] = array();
      $data['data'][0] = 'http://www.aparesse.com/Update/images/tkzc/1.png';
      $data['data'][1] = 'http://www.aparesse.com/Update/images/tkzc/2.png';
    }else{
      $data['name'] = '《漂洋过海来看你》';
      $data['author'] = '周深';
      $data['time'] = '2017-08-19';
      $data['id'] = '1';
      $data['data'] = array();
      $data['data'][0] = 'http://www.aparesse.com/Update/images/pyghlkn/1.png';
      $data['data'][1] = 'http://www.aparesse.com/Update/images/pyghlkn/2.png';
    }

    $this->ajaxReturn($data);
  }
}
