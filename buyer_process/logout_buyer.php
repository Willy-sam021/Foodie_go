<?php
 require_once "../class/Buyer.php";
 $buyer= new Buyer;
$buyer->logout();
header("location:../login2.php");
session_destroy();






?>