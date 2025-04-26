<?php
require_once "../class/Seller.php";
    $sell=new Seller;
    echo $sell->logout();
    unset($_SESSION['cart']);
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    session_unset();
    header("location:../index.php");
    session_destroy();
?>