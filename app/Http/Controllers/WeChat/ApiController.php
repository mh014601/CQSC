<?php

//namespace App\Http\Controllers\WeChat;
//
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//use DB;


namespace Home\Controller;
use  Think\Controller;
class ApiController extends Controller
{

    const TOKEN = 'dong';
    public function index415(){

                if($this->checkWechat()){
                     echo $_GET['echostr'];
                 }

        //如何接收经过微信服务器处理之后再次转发给公众号的数据
        //微信服务发送给微信订阅号的数据
//        　$str = $GLOBALS["HTTP_RAW_POST_DATA"];// 7-
        $postStr = file_get_contents("php://input");//php 7+

        /* file_put_contents("a.txt",$postStr);

         die;*/
        // 实现了xml->字符串 对象
        $this->postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        // 用户发送的类型
        $MsgType = $this->postObj ->MsgType;
        switch ($MsgType){
            // 事件
            case 'event':
                $Event = $this->postObj->Event;
                $this->sendEvent($Event);
            // 文本消息
            case 'text':
                $Conent = $this->postObj->Content;
                $this->sendText($Conent);
        }
    }
    // 事件操作
    public function sendEvent($Event){
        switch ($Event){
            // 订阅 关注
            case 'subscribe':
                $this->sendText('欢迎关注,恭候多时,大驾光临,有失远迎,失敬失敬');
                break;
            // 取消订阅 取消关注
            case 'unsubscribe':
                break;


        }
    }
    // 发送文本
    public function sendText($content){
        // 被动回复给用户消息
        $str = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        // 公众号
        $ToUserName = $this->postObj->ToUserName;
        // 用户
        $FromUserName = $this->postObj->FromUserName;
        // 用户发送的内容
        // 公众号回复给用户的时间
        $CreateTime = time();
        // printf 格式化输出
        echo printf($str,$FromUserName,$ToUserName,$CreateTime,'text',$content);
    }

    private function checkWechat(){
        //1.接收 由微信服务器转出的参数
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        // 2.将接收的三个值放入数组
        $tmpArr = [self::TOKEN,$timestamp,$nonce];
        // 3.进行字典排序 从小到大 1.2.3. a.b.c
        sort($tmpArr,SORT_STRING);
        // 4.合并成一个字符串
        $tmpArr = implode($tmpArr);
        // 5.sha1加密
        $tmpStr = sha1($tmpArr);
        // 6.加密之后的结果 同 微信传递过来的 signature 比对
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }
    	public function index(){
    		echo 1111111;
    		 if($this->checkWechat()){
                     echo $_GET['echostr'];
                 }
    	}

}
