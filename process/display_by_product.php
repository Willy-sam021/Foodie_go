<?php
require_once "../class/Product.php";
if(isset($_POST)){
    $text=$_POST['message'];
    
    if($text==""){
        echo "<p class='alert alert-danger'>Please enter a product name</p>";
        exit();
    }
    $pro= new Product;
   $prod= $pro->search_all_products($text);
  
//    echo "<pre>";
//    print_r($prod);
//    echo "<pre>";

    if($prod){
        foreach($prod as $products){
echo "

<div class='col-12 col-sm-6 col-md-3  mb-2 '>
    <a href='product_details.php?id=$products[product_id]'>
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
echo " <p class='alert alert-danger'>No products available<p>";
}

}

?>
