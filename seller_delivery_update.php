<?php
    session_start();
    require_once "class/Order.php";
    require_once "class/Product.php";
    require_once "seller_guard.php";
    require_once "userguard.php";

if(!isset($_GET['id'])|| empty($_GET['id']) || !is_Numeric($_GET['id']) ){
    header("location:delivery.php");
    exit;
}

$_SESSION['delivery_id']=$_GET['id'];
require_once "partials/header.php";

?>
 
    <div class="row "style='min-height:500px'>
    <?php require_once "partials/seller_sidebar.php"?>
    
            <div class="col-md-6 offset-md-2">
                <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    Menu
                </button>
                <div id="display">

                </div>
                <form>
                    <div >
                        <h1 class='text-center mb-3'>Set delivery</h1>
                    </div>
                    <div>
                        <label class='mb-2' >Choose date of delivery</label><br>
                        
                        <input type="date" id='delivery_date' name='delivery_date' class='mb-3 form-control'><span>
                    </div>
                    
                    <div>
                        <button class='btn  btn-success' id="btndelivery"name='btndelivery'>Send</button>
                    </div>

                </form>
            </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
        $(document).ready(function(){
            $('#logout').click(function(event){
                event.preventDefault()
                var x = confirm('are you sure you want to log out?')

                if(x==true){
                    window.location.href="seller_process/logout_seller.php"
            }



            })
       
       
       
            $('#btndelivery').click(function(event){
                event.preventDefault()
               var deliveryDate=$('#delivery_date').val()
                //console.log(deliveryDate)

                $.ajax({
                    url:"seller_process/process_delivery_date.php",
                    method:"post",
                    data:{
                        date:deliveryDate, button:true
                    },
                    dataType:"text",
                    success:function(response){
                      //  alert(response)
                        $('#display').empty()
                        $('#display').append(response)
                    }
                })
            })
       
       
       
     //  
       
        })
    </script>

    <?php require_once "partials/footer.php"?>
    