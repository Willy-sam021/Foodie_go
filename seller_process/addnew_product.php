<?php
session_start();
require_once "../class/Utility.php";
require_once "../class/Seller.php";
$seller=new Seller;
if(isset($_POST['button'])){
    $details=$_SESSION['id'];    
    $address=$details['seller_address'];
    $lga=$details['seller_lga'];
    $state=$details['seller_state_id'];
    $seller1=$details['seller_id'];
    
    if(empty($address)||empty($lga)||empty($state)){
        $_SESSION['errormsg_update']="please update your profile before adding new product";
        header("location:../seller_addnewproduct.php");
        exit;
    }
    $name=Utility::sanitize($_POST['prod_name']);
    $price=Utility::sanitize($_POST['prod_price']);
    $description=Utility::sanitize($_POST['prod_description']);
    $quantity=Utility::sanitize($_POST['quantity']);
    $cate=Utility::sanitize($_POST['prod_cat']);
    
    if(empty($name) || empty($price) || empty($description)|| empty($quantity)){
        $_SESSION['errormsg_update']='all fields are required';
        header('location:../seller_addnewproduct.php');
        exit;
    }

    $filename= $_FILES['upload']['name']; 
    $filetype= $_FILES['upload']['type']; 
    $filetmpname= $_FILES['upload']['tmp_name'];
    $fileerror= $_FILES['upload']['error']; 
    $filesize= $_FILES['upload']['size'];

    if($fileerror > 0){
    $_SESSION['errormsg_update']="failed to upload";
    header('location:../seller_addnewproduct.php');
    exit;
    }
    if($filesize > 3145728){
        $_SESSION['errormsg_update']='you cannot upload more than 3mb';
        header('location:../seller_addnewproduct.php');
        exit();
    }

    $allowed=["jpg","jpeg"];
    $userpath=pathinfo($filename,PATHINFO_EXTENSION);

    if(!in_array($userpath,$allowed)){
    $_SESSION['errormsg_update']="failed to upload file type must be jpeg or jpg";
    header('location:../seller_addnewproduct.php');
    exit;
    }

    $unique="WS_".uniqid().".".$userpath;
    $to="../upload/".$unique;
    
    
    $confirm=$seller->add_product($name,$description,$filetmpname,$to,$unique,$price,$quantity,$seller1,$cate);
    if($confirm){
        $_SESSION['feedback_update']='update successful';
        header('location:../seller_addnewproduct.php');
        exit;
    }else{
        $_SESSION['errormsg_update']='update not successful';
        header('location:../seller_addnewproduct.php');
        exit;
    }


    
}else{
    $_SESSION['seller_profile']='fill the form the right way';
        header('location:../seller_addnewproduct.php');
        exit;

}


?>