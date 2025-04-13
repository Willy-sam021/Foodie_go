<?php
session_start();
//  echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

require_once "partials/header.php";
   
?>

<!-- row1 -->
<div class="row mt-md-2 p-2 " style='min-height:500px'>
    <div class="col-md-8  offset-md-2">
        <div class="row mt-md-2 pt-md-5 ">
            <div class="col-md-4 pt-md-5 mt-md-4">
                    <div class="animate__animated animate__tada animate__repeat-2">
                        <h1 class="text-center ">WELCOME TO FOODIE_GO </h1>
                        <p class="text-center"><img src="assets/images/chicken.png" alt="chicken" class="sixtyfour"><img src="assets/images/shopping.png" alt="shopping cart" class='sixtyfour'></p>
                        <p class="text-center text-success" id="slogan">- Healthy choices, delivered to your kitchen!</p>
                     </div>
            </div>
        
            <div class="col-md-6 offset-md-2 p-md-3 shadow-lg rounded-4">
                
                <div>
                    <form action="process/register_process.php" method="post" >
                           <h4 class='text-center  my-3'>Registration form</h4>
                           <hr size='6' color='green'>
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
           
                            <div class="row ">
                                <div class="col-md-6 ">                               
                                    <label >Enter firstname</label>
                               
                                    <input type="text" name="fname" id='fname'class="form-control  border-success mt-1">
                               </div> 
                               <div class="col-md-6 ">                               
                                    <label >Enter lastname</label>
                               
                                    <input type="text" name="lname" id='lname' class="form-control border-success mt-1">
                               </div>   
                            </div>
                            

                            <div class="row">
                                <div class="col-md-12  mt-md-2">                               
                                    <label >Enter Email</label>
                               
                                    <input type="email" name="email" id='email' class="form-control border-success mt-md-1">
                               </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">                               
                                    <label >Enter phone </label>
                               
                                    <input type="text" name="phone" id='phone' class="form-control border-success mt-md-1">
                               </div>  
                            </div>                       
                            <div class="row mb-md-1">
                                
                                <div class="col mt-2">
                                    <label >Choose role</label>
                                    <input type="radio"  name="role" value='buyer'  id='buyer' class="form-check-input me-md-1 border-success ms-2"><span>Buyer</span>
                                    <input type="radio"  name="role" value='seller' id='seller' class="form-check-input ms-md-4 ms-2 me-1 border-success"><span>Seller</span>
                                </div>
                            </div>
                            <div class=' mb-md-2 ' id="vendor">
                                <label >Enter Business name</label>
                                <input type="text" name="vendor"  class="form-control border-success mt-1">
                            </div>
                            <div class='row '>
                                <div class="col-md-6 ">
                                    <label>Enter password</label>
                                    <input type="password" name="pwd" id='pwd' class="form-control border-success ">
                                </div>
                                <div class="col-md-6 ">
                                    <label >Confirm password</label>
                                    <input type="password" name="confpwd" id='confpwd'  class="form-control border-success ">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center"> <button class="btn btn-success col-md-4 mt-3" id='button' name='button'>Sign Up</button></p>
                                    <p class="text-center"> <a href='login2.php'p id='button'style='color:red' name='button'>back</a></p>
                                </div>
                            </div>
                     </form>
                </div>
            </div>
        </div> 
    </div>
</div>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/jquery-3.7.1.min.js"> </script>
<script>
    $(document).ready(function(){

        $('#vendor').hide()

        $('#seller').click(function(){
        var check=$('#seller').prop('checked')
    
        if(check ===true){
            $('#vendor').show()
        }

         })

         $('#buyer').click(function(){

            $('#vendor').hide()

         })

    })
   
</script>
<?php require_once "partials/footer.php"?>