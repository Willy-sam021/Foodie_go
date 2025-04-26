<?php 
session_start();
require_once "buyer_guard.php";
require_once "class/Order.php";
require_once "class/Product.php";

$order= new Order;

$orderid= $_SESSION['order_id'];
$product= new Product;
require_once "partials/header.php";


?>
<?php
    if(isset($_SESSION['payment_error'])){
        echo "<p class='alert alert-danger fw-bold'>".$_SESSION['payment_error']."</p>";
        unset($_SESSION['payment_error']);
    }
?>
<?php 
    if(isset($_SESSION['payment_feedback'])){
        echo "<p class='alert alert-info fw-bold'>".$_SESSION['payment_feedback']."</p>";
        unset($_SESSION['payment_feedback']);
    }
?>
        <div class="row ">
            <div class="col-md-12 d-none d-md-block">
                <h1>confirm payment</h1>
            <?php
                    if(isset($_SESSION['payment_error'])){
                        echo "<p class='alert alert-danger fw-bold'>".$_SESSION['payment_error']."</p>";
                        unset($_SESSION['payment_error']);
                    }
                ?>
                <?php 
                    if(isset($_SESSION['payment_feedback'])){
                        echo "<p class='alert alert-info fw-bold'>".$_SESSION['payment_feedback']."</p>";
                        unset($_SESSION['payment_feedback']);
                    }
                ?>
                
                    <table class='table '>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>item name</th>
                                <th>image</th>
                                <th>vendor name</th>
                                <th>quantity</th>
                                
                                <th>total amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $serial=1;
                                if(isset($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $lex){
                                    $products=$product->get_product_cart($lex['productid']);
                                    foreach($products as $prod){                            
                            ?>
                            <div class='card'>
                            <tr>
                               
                                    <td><?php echo $serial++?></td>
                                    <td><?php echo $prod['product_name']?></td>
                                    <td><img src="upload/<?php echo $prod['product_image']?>" width='64px' alt=""></td>
                                    <td><?php echo $prod['business_name']?></td>
                                    <td><?php echo $lex['quantity']?></td>
                                    
                                    <td><?php echo $prod['product_price'] * $lex['quantity']?></td>
                                    
                            </tr>
                            </div>



                            <?php
                                 }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <form action="process/process_paystack.php" method='post'>
                    <div class='justify-content-end d-flex flex-column ms-5 align-items-end'>
                    <p>Grand Total:&nbsp;&#8358;<?php echo Number_format($_SESSION['grand_total'])?></p>
                    <button class='btn btn-success' name="btnpaystack">confirm</button>
                    </div>
                </form>
                    
                
               
            </div>
        </div>
        <div class="row d-block d-md-none  ">
            <div class="col">
                <h1 class='text-center text-capitalize'>confirm payment</h1>
                    <?php 
                        $serial=1;
                        if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $lex){
                            $prod=$product->get_product_cart($lex['productid']);
                            foreach($prod as $pro){                            
                    ?>
                    <div class="row my-3">
                        <div class="col-6 border">
                            <img src="upload/<?php echo $pro['product_image']?>" class='img-fluid' alt="product_img">
                        </div>
                        <div class="col-6 border">
                            <div>
                                <h6 class='text-center badge bg-success'><?php echo $serial++?></h6>
                                <p class='ms-2'>Product name: <span><?php  echo $pro['product_name']; ?></span><br>
                                <span>Vendor name: <span><?php echo $pro['business_name']?></span><br>
                                
                                <p>Quantity:<?php echo $lex['quantity']?></p>
                                <p>Total amount:<?php echo $pro['product_price'] * $lex['quantity']?></p>
                                
                            </div>
                            
                        </div>
                    </div>
                <?php
                }
                    }   
                }else{
                    echo "<p class='alert alert-danger'>No items in cart</p>";
                }             
                ?> 
                <form action="process/process_paystack.php" method='post'>
                    <div class='justify-content-end d-flex flex-column ms-5 align-items-end'>
                        <p>Grand Total:&nbsp;&#8358;<?php echo Number_format($_SESSION['grand_total'])?></p>
                        <button class='btn btn-success' name="btnpaystack">confirm</button>
                    </div>
                </form>        
            </div>
        </div>

  

<?php require_once "partials/footer.php"?>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>