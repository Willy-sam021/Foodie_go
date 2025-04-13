<?php
session_start();
require_once "../class/Admin.php";

require_once "../class/Utility.php";
$buyer= new Admin;



if(isset($_POST['btnupdate'])){
  $fname= Utility::sanitize($_POST['firstname']);
  $lname= Utility::sanitize ($_POST['lastname']);
  $phone= Utility::sanitize($_POST['phone']);
  $address=Utility::sanitize($_POST['address']);
 

  
    if(empty($fname)||empty($lname)||empty($phone)||empty($address)){
        $_SESSION['admin_update_buyer_error']="all fields are required";
        header("location:../admin_buyer.php");
        exit;
    
    }
       
    if(isset($_SESSION['admin_buyerid'])){
        $id=$_SESSION['admin_buyerid']; 
    }else{
        $_SESSION['admin_update_buyer_error']="no buyer found";
        header("location:../admin_buyer.php?id=$id");
        exit;
    }

   $chk= $buyer->update_buyer($fname,$lname,$phone,$address,$id);

  
  if($chk){
    
    $_SESSION['admin_update_buyer_feedback']='updated successfully';
    header("location:../admin_buyer.php?id=$id");
    exit;
  }else{
    $_SESSION['admin_update_buyer_error']='update usuccessful';
    header("location:../admin_buyer.php?id=$id");
    exit;
  }



}else{
    $_SESSION['admin_update_buyer_error']='please fill the form properly';
    header("location:../admin_buyer.php?id=$id");
    exit;
  } 
        










?>