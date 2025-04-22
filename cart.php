<?php
session_start();
if(!isset($_SESSION['cart'])){
    header('location:landing2.php');
    exit;
}
// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";

$_SESSION['count_cart']= count($_SESSION['cart']);
require_once "userguard.php";
require_once "buyer_guard.php";
require_once "class/Product.php";
$product = new Product;
$carty=$_SESSION['cart'];
//print_r($_SESSION['cart']);
require_once "partials/header.php"
?>
    
        <!-- row1 -->
<div class="row">
    <div class="col">
        <h1 class='text-center'>Your cart(<?php if(isset($_SESSION['count_cart'])){
            echo $_SESSION['count_cart'];
        }?> items)</h1>
        <?php if(isset($_SESSION['count_cart'])){
                if($_SESSION['count_cart']==0){
                echo "<p class='alert alert-danger'>You have nothing in your cart</p>";
            }
            }
        ?>
    </div>
</div>

<!-- cart table session -->
<div class="row d-none d-lg-block" style='min-height: 100vh;'>
    <div class="col ">
        <table class='table table-lg table-striped  ' >
            <tr>
                <th>S/N</th>
                <th>Item</th>
                <th>image</th>
                <th>Price</th>
                <th>Quantity</th>
                
                <th>Action</th>
            </tr>
            <tr>
                <?php 
                // loop starts
                    $serial=1;
                    foreach($carty as $lex){
                        $prod=$product->get_product_cart($lex['productid']);
                        foreach($prod as $pro){                            
                ?>
                <td><?php echo $serial++ ;?></td>
                <td>
                    <div>
                        <p class='ms-2'>Product name: <span><?php  echo $pro['product_name']; ?></span><br>
                        <span>Vendor name: <span><?php echo $pro['business_name']?></span><br><p>
                        
                        </div>  
                        
                </td >
                <td>
                    <div>
                        <img src="upload/<?php echo $pro['product_image']?>" class='sixtyfour' alt="">
                    </div>
                </td>
                <td>

                    <p><span>&#8358;<?php echo $pro['product_price']?></span></p>
                </td>
                <td>
                    
                    <form >
                    <input type="hidden" name="product_id" value="<?php echo $lex['productid'];?>" id='proddy'>
                    <input type="number" name='quantity' id='quantity' min="1" class='text-center'>
                    
                    <button class='btn btn-primary btnupdate btncart' value="<?php echo $pro['product_id']?>" name='btnupdate' >update</button>
                    </form>
                    
                </td>
                
                <td>
                    <a href="process/remove_cart.php?id=<?php echo $pro['product_id']?>" class="btn btncart btn-danger">remove from cart</a>
                
            
        
                </td>
            
            </tr>

            <?php
                }
                    } 

                //  loop ends
            ?>
        </table>
        <a href='process/order_cart.php'class="btn btn-success ms-2 btncart "name='btncheckout' class="checkout">checkout</a>     
    </div>
</div>
<!-- RESPONSIVE -->
<div class="row d-block d-lg-none">
    <div class="col">
        <?php 
            $serial=1;
            foreach($carty as $lex){
                $prod=$product->get_product_cart($lex['productid']);
                foreach($prod as $pro){                            
        ?>
        <div class="row my-3">
            <div class="col-12 border">
                <img src="upload/<?php echo $pro['product_image']?>" width='100%'class='img-fluid' alt="product_img">
            </div>
            <div class="col-12 border">
                <div>
                    <h6 class='text-center badge bg-success'><?php echo $serial++?></h6>
                    <p class='ms-2'>Product name: <span><?php  echo $pro['product_name']; ?></span><br>
                    <span>Vendor name: <span><?php echo $pro['business_name']?></span><br>
                    <p><span>Price:&#8358;&nbsp;<?php echo $pro['product_price']?></span></p>
                    <form >
                    <input type="hidden" name="product_id" value="<?php echo $lex['productid'];?>" id='proddy'>
                    <label >Quantity</label>
                    <input type="number" name='quantity' id='quantity' min="1" class='text-center'>
                    
                    <button class='btn btn-primary btnupdate btncart' value="<?php echo $pro['product_id']?>" name='btnupdate' >update</button>
                    </form>
                    
                </div>
                <a href="process/remove_cart.php?id=<?php echo $pro['product_id']?>" class="btn btncart my-3 btn-danger">remove from cart</a>

            </div>
        </div>
    <?php
    }
        }                
    ?>
            
            
    </div>
</div>
<!-- confirm button -->
<div class="row">
    <div class="col d-block d-lg-none">
        <p class='text-center'> <a href='process/order_cart.php'class="btn btn-success  mt-2 ms-2 btncart"name='btncheckout' class="checkout">checkout</a></p>
    </div>
</div>

<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
    $(document).ready(function(){
                
         $('.btnupdate').click(function(event){
            event.preventDefault()
        
            var quant=$(this).prev().val()
            
            var prod=$(this).val()
           // alert(prod)
           // alert(quant)

            $.ajax({
                url:"process/confirm_order_deets.php",
                method:"post",
                data:{
                    product_id: prod, quantity: quant, xy:true
                },
                dataType:"text",
                success:function(response){
                    alert(response)
                }

            })

         })

         
    })
</script>

<?php require_once "partials/footer.php"?>
