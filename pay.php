<?php
/**
 * ---------------------参数生成页-------------------------------
 * 
 * 在您自己的服务器上生成新订单，并把计算好的订单信息传给您的前端网页。
 * 注意：
 * 1.sign一定要在服务端计算，不要在网页中计算。
 * 2.secretkey密钥只能存放在服务端，不可以以任何形式存放在网页代码中（可逆加密也不行），也不可以通过url参数方式传入网页。
 * 3.接口跑通后，如果发现收款二维码是我们官方的，请检查APP是否正在运行。为保障您收款功能正常，请确保您的收款手机APP全天假在线，手机开机。
 * --------------------------------------------------------------
 */

    //从网页传入order_price:支付价格， order_type:支付渠道：alipay-支付宝；wechat-微信支付
    $order_price = $_POST["order_price"];
    $order_type = $_POST["order_type"];
	$order_name = "cs123456";//"订单名称，自己设定";
	$extension = "cs222222";//"备注信息，自己设定";
	
	date_default_timezone_set("PRC");
    $order_id = date("YmdHis").mt_rand(100,999);//"此处生成唯一性的订单号，可以用你自己的方法生成保证每次提交订单唯一性。";

    //校验传入的表单，确保价格为正常价格（整数，1位小数，2位小数都可以），支付渠道只能是alipay或者wechat，ordername长度不要超过30个中英文字。

    //此处就在您服务器生成新订单，并把创建的订单号传入到下面的order_id中。
      //每次有任何参数变化，订单号就变一个吧。
    $uid = "111111";//"此处填写易合支付申请的的uid";
    $secretkey = "123456";//"此处填易合支付申请的的secretkey密钥";
    $redirect_url = 'http://192.168.0.135:300/';//"此处填支付成功后跳转的url";
	$notify_url = 'http://192.168.0.135:300/fh3.php';//"此处填支付成功后回调通知的url";
    $pay_format = 'html';
	
    
    $sign = md5(md5($order_price.$order_type).$secretkey);
    //经常遇到有研发问为啥sign值返回错误，大多数原因：1.参数的排列顺序不对；2.上面的参数少传了，导致服务端sign算出来和你的不一样。

    $returndata['order_name'] = $order_name;
    $returndata['order_type'] = $order_type;
    $returndata['extension'] = $extension;
    $returndata['redirect_url'] = $redirect_url;
	$returndata['notify_url'] = $notify_url;
    $returndata['order_id'] = $order_id;
    $returndata['uid'] =$uid;
    $returndata['order_price'] = $order_price;
    $returndata['pay_format'] = $pay_format;
    $returndata['sign'] = $sign ;
    echo jsonSuccess("OK",$returndata,"");


    //返回错误
    function jsonError($message = '',$url=null) 
    {
        $return['msg'] = $message;
        $return['data'] = '';
        $return['code'] = -1;
        $return['url'] = $url;
        return json_encode($return);
    }

    //返回正确
    function jsonSuccess($message = '',$data = '',$url=null) 
    {
        $return['msg']  = $message;
        $return['data'] = $data;
        $return['code'] = 1;
        $return['url'] = $url;
        return json_encode($return);
    }

?>