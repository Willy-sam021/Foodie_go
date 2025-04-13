<?php

if($_SESSION['role']!= "seller"){
    header('location:login2.php');
    exit;
}


?>