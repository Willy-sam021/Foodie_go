<?php
session_start();
require_once "../class/Utility.php";
   if(isset($_SESSION['id'])){
       $id=$_SESSION['id'] ;
   }

   if(!isset($id['buyer_address'])){
        // $_SESSION['buyer_errorprofile']="Please update your profile address before placing an order";
        echo "please update your profile address before placing an order";
         // header("location:buyer.php");
         exit;
   } 
       
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

   if(isset($_POST['xy'])){
    //sanitize
        
       $prod_id= Utility::sanitize($_POST['product_id']);
       $quantity=Utility::sanitize($_POST['quantity']);
       if($quantity==''){
         echo "please pick a number";
        $quantity=1;
        exit;
       }
    
       
    
    $_SESSION['cart'][$prod_id]['quantity']=$quantity;
   // print_r($_SESSION['cart']);
    echo "updated successful";

   //  echo "<pre>";
   //  print_r($_SESSION['cart']);
   //  echo "</pre>";
   }




?>