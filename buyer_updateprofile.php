<?php 
session_start();
require_once "buyer_guard.php";
require_once "class/Buyer.php";

$buyer=new Buyer;

$id= $_SESSION['id'];
require_once "partials/header.php";

?>


<div class="row" style='min-height: 400px;'>
<?php require_once "partials/buyer_navbar.php"?>    
    <div class="col">
    <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Menu
    </button>
        
        <div id='response'></div>
            <div class="row mt-md-4">
                <div class="col-md-6 shadow  border-success rounded-3 offset-md-2">
                 <?php
                    if(isset($_SESSION['buyer_feebackprofile'])){
                        echo "<p class='alert alert-success'>".$_SESSION['buyer_feedbackprofile']."</p>";
                        unset($_SESSION['buyer_feedbackprofile']);
                    }
                    if(isset($_SESSION['buyer_errorprofile'])){
                        echo "<p class='alert alert-danger'>".$_SESSION['buyer_errorprofile']."</p>";
                        unset($_SESSION['buyer_errorprofile']);
                    }
                 
                 
                 
                 ?>   
                    <h3 class='text-center mt-2 '>Profile update</h3>
                    <form action='buyer_process/process_profile_buyer.php'  id='myform' method='post'>
                        <div class="row py-md-3 px-md-2 ">
                            <div class="col-md-3  ">
                                <label>First Name</label>
                            </div>
                            <div class="col-md-7 ">
                                <input type="text" name="firstname" value="<?php echo ucfirst($id['buyer_fname'])?>" class="form-control noround border-dark" id="firstname">
                            </div>
                        </div>
                        <div class="row py-md-2 px-md-2">
                            <div class="col-md-3 ">
                                <label for="lastname" >Last Name</label>
                            </div>  
                            <div class="col-md-7 ">
                                <input type="text" name="lastname" value="<?php echo ucfirst( $id['buyer_lname'])?>" class="form-control noround border-dark" id="lastname">
                            </div>
                        </div>

                    <div class="row py-md-2 px-md-2">
                        <div class="col-md-3 ">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-7 ">
                            <input type="text" class="form-control noround border-dark" value="<?php echo $id['buyer_phone']?>" id="phone" name="phone">   
                        </div>
                    </div>
                    
                    

                    <div class="row py-2 px-2">
                        <div class="col-md-3 ">
                            <label>Address</label>
                        </div>
                        <div class="col-md-7">
                            <textarea class="form-control border-dark"  id="address" name="address"><?php echo $id['buyer_address']?></textarea>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center my-3">
                            <button type="submit" id="btnupdate"name="btnupdate" class="btn btn-success ">Update Account</button>
                        </div>
                    </div>
                    
   
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
     <?php require_once "partials/buyer_logout.js"?>
</script>

<?php require_once "partials/footer.php"?>
