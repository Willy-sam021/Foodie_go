<?php
session_start();
require_once "../class/Utility.php";
require_once "../admin_guard.php";
require_once "../class/Admin.php";
if(isset($_POST['btndelete'])){
    
   
    $cate_id=Utility::sanitize($_POST['delete_cat']);

    $admin= new Admin;
    $delete=$admin->delete_category($cate_id);
    if($delete){
        echo "Category sucessfully deleted";
        exit;
    }else{
        echo "Failed to delete Category";
        
        exit;
    }
}else{
    echo "please fill the form properly";
    exit;
 }










?>