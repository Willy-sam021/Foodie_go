<?php
 require_once "../class/Buyer.php";
 $buyer= new Buyer;
$buyer->logout();
header("location:../index.php");
session_destroy();






?>