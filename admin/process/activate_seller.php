<?php
session_start();
    require_once "../class/Admin.php";

    $activate= new Admin;
    $activate=$activate->activate_seller( $_SESSION['admin_sellerid']);
    if($activate){
    $_SESSION['admin_feedback']="seller successfully activated";
    header('location:../admin_view_sellers.php');
    exit;

     }else{ $_SESSION['admin_error']="unable to activate seller";
    header('location:../admin_view_sellers.php');
    exit;}













?>