<?php

if($_SESSION['role']!= "seller"){
    header('location:index.php');
    exit;
}


?>