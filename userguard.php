<?php
if(!isset($_SESSION['id']) && !isset($_SESSION['role'])){
    $_SESSION['errormsg']="please login";
    header("location:index.php");
}






?>