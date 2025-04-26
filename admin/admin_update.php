

<?php 
session_start();
require_once "admin_guard.php";
require_once "class/Admin.php";

$sell=new Admin;
$categories=$sell->fetch_category();

$view=$sell->view_all_products();
if(!isset($_GET['id'])){
  header('location:admin_view_product.php');
  exit;
}
$_SESSION['product_update']=$_GET['id'];
$pro=$sell->view_a_product($_SESSION['product_update']);

// print_r($pro);
//exit;
 require_once "partials/header.php"
 ?>

    
<div class="row" style='min-height:500px'>
<?php require_once "partials/admin_sidebar.php"?>      

        <main role="main" class="col-10 col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>

         

          <h2>SELLERS</h2>
          
          <!-- update product -->
    
          <div class="col-md-8 mt-2 shadow-lg">
                <h1 class='text-center'>UPDATE PRODUCT</h1>
                
                <div>
                <form action='process/process_updateproduct.php' method='post' enctype='multipart/form-data'>  
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
                          <input type="file" name='upload' id='upload' class='form-control'>
                          <?php 
                                    if($pro['product_image']){
                                        echo"<div class=' d-flex mt-md-3'>
                                        <p>previous image<p>
                                        <img src='../upload/$pro[product_image]'style='width:100px' class='form-control update_pix ms-md-2'>
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
                                  foreach($categories as $category){
                              ?>

                              <option value="<?php echo $category['category_id']?>"><?php echo $category['category_names']?></option>


                              <?php
                              }
                              ?>
                          </select>
                        </div>
                    <div class='row mt-2'>
                        <div class="col-md-3">
                          <label class='ms-md-3'>product description</label>
                        </div>
                        <div class="col-md-8">
                          <textarea name='prod_description' class='form-control' id='description' ><?php echo $pro['product_description']?></textarea>
                        </div>
                    </div>

                    <div class='row mt-2'>
                      <div class="col">
                        <p class='text-center '><button class='btn btn-success' name='button'>update product</button></p>
                      </div>
                    </div>
                </form>
                </div>
            </div>
               
    
        </main>
     </div>
                      
         <!-- container div -->
<!-- <script src="admin_assets/jquery-3.7.1.min.js"> </script> -->

<?php require_once "partials/footer.php"?>
<script src="admin_assets/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        
        $('#product').change(function(event){
            event.preventDefault()

            var prod=$('#product').val()
            
           
            $.ajax({
                url:"process/ajax_fetchvendor.php",
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
                  
                }
              })

        })
    
    
        $(document).ready(function(){
   
   <?php require_once "partials/admin_logout.js"?>
   })

    
        //doucment .write    
    })
    

   </script> 

</body>
</html>
