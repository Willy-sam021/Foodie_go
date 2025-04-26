<?php
session_start();
require_once "seller_deleted_guard.php";
require_once "class/Seller.php";
    
   
$id=$_SESSION['id'];
$_SESSION['seller_id']= $id['seller_id'];

$test= new Seller;
$all_products=$test->seller_view_products($_SESSION['seller_id']);
    
    require_once "partials/header.php";
    
?>
<style>
    img.fifty{width:50px}
</style>
<div class="row" style='min-height: 400px;'>
    <?php require_once "partials/seller_sidebar.php"?>  
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          Menu
          </button>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary"></button>
                <button class="btn btn-sm btn-outline-secondary"></button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                
              </button>
            </div>
          </div>
         
          
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
          <h2>View all products</h2>
          <!-- table starts -->
          <div class="table-responsive d-none d-md-block">
              <table class="table  seller_table  table-sm">
                <tr>
                  <th>S/N</th>
                  <th>product name</th>
                  <th>product image</th>
                  <th>vendor name</th>
                  <th>product price</th>
                  <th>category name</th>
                  <th>action</th>                        
                </tr>
                <?php 
                // looping starts
                $sn=1;
                    if($all_products){
                        foreach($all_products as $product){?>
                <tr>
                  <td><?php echo $sn++?></td>
                  <td><?php echo $product['product_name']?></td>
                  <td><img src="upload/<?php echo $product['product_image']?>" class='fifty' alt=""></td>
                  
                  <td><?php echo $product['business_name']?></td>
                  <td><?php echo $product['product_price']?></td>
                  <td><?php echo $product['category_names']?></td>
                  <td>
                      <button class='btn btn-danger buttondelete' name="deletebtn">delete </button>
                      <a class="btn btn-success" href='seller_update_product.php?id=<?php echo $product['product_id']?>'>edit</a>
                      
                  </td>
                      
                </tr>

                <?php
                  }
                }else{
                  echo "<p class='alert alert-danger'>You havent sold any product yet</p>";
                }
                ?> 
              </table> 
          </div>

                <!-- RESPONSIVE -->

            <?php 
            $sn=1;
            if($all_products){
            foreach($all_products as $product){
        
            ?>
          <div class="col  border d-block d-md-none pb-2 ">
              <h3 class='text-center'><?php echo $sn++?></h3>
              <div class="row mt-3">
                  <div class="col mb-5 ">
                      <p class='fw-bold'>Product name:    <?php echo $product['product_name']?></p>
                      <p class='fw-bold'>Vendor name:  <?php echo $product['business_name']?></p>
                      <p class='fw-bold'>Amount:  &#8358;    <?php echo Number_format($product['product_price'])?></p>
                      <p class='fw-bold'>Category name:   <?php echo $product['category_names']?></p>
                      <button class='btn btn-danger buttondelete' name="deletebtn">delete </button>
                      <a class="btn btn-success" href='seller_update_product.php?id=<?php echo $product['product_id']?>'>edit</a>
                          
                  </div>
                  <div class="col">
                      <p class='fw-bold'>Product image</p>
                      <img src="upload/<?php echo $product['product_image']?>" width='100%' alt="">
                  </div>
              </div>
          </div>
        <?php
            }
        }else{
            echo "<p class='alert alert-danger'>No orders yet</p>";
        }
        ?>
      </main>
</div>   



<?php require_once "partials/footer.php"?>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/jquery-3.7.1.min.js"> </script>
<script>

  $(document).ready(function(){
    <?php require_once "partials/seller_logout.js"?>
    $('.buttondelete').click(function(){
            
            var x = confirm('are you sure you want to delete this product ?')

            if(x==true){
                window.location.href="process/delete_product.php?id=<?php echo $product['product_id']?>"
        }

         })
         $('#myform').submit(function(event){
        
        event.preventDefault()

        var text=$("#search").val()
        var filter=$('#filter').val()

        

        $.ajax({
          url:"process/process_search.php",
          method:"get",
          dataType:'text',
          data:{
            message:text,
            filter:filter,
            xyz:true
          },
          success:function(response){
           
            $('#searchshow').empty()
            $('#searchshow').append(response)
         },
          error:function(error){
            alert(error)
          }
          
        })

        
      })

  
   })
</script>



</body>
</html>

