<?php
require_once "../class/Admin.php";
$sell=new Admin;
$prod=$_POST['product'];
$cat=$sell->vendor_name_fetch($prod);
$category=$cat['business_name'];

echo $category;


?>
