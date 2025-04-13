<?php
session_start();
$cart=$_GET['id'];

unset($_SESSION['cart'][$cart]);



header("location:../cart.php");
?>