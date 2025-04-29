<?php
session_start();
require_once "admin_guard.php";
require_once "class/Admin.php";
$admin= new Admin;

if(!isset($_GET['id'])||!isset($_GET['buyer_id'])){
  header('location:admin.php');
  exit;
}
$id= $_GET['id'];
$buyer_id=$_GET['buyer_id'];

// echo $id;
// echo $buyer_id;

$one_product=$admin->admin_order_deets($id);
$buyer=$admin->get_buyer_id($buyer_id);
// echo "<pre>";
// print_r($one_product);
// echo "</pre>";


// echo "<pre>";
// print_r($buyer);
// echo "</pre>";

 // $user_total=$test->display_usercount();
// $order_total=$test->display_ordercount();

require_once "partials/header.php";

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
          <h2>VIEW PRODUCT</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm" id='dashtable'>
                <thead>
                  <tr>        
                        <th>S/N</th>
                        <th>product name</th>
                        <th>product image</th>
                        <th>Quantity</th>
                        <th>product price</th>
                        <th>buyer name</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sn=1;
                  if(is_array($one_product)){
                   foreach($one_product as $product){?>
                    <tr>
                      <td><?php echo $sn++?></td>
                        <td><?php echo $product['product_name']?></td>
                        <td><img src="../upload/<?php echo $product['product_image']?>" class='fifty' alt="product image"></td>
                        
                        <td><?php echo $product['quantity_purchased']?></td>
                        <td><?php echo $product['product_price']?></td>
                        <td><?php 
                        if($buyer){
                        echo $buyer['buyer_lname']." ".$buyer['buyer_fname'];
                      }
                        ?>
                        
                      </td>
                        
                       
                    </tr>

                  <?php
                    }
                  }else{
                    echo "<p class='alert alert-danger'>order not found</p>";
                  }
                  ?> 
                  </tbody>
                </table> 
                <div>
                <a href="admin_view_orders.php"class='btn btn-success' >Back</a>
                </div>
            </div>
        </main>
     </div>   

<?php require_once "partials/footer.php"?>

<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script src='//cdn.datatables.net/2.2.2/js/dataTables.min.js'></script>

<script>

  $(document).ready(function(){
  let table = new DataTable('#dashtable')
    $('.buttondelete').click(function(){
            
            var x = confirm('are you sure you want to delete this product ?')

            if(x==true){
                window.location.href="process/delete_product.php?id=<?php echo $product['product_id']?>"
        }

         })
  
  
         
   
   <?php require_once "partials/admin_logout.js"?>
  

   })
</script>

</body>
</html>



    
