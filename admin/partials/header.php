<?php 
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FOODIE_GO</title>
    <head>
    <link rel="stylesheet" href="admin_assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_assets/animate.min.css">
    <link rel="stylesheet" type="text/css" href="admin_assets/fontawesome/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
    
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="admin_assets/admin_styles.css">
    
    <style>  
         *{margin: 0px;padding: 0px;}
         #navvy{position:sticky; top: 0px;width:100vw}
        body{font-family:"Alegreya",serif;overflow-x:hidden}
       .shift{margin-right: 20px;}
        #search{width: 400px;}
        img{max-width:100% }
        /* @media (max-width: 768px) {
            img {margin-top: 10px;}

        } */

        @media (min-width: 992px) and (max-width: 1205px) {
            #search{width: 150px;}

        }

    {padding:0px;margin:0px}
   .design{background-color:rgba(0, 0, 0, 0.636);color:white}
   .white a{text-decoration: none !important;color:white} 
   h6{font-weight: bolder;}
   ul{list-style-type: none;}
   #logo{font-size: 2em;}

   #banner{
    background-image:url("admin_assets/images/chicken pics2.jpeg");
    background-size: cover;
}
.overlay{
    background-color: rgba(0, 0, 0, 0.9);
   }

   
    /* body{
      background-color:rgba(250, 240, 230); 
   } */
   #navvy{
    
    /* background-color:rgba(56,102,65); */
    
    position:sticky;
    top: 0px;
    width:100vw;
    /* background-color: rgba(139, 68, 10, 0.8)!important;  */
    

}
#navvy a{
    /* color:white!important; */
}
#navvy a:hover{
    /* color:yellow!important; */
}

    </style>
</head>
<body>
 
<nav class="navbar navbar-expand-lg  w-100 z-1" id="navvy">
    <div class="container-fluid">
      <a class="navbar-brand ms-4" href="landing2.php">Foodie_Go</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php 
        
        if(isset($_SESSION['admin_id'])){
        
        
        ?>
        <form class="d-flex ms-3" id='myform' role="search">
          
            <input class="form-control me-2 ms-5" id="search"  type="search" placeholder="Search" aria-label="Search">
            
            <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal" id='btnsearch' type="submit">Search</button>
            
        </form>
        
        
      </div>
      <?php
        }
      ?>
    </div>
  </nav>

    <!-- container -->
    <div class="container-fluid">
    
    <!-- Button trigger modal -->

