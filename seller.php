<?php 
session_start();
require_once "userguard.php";
require_once "seller_guard.php";
require_once "class/Seller.php";
require_once "class/Order.php";
require_once "seller_deleted_guard.php";
$sell=new Seller;
$categories=$sell->fetch_category();
$id=$_SESSION['id'];
$order= new Order;

require_once "partials/header.php"
 ?>
<div class="row" style='min-height:500px'>
    <?php require_once "partials/seller_sidebar.php"?>                
    <div class="col-md-10 mt-2">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Menu
        </button>
        <?php 
            if(isset($_SESSION['seller_profile'])){
                echo "<p class='alert alert-info fw-bold'>".$_SESSION['seller_profile']."</p>";
                unset($_SESSION['seller_profile']);
            }
        ?>
        <div class='card' id='seller_dashboard'>
            <h4 class=' text-center card-header'>Welcome  <span class='fw-bold text-capitalize'>
            <?php 
                if(isset($_SESSION['id']) && isset($_SESSION['role'])){
                    echo  $id['seller_fname'];
            
            ?>
            </span> to your dashboard</h4>
            <p class='ms-2 card-text text-capitalize '><b>Vendor name:</b><span>
            <?php 
                echo $id['business_name'];
            ?>
            </span><br></p>
            <p class='ms-2 card-text'><b>Phone number:  </b><span>
            <?php       
                echo $id['seller_phone'];
            ?>
            </span> </p>
            <p class='ms-2 card-text'><b>Email: </b><span>
            <?php 
                echo $id['seller_email'] 
            ?>
            </span></p>
            
            <?php
                }
            ?>
        </div>                
    </div>
</div>



<?php require_once "partials/footer.php"?>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
   <?php require_once "partials/seller_logout.js"?>
   </script>

</body>
</html>




