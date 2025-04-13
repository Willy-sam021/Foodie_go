<?php
    session_start();
    require_once "class/Order.php";
    require_once "class/Buyer.php";
    require_once "buyer_guard.php";
    require_once "userguard.php";


$id= $_SESSION['id'];
$_SESSION['buyer_id']=$id['buyer_id'];
$buyer= new Buyer;

$order= new Order;
$buyer_order=$buyer->buyer_order_count($id['buyer_id']);
require_once "partials/header.php"
   
?>
 
<div class="row " style='min-height:500px' id='buyerbanner' >
    <?php require_once "partials/buyer_navbar.php"?>



            <div class="col-md-10 " id='buyeroverlay' >
                        <div class="row">
                            <div class="col">
                            <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                 Menu
                             </button>

                                <h1 class='text-center  text-capitalize mb-md-3'>Welcome, <?php 
                                if(isset($_SESSION['id']) && isset($_SESSION['role'])){
                                echo $id['buyer_lname'];
                                }?> to your dashboard</h1>
                            </div>
                            <?php if(isset($_SESSION['buyer_errorprofile'])){
                                echo "<p class='alert alert-danger fw-bold'>".$_SESSION['buyer_errorprofile']."</p>";
                                unset($_SESSION['buyer_errorprofile']);
                            }?>
                             <?php if(isset($_SESSION['buyer_feedbackprofile'])){
                                echo "<p class='alert alert-success fw-bold'>".$_SESSION['buyer_feedbackprofile']."</p>";
                                unset($_SESSION['buyer_feedbackprofile']);
                            }?>
                        </div>

                        <div class="row">
                            <div class="col-md-11 card mb-3 " id='buyer_dashboard'>
                                <div class="col-md-4 mt-md-1" >
                                    
                                    <p class='ms-2 text-capitalize'><b>NAME: &nbsp;</b><span><?php 
                                    if(isset($_SESSION['id']) && isset($_SESSION['role'])){
                                    echo $id['buyer_lname'].' '.$id['buyer_fname'];
                                    }?></span><br></p>
                                    <p class='ms-2'><b>Phone Number:&nbsp; </b> <span><?php 
                                    if(isset($_SESSION['id']) && isset($_SESSION['role'])){
                                    echo $id['buyer_phone'];
                                }
                                    ?></span> </p>
                                    <div>
                                        <p class='ms-2'><b>Email: &nbsp;</b><?php 
                                        if(isset($_SESSION['id'])&& isset($_SESSION['role'])){
                                            echo $id['buyer_email'];
                                        
                                        ?></p>

                                        <p class='ms-2'><b>Address: &nbsp;</b><?php echo $id['buyer_address']?></p>
                                    
                                
                                <?php
                                        }
                                ?>
                                </div>
                                    
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <h3 class="card-header opacity-60 bg-warning text-center">
                                        Total orders
                                    </h3>
                                    <div class="card-body  text-center">
                                        
                                        <h4 class='lead' >
                                            <?php if($buyer_order){
                                                echo $buyer_order;
                                            }else{
                                                echo "0";
                                            }
                                            ?>
                                            
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                    <!--col  -->
                    </div>

            
               


             
</div>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
 <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
         <?php require_once "partials/buyer_logout.js"?>
    </script>

    <?php require_once "partials/footer.php"?>
    
    