<?php
session_start();
require_once "../class/Utility.php";
require_once "../class/Review.php";
require_once "../class/Product.php";

if(isset($_POST['btnreview'])){

$rating=isset($_POST['rating'])?$_POST['rating']:'';
$comment= Utility::sanitize($_POST['comment']);

if(empty($comment) || empty($rating)){
    $_SESSION['buyer_error_review']="all fields are required ";
    header("location:../review_buyer.php?id=".$_SESSION['product_review']);
    exit;
}



// echo"<pre>";
// print_r($_SESSION);
// echo"</pre>";
// echo $_SESSION['buyer_id'];
// exit;


$rate= new Review;
$review=$rate->buyer_review($_SESSION['buyer_id'],$_SESSION['product_review'],$comment,$rating);
if($review){
    $_SESSION['buyer_feedback_review']="Review successfully sent, Thank you ";
    header("location:../review_buyer.php?id=".$_SESSION['product_review']);
    exit;
}else{
    $_SESSION['buyer_error_review']="Error sending review, please try again ";
    header("location:../review_buyer.php?id=".$_SESSION['product_review']);
    exit;
}



}else{
    header('location:../buyer.php');
    exit;
}








?>