<?php
    session_start();
    require_once "admin_guard.php";
    require_once "class/Admin.php";
    $admin= new Admin;
    

    if(! isset($_GET['id']) || empty($_GET['id']) || !is_Numeric($_GET['id']) ){
      
      
        header("location:admin_view_buyers.php");
      // header("location:admin_buyer.php");
      
        
    }else{
      
        $_SESSION['admin_buyerid']=$_GET['id'];
         
       $validate= $admin->get_buyer_id($_SESSION['admin_buyerid']);
       if(!$validate){
        header("location:admin_view_buyers.php");
        exit;
       }

       $buyer_order=$admin->buyer_view_deets($_SESSION['admin_buyerid']);
         $user=$admin->get_buyer_id($_SESSION['admin_buyerid']);
        
         if(! $user){
           $_SESSION['admin_error']="not found";
           header("location:admin_view_buyers.php");
           exit;
           
         }
    }
    
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

         

          <h2>View Buyer info</h2>
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
                        <th>Action</th>
                        
                    </tr>
                     <tr>
                        <td><?php
                        if($user){
                          echo $user['buyer_fname'];
                        }
                         ?>
                        </td>
                        <td>
                          <?php if($user){
                          echo $user['buyer_lname'];
                          
                        }
                        ?>
                        </td>
                        
                        <td>
                          <?php if($user){
                          echo $user['buyer_phone'];
                        }
                        ?>
                        </td>
                        <td>
                        <button class='btn btn-danger' id='btndelete' name="deletebtn">delete </button>
                        </td>
                        
                    </tr>

                  
                </table>
               
            </table>
          </div>
        </main>
  
  
  
  
  
  
  
  
</div>
    
      <div class="row my-md-3">
            <div class="col-md-12">
              <h1 class='text-center'>Update buyer info</h1>
              <?php 
                    if(isset($_SESSION['admin_update_buyer_error'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_update_buyer_error']."</p>";
                        unset($_SESSION['admin_update_buyer_error']);
                    }
                
                ?>
                <?php 
                    if(isset($_SESSION['admin_update_buyer_feedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_update_buyer_feedback']."</p>";
                        unset($_SESSION['admin_update_buyer_feedback']);
                    }
                
                ?>
            <div class="col-md-7  shadow offset-md-3">
            <form action="process/update_buyer.php" method="post" id='myform' class='offset-md-2'>
             <div class="row mb-3">
                <label for="person" class="col-sm-2 col-form-label">First Name</label>
                     <div class="col-sm-5">
                            <input type="text" name="firstname" value="<?php echo $user['buyer_fname']?>" class="form-control noround border-dark mb-3" id="firstname">
                     </div>
            </div>
            <div class="row">
                 <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-5">
                            <input type="text" name="lastname" value="<?php echo $user['buyer_lname']?>" class="form-control noround border-dark mb-3" id="lastname">
                        </div>
                 </div>
            
                    <div class="row">
                        <label  class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control noround border-dark mb-3" value="<?php echo $user['buyer_phone']?>" id="phone" name="phone">
                                
                            </div>
                    </div>
                    
                    

                    <div class="row">
                        <label  class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-5">
                               <textarea class="form-control noround border-dark "  id="phone" name="address"><?php echo $user['buyer_address']?></textarea>
                                
                            </div>
                    </div>              
        
                      <div class="row mt-3">
                            
                            <div class="col-sm-9 text-center">
                                <button type="submit" id="btnupdate"name="btnupdate" class="btn btn-success col-6 noround mb-3">Update Account</button>
                            </div>
                        </div>
                    
   
                    </form>
                    </div>
            </div>
        </div>


<?php require_once "partials/footer.php"?>

<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script>

  $(document).ready(function(){
  
    $('#btndelete').click(function(event){
            event.preventDefault()
            var x = confirm('are you sure you want to delete this buyer ?')

            if(x==true){
                window.location.href="process/delete_buyer.php"
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



    
