<?php
    session_start();
    require_once "../class/Admin.php";
    $admin= new Admin;
    //sanitize
    if(isset($_POST['btnseller'])){
      $fname=  $_POST['fname'];
      $lname=  $_POST['lname'];
      $phone=  $_POST['phone'];
      $address=  $_POST['address'];
      $business=  $_POST['business'];

      if(empty($fname)||empty($lname)||empty($phone)||empty($address)||empty($business)){
        $_SESSION['admin_update_seller_error']='all fields are required';
        header('location:../admin_seller.php');
        exit;
      }

      if(isset($_SESSION['admin_sellerid'])){
        $sellerid=$_SESSION['admin_sellerid'];
    }else{
        $_SESSION['admin_update_buyer_error']="no seller found";
        header("location:../admin_buyer.php?id=$sellerid");
        exit;
    }

      

      $check=$admin->update_seller($fname,$lname,$phone,$address,$business,$sellerid);
      if($check){
        $_SESSION['admin_update_seller_feedback']='update successful';
        header("location:../admin_seller.php?id=$sellerid");
        exit;
      }else{
        $_SESSION['admin_update_seller_error']='update unsuccessful';
        header("location:../admin_seller.php?id=$sellerid");
        exit;
      }



      
    }else{
        $_SESSION['admin_error']='visit the page the right way';
        header('location:../admin_view_sellers.php');
        exit;
    }












?>