 <!-- containerdiv -->
</div>
<!-- containerdiv -->
<!-- footer -->
 
<div class="container-fluid design  mt-5">
    <div class="row">
        <div class="col m-0 p-0">
            <div class="overlay">       
                <div class="row p-3 ">
                     <div class="col-sm-3 ">
                        <h6 id="logo">Foodie_Go</h6>
                        <p>Healthy choices delivered to your kitchen</p>
                    </div>
                </div>
                <?php 
                    if(isset($_SESSION['id'])){
                
                ?>
                <div class="row ps-md-3 p-3">
                    <div class="col-sm-3">
                        <p><i class="fa-solid fa-envelope"></i> Email: foodie_go@gmail.com</p>
                        <p><i class="fa-solid fa-phone"></i> Contact: 007 665 47</p>
                        <hr class='d-block d-md-none' color='black' size='10'>
                    </div>
                        
                    <div class="col-md-3 white">
                        <h6 class='d-none d-md-block'>CUSTOMER SERVICE AND SUPPORT</h6>
                        <p><a href="">Contact us</a></p>
                        <p><a href="">FAQs</a></p>   
                    </div>
                    <div class="col-md-3 white">
                        <h6 class='d-none d-md-block'>COMPANY INFORMATION</h6>
                        <p><a href="">About us</a></p>
                    </div>
                    <div class="col-md-3 white ">
                        <h6 class='d-none d-md-block'>POLICIES AND LEGAL</h6>
                        <p><a href="">Privacy policy|</a></p>
                        <p><a href="">Terms and condition</a></p>
                        <p><a href="">Cooking policy</a></p>
                        <p><a href="">Refund and cancellation policy</a></p>
                        <hr class='d-block d-md-none' color='black' size='10'>
                    </div>
                    
                    <div class="row ">
                        <div class="col-md-12 pb-2 mb-0 white">
                            <div>
                                <h6>JOIN US</h6>
                                <a href="" ><i class="fa-brands fa-facebook"></i>Facebook</a>
                                <a href="" class="ms-2"><i class="fa-brands fa-instagram"></i>Instagram</a>
                                <a href="" class="ms-2"><i class="fa-brands fa-youtube"></i>youtube</a>
                            </div>
                        </div>
                    </div>
                    <hr class='d-block d-md-none' color='black' size='10'>
                    <div class="row">
                        <div class="col">
                            <p class='text-center'>Foodie_Go &copy;2025 all rights reserved</p>
                        </div>
                    </div>
                    <?php
                        }
                    
                    ?>

                </div>     
            </div>
        </div>
    </div>
</div>

</body>
</html>
   