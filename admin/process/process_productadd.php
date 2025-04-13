<?php

session_start();
require_once "../class/Utility.php";
require_once "../admin_guard.php";
require_once "../class/Admin.php";
$admin=new Admin;

if(isset($_POST['button'])){
    $name=Utility::sanitize($_POST['prod_name']);
    $price=Utility::sanitize($_POST['prod_price']);
    $description=Utility::sanitize($_POST['prod_description']);
    $quantity=Utility::sanitize($_POST['quantity']);
    $cate=Utility::sanitize($_POST['prod_cat']);
    $seller_id=Utility::sanitize($_POST['seller']);

    if(empty($name) || empty($price) || empty($description)|| empty($quantity)){
        $_SESSION['admin_adderror']='all fields are required';
        header("location:../admin_product.php");
        exit;
    }

    $filename= $_FILES['upload']['name']; 
    $filetype= $_FILES['upload']['type']; 
    $filetmpname= $_FILES['upload']['tmp_name'];
    $fileerror= $_FILES['upload']['error']; 
    $filesize= $_FILES['upload']['size'];

    if($fileerror > 0){
        $_SESSION['admin_adderror']="failed to upload";
        header('location:../admin_product.php');
        exit;
    }
    if($filesize > 3145728){
        $_SESSION['admin_error']='you cannot upload more than 3mb';
        header('location:../admin_product.php');
        exit();
    }

    $allowed=["jpg","jpeg"];

    $userpath=pathinfo($filename,PATHINFO_EXTENSION);
    if(!in_array($userpath,$allowed)){
        $_SESSION['admin_adderror']="failed to upload";
        header('location:../admin_product.php');
        exit;
    }

    $unique="WS_".uniqid().".".$userpath;
    $to="../../upload/".$unique;


    $admin1=$admin->add_product($name,$description,$filetmpname,$to,$unique,$price,$quantity,$seller_id,$cate);
    if($admin1){
        $_SESSION['admin_addfeedback']='successfully added';
        header('location:../admin_product.php');
        exit;
    }else{
    $_SESSION['admin_adderror']='product not added';
    header('location:../admin_product.php');
    }


}else{
    $_SESSION['admin_adderror']='please access the page the right way';
    header('location:../admin.php');
    }


?>