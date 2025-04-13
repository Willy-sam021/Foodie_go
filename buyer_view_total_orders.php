<?php
    session_start();
    require_once "class/Order.php";
    require_once "class/Buyer.php";
    require_once "class/Delivery.php";
    require_once "buyer_guard.php";
    require_once "userguard.php";


$id= $_SESSION['id'];
$buyer= new Buyer;
if(!isset($_GET['order'])){
    header("location:buyer.php");
    exit;
}
$delivery_id=$_GET['order'];
$_SESSION['delivery_id']=$delivery_id;

$order= new Order;
$buyer_order=$order->buyer_view_deets($delivery_id);
// echo "<pre>";
// print_r($buyer_order);
// echo "</pre>";

$delivery= new Delivery;
$delivery_info=$delivery->fetch_delivery($delivery_id);
echo "<pre>";
print_r($delivery_info);
echo "</pre>";

   require_once "partials/header.php";

?>
 
<div class="row" style='min-height:500px'>
    <?php require_once "partials/buyer_navbar.php"?> 
    <div class="col-md-10 ">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Menu
        </button>
        <!-- BEGIN OF TABLE -->
        <div class="row">
            <div class="col-md-12 d-none d-md-block">
                
                <h2 class='text-center'>ORDERS</h2>
                <table class='table table-lg mb-5 table-striped'>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>product name</th>
                            <th>product image</th>
                            
                            <th>quantity purchased</th>
                            <th>total amount</th>
                            <th>action</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sn=1;
                            if($buyer_order){
                            foreach($buyer_order as $ord){
                        
                        ?>
                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $ord['product_name']?></td>
                                <td><img src="upload/<?php echo $ord['product_image']?>" alt="" class="sixtyfour"></td>
                                <td><?php echo $ord['quantity_purchased']?></td>
                                <td>&#8358;<?php echo Number_format($ord['total_amount'])?></td>
                            
                            <td>
                                <?php 
                                    if($buyer_order){
                                        if($ord['order_amount']== 0){
                                            echo "<p class='text-danger'>Cannot make review</p>";
                                        }
                                        
                                        if($delivery_info){
                                            if($delivery_info['delivery_status']=='pending'){
                                                echo "<p class='text-danger'>Cannot make review</p>";
                                            }else{
                                            echo"<a href='review_buyer.php?id=$ord[product_id]' class='btn btn-success'>Make a review</a>";
                                        }
                                    }
                                }
                                ?>
                                
                            </td>
                            
                                
                                
                            </tr>

                        <?php
                            }
                        }else{
                            echo "<p class='alert alert-danger'>No orders yet</p>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<!-- RESPONSIVE SECTION -->
            <div class="col d-md-none border  pb-2 ">
            <?php 
                $sn=1;
                if($buyer_order){
                foreach($buyer_order as $ord){
            
            ?>
            
                <h3 class='text-center'><?php echo $sn++?></h3>
                <div class="row mt-3">
                    <div class="col mb-5 ">
                        <p class='fw-bold'>Product name:    <?php echo $ord['product_name']?></p>
                        <p class='fw-bold'>Quantity purchased:  <?php echo $ord['quantity_purchased']?></p>
                        <p class='fw-bold'>Amount:  &#8358;    <?php echo Number_format($ord['total_amount'])?></p>
                        <?php 
                            if($buyer_order){
                                if($ord['order_amount']== 0){
                                    echo "<p class='text-danger'>Cannot make review</p>";
                                }
                                
                                if($delivery_info){
                                    if($delivery_info['delivery_status']=='pending'){
                                        echo "<p class='text-danger'>Cannot make review</p>";
                                    }else{
                                    echo"<a href='review_buyer.php?id=$ord[product_id]' class='btn btn-success'>Make a review</a>";
                                }
                            }
                        }
                    ?>                        </div>
                    <div class="col">
                        <p class='fw-bold'>Product image</p>
                        <img src="upload/<?php echo $ord['product_image']?>" width='100%' alt="">
                    </div>
                </div>
            
        
        <?php
            }
        }else{
            echo "<p class='alert alert-danger'>No orders yet</p>";
        }
        ?>
    </div>



<!-- BEGIN OF DELIVERY  -->
        <div class="row">
            <div class="col-md-6  mt-4 p-3 shadow offset-md-2">

                <?php 
                if(isset($_SESSION['delivery_status'])){
                    echo "<p class='alert alert-success'>".$_SESSION['delivery_status']."</p>";
                    unset($_SESSION['delivery_status']);
                }
                ?>
                <?php 
                if(isset($_SESSION['delivery_error'])){
                    echo "<p class='alert alert-danger'>".$_SESSION['delivery_error']."</p>";
                    unset($_SESSION['delivery_error']);
                    
                }
                ?>

                <form action="buyer_process/process_buyer_delivery.php?id=<?php echo $buyer_order[0]['order_id']?>" method='post'>
                    <div>
                        <h1 class='text-center'>Delivery details</h1>
                        <hr>
                        
                    </div>
                    <div>
                        <label class='mb-3' >Expected date of delivery:</label>
                        <span class='text-center fw-bold ms-3'><?php 
                        if($delivery_info){
                        echo 
                        date('d,F,Y' ,strtotime($delivery_info['exp_dateofdelivery']));
                        
                    }?></span>
                    </div>
                    <div>
                        
                        <?php 
                        if($delivery_info){
                        if($delivery_info['delivery_status']=='delivered'){
                            echo "<h5 class='text-success fw-bold'>Delivery Successful</h5>";
                        }else{
                            echo "<p class='text-danger'>Delivery status: <span>Pending Delivery<span></p>
                            <label class='mb-3'>click here update product status</label><br>
                            <input type='radio' class='mx-3'name='delivery_status' value='delivered'><span>delivered</span><br>
                            <p class='text-center'> <button class='btn  btn-success' name='btndelivery'>Send</button><p>";
                        }
                    }else{
                        echo "<p class='alert alert-danger'>cannot deliver items with failed payment</p>";
                    }
                    ?> 
                    </div>  
                </form>
            </div>
        </div>
        </div>
    </div>
 <!-- End of beign row  -->                
</div>  
   
                
    


<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
          <?php require_once "partials/buyer_logout.js"?>
    </script>

    <?php require_once "partials/footer.php"?>
    