<?php

if($_SESSION['role']!= "buyer"){
    header('location:index.php');
    exit;
}


?>