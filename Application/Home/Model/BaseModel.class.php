<?php
 namespace Home\Model;
/**
 * 基础服务类
 */
use Think\Model;
class BaseModel extends Model {

    /**
     * 用来处理内容中为空的判断
     */
    public function okayCheckEmpty($data){
        $result = array(
            'status' => 1
        );
        foreach ($data as $key=>$v){
            if(trim($v)==''){
                $result = array(
                    'status'=> -1,
                    'key' =>"$key"
                );
                return $result;
            }
        }
        return $result;
    }

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
	 * 去除html标签
	 */
	public function replaceHtml($str){
	}

  /**
	 * 输入sql调试信息
	 */
	public function logSql($m){
		echo $m->getLastSql();
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
