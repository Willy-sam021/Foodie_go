<?php
    session_start();
    require_once "admin_guard.php";
    require_once "class/Admin.php";
    
   $admin_deets=$_SESSION['admin_id'];
   //print_r($admin_deets);

    

    require_once "partials/header.php";
    $test= new Admin;
    

    $total_order=$test->order_count();
    $total_sellers=$test->seller_count();
    $total_buyers=$test->buyer_count();

    // print_r($total_buyers);
    // echo count($total_buyers);

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

          
          <div class="row">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center">
                        <h5>Number of Orders                 
                        </h5>
                    </div>
                    <div class="card-body">
                      <a href="admin_view_orders.php" class="text-decoration-none text-white">
                        <h5 class="card-title  text-center"><?php
                        if($total_order){
                          echo "<span class='badge badge-success'>$total_order</span>";
                      }else{
                          echo "0";
                      }
                        
                        ?>
                        </a></h5>                           
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center">
                        <h5>Number of Sellers</h5>
                    </div>
                    <div class="card-body">
                      <a href="admin_view_sellers.php"class="text-decoration-none ">
                      <h5 class="card-title text-center">
                        <?php
                        if($total_sellers){
                          echo $total_sellers;
                      }else{
                          echo "0";
                      }
                        
                        ?>
                        </a>
                        </h5>
                      </h5>                           
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center">
                        <h5>Number of Buyers</h5>
                    </div>
                    <div class="card-body">
                      <a href="admin_view_buyers.php" class="text-decoration-none text-white">
                      <h5 class="card-title text-center">

                      <?php
                        if($total_buyers){
                          echo $total_buyers;
                      }else{
                          echo "0";
                      }
                        
                        ?>
                      </a>
                      </h5>                           
                    </div>
                </div>
            </div>
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



    
