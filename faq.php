<?php 
session_start();
require_once "partials/header.php";
require_once "userguard.php";

?>
    <div class="row" style='min-height:500px'>
        <div class="col">
            <div class="row mb-4">
                <div class="col-md-4 border">
                    <img src="assets/images/faqtwo.png" width='100%'class=' img-fluid' alt="">
                </div>
                <div class='col-md-8'>
                    <div class='mt-4'>
                        <h1>Welcome to our FAQ page!<h1> 
                        <h4>
                            Here you'll find answers to the most common questions about using our platform to buy and sell raw food items
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Shipping and delivery information
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <!-- first accordion -->
                                <div class="accordion-body">
                                    <h6>How are deliveries handled?</h6>
                                    <p>
                                        Delivery options vary by seller. Some sellers may offer home delivery, while others may arrange pickup points. Delivery fees (if any) will be displayed during checkout.
                                    </p>


                                </div>
                            </div>
                        </div>
                    <!-- second accordion item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Returns and Refund Policy
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <!-- second accordion -->
                                <div class="accordion-body">
                                    <h6>What if I receive a bad product?</h6>
                                        <p>
                                            We encourage sellers to maintain high-quality standards. If you receive a product that doesn't match the description or is spoiled, please report the issue within 24 hours of delivery. We’ll review the case and issue a refund or replacement if necessary.
                                        </p>
                                </div>
                            </div>
                        </div>
                        <!-- third accordion item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How does the platform work
                            </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"                     aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <!-- third accordion -->
                                <div class="accordion-body">
                                    <h6>How does the platform work?</h6>
                                        <p>
                                            Our platform connects buyers and sellers of raw food items. Sellers list their products with details like price, quantity, and location, while buyers can browse, order, and arrange for delivery or pickup.
                                        </p>                            
                                    <h6>Who can use the platform?</h6>
                                        <p>
                                            Anyone can sign up to buy or sell raw food items, provided they meet our terms of use. Whether you're a farmer, distributor, or a home buyer looking for fresh produce
                                        </p>
                                    <h6>Is it free to join?</h6>
                                        <p>
                                            Yes, signing up and creating an account is completely free. We may charge a small commission on successful sales, which will be clearly stated.

                                        </p>

                                    <h6>How do I place an order?</h6>
                                        <p>
                                            Browse the product listings, add items to your cart, and proceed to checkout. Once your order is confirmed, the seller will prepare it for delivery or pickup based on your preference
                                        </p>

                                    <h6>Is my payment information secure?</h6>
                                        <p>
                                            Yes. All payments are processed through secure, trusted third-party payment gateways. We do not store your credit or debit card information on our servers
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
