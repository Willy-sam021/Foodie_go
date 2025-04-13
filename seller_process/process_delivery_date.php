<?php
session_start();
require_once "../class/Delivery.php";
if(isset($_POST['button'])){
    
    $date=$_POST['date'];
    if($date==''){
        echo "<p class='alert alert-danger'>please pick a date</p>";
        exit;
    }
    $_SESSION['delivery_id'];
    
    $delivery= new Delivery;
    $deliver=$delivery->set_delivery_date($_SESSION['delivery_id'],$date);
    if($deliver){
        echo "<p class='alert alert-info'>date set successfully<p>";

    }else{
        echo "<p class='alert alert-danger'>unable to set date, please try again</p>";
    }





}














?>