<?php 
session_start();
require_once "partials/header.php";
require_once "userguard.php";

?>

    <div class="row" style='min-height:500px'>
        <div class="col">
            <h3 class='text-center text-capitalize'>Privacy Policy</h3>
            <p class='fw-bold'>
                
                <span class='text-danger' style='font-size:1em'>Effective Date: 9th,April 2025 </span>
                <br>
                Thank you for choosing to be part of our community at Foodiego. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services.
            </p>
            <ol type='1'>
                <li class='fw-bold'>Information We Collect
                    <p>We collect personal information that you voluntarily provide when you register on the site, place an order, or interact with our platform. This may include: <br>
                        
                    •	Personal Identifiable Information (PII): such as your name, email address, phone number, and delivery address. <br>
                    •	Payment Information: such as billing details (Note: we do not store card information. Payments are processed through secure third-party gateways). <br>
                    •	Account Credentials: such as your username and encrypted password. <br>
                    
                    •	Usage Data: such as pages visited, time spent on the site, and device/browser information.
                    </p>

                </li>

                <li class='fw-bold'>How We Use Your Information
                    <p>
                    We use your information for the following purposes: <br>
                    •	To create and manage your user account <br>
                    •	To facilitate the buying and selling of raw food items <br>
                    •	To process and fulfill orders <br>
                    •	To communicate with you about updates, transactions, and support <br>
                    •	To improve our website, services, and user experience <br>
                    •	To ensure compliance with legal obligations <br>

                    </p>

                </li>

                <li class='fw-bold'>
                    Sharing Your Information
                
                    <p>
                    We do not sell, rent, or trade your personal information to third parties. We may share your data with: <br>
                        •	Service providers that help us with website hosting, payment processing, delivery logistics, etc. <br>
                        •	Law enforcement or regulatory bodies if required by law briefly <br>
                        •	Other users, such as when a seller needs to contact a buyer for delivery purposes (only necessary details will be shared)

                    </p>
                </li>
                <li class='fw-bold'>Changes to This Policy
                    <p>We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on this page with a revised “Effective Date.”</p>
                </li>
            </ol>
           
        </div>     
    </div>  
        <!-- container div -->
    
    
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
 <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
         <?php require_once "partials/buyer_logout.js"?>
    </script>

    <?php require_once "partials/footer.php"?>
