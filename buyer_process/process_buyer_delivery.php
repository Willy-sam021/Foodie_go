<?php


session_start();

require_once "../class/Delivery.php";  
if(isset($_POST['btndelivery'])&& isset($_GET['id'])){

    $status=isset($_POST['delivery_status'])?$_POST['delivery_status']:'';
    $order_id=isset($_GET['id'])?$_GET['id']:'';
    $buyer_id=isset($_SESSION['buyer_id'])?$_SESSION['buyer_id']:'';
    
    if(empty($status)){
        header("location:../buyer_view_total_orders.php?order=$order_id");
        $_SESSION['delivery_error']="Please select delivery status";
        exit;
    }

    
    $delivery= new Delivery;
    $res=$delivery->update_delivery($status,$buyer_id,$order_id);
    if($res==true){
        $_SESSION['delivery_status']="Delivery status updated successfully";
        header("location:../buyer_view_total_orders.php?order=$order_id");
        ;
        exit;
    }else{
        $_SESSION['delivery_error']="failed to update";
        header("location:../buyer_view_total_orders.php?order=$order_id");
        ;
        exit;
    }




}else{
    header("location:../buyer.php");
    exit;
}

?>