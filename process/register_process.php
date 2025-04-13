<?php
    session_start();
    require_once "../class/Utility.php";
    require_once "../class/Buyer.php";
    require_once "../class/Seller.php";
    $buyer= new Buyer;
    $seller= new Seller;
   if(isset($_POST['button'])){

        $fname=Utility::sanitize($_POST['fname']);
       
        $lname=Utility::sanitize($_POST['lname']);
        $email=Utility::sanitize($_POST['email']);
        $phone=Utility::sanitize($_POST['phone']);
        $vendor=Utility::sanitize($_POST['vendor']);

        $role= isset($_POST['role']) ? Utility::sanitize($_POST['role']):'' ;
        
        $pass1=$_POST['pwd'];
        $pass2=$_POST['confpwd'];
       
       
        $fname=strtolower($fname);
        $lname=strtolower($lname);


       
        if(trim($fname)==''||trim($lname)==''||trim($phone)==''||trim($pass1)==''||trim($pass2)==''||trim($email)==''||trim($role)==''){
            $_SESSION["errormsg"] ="all fields are required";
            header("location:../register.php");
            exit;
        }
        if($role=='seller'){
          $vendor= strtolower(trim($vendor)) ;
           
        }
        if($pass1 !== $pass2){
            $_SESSION["errormsg"] ="Password mismatch";
            header("location:../register.php");
            exit;
        }

        if($role=="buyer"){
            $data=$buyer->email_exists($email);
            if($data===true){
                $_SESSION["errormsg"] ="Email already exists";
                header("location:../register.php");
           exit;
          }
         }elseif($role=='seller'){
            $data=$seller->email_exists($email);
                if($data===true){
                    $_SESSION["errormsg"] ="Email already exists";
                    header("location:../register.php");
               exit;
            }

         }else{
            $_SESSION["errormsg"] ="registration unsuccessful please try again";
            header("location:../register.php");
              exit;
         }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION["errormsg"] ="please supply a valid email";
            header("location:../register.php");
             exit;
        
        }

        if($role=="buyer"){
            $buyer1=$buyer->register_buyer($fname,$lname,$phone,$email,$pass1);
                if($buyer1 !==true){
                    $_SESSION["errormsg"] ="registration unsuccessful please try again";
                    header("location:../register.php");
                    exit;
                }else{
                    $_SESSION['feedback']="registration successful please login";
                    header('location:../login2.php');
                    
                     exit;
                }
        }elseif($role=="seller"){
            $seller1=$seller->register_seller($fname,$lname,$phone,$email,$pass1,$vendor);
            if($seller1!==true){
                $_SESSION["errormsg"] ="registration unsuccessful please try again";
                header("location:../register.php");  
                exit;
            }else{
                $_SESSION['feedback']="registration successful please login";
                header('location:../login2.php');
                
                exit;
            }

        
           
        }else{
           header("location:../register.php");
        }
        


    }else{
        $_SESSION['errormsg'] = "please complete the form";
        header("location:../register.php");
        exit();
    }











?>