<?php

require_once "class/Seller.php";
require_once "seller_guard.php";
$sell=new Seller;
$id=$_SESSION['id'];
$_SESSION['seller_id']=$id['seller_id'];
$res=$sell->is_deleted($id['seller_id']);
// var_dump($res);
// exit;

if($res['is_deleted'] ==true){
    $_SESSION['errormsg']="youve been banned";
    header("location:login2.php");
    exit;
    }




?>