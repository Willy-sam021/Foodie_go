

<?php 
session_start();
require_once "seller_guard.php";
require_once "class/Seller.php";
if(!isset($_GET['id'])){
   
   header("location:seller_view_product.php");
   exit;

 }

  $pro_id=$_GET['id'];


$sell=new Seller;
$categories=$sell->fetch_category();
$view=$sell->seller_edit_products($pro_id);

require_once "partials/header.php"
 ?>


<div class="row style='min-height:500px'">
    <?php require_once "partials/seller_sidebar.php"?>      

    <!-- update product -->
    
    <div class="col-md-7 mt-2 offset-md-1 my-md-2 shadow-lg">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          Menu
        </button>
        <h1 class='text-center'>Update Product</h1>
            <?php 
                if(isset($_SESSION['errormsg'])){
                    echo "<p class='alert alert-danger text-danger'>".$_SESSION['errormsg']."</p>";
                    unset($_SESSION['errormsg']);
                }
            ?>
            <?php 
                if(isset($_SESSION['feedback'])){
                    echo "<p class='alert alert-info'>".$_SESSION['feedback']."</p>";
                    unset($_SESSION['feedback']);
                }
            ?>
        <div>
        <form action='seller_process/process_productupdate.php' method='post' enctype='multipart/form-data'>
            <?php 
            // looping starts
            if(is_array($view)){
                foreach($view as $pro){
            ?>  
                    <div class='row mb-2'>
                        <div class="col-md-3">
                          <label class='ms-md-3'>business name</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" name='businessname' id='business' value='<?php echo $pro['business_name']?>'class='form-control'>
                        </div>  
                    </div>
                    <div class='row mb-2'>
                    
                        <div class="col-md-3">
                          <label class="ms-md-3">product name</label>
                        </div> 
                        <div class="col-md-8">
                          <input type="text" name='prod_name' value="<?php echo $pro['product_name']?>"class='form-control' id='newproduct'>
                        </div>
                    </div>

                    <div class='row mb-2'>
                        <div class="col-md-3">
                          <label class='ms-md-3' >upload product image</label>
                        </div>
                        <div class="col-md-8">
                          <input type="file" name='upload' id='upload' value="<?php echo $pro['product_image']?>" class='form-control'>  
                                <?php 
                                    if($pro['product_image']){
                                        echo"<div class=' d-flex mt-md-3'>
                                        <p>previous image<p>
                                        <img src='upload/$pro[product_image]'style='width:100px' class='form-control ms-md-2'>
                                        </div>";
                                    }
                                ?>
                            
                        </div>
                    </div>
                    
                    <div class='row mt-2'>
                      <div class="col-md-5  ms-md-4">
                        <label >quantity</label>
                        <input type="text" name='quantity' id='quantity' value="<?php echo $pro['product_quantity']?>" class='form-control'>
                      </div>
                        <div class='col-md-5 ms-md-2'>
                            <label for="">product price</label>
                            <input type="text" name='prod_price'class='form-control' id='price' value="<?php echo $pro['product_price']?>">
                        </div>
                    </div>
                    <input type="hidden" name="product" value=<?php echo $pro['product_id']?>>
                    
                    <div class='row mt-2'>
                      <div class="col-md-3">
                        <label class='ms-md-3'>product category</label>
                      </div>
                      <div class="col-md-8">
                          <select name="prod_cat" class='form-select' id='category'>
                            <?php 
                                if($pro['category_names']){
                                    echo "<option value='$pro[category_id]'>$pro[category_names]</option>";
                                }
                            ?>
                              <option value="">select category</option>
                              <?php
                              if(is_array($categories)){
                                  foreach($categories as $category){
                              ?>

                              <option value="<?php echo $category['category_id']?>"><?php echo $category['category_names']?></option>


                              <?php
                                 }
                                }
                              ?>
                          </select>
                        </div>
                    <div class='row mt-2'>
                        <div class="col-md-3">
                          <label class='ms-md-3'>product description</label>
                        </div>
                        <div class="col-md-8 ms-md-2">
                          <textarea name='prod_description' class='form-control' id='description' rows='5' cols='5'> <?php echo $pro['product_description']?></textarea>
                        </div>
                    </div>

                    <div class='row mt-2'>
                      <div class="col">
                        <p class='text-center '><button class='btn btn-success' name='button'>update product</button></p>
                      </div>
                    </div>
                </form>
        </div>
        <?php
            }
                }else{
                    echo "<p class='alert alert-danger'>No product to update </p>";
                }
                // looping ends
        ?>
    </div>
</div>
    
         <!-- container div -->

<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
 <script src="assets/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        <?php require_once "partials/seller_logout.js"?>
        $('#product').change(function(event){
            event.preventDefault()

            var prod=$('#product').val()
            
            alert(prod)
           
            $.ajax({
                url:"seller_process/seller_ajax_fetchvendor.php",
                method:"post",
                dataType:"text",
                data:{
                    product:prod
                },
                success:function(response){
        
                
                  // var y=JSON.parse(response)
                 $('#business').val(response)
                
                },
                error:function(err){
                    alert(err)
                }



                })

        


       

        })
    
    
    
    
    
        //doucment .write    
    })



    

   </script> 













<?php require_once "partials/footer.php"?>
