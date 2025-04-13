<?php
session_start();
require_once "../userguard.php";
require_once "../class/Seller.php";
require_once "../class/Utility.php";
$seller= new Seller;
if(isset($_POST['firstname'])||isset($_POST['lastname'])||isset($_POST['phone'])|| isset($_POST['address'])||isset($_POST['state'])||isset($_POST['lg'])){
  $fname= Utility::sanitize($_POST['firstname']);
  $lname= Utility::sanitize ($_POST['lastname']);
  $phone= Utility::sanitize($_POST['phone']);
  $address=Utility::sanitize($_POST['address']);
  $state=Utility::sanitize($_POST['state']);
  $lga=Utility::sanitize($_POST['lg']);


  
    if(empty($fname)||empty($lname)||empty($phone)||empty($address)||empty($state)||empty($lga)){
    
      echo "all fields are required";
     
    }
       $id=$_SESSION['id'];
      $seller_id=$id['seller_id'];
       
       

   $chk= $seller->update_seller_profile($fname,$lname,$phone,$address,$state,$lga,$seller_id);

   $_SESSION['id']=$seller->identify_id($seller_id);

  if($chk){
    echo "updated successfully";
    $_SESSION['seller_profile']='updated successfully';
      exit;
  }else{
    echo "unable to update"; 
    $_SESSION['seller_profile']='unable to update';
    exit;
  }



}else{
    echo "Please go back and fill the form properly";
        
}









?>