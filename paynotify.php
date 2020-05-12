<?php
/**
 * ---------------------通知异步回调接收页-------------------------------
 * 
 * 此页就是您之前传给vippay.cnyueqiu.com的notify_url页的网址
 * 支付成功，易合支付会根据您之前传入的网址，回调此页URL，Get回参数
 * 
 * --------------------------------------------------------------
 */

    $order_id = $_GET['order_id'];//"订单号";
    $order_price = $_GET['order_price'];//"订单金额";
    $qr_price = $_GET['qr_price'];//"客户实际支付金额";
    $order_name = $_GET['order_name'];//"订单名称";
    $extension = $_GET['extension'];//"备注信息'';
    $sign = $_GET['sign'];//sign = md5(md5(order_id + order_price) + secretkey);

    //校验传入的参数是否格式正确，略

    $secretkey = "此处填写用户的secretkey";
    
    $temps = md5(md5($order_id.$order_price).$secretkey);

    if ($temps != $sign){
        exit('sign值不匹配');
    }else{
        //校验sign成功，是自己人。执行自己的业务逻辑：加余额，订单付款成功，装备购买成功等等。
        
    }

  

?>