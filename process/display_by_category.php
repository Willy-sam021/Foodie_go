<?php
require_once "../class/Product.php";
if(isset($_POST)){
    $cate=$_POST['category'];
    if($cate==""){
        echo "<p class='alert alert-danger'>Please select a category</p>";
        exit();
    }

    $category= new Product;
   $catty= $category->buyer_category($cate);
  

    if($catty){
        foreach($catty as $products){
echo "
           
        <div class='col-12 col-sm-6 col-md-3  my-2 '>
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
echo " <p class='alert alert-danger mt-3'>No products available<p>";
}

}

?>