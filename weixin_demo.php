<?php 

	header("Content-type:text/html;charset=utf-8");

	define("TOKEN", "weixin");


	class weixinResponse{

		//验证签名的方法
		public function valid(){
			//接受微信服务器发送的get数据
			//随机字符串
			$echoStr = $_GET['echostr'];
			//微信加密签名  结合了token参数和请求的timestamp参数,nonce参数
			$signature = $_GET['signature'];
			//时间戳
			$timestamp = $_GET['timestamp'];
			//随机数
			$nonce = $_GET['nonce'];
			//token值
			$token = TOKEN;
			//三个参数组合数组
			$tmpArr = array($token,$timestamp,$nonce);
			//自然排序
			sort($tmpArr,SORT_STRING);
			$tmpStr = implode($tmpArr);
			//如果签名符合
			if($tmpStr == $signature){
				echo $echoStr;
				exit;
			}

		}

		public function responseMsg(){

			//接收xml数据包
			$postStr = $HTTP_ROW_POST_DATA;
			//如果接收为空
			if(empty($postStr)){
				echo "error";
				exit();
			}

			//把xml数据包转换成对象
			$object = simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
			//事件类型
			$RX_TYPE = trim($object->MsgType);

			//选择消息类型做处理
			switch ($RX_TYPE) {
				case 'event':
					$result = $this->receiveEvent($object);
					break;
				
				default:
					# code...
					break;
			}


		}


		public function receiveEvent($obj){

		}
	}


 ?>

















