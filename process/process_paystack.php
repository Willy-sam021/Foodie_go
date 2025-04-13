<?php
session_start();
require_once "../class/Order.php";
require_once "../class/Payment.php";
require_once "../class/Product.php";
require_once "../class/Buyer.php";
$order= new Order;
$pay = new Payment;
$product = new Product;



if(isset($_POST['btnpaystack'])){
    

$orderid=$_SESSION['order_id'];


$buyer_deets=$_SESSION['id'];
$buyer_email=$buyer_deets['buyer_email'];





$transaction_id= uniqid('FG');
$_SESSION['transaction_id']=$transaction_id;

$cart=$_SESSION['cart'];
foreach($cart as $item){
    $prod_id=$item['productid'];
    $quantity=$item['quantity'];
        $prod=$product->get_product_cart($prod_id);
            if($prod){
                $prod_amt=$prod[0]['product_price'];
                
                $total_amt= $quantity * $prod_amt;
                // foreach($cart_orderid as $carty){
                //     $orderid=$carty;
               // $details=$order->Insert_into_orderdetails($_SESSION['order_id'][$prod_id],$quantity,$prod_id,$total_amt);
                $payid=$pay->insert_payment($orderid,$total_amt,$transaction_id);

            }
// }
}

if($payid){
  
    $_SESSION['payment_id']=$payid;
    

}else{
    $_SESSION['payment_error']="an error was encountered";
    header("location:../success.php");
    exit;
}


$amt_paid= $_SESSION['grand_total'];

$paystack_response= $pay->paystack_initialize_step1($buyer_email,$amt_paid,$transaction_id);


    if($paystack_response){
        $auth_url = $paystack_response->data->authorization_url;
        header("location:$auth_url");
        exit;
    }else{
        $_SESSION['payment_error']="Unable to connect to payment gateway";
        header("location:../success.php");
        exit;
    }

    






}




?>