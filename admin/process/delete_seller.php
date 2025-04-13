<?php
session_start();
    require_once "../class/Admin.php";

    $delete= new Admin;
    $deleted=$delete->deactivate_seller( $_SESSION['admin_sellerid']);
    if($deleted){
    $_SESSION['admin_feedback']="seller successfully deactivated";
    header('location:../admin_view_sellers.php');
    exit;

     }else{ $_SESSION['admin_error']="unable to deactivate seller";
    header('location:../admin_view_sellers.php');
    exit;}













?>