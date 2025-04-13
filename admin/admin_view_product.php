<?php
session_start();
 require_once "admin_guard.php";
    require_once "class/Admin.php";
    
   



    // $user_total=$test->display_usercount();
    // $order_total=$test->display_ordercount();

    require_once "partials/header.php";
    $test= new Admin;
    $all_products=$test->view_all_products();
    // echo "<pre>";
    // print_r($all_buyers);
    // echo "<pre>";
?>
    
      <div class="row" style='min-height:500px'>
      <?php require_once "partials/admin_sidebar.php"?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
          <?php 
                    if(isset($_SESSION['admin_updateerror'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_updateerror']."</p>";
                        unset($_SESSION['admin_updateerror']);
                    }
                
                ?>
                <?php 
                    if(isset($_SESSION['admin_updatefeedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_updatefeedback']."</p>";
                        unset($_SESSION['admin_updatefeedback']);
                    }
                
                ?>



              <?php 
                    if(isset($_SESSION['admin_error'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_error']."</p>";
                        unset($_SESSION['admin_error']);
                    }
                
                ?>
                <?php 
                    if(isset($_SESSION['admin_feedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_feedback']."</p>";
                        unset($_SESSION['admin_feedback']);
                    }
                
                ?>
          <h2>All Products</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
            <tr>
                        <th>product name</th>
                        <th>product image</th>
                        <th>vendor name</th>
                        <th>product price</th>
                        <th>category name</th>
                        <th>action</th>
                        
                    </tr>
                  <?php 
                  if($all_products){
                  foreach($all_products as $product){?>
                    <tr>
                        <td><?php echo $product['product_name']?></td>
                        <td><img src="../upload/<?php echo $product['product_image']?>" class='fifty' alt="pictures of products"></td>
                        
                        <td><?php echo $product['business_name']?></td>
                        <td><?php echo $product['product_price']?></td>
                        <td><?php echo $product['category_names']?></td>
                        <td>
                          
                          <button class='btn btn-danger buttondelete' name="deletebtn">delete </button>
                          <a class="btn btn-success" href='admin_update.php?id=<?php echo $product['product_id']?>'>edit</a>
                          
                        </td>
                        
                    </tr>

                  <?php
                    }
                  }else{
                    echo "<p class='alert alert-danger'>No product yet</p>";
                  }
                  ?> 
                </table> 
            </div>
        </main>
     </div>   



<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script>

  $(document).ready(function(){
  
    $('.buttondelete').click(function(){
            
            var x = confirm('are you sure you want to delete this product ?')

            if(x==true){
                window.location.href="process/delete_product.php?id=<?php echo $product['product_id']?>"
        }

         })
      
   
   <?php require_once "partials/admin_logout.js"?>
   


  
   })
</script>

<?php require_once "partials/footer.php"?>


    
<script src="admin_assets/jquery-3.7.1.min.js"> </script>
