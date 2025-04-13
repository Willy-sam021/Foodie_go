<?php
session_start();
require_once "../class/Admin.php";
require_once "../class/Utility.php";

if(isset($_GET['xyz'])){
   $msg= Utility::sanitize($_GET['message']);
   $filter= Utility::sanitize($_GET['filter']);
   
   if(empty($msg)||empty($filter)){
    
    
            echo "<p class='alert alert-danger'>please input a text and select a filter</p>";
       
        exit;
   }

   
    $admin =new Admin;
    if($filter=='sellers'){
        $search= $admin->search_all_sellers($msg);
        if(!$search){
            echo "<p class='alert alert-danger'>No seller found</p>";
            exit;
        }
        
        foreach($search as $ser){
            echo "<a class='dropdown-item' href='admin_seller.php?id= $ser[seller_id]'>".$ser['business_name']."</a><br>";
           
         }
         exit;     
    }else{
        $search= $admin->search_all_products($msg);
        if(!$search){
            echo "<p class='alert alert-danger'>No product found</p>";
            exit;
        }
        

        foreach($search as $ser){
        echo"<a class='dropdown-item' href='admin_search_product.php?id=$ser[product_id]'>$ser[product_name]</a><br>";
        
      }
        
        exit;
    }








}else{
        echo "please search properly";
        exit;

}





?>