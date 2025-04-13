<?php
session_start();
require_once "../userguard.php";
require_once "../class/Seller.php";
$seller=new Seller;


if(isset($_POST['button'])){
    
    $name=$_POST['prod_name'];
    $price=$_POST['prod_price'];
    $description=$_POST['prod_description'];
    $quantity=$_POST['quantity'];
    $catid=$_POST['prod_cat'];

    $product_id=$_POST['product'];
    $businessname=$_POST['businessname'];

    

    if(empty($name) || empty($price) || empty($description)|| empty($quantity)||empty($catid) ||empty($product_id)|| empty($businessname)){
        $_SESSION['errormsg']='all fields are required';
        header("location:../seller_view_product.php");
        exit;
    }

    if(!isset($_FILES['upload'])){
        $_SESSION['errormsg']='please select an image';
        header("location:../seller_view_product.php");
       
        exit;
    }

    
    $filename= $_FILES['upload']['name']; 
    $filetype= $_FILES['upload']['type']; 
    $filetmpname= $_FILES['upload']['tmp_name'];
    $fileerror= $_FILES['upload']['error']; 
    $filesize= $_FILES['upload']['size'];


    if($fileerror > 0){
        $_SESSION['errormsg']="choose an image upload";
        header('location:../seller_view_product.php');
        exit;
    }
    if($filesize > 3145728){
        $_SESSION['errormsg']='you cannot upload more than 3mb';
        header('location:../seller_view_product.php');
        exit();
    }

    $allowed=["jpg","jpeg"];
    $userpath=pathinfo($filename,PATHINFO_EXTENSION);
        if(!in_array($userpath,$allowed)){
        $_SESSION['errormsg']="failed to upload";
        header('location:../seller_view_product.php');
        exit;
    }

    $unique="WS_".uniqid().".".$userpath;
    $to="../upload/".$unique;

    $product_verify=$seller->verify_product($product_id,$businessname);
        if(!$product_verify){
            $_SESSION['errormsg']='vendor name and product mismatch';
            header('location:../seller_view_product.php');
            exit;
        }

       
    $seller1=$seller->update_product($filetmpname,$to,$name,$description,$unique,$price,$quantity,$catid,$product_id);
    
        if($seller1){
           
            $_SESSION['feedback']='update successful';
           header('location:../seller_view_product.php');     
        }else{
           
            $_SESSION['errormsg']='update failed';
        header('location:../seller_view_product.php');
        }




}else{
    $_SESSION['errormsg']='fill the form';
   // header('location:../seller_update_product.php');
    exit;
}


?>