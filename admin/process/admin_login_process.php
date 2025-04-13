<?php
session_start();

require_once "../class/Utility.php";
require_once "../class/Admin.php";

    $admin= new Admin;

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['pwd'];
    
    
        $id= $admin->login($username,$password);
        
        if($id){
            $_SESSION['admin_id']=$id;
            header('location:../admin.php');
            exit;
        } else{
            $_SESSION['admin_loginerror']='invalid credentials';
            header('location:../admin_login.php');
        }
        
    
    
}else{ header('location:../login2.php');
}











?>