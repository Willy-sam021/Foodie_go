<?php 
    
    if(!isset($_SESSION['admin_id'])){
        header('location:admin_login.php');
        exit;
    }


?>