<?php 
session_start();
require_once "partials/header.php";
require_once "userguard.php";

?>

    <div class="row" style='min-height:500px'>
        <div class="col">
            <div class="row mb-4">
                <div class="col-md-4 pt-md-5">
                    <img src="assets/images/about_us.png" width='100%'class='mt-md-2 img-fluid' alt="about us">
                </div>
                <div class='col-md-8'>
                    <p class='text-center fw-bold fs-2 text-capitalize'>About us<p> 
                    <div class='mt-4'>
                        
                        <p>
                        Welcome to Foodiego — a vibrant online marketplace where fresh, raw foods meet eager buyers. <br>
                            We are passionate about connecting farmers, food vendors, and health-conscious consumers in one seamless, easy-to-use platform. Whether you're looking to sell your fresh produce or stock up on nutrient-rich, farm-to-table goodness, we make the process simple, secure, and rewarding.

                       </p>
                    </div>
                </div>
            </div>
<hr>

            <div class="row">
                <!-- our mission -->
                <div class="col">
                        <h1 class='text-center text-capitalize'>OUR MISSION</h1>
                        <p>At Foodie go, our mission is to redefine the raw food experience by building a sustainable, people-first ecosystem that connects local producers with health-conscious consumers.
                        We aim to: <br>
                        🌱 Empower farmers and small-scale vendors by giving them an online platform to grow their customer base and income. <br>
                        🍅 Provide buyers with fresh, nutrient-rich foods that support a healthy lifestyle and clean eating. <br>
                        🚛 Simplify the food supply chain, making it transparent, traceable, and trustworthy. <br>
                        🌍 Encourage environmentally responsible practices, reduce food waste, and promote community-driven commerce. <br>
                        Our commitment lies in creating a world where healthy food choices are accessible to all — and where every purchase supports a bigger purpose and a bigger future.
                        </p>
                </div>

                <!-- our vision -->
                <div class="col">
                    <h1 class='text-center text-capitalize'>OUR VISION</h1>
                    <p>We envision a world where fresh, raw, and wholesome food is within reach for everyone — regardless of location or lifestyle.
                        Our dream is to be the leading online hub for raw food trading in Africa and beyond, where farmers, traders, chefs, and conscious eaters come together in a thriving, fair, and transparent digital marketplace.
                        We see: <br>
                        🌐 A global community rooted in local raw food. <br>
                        💡 A smarter food economy where buyers and sellers are empowered. <br>
                        🧺 A future where every plate is filled with food that’s fresh, traceable, and full of life. <br>
                        We’re not just selling food — we’re building a healthier tomorrow, one raw ingredient at a time.

                        </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <!-- what we offer -->
                <div class="col">
                    <h1 class='text-center text-capitalize'>What we offer</h1>
                    <p>A space for farmers and sellers to showcase their raw food products <br>

                        🛒 A reliable shopping experience for buyers seeking fresh, unprocessed ingredients <br>

                        🚚 Delivery coordination to ensure timely and safe food transport <br>

                        🌍 Support for sustainable, eco-friendly food practices
                    </p>
                </div>
                <div class="col">
                    <!-- why choose us -->
                        <h1 class='text-center text-capitalize'>why choose us</h1>
                        <p>🔄 Direct Farm-to-Table Access <br>
                            No middlemen. Just real people with real produce. <br>
                            📱 User-Friendly Platform <br>
                            Post, browse, buy, or sell — all in just a few clicks. <br>
                            💬 Community-Focused Support <br>
                            We’re here to help — whether you're growing it, selling it, or eating it.</p>
                </div>
            </div>
<hr>
            <div class="row">
                <!-- our story  -->
                <div class="col">
                    <h1 class='text-center'>Our story</h1>
                    <p>This project began with a simple idea: What if buying and selling raw food was as easy as ordering takeout?
                    With that question, we set out to build a solution — a platform that empowers farmers, supports healthy eating, and makes fresh food more accessible to all.

                    We’re more than just a marketplace — we’re a movement towards better food, better health, and better connections.</p>
                </div>
            </div>

            <div class="row">
                
        <!-- contact us -->
                    <div class="col-6 border">
                        <div id="contact">
                            <h1 class='text-center'>Contact us</h1>
                            <p>If you're encountering any problem, please dont hesistate to contact us:</p>
                            <p>Our Email: Foodiego.com</p>
                            <h3>Our social media handle</h3>
                            <p><a href="" ><i class="fa-brands fa-facebook"></i>Facebook</a>
                                <a href="" class="ms-2"><i class="fa-brands fa-instagram"></i>Instagram</a>
                                <a href="" class="ms-2"><i class="fa-brands fa-youtube"></i>youtube</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 border">
                        <h1 class='text-center'>Our location</h1>
                        <p>Lagos island</p>
                        <div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63432.57438824445!2d3.380540347888019!3d6.453569645590524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf4cc9b07cf55%3A0xc4ae10b395418b9b!2sLagos%20Island!5e0!3m2!1sen!2sng!4v1744661428701!5m2!1sen!2sng" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                
            </div>
        </div>     
    </div>  
        <!-- container div -->
    
    
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
 <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
         <?php require_once "partials/buyer_logout.js"?>
    </script>

    <?php require_once "partials/footer.php"?>
