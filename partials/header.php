<?php 

if(isset($_SESSION['id']) && isset($_SESSION['role'])){
  $id= $_SESSION['id'];
  $role= $_SESSION['role'];
}    
require_once "class/Category.php";
$category = new Category;
$cat=$category->fetch_category();
// print_r($_SESSION['id']);
// echo $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name='description' content='Foodiego, healthy choices delivered to your kitchen. An online platform that facilitates the connection and transaction between buyers and sellers of food products.'>
    <meta name='keywords' content='Foodiego, online food delivery, healthy choices, food products, buyers and sellers, food delivery service, online marketplace, food shopping, convenience, quality food, local produce'>
    <meta name='author' content='Williams samuel'>
    <meta name='robots' content='index, follow'>
    <title>FOODIE_GO</title>
    <link href="assets/styles.css" rel="stylsheet">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/animate.min.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">


<link rel="icon" href="assets/favicon.ico">


<style>
body{
     background-color:#FFFFE0;  
     font-family:"Alegreya",serif;
    overflow-x:hidden
}

#navvy{
    
    background-color:#006600;
    position:sticky !important;
    top: 0px;
    width:100vw;
    /* background-color: rgba(139, 68, 10, 0.8)!important;  */
    

}

#navvy  a:hover{
    color: yellow !important;;
}
#navvy  a{
    color: #FFFAE0 !important;;
}

.design{
    background-color:#006600;color:white}
   .white a{
    text-decoration: none !important;color:white} 
   h6{
    font-weight: bolder;}
   ul{
    list-style-type: none;}
   #logo{
    font-size: 2em;}
    a:hover{
        color:yellow;
    }

.searchbutton:hover{
    background-color:#FFD700;
    
}
.searchbutton{
    color:white;
    border:1px solid yellow;
    
}
.overlay{
    background-color:rgba(0,0,0,0.3);
}
.buyer_sidebar a:hover{
color:red;
}
img.sixtyfour{
    width:64px;
}
#seller_sidebar a:hover{
color:red !important;
}
#seller_dashboard{
    background-color:#FFFFE0;
}
#buyer_dashboard{
  background-color:#FFFFE0 !important;
}
.buyer_sidebar a:hover{
color:red !important;
}


</style>


   

</head>

<body class='d-flex flex-column min-vh-100 '>
<nav class="navbar navbar-expand-lg   w-100 z-1" id="navvy">
    <div class="container-fluid">
      <a class="navbar-brand ms-4" href="landing2.php">Foodie_Go</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <?php 
      if(isset($_SESSION['id']) && isset($_SESSION['role'])){
        
      ?>
        <form class="d-flex ms-3" role="search">
        
            <input class="form-control me-2 ms-5 " width='100%' id="navsearch"  type="search" placeholder="Enter product name" aria-label="Search">
        
            <button class="btn searchbutton" type="button" id="btnsearch">Search</button>
        </form>
        
        <ul class="navbar-nav ms-auto  me-4 mb-2 mb-lg-0">
          <li class="nav-item shift">
              <a class="nav-link active" aria-current="page" href="landing2.php"><i class="fa-solid fa-house"></i>Home</a>
          </li>
                          
                <li class="nav-item shift">
                    <a class="nav-link active" aria-current="page"
                  href=" 
                    <?php
                    if(isset($_SESSION['role'])){
                      if($role=='seller'){
                      echo "seller.php";
                      }else{
                      echo 'buyer.php';
                      }
                    }
                    ?>"
                  ><i class="fa-solid fa-user"></i>account</a>
                </li>
      <?php 
          if(isset($_SESSION['role'])){
            if($role=='buyer'){
        ?>
        <li class="nav-item shift" >   
            <a class="nav-link active" aria-current="page" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>cart <span id="cart_icon" class="badge bg-danger"><?php 
            if(isset($_SESSION['cart'])){
                echo $_SESSION['count_cart'];
            }
            
            ?></span></a></li>

         <?php
          
            }
          }
         ?>   
         <li class="nav-item shift"> 
            <a class="nav-link active" aria-current="page" href="faq.php"><i class="fa-solid fa-question"></i>help</a></li>
        </ul>
          <?php
      }
          ?>
      </div>
    </div>
  </nav>

    <!-- container -->
  <div class="container-fluid contain_bg">
      
   