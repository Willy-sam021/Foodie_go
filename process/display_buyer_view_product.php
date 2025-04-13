<?php
session_start();
require_once "../class/Product.php";
    

    $prod= new Product;
    if(isset($_SESSION['buyer_product'])){
        $product_details=$prod->product_deets($_SESSION['buyer_product']);
    }else{
        echo "no match found";
    }
    // echo "<pre>";
    // print_r($product_details);
    // echo "</pre>";

    
   $catty= $prod->display_productsby_category($product_details['category_id'],$_SESSION['buyer_product']);
  

    if($catty){
        foreach($catty as $products){
echo "
<div class='col-12 col-sm-6 col-md-3  mb-2 '>
            <a href='product_details.php?id= $products[product_id]' class='text-decoration-none'>

            <div class='card w-100' style='width: 14rem;'>
                <img class='card-img-top w-100' src='upload/$products[product_image]' alt='chicken'>
                 </a>
                <div class='card-body'>
                    <h5 class='card-title'> $products[product_name]</h5>
                    <p class='card-text '>price:&#8358;&nbsp;<span class='fw-bold'> $products[product_price]</span></p>
                    <p class='card-text'>$products[business_name]</p>
                    <button class='btn cart btn-success' id='btn_cart' value='$products[product_id]'> add to cart</button>
                </div>
            </div>
           
</div>

";
        }
    }else{
        echo "No results found";
    }
?>