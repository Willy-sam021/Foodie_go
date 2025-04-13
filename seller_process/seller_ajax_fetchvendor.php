<?php
require_once "../class/Seller.php";
$sell=new Seller;
$prod=$_POST['product'];
$cat=$sell->vendor_name_fetch($prod);
$category=$cat['business_name'];

echo $category;



?>
