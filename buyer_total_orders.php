<?php
    session_start();
    require_once "class/Order.php";
    require_once "class/Buyer.php";
    require_once "buyer_guard.php";
    require_once "userguard.php";

$id= $_SESSION['id'];//BUYER GUARD HAS HANDLED THIS
$buyer= new Buyer;

$order= new Order;
$buyer_order=$order->buyer_order_deets($id['buyer_id']);


   require_once "partials/header.php";
?>

<div class="row" style='min-height:500px'>
    <?php require_once "partials/buyer_navbar.php"?>
     <div class="col">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Menu
        </button>
        
            <h2 class='text-center'>ORDERS <span class='badge bg-dark text-white'><?php echo count($buyer_order);?></span></h2>
            <div class='d-none d-sm-block'>
                <table class='table table-striped responsive table-lg' >
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>order date</th>
                            <th>total amount</th>
                        
                            <th>action</th>                                                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // looping starts
                            $sn=1;
                            if($buyer_order){
                            foreach($buyer_order as $ord){
                        
                        ?>
                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php 
                                    echo 
                                    date('d/F/Y (H:i:s a)',strtotime($ord['order_date']))
                                    ?>
                                    
                                </td>
                                <td>&#8358;<?php 
                                if($ord['order_amount']==0){
                                    echo "<span class='text-danger'>payment failed</span>";
                                }else{
                                echo Number_format($ord['order_amount']);
                            }
                                
                                ?></td>
                        <td><a href="buyer_view_total_orders.php?order=<?php echo $ord['order_id']?>" class='btn btn-success'>view more</a></td>
                                
                                
                                
                                
                            </tr>
                            <?php
                        }
                        }else{
                        echo "<p class='alert alert-danger'>No orders yet</p>";
                    }
                    ?>
                    <!-- looping ends -->

                    </tbody>
                </table>
            </div>        <!-- RESPONSIVENESS -->

       
             <?php 
            //  looping starts
                $sn=1;
                if($buyer_order){
                foreach($buyer_order as $ord){
            
            ?>
             <div class="col-12 border border-1 p-3 border-dark d-block d-sm-none ">
                <p class='text-center fw-4'><?php echo $sn++?></p>
            <form>
                <div>
                    <label for="">Order date</label>
                    <input type="text" class='form-control mb-2' value='<?php echo date('d/F/Y (H:i:s a)',strtotime($ord['order_date']))?>' readonly>
                </div>
                <div>
                    <label >Amount</label>
                    <h5>
                    <?php 
                        if($buyer_order){
                        if($ord['order_amount']==0){
                            echo '<span class=text-danger>payment failed</span>';
                         }else{
                                echo Number_format($ord['order_amount']);
                        }
                    }        
                    ?></h5>

                </div>
                
                <div>
                <a href="buyer_view_total_orders.php?order=<?php echo $ord['order_id']?>" class='btn btn-success'>view more</a>
                </div>
            </form>
        </div>
        <?php
             }
              }else{
                echo "<p class='alert alert-danger'>No orders yet</p>";
            }
            // looping ends
            ?>

    </div>
        <!-- end of responsiveness -->
</div>

<?php require_once "partials/footer.php"?>
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src='assets/jquery-3.7.1.min.js'></script>
    <script><?php require_once "partials/buyer_logout.js"?> </script>

    </body>
</html>

    