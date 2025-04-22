<?php
session_start();
require_once "class/Order.php";
require_once "class/Product.php";
require_once "buyer_guard.php";
require_once "userguard.php";

   
$id= $_SESSION['id'];
if(!isset($_GET['id'])|| empty($_GET['id']) || !is_Numeric($_GET['id']) ){
    header("location:buyer_total_orders.php");
    exit;
}

$pro= new Product;
$verify=$pro->product_deets($_GET['id']);
if(!$verify){
    header("location:buyer_total_orders.php");
    exit;
}

$_SESSION['product_review']=$_GET['id'];

require_once "partials/header.php";
   
?>
 
<div class="row" style='min-height:500px'>
    <?php
        require_once "partials/buyer_navbar.php";
    ?>
        <div class="col-md-6 offset-md-2 py-2">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
             Menu
        </button>
        <!-- checking for session errors -->
            <?php
                if(isset($_SESSION['buyer_error_review'])){
                echo "<p class='alert alert-danger fw-bold'>".$_SESSION['buyer_error_review']."</p>";
                unset($_SESSION['buyer_error_review']);
                }?>
            <?php
                if(isset($_SESSION['buyer_feedback_review'])){
                    echo "<p class='alert alert-success fw-bold'>".$_SESSION['buyer_feedback_review']."</p>";
                    unset($_SESSION['buyer_feedback_review']);
                }?>

            <!-- buyer review form starts -->
            <form action="buyer_process/process_reviews.php" method='post'>
                <div>
                    <h1 class='text-center'>Buyer's Review</h1>
                </div>
                <div>
                    <label class='mb-1 mb-3'>How would you rate the product?</label><br>
                    <input type="radio" class='mb-2' name='rating' value='good'><span>Good</span><br>
                    <input type="radio"  class='mb-2'  name='rating' value='bad'><span>Bad</span><br>
                    <input type="radio"  class='mb-2'  name='rating' value='excellent'><span>Execellent</span>
                </div>
                <div>
                    <p class='lead mb-2 mt-2' >Make a comment</p>
                    <textarea name="comment" id="comment" max='2000' class='form-control'></textarea>
                </div>
                <div>
                    <p class='text-center'>  <button class='btn p-2 col-3 btn-outline-warning btn-success mt-2' name='btnreview'>Send</button></p>
                </div>
            </form>
            <!-- form ends -->
        </div>
</div>

<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>  
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
    $(document).ready(function(){
        $('#logout').click(function(event){
            event.preventDefault()
            var x = confirm('are you sure you want to log out?')

            if(x==true){
                window.location.href="buyer_process/logout_buyer.php"
        }



        })
    })
</script>
<?php require_once "partials/footer.php"?>
    