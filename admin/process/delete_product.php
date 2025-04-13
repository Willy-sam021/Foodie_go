<?php
session_start();
    require_once "../class/Admin.php";

    $delete= new Admin;

    $deleted=$delete->delete_product($_GET['id']);
    if($deleted){
    $_SESSION['admin_feedback']="product successfully deleted";
    header('location:../admin_view_product.php');
    exit;

     }else{ $_SESSION['admin_error']="unable to delete";
    header('location:../admin_view_product.php');
    exit;}













?>