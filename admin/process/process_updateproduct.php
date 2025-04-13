<?php
session_start();
require_once "../class/Admin.php";
$admin=new Admin;

if(isset($_POST['button'])){
    $name=$_POST['prod_name'];
    $price=$_POST['prod_price'];
    $description=$_POST['prod_description'];
    $quantity=$_POST['quantity'];
    $catid=$_POST['prod_cat'];

    $product_id=$_POST['product'];
    $businessname=$_POST['businessname'];





if(empty($name) || empty($price) || empty($description)|| empty($quantity)||empty($catid) ||empty($product_id)|| empty($businessname)){
    $_SESSION['admin_updateerror']='all fields are required';
    header("location:../admin_update.php");
    exit;
}




$filename= $_FILES['upload']['name']; 
$filetype= $_FILES['upload']['type']; 
$filetmpname= $_FILES['upload']['tmp_name'];
$fileerror= $_FILES['upload']['error']; 
$filesize= $_FILES['upload']['size'];



if($fileerror > 0){
$_SESSION['admin_updateerror']="failed to upload";
exit;
}
if($filesize > 3145728){
    $_SESSION['admin_error']='you cannot upload more than 3mb';
    header('location:../admin_update.php');
    exit();
}

$allowed=["jpg","jpeg"];

$userpath=pathinfo($filename,PATHINFO_EXTENSION);
if(!in_array($userpath,$allowed)){
$_SESSION['admin_updateerror']="failed to upload";
exit;}

$unique="WS_".uniqid().".".$userpath;
$to="../../upload/".$unique;
//move_uploaded_file("$filetmpname",$to);
$product_verify=$admin->verify_product($product_id,$businessname);

if(!$product_verify){
  $_SESSION['admin_updateerror']='an error occured';
 header('location:../admin_update.php');
    exit;
}
$admin1=$admin->update_product($filetmpname,$to,$name,$description,$unique,$price,$quantity,$catid,$product_id);





if($admin1){
     $_SESSION['admin_updatefeedback']='update successful';
    header('location:../admin_update.php');
    
}else{
header('location:../admin_update.php');
}




}else{
    $_SESSION['admin_feedback']='fill the form';
    header('location:../admin_product.php');
    exit;
}






?>