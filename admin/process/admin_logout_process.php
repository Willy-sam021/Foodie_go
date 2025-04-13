<?php
 require_once "../class/Admin.php";
 $admin= new Admin;
$admin->logout();
unset($_SESSION);
header("location:../admin_login.php");
session_destroy();






?>