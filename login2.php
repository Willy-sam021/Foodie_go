<?php
session_start(); 
unset($_SESSION['id']);
unset($_SESSION['role']);
unset($_SESSION['cart']);
unset($_SESSION['seller_id']);
unset($_SESSION['buyer_id']);
unset($_SESSION['count_cart']);


require_once "partials/header.php";

    print_r($_SESSION);
?>
<style>
    img{width: 64px;}
    /* body{height: 100%; margin: 0;} */
</style>

<div class="row " style='min-height:600px'>
    <div class="col-md-8 offset-md-2">
        <div class="row mt-4 " style='min-height:400px'>
            <div class="col-md-5 pt-md-5 ">
                <div class="animate__animated animate__tada animate__repeat-2">
                    <h1 class="text-center ">WELCOME TO FOODIE_GO </h1>
                    <p class="text-center"><img src="assets/images/chicken.png" alt="a picture of a chicken" class='sixtyfour'><img src="assets/images/shopping.png" alt="a shopping bag" class='sixtyfour'></p>
                    <p class="text-center text-success" id="slogan">- Healthy choices, delivered to your kitchen!</p>
                </div>
            </div>
            <div class="col-md-6 offset-md-1 pt-4 ">
                
                    <?php 
                        if(isset($_SESSION['errormsg'])){
                            echo "<p class='alert alert-danger '>".$_SESSION['errormsg']."</p>";
                            unset($_SESSION['errormsg']);
                        }
                
                    ?>
                    <?php 
                        if(isset($_SESSION['feedback'])){
                            echo "<p class='alert alert-success'>".$_SESSION['feedback']."</p>";
                            unset($_SESSION['feedback']);
                    }
                
                    ?>
            
            <div>
                <form action="process/login_process.php" method='post'  id='form'> 
                    
                    <h1 class='text-center text-success fw-lighter lead mt-3 '>Foodie_go </h1>
                    
                    
                    <div class='row mt-md-3'>
                        <div class="col-md-4">
                            <label for="">Enter Email</label>
                        </div>
                        <div class="col-md-7">
                            <input type="email" name='name_email' class="form-control border border-success">
                        </div>
                    </div>
                    <div class='row mt-4'>
                        <div class="col-md-4">
                            <label>Enter Password</label>
                        </div>
                        <div class="col-md-7">
                            <input type="password" name='pwd'  class="form-control border border-success">
                        </div>
                    </div>
                    <div class=" row mt-4 mb-2">
                        <div class="col-md-4 mb-2">
                            <label >Choose Role</label><br>
                        </div>
                    
                    <div class=" col-md-7  ">
                        <input type="radio"  name="role" value='buyer' class="form-check-input me-1 border border-success"><span>Buyer</span>
                        <input type="radio"  name="role" value='seller' class="form-check-input ms-4 border border-success me-1"><span>Seller</span>
                    </div>
                    <div>
                        <p class='text-center'> <button class="btn btn-success mt-4 " name='submit' id="login">
                            Login
                        </button></p>
                    </div>
                    <div>
                    
                        <p class='text-center'>Dont have an account?<a href="register.php" class='text-decoration-none'style='color:red'> SignUp</a></p>
                           
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
    
<?php require_once "partials/footer.php"?>
