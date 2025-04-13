<?php 
session_start();
require_once "seller_guard.php";
require_once "class/Order.php";
require_once "class/Product.php";

 $order= new Order;

// $orderid= $_SESSION['order_id'];

$seller_orders=$order->seller_orders($_SESSION['seller_id']);
// echo "<pre>";
// print_r($seller_orders);
// echo "</pre>";

// echo "<pre>";
// print_r($order_deets);
// echo "</pre>";

require_once "partials/header.php";
?>

<div class="row" style='min-height:500px'>
    <?php require_once "partials/seller_sidebar.php"?> 
        <div class="col-md-10">
            <button class="btn btn-primary mt-1 d-block  d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Menu</button>
                <h3 class='text-center'>All orders</h3>
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
            
                <table class='table d-none d-lg-block'>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>item name</th>
                            <th>image</th>
                            <th>Buyer name</th>
                            <th>Buyer address</th>
                            <th>buyer phone</th>
                            <th>Quantity</th>
                            <th>total amount</th>
                            <th>payment status</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial=0;
                        if($seller_orders!=false){
                            foreach($seller_orders as $or){
            
                        ?>
                        <div class='card'>
                            <tr>
                                
                                <td><?php echo $serial+1?></td>
                                <td><?php echo $or['product_name']?></td>
                                <td><img src="upload/<?php echo $or['product_image']?>" width='64px' alt=""></td>
                                <td><?php echo $or['buyer_fname']." ".$or['buyer_lname']?></td>
                                <td><?php echo $or['buyer_address']?></td>
                                <td><?php echo $or['buyer_phone']?></td>
                                <td><?php echo $or['quantity_purchased']?></td>
                                <td><?php echo Number_format($or['amount_paid'])?></td>
                                <td><?php echo $or['payment_status']?></td>
                                <td><a class='btn btn-success' href="seller_delivery_update.php?id=<?php echo $or['order_id']?>">set delivery</a></td>
                                                                    
                            </tr>
                        </div>
                        <?php
                        }
                            }else{
                            echo "<p class='alert alert-danger'>No orders yet</p>";
                            }
                            
                        ?>
                    </tbody>
                </table>
               
                    <!-- RESPONSIVE -->

                <?php 
                $serial=1;
                if($seller_orders){
                foreach($seller_orders as $or){
            
                ?>
                    <div class="col d-block d-lg-none border  pb-2 ">
                        <h3 class='text-center'><?php echo $serial++?></h3>
                        <div class="row mt-3">
                            <div class="col mb-5 ">
                                <p class='fw-bold'>Product name:    <?php echo $or['product_name']?></p>
                                
                                <p class='fw-bold'>Amount:  &#8358;    <?php echo Number_format($or['amount_paid'])?></p>
                                <p class='fw-bold'>Quantity purchased:    <?php echo $or['quantity_purchased']?></p>
                                
                                <p class='fw-bold'>Buyer name:   <?php echo $or['buyer_fname']." ".$or['buyer_lname']?></p>
                                <p class='fw-bold'>Buyer address: </p> <p> <?php echo $or['buyer_address']?></p>
                                <p class='fw-bold'>Buyer phone:  <?php echo $or['buyer_phone']?></p>
                                <p class='fw-bold'>Payment status: <?php echo $or['payment_status']?></p>

                                
                                <a class='btn btn-success' href="seller_delivery_update.php?id=<?php echo $or['order_id']?>">set delivery</a>
                                    
                            </div>
                            <div class="col">
                                <p class='fw-bold'>Product image</p>
                                <img src="upload/<?php echo $or['product_image']?>" width='100%' alt="">
                            </div>
                        </div>
                    </div>
        
                <?php
                }
                    }else{
                        echo "<p class='alert alert-danger'>No orders yet</p>";
                    }
                 ?>





        </div>
</div>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
   <?php require_once "partials/seller_logout.js"?>
</script>

<?php require_once "partials/footer.php"?>