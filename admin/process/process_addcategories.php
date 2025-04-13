<?php
session_start();
require_once "../class/Admin.php";
$admin=new Admin;
if(isset($_POST['button'])){

    $category_name=$_POST['cat_name'];

    if($category_name==''){
        $_SESSION['cat_error']='all fields are required ';
        header('location:../admin_product.php');
        exit;
    }

    $filename=$_FILES["cat_image"]['name'];
    $filepath=$_FILES["cat_image"]['full_path'];
    $filetemp=$_FILES["cat_image"]['tmp_name'];
    $filetype=$_FILES["cat_image"]['type'];
    $filerror=$_FILES["cat_image"]['error'];
    $filesize=$_FILES["cat_image"]['size'];
    
    
    if($filerror > 0){
        $_SESSION['cat_error']="failed to upload";
        header('location:../admin_product.php');
        exit;
        }
    if($filesize > 3145728){
        $_SESSION['cat_error']='you cannot upload more than 3mb';
        header('location:../admin_product.php');
        exit();
     }
    $allowed=["jpg","jpeg"];
    $userpath=pathinfo($filename,PATHINFO_EXTENSION);
        if(!in_array($userpath,$allowed)){
            $_SESSION['cat_error']="ensure image is of type jpg or jpeg";
            header('location:../admin_product.php');
            exit;
        }
    
    $unique="WS_".uniqid().".".$userpath;
    $to="../../upload/".$unique;
    

       $admin1= $admin->add_category($filetemp,$to,$category_name,$unique);
       if($admin1){
            $_SESSION['cat_feedback']='successfully added';
            header('location:../admin_product.php');
            exit;
       }else{
        $_SESSION['cat_eror']='not added';
       header('location:../admin_product.php');
       }


}





?>