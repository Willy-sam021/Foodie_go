<?php
session_start();
    require_once "../class/Admin.php";

    $delete= new Admin;
    $deleted=$delete->delete_buyer( $_SESSION['admin_buyerid']);
    if($deleted){
    $_SESSION['admin_feedback']="buyer successfully deleted";
    header('location:../admin_view_buyers.php');
    exit;

     }else{ $_SESSION['admin_error']="unable to delete";
    header('location:../admin_view_buyers.php');
    exit;}













?>