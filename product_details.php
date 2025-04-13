<?php 
session_start();
require_once "userguard.php";
require_once "class/Product.php";
require_once "class/Category.php";
require_once "class/Buyer.php";
$buyer= new Buyer;
$category= new Category;
$categories=$category->fetch_category();

$buy=$buyer->fetch_all_states();

if(!isset($_SESSION['id']) && !isset($_SESSION['role'])){
   header('location:login2.php');
}  

if(isset($_SESSION['cart'])){
    $_SESSION['count_cart']= count($_SESSION['cart']);
}
    
$id= $_SESSION['id'];
$role= $_SESSION['role'];
$_SESSION['buyer_product']= $_GET['id'];


$prod= new Product;
$products=$prod->view_all_products();
$product_details=$prod->product_deets($_SESSION['buyer_product']);

// echo "<pre>";
// // print_r($product_details);
// echo "</pre>";
   
require_once "partials/header.php";

?>


    
    
<!-- first ROW -->

<div class="row  " style='min-height:500px'>

<!-- RESPONSIVE -->
        
            <div class="col">
                <h4 class='text-center'>Product Details</h4>
                <div class="row">
                    <div class="col-4 border">
                        <img  src="upload/<?php echo $product_details['product_image']?>" alt="chicken" width='100%'class='img-fluid'>
                    </div>
                    <div class="col-8 border">
                        <p>Product name <?php echo $product_details['product_name']?></p>
                        <p>price &#8358;<?php echo Number_format($product_details['product_price'])?></p>
                        <p>Vendor name <?php echo $product_details['business_name']?></p>
                        <p><button class=' btn btn-success cart' value="<?php echo $product_details['product_id']?>">add to cart</button>
                        <p>Description :</p>
                        <div>
                            <?php echo $product_details['product_description']?>
                        </div>
                    </div>
                </div>
            </div>
        


        <div class="row"id='display'>

        </div>
            <hr color='red' size='10'>
            <div class="row mt-2" >
                <div class='col-md-12'>
                <h3 class='text-center'>view more products</h3>
                </div>
            </div>
        <div class="row" id="displaymore">
            <!-- PRODUCTS OF CATEGORY ARE HERE -->
        </div>
        
</div>           
  
       
    
       
       
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
    <script>
        var m=  document.getElementById('cart_icon').innerHTML ;
        function shop_cart(){  
           m= Number(m)+1 ;
          document.getElementById('cart_icon').innerHTML=m;
        }


        $(document).ready(function(){
            $('.cart').click(function(event){

                event.preventDefault()
               var t= $(this).val()
            
                $.ajax({
                    url:"process/landing_cart.php",
                    method:"post",
                    data:{cart:t,xyz:true},
                    dataType:"text",
                    success:function(response){
                        $('#cart_icon').text(response)
                       alert('added to cart')
                    },
                    error:function(error){
                        alert(error)
                    }

                })
           
           
            })


        $('li.categories').click(function(){
                
                var cate=$(this).val()
                
                
               $('#display').load('process/display_by_category.php',{category:cate})
                
            
        })

        $('#btnsearch').click(function(){
            
            var text=$('#navsearch').val()
            alert(text)
            $('#display').load('process/display_by_product.php',{message:text})
        })

        $('#displaymore').load('process/display_buyer_view_product.php')

        })
    </script>



   <?php require_once "partials/footer.php"?>
  
  
  
  
  
  
  
  
    
  
