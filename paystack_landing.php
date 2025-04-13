<?php
session_start();
//require_once "userguard.php";

require_once "class/Payment.php";
require_once "class/Order.php";

$order= new Order;
if(!isset($_SESSION['transaction_id'])){
    $_SESSION['payment_error']="you need to start a transaction";
    header("location:success.php");exit;
}
$orderid=$_SESSION['order_id'];
$grand_total=$_SESSION['grand_total'];
$pay= new Payment ;

$ref=$_SESSION['transaction_id'];

$rsp=$pay->paystack_verify_step2($ref);

if($rsp && ($rsp->status)){
    
    $paystatus="successful";
    $amt_deducted=$rsp->data->amount;
    $data = json_encode($rsp);
    $order->update_order_total($orderid,$grand_total);
    $_SESSION['buyer_feedbackprofile']="payment was successful";
    
}else{
    
    $paystatus="failed";
    $amt_deducted = 0;
    $data = json_encode($rsp);
    $order->update_order_total($orderid,$amt_deducted);
 $_SESSION['buyer_errorprofile']="payment failed";
 
}

$chk=$pay->update_payment($paystatus,$data,$ref);
if($chk){
   $_SESSION['buyer_feedbackprofile']="payment complete";
   unset($_SESSION['cart']);
  header("location:buyer.php");
   exit;

}else{
    $_SESSION['buyer_errorprofile']="transaction error";
    header("location:buyer.php");
   exit;

}


?>