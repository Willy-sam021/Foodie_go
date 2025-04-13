<?php
session_start();
require_once "admin_guard.php";
require_once "class/Admin.php";
$test= new Admin;
if(! isset($_GET['id'])|| empty($_GET['id']) || !is_Numeric($_GET['id']) ){
    header("location:admin_view_sellers.php");
    exit;

}else{

$_SESSION['admin_sellerid']=$_GET['id'];

$validate= $test->get_seller_id($_SESSION['admin_sellerid']);
if(!$validate){
    header("location:admin_view_sellers.php");
    exit;
}


$user=$test->get_seller_id( $_SESSION['admin_sellerid']);
// echo "<pre>";
// print_r($user);
// echo "</pre>";
if(! $user){
  $_SESSION['admin_error']="user not found";
  header("location:admin_view_sellers.php");
  exit;
//unset($_SESSION['admin_error']);
  
}
}
// print_r($_SESSION);
require_once "partials/header.php";
    
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
          <div class="table-responsive">
         
            <table class="table table-striped table-sm">
            <tr>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>phone</th>
                        <th>action</th>
                        
                    </tr>
                     <tr>
                        <td> <?php 
                        if($user){
                          echo $user['seller_fname'];
                          
                        }
                        ?></td>
                        <td> <?php 
                        if($user){
                          echo $user['seller_lname'];
                          
                        }
                        ?></td>
                        
                        <td> <?php if($user){
                          echo $user['seller_phone'];
                          
                        }
                        ?></td>
                        
                        <td>
                          <!-- <form action="process/delete_seller.php" method="post"> -->
                          <?php 
                            if($user['is_deleted']==FALSE){
                              echo" <button class='btn btn-danger' id='btndelete' name='deletebtn'>Deactivate </button>";

                            }else{
                              echo" <button class='btn btn-success' id='btnactivate' name='deletebtn'>Activate </button>";

                            }
                          ?>
                         
                          
                        </td>
                    </tr>
                </table>
          </div>
        </main>
     </div>


<div class='row'>
  <div class="col-md-5 offset-md-3 shadow rounded">
    <div class="row">
      <div class="col-md-12 ">
             <?php 
                    if(isset($_SESSION['admin_update_seller_error'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_update_seller_error']."</p>";
                        unset($_SESSION['admin_update_seller_error']);
                    }
                
                ?>
                <?php 
                    if(isset($_SESSION['admin_update_seller_feedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_update_seller_feedback']."</p>";
                        unset($_SESSION['admin_update_seller_feedback']);
                    }
                
                ?>
          <form action="process/update_seller.php" method='post'>
            <h1 class='text-center'>Edit Seller</h1>
            
              <div class="row">
                 <div class="col-md-3">
                    <label for="">Firstname</label>
                  </div>
                  <div class="col-md-6">
                     <input type="text"name='fname' class='form-control mt-2' value="<?php echo $user['seller_fname']?>" id='fname'placeholder='enter new first name'>
                  </div>
              </div>
            

              <div class="row">
                  <div class="col-md-3">
                    <label for="">Lastname</label> 
                  </div>
                  <div class="col-md-6">
                     <input type="text"name='lname' id='lname' class='form-control mt-2' value="<?php echo $user['seller_lname']?>" placeholder='enter new last name'>
                  </div>
              </div>
            
            
              <div class="row">
                  <div class="col-md-3">
                    <label for="">Phone</label>
                    
                  </div>
                  <div class="col-md-6">
                     <input type="text" name='phone'class='form-control mt-2' id='phone' value="<?php echo $user['seller_phone']?>" placeholder='enter new phone'>
                  </div>
              </div>
            
            
              <div class="row">
                  <div class="col-md-3">
                      <label for="">Address</label>
                    
                    </div>
                    <div class="col-md-6">
                      <input type="text" name='address' class='form-control mt-2' id='address' value="<?php echo $user['seller_address']?>" placeholder='enter new address'>
                    </div>
                </div>
            
              <div class="row">
                  <div class="col-md-3">
                      <label for="">Vendor name</label>
                      
                    </div>
                    <div class="col-md-6">
                     <input type="text" name='business' class='form-control mt-2' id='business' value="<?php echo $user['business_name']?>" placeholder='enter new vendor name'>
                  </div>
              </div>
            

            <div>
             <p class='text-center'><button class='btn btn-success mt-3' name='btnseller'>Update</button></p> 
            </div>

          </form>
      </div>
    </div>
  </div>
</div>




<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script>

  $(document).ready(function(){
  
    $('#btndelete').click(function(event){
            event.preventDefault()
            var x = confirm('Do you want to deactivate this seller ?')

            if(x==true){
                window.location.href="process/delete_seller.php"
          }

         })

         $('#btnactivate').click(function(event){
            event.preventDefault()
            var x = confirm('Do you want to Activate this seller ?')

            if(x==true){
                window.location.href="process/activate_seller.php"
          }

         })



        <?php echo "partials/admin_search.js"?>


  
   })
</script>
<?php require_once "partials/footer.php"?>


    
