<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <?php require "links.html"?>
</head>
<body>
<?php require "navbar.html"?>
    <div class="container">
        <div class="row">
            <div class="col">
                 <h1>Frequently asked questions</h1>
                    <li><a href="">Shipping and delivery information</a></li>
                    <li><a href="">Shipping and delivery information</a></li>
                    <li><a href="">Returns and Refund Policy</a></li>
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
                                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <!-- third accordion item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Shipping and delivery information
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse"                     aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <!-- third accordion -->
                            <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <form action="process/process_contactform.php" method="post">
                    <h1>send us a message</h1>
                    <div class="row">
                        <div class="col-md-10">
                              <input type="text" name='name' class="form-control mb-3" placeholder='Name*'>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div>
                                 <input type="text" name='email' class="form-control" placeholder='Email*'>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div>
                                 <input type="text" name='phone' class="form-control" placeholder='Telephone*'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div>
                                 <textarea name='msg'  class="form-control mb-3"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <button name='button' class='btn btn-success'>Send message</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>

            <!-- container div -->
    </div>
    
        <?php require_once "footer.php"?>
        <?php require_once "scriptslinks.html"?>
</body>
</html>