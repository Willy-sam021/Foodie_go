<?php 
session_start();
require_once "userguard.php";
require_once "seller_guard.php";
require_once "class/Seller.php";
require_once "seller_deleted_guard.php";
$sell=new Seller;
$categories=$sell->fetch_category();
require_once "partials/header.php"
 ?>


<div class="row style='min-height:500px'">
    <?php require_once "partials/seller_sidebar.php"?>  
                
    
    <div class="col-md-7 mt-2 offset-md-1 bg-light shadow shadow-lg ">
    <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
         Menu
    </button>
        <h1 class='mt-2 text-center text-capitalize'>Add new Product</h1>
        <hr color='green' size='8'>
        <?php 
            if(isset($_SESSION['errormsg_update'])){
                echo "<p class='alert alert-danger text-danger'>".$_SESSION['errormsg_update']."</p>";
                unset($_SESSION['errormsg_update']);
            }
        
        ?>
        <?php 
            if(isset($_SESSION['feedback_update'])){
                echo "<p class='alert alert-info'>".$_SESSION['feedback_update']."</p>";
                unset($_SESSION['feedback_update']);
            }
        
        ?>
        <form action="seller_process/addnew_product.php" method='post' enctype='multipart/form-data'>
            <div>
                <label class='form-label fw-bold'>Product Name</label>
                <input type="text" name='prod_name' class='form-control mb-1'>
            </div>
            
            <div>
                <label class='form-label fw-bold'>Upload Product Image</label>
                <input type="file" name='upload'  class='form-control mb-1'>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Quantity</label>
                        <input type="text" name='quantity'  class='form-control mb-1'>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Product Price</label>
                        <input type="text" name='prod_price'class='form-control mb-1'>
                     </div>
                </div>
            </div>
            <div>
                <label class="form-label fw-bold">Product Category</label>
                <select name="prod_cat" class='form-select mb-1'>
                    <option value="">select category</option>
                    <?php
                        foreach($categories as $category){
                    ?>

                    <option value="<?php echo $category['category_id']?>"><?php echo $category['category_names']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
            
                <label class="form-label fw-bold">product description</label>
                <textarea type="text" name='prod_description' class='form-control mb-1'></textarea>
            
            </div>

            <div>
               <p class='text-center'><button class='btn mt-2 btn-success' name='button'>add product</button></p>
            </div>
        </form>
    </div>           
    </div>
</div>


<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
    $(document).ready(function(){
        <?php require_once "partials/seller_logout.js"?>
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



