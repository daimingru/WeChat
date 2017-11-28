<?php
 namespace Home\Model;
/**
 * 基础服务类
 */
use Think\Model;
class BaseModel extends Model {

    /**
     * HTTP请求（支持HTTP/HTTPS，支持GET/POST）
     * $url 请求url
     * $jsonStr 发送的json字符串
     * array
     */
    function http_post_json($url, $jsonStr){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
          )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($httpCode, $response);
    }

    /**
     * 用来处理内容中为空的判断
     */
  	public function checkEmpty($data,$isDie = false){
  	    foreach ($data as $key=>$v){
  			if(trim($v)==''){
  				if($isDie){
  				    die("{status:-1,'key'=>'$key'}");
                  }
  				return false;
  			}
  		}
  		return true;
  	}

    /**
  	 * 微信emoji表情存入处理
  	 */
  	public function textEncode($str){
      if(!is_string($str))return $str;
      if(!$str || $str=='undefined')return '';

      $text = json_encode($str); //暴露出unicode
      $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
          return addslashes($str[0]);
      },$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
      return json_decode($text);
  	}

    /**
  	 * 微信emoji表情取出处理
  	 */
    public function textDecode($text){
      $text = json_encode($str); //暴露出unicode
      $text = preg_replace_callback('/\\\\\\\\/i',function($str){
          return '\\';
      },$text); //将两条斜杠变成一条，其他不动
      return json_decode($text);
    }

    /**
  	 * 输入sql调试信息
  	 */
  	public function logSql($m){
  		echo $m->getLastSql();
  	}

    /**
     * 屏蔽敏感词
     */
    public function sensitiveWords($data){
        $sensitiveWords = array('习近平','日你','草你','干你','傻逼','靠你妈');
        $isin = in_array($data,$sensitiveWords);
        return $isin;
    }

  	/**
  	 * 获取一行记录
  	 */
  	public function queryRow($sql){
  		$plist = $this->query($sql);
  		return $plist[0];
  	}


  	/**
  	 * 格式化查询语句中传入的in 参与，防止sql注入
  	 * @param  $split
  	 * @param  $str
  	 */
  	public function formatIn($split,$str){
  		if(is_array($str)){
  			$strdatas = $str;
  		}else{
  			$strdatas = explode($split,$str);
  		}

  		$data = array();
  		for($i=0;$i<count($strdatas);$i++){
  			$data[] = (int)$strdatas[$i];
  		}
  		$data = array_unique($data);
  		return implode($split,$data);
  	}
};
?>
