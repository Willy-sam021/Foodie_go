<?php
    session_start();
    unset($_SESSION['admin_id']);
    require_once "partials/header.php"
   
?>
<style>
    img{width: 64px;}
</style>

<div class="row" style='min-height:400px'>
    <div class="col-md-8 offset-md-2 ">
        <div class="row mt-4">
        
            <div class="col-md-5 ">
                    <div class="animate__animated animate__tada animate__repeat-2">
                        <h1 class="text-center ">WELCOME TO FOODIE_GO </h1>
                        <p class="text-center"><img src="admin_assets/images/chicken.png" alt="chciken"><img src="admin_assets/images/shopping.png" alt=""></p>
                        <p class="text-center text-success" id="slogan">- Healthy choices, delivered to your kitchen!</p>
                     </div>
            </div>
        
            <div class="col-md-7 shadow-lg">
            <?php 
                    if(isset($_SESSION['admin_loginerror'])){
                        echo "<p class='alert alert-danger text-danger'>".$_SESSION['admin_loginerror']."</p>";
                        unset($_SESSION['admin_loginerror']);
                    }
                
                ?>
                <?php 
                    if(isset($_SESSION['admin_loginfeedback'])){
                        echo "<p class='alert alert-info'>".$_SESSION['admin_loginfeedback']."</p>";
                        unset($_SESSION['admin_loginfeedback']);
                    }
                
                ?>
                <div>
                    <h1 class='text-center mt-2  lead fw-bold'>ADMIN LOGIN</h1>
                <form action="process/admin_login_process.php" method='post' id='form'>
                      
                       
                        <div>
                            <label for="">Enter username</label>
                            <input type="text" name='username' class="form-control">
                        </div>
                        <div class='mt-2'>
                            <label for="">Enter password</label>
                            <input type="password" name='pwd'  class="form-control">
                        </div>
                       
                       
                        
                        <div>
                           <p class='text-center mt-3'> <button class="btn btn-success" name='submit' id="login">
                                Login
                            </button></p>
                        </div>
                        
                    </form>
    
                </div>
    
            </div>
        </div> 
    </div>
</div>
    
        <?php require_once "partials/footer.php"?>
    