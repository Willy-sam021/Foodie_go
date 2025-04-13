<?php
session_start();
require_once "../class/Product.php";
require_once "../class/Order.php";

//    $prod_id= $_POST['product_id'];
//    $quantity= $_POST['quantity'];
//    if($quantity==''){
//     $quantity=1;
//    }
//echo $quantity;

if(count($_SESSION['cart'])==0){
    header('location:../landing2.php');
    exit;

}
if(!isset($_SESSION['cart'])){
    header('location:../landing2.php');
    exit;

}
$id=$_SESSION['id'];
$buyer_id=$id['buyer_id'];

$order= new Order;
$orderid=$order->Insert_into_order($buyer_id,0);

// echo $orderid;
// die;
if(!$orderid){
    $_SESSION['buyer_errorprofile']= "an error occured";
    header("location:../buyer.php");
   exit;
}
$_SESSION['order_id']=$orderid;


$cart=$_SESSION['cart'];

$grand_total=0;
foreach($cart as $item){
    $prod_id=$item['productid'];
    $quantity=$item['quantity'];


$product = new Product;
$prod=$product->get_product_cart($prod_id);
if($prod){
$prod_amt=$prod[0]['product_price'];

$total_amt= $quantity * $prod_amt;
$grand_total=$grand_total+($prod_amt*$quantity);





}

}//end of foreach


echo "<pre>";
print_r($_SESSION['order_id']);
echo "</pre>";

//$cart_orderid=
$_SESSION['order_id'];

        foreach($cart as $item){
            $prod_id=$item['productid'];
            $quantity=$item['quantity'];
                $prod=$product->get_product_cart($prod_id);
                    if($prod){
                        $prod_amt=$prod[0]['product_price'];
                        
                        $total_amt= $quantity * $prod_amt;
                        // foreach($cart_orderid as $carty){
                        //     $orderid=$carty;
                        $details=$order->Insert_into_orderdetails($orderid,$quantity,$prod_id,$total_amt);
                    }
       // }
 }
if($details){
    header("location:../success.php");
   $_SESSION['grand_total']=$grand_total;


    
}else{
    echo "not yet done";
}





?>