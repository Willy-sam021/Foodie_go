

<?php 
session_start();
require_once "admin_guard.php";
require_once "class/Admin.php";

$sell=new Admin;
$categories=$sell->fetch_category();
$seller1=$sell->fetch_all_sellers();
 require_once "partials/header.php"
 ?>

    
<div class="row mb-5" style='min-height:500px'>
<?php require_once "partials/admin_sidebar.php"?>

      <div class="col-md-8 ml-sm-auto  col-lg-10 px-4">
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




         <div class="col-md-6 mb-4 border rounded rounded-4 p-3 shadow offset-md-1">
            <h1 class='text-center text-capitalize m-2'>Add new categories</h1>
                <?php 
                    if(isset($_SESSION['cat_error'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['cat_error']."</p>";
                        unset($_SESSION['cat_error']);
                    }  
                ?>
                <?php 
                    if(isset($_SESSION['cat_feedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['cat_feedback']."</p>";
                        unset($_SESSION['cat_feedback']);
                    }
                ?>
                <form action="process/process_addcategories.php" method="post" enctype="multipart/form-data">
                    <div class='row'>
                      <div class="col-md-2 m-2">
                        <label class='form-label fw-bold'>Name</label>
                        </div>
                      <div class="col-md-8">
                        <input type="text" name="cat_name" class='form-control my-2'>
                      </div>
                    </div>
                    <div class='row'>
                      <div class="col-md-4 m-2">
                          <label class='mt-2 fw-bold '>Upload Category Image</label>
                      </div>
                      <div class='col-md-7'>
                          <input type="file" name="cat_image" class='form-control my-2'>
                        </div>
                      </div>
                    <div class='row'>
                      <div class="col">
                       <p class='text-center my-3'> <button class='btn btn-success' name='button'>add category</button></p>
                       </div>
                    </div>
                </form>
          
          
          
          
            <!-- <div class="col-md-6 shadow mt-md-5"> -->
              <hr color='black' size='4'>
            <h2 class='text-center text-capitalize'>delete category</h2>
            <div id='cat_response'></div>
            <form  id="delete_form" >
                    <div class='row'>
                      <div class="col-md-4">
                    <label class='fw-bold ms-1'>Select Category</label>
                    </div>
                    <div class="col-md-7">
                  <select name="deletecategory" class='form-select' id="deletecategory">
                      <?php
                      if(is_array($categories)){
                        foreach($categories as $cat){                      
                      ?>
                        <option value="<?php echo $cat['category_id']?>"><?php echo $cat['category_names']?></option>
                      <?php
                        }
                      }
                      ?>
                  </select> 
                  </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class='text-center my-4'><button class='btn btn-danger' name='btndelete' id="btndelete">Delete category</button></p>
               </div>
              </div>
              </form>
           
          <!-- </div> -->          
          
    </div>

          
         




    </div>
   
<?php require_once "partials/footer.php"?>
<script src="admin_assets/jquery-3.7.1.min.js"> </script>
<script>

  $(document).ready(function(){
  
      $('#delete_form').submit(function(event){  
        event.preventDefault()
        
       
          var x = confirm('are you sure you want to delete this category ?')
          var delete_cat = $('#deletecategory').val()
        
          if(x==true){
                $.ajax({
                  url:"process/delete_category.php",
                  method: "post",
                  data:{delete_cat,btndelete:true},
                  dataType:"text",
                  success:function(response){
                        $('#cat_response').empty()
                        $('#cat_response').append(
                          "<p class='alert alert-info'>"+response+"</p>"
                        )
                      
                  },
                  error:function(error){
                    console.log(error)
                  }
               
               
                })
             }

          
      
      })
   
   <?php require_once "partials/admin_logout.js"?>
   
  })
</script>
</body>
</html>



    