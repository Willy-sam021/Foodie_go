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
         
            <table class="table table-striped table-sm" id='dashtable'>
                <thead> 
                    <tr>
                        <th>S/N</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>phone</th>
                        <th>action</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php $sn=1; echo $sn++?></td>
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
  let table= new DataTable('#dashtable')
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

</body>
</html>



    
