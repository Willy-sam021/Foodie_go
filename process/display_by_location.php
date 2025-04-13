<?php
require_once "../class/Buyer.php";
$buyer= new Buyer;

if(isset($_POST)){
   $state= $_POST['state_id'];
   $lga= $_POST['lga_id'];
   if($state=="" || $lga==""){
    echo "<p class='alert alert-danger'>Please select a state and lga</p>";
    exit();
   }
 $prod= $buyer-> fetch_allproductby_state($state,$lga);
 if($prod){
            foreach($prod as $products){
    echo "
    <div class='col-12 col-sm-6 col-md-3  mb-2 '>
    <a href='product_details.php?id=$products[product_id]' class='text-decoration-none'>
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