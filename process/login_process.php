<?php
session_start();
    require_once "../class/Utility.php";
    require_once "../class/Buyer.php";
    require_once "../class/Seller.php";
   
     $buyer= new Buyer;
     $seller= new Seller;
    
    if(isset($_POST['submit'])){
        $name_email=$_POST['name_email'];
        $password=$_POST['pwd'];
        $role= isset($_POST['role']) ? ($_POST['role']):'' ;

        if(empty($name_email)||empty($password)||empty($role)){
            $_SESSION['errormsg']="All fields are required";
            header("location:../login2.php");
            exit;
        }

        if($role=="buyer"){
            $id= $buyer->login($name_email,$password);
            if($id){
                $_SESSION['id']=$id;
                 $_SESSION['role']=$role;
                header('location:../landing2.php');
                exit;
            }else{
                $_SESSION['errormsg']="invalid credentials";
                header('location:../login2.php');
                exit;
            }
            
           
        }elseif($role=="seller"){
            
            $id= $seller->login($name_email,$password);

            
            if($id['is_deleted']==FALSE){
                $_SESSION['id']=$id;
                 $_SESSION['role']=$role;
                header('location:../landing2.php');
                exit;
            }elseif($id['is_deleted']==TRUE){ 
                $_SESSION['errormsg']="you've been banned";
                header('location:../login2.php');
                exit;
            }else{
                $_SESSION['errormsg']="invalid credentials";
                header('location:../login2.php');
                exit;
                }
                
        }else{
            $_SESSION['errormsg']="invalid credentials";
            header('location:../login2.php');
            exit;
        }
        
        
        
       
      
      
     }else{
         $_SESSION['errormsg']="Please register properly";
        header('location:../login2.php');
        exit;}











?>