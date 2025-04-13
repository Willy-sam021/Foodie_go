<?php

if($_SESSION['role']!= "buyer"){
    header('location:landing2.php');
    exit;
}


?>