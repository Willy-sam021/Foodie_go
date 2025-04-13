<?php
session_start();
require_once "../class/Buyer.php";
require_once "../class/Utility.php";
$buyer= new Buyer;
if(isset($_POST['btnupdate'])){
  $fname= Utility::sanitize($_POST['firstname']);
  $lname= Utility::sanitize ($_POST['lastname']);
  $phone= Utility::sanitize($_POST['phone']);
  $address=Utility::sanitize($_POST['address']);


  
    if(empty($fname)||empty($lname)||empty($phone)||empty($address)){
      $_SESSION['buyer_errorprofile']="all fields are required";
      header("location:../buyer.php");
      exit;
  
    }
       $id=$_SESSION['id'];
      $buyer_id=$id['buyer_id'];
       
       

   $chk= $buyer->update_buyer_profile($fname,$lname,$phone,$address,$buyer_id);

   $_SESSION['id']=$buyer->identify_id($buyer_id);

   
  if($chk){
    $_SESSION['buyer_feedbackprofile']="update successful";
      header("location:../buyer.php");
      exit;
  }else{
    $_SESSION['buyer_errorprofile']="failed to update";
      header("location:../buyer.php");
      exit; 
  }

  


}else{
  $_SESSION['buyer_errorprofile']="please fill the form properly";
    header("location:../buyer.php");
    exit;   
}









?>