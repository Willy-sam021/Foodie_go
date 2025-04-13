<?php
session_start();
require_once "admin_guard.php";
require_once "class/Admin.php";
    
// $user_total=$test->display_usercount();
// $order_total=$test->display_ordercount();

require_once "partials/header.php";
$test= new Admin;
$all_buyers=$test->display_all_buyers();
//print_r($all_buyers);
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

         

          <h2>BUYERS</h2>
          <?php 
                    if(isset($_SESSION['admin_error'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_error']."</p>";
                        unset($_SESSION['admin_error']);
                    }
                
                    if(isset($_SESSION['admin_feedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_feedback']."</p>";
                        unset($_SESSION['admin_feedback']);
                    }
                
          ?>
          <div class="table-responsive">
         
            <table class="table table-striped table-sm">
            <tr>
                        <th>S/N</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>phone</th>
                        <th colspan='2'>Activity</th>
                    </tr>
                  <?php 
                  $sn=1;
                  if($all_buyers){
                  foreach($all_buyers as $buyer){?>
                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $buyer['buyer_fname']?></td>
                        <td><?php echo $buyer['buyer_lname']?></td>
                        
                        <td><?php echo $buyer['buyer_phone']?></td>
                        <td>
                            <a href="admin_buyer.php?id=<?php echo $buyer['buyer_id']?>" class='btn btn-success ms-1'>view details</a>
                        
                        </td>
                    </tr>

                  <?php
                    }
                  }else{
                      echo "<p class='alert alert-danger'>No buyers yet</p>";
                    }
                  ?> 
                </table>
               
            </table>
          </div>
        </main>
     </div>
     
      

<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script>
  
    $(document).ready(function(){
   
   <?php require_once "partials/admin_logout.js"?>
   })


</script>

<?php require_once "partials/footer.php"?>


    
