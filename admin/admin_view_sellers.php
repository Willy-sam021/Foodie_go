<?php
    session_start();
    require_once "admin_guard.php";
    require_once "class/Admin.php";
    // $all_sellers=$test->display_all_sellers();
    // echo "<pre>";
    // print_r($all_sellers);
    // echo "<pre>";

    // $user_total=$test->display_usercount();
    // $order_total=$test->display_ordercount();

    require_once "partials/header.php";
    $test= new Admin;
    $all_sellers=$test->display_all_sellers();
    
    // echo "<pre>";
    // print_r($all_sellers);
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

          <h2>SELLERS</h2>
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
         
            <table class="table table-striped table-sm" id='dashtable'>
              <thead>
                   <tr>
                        <th>S/N</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>phone</th>
                        <th>Status</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $sn=1;
                  if($all_sellers){
                     foreach($all_sellers as $user){?>

                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $user['seller_fname']?></td>
                        <td><?php echo $user['seller_lname']?></td>
                        
                        <td><?php echo $user['seller_phone']?></td>
                        <td>
                          <?php 
                            if($user['is_deleted']==TRUE){
                              echo"<p class='text-danger fw-bold'>Deactivated</p>";
                            }else{
                              echo"<p class='text-success fw-bold'>Activated</p>";
                            }
                          ?>
                        </td>
                        <td>
                            <a href="admin_seller.php?id=<?php echo $user['seller_id']?>" class='btn btn-success ms-1'>view details
                            </a>                        
                        </td>

                    </tr>

                  <?php
                    }
                  }else{
                    echo "<p class='alert alert-danger'>No sellers yet</p>";
                  }
                  ?> 
                  </tbody>

                </table>  
          </div>
        </main>
     </div>
     
      

<?php require_once "partials/footer.php"?>
<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script src='//cdn.datatables.net/2.2.2/js/dataTables.min.js'></script>
<script>
  
  $(document).ready(function(){
    // alert('i am here')
    let table = new DataTable('#dashtable')

   <?php require_once "partials/admin_logout.js"?>
   })
</script>

</body>
</html>



    
