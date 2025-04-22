<?php 
session_start();
require_once "userguard.php";
require_once "class/Product.php";
require_once "class/Category.php";
require_once "class/Buyer.php";
if(isset($_SESSION['id']) && isset($_SESSION['role'])){
    $id= $_SESSION['id'];
    $role= $_SESSION['role'];
  }    
  require_once "class/Category.php";
  $category = new Category;
  $cat=$category->fetch_category();
  
$buyer= new Buyer;
$category= new Category;
$categories=$category->fetch_category();

$buy=$buyer->fetch_all_states();

if(!isset($_SESSION['id']) && !isset($_SESSION['role'])){
   header('location:login2.php');
   exit;
}  

if(isset($_SESSION['cart'])){
    $_SESSION['count_cart']= count($_SESSION['cart']);
}
    $id= $_SESSION['id'];
    $role= $_SESSION['role'];
    
 $prod= new Product;
    $products=$prod->view_all_products();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FOODIE_GO</title>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/animate.min.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">


<link rel="icon" href="assets/favicon.ico">

<!-- <link href="assets/styles.css" rel="stylesheet"> -->
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

#cattydroppy a:hover{
    color:red !important;
}
</style>

</head>

<body>
    <nav class="navbar navbar-expand-lg  w-100 z-1" id="navvy">
        <div class="container-fluid m-0 p-0">
            <a class="navbar-brand ms-4" href="landing2.php">Foodie_Go</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                    <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                <?php 
                if(isset($_SESSION['id']) && isset($_SESSION['role'])){
                    
                ?>     
                   <!-- search bar--  -->
                <div class='mt-3'>
                    <form class="d-flex ms-3" role="search">
                        <input class="form-control me-2 ms-5"  width='100%' id="navsearch" type="search" placeholder="Enter product name" aria-label="Search">
                        <button class="btn searchbutton" type="button" id="btnsearch">Search</button>
                    </form>
                </div>
                <!-- search bar ends  -->

                <ul class="navbar-nav ms-auto p-2 me-4 mb-2 mb-lg-0">
                    <li class="nav-item shift">
                        <a class="nav-link active" aria-current="page" href="landing2.php"><i class="fa-solid fa-house"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-list"></i> categories
                            </a>
                            <ul class="dropdown-menu bg-dark" id='cattydroppy' >
                                
                                <?php 
                                if($cat){
                                foreach($cat as $cate){
                                    echo "<li class='categories'   value='$cate[category_id]'><a class='dropdown-item' >$cate[category_names]</a></li>";

                                }
                            }
                                ?>
                                
                            </ul>
                    </li>
                            
                    <li class="nav-item shift">
                        <a class="nav-link active" aria-current="page" href=" 
                            <?php
                            if(isset($_SESSION['role'])){
                                if($role=='seller'){
                                    echo "seller.php";
                                }else{
                                    echo 'buyer.php';
                                }
                            }
                            ?>"
                        ><i class="fa-solid fa-user"></i>account   
                        </a> 
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
                        <a class="nav-link active" aria-current="page" href="faq.php"><i class="fa-solid fa-question"></i>help</a>
                    </li>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
    </nav>

    <!-- container -->
  
    <div class="container-fluid m-0 p-0">
           <!-- navbar -->
        <div class="row mt-2" style='min-height:500px'>
            <nav class="col rounded   sidebar" >
                <div class="sidebar-sticky p-3 rounded" id='sidebar'>
                    <h4 class='text-center mt-3'>Filter</h4>
                
                    <label >State</label>
                        <select name="state" id="state" class='form-select mb-3'>
                            <?php 
                            if($buy){
                                foreach($buy as $state){
                            ?>        
                            <option value="<?php echo $state['state_id']?>"><?php echo $state['state_name']?></option>

                            <?php
                            }
                                }
                            ?>
                        </select>
                    <label >LGA</label>
                        <select name="lga" id="lga" class='form-select mb-3'>  
                        </select>
                    <button class="btn btn-success mt-2" id='location'>search</button>
                </div>
            </nav> 
        <!-- nav bar ends -->
    
            <div class="col-md-10 shadow-lg"  id='landing_display'>
                <div class="row mt-2 " id="display">

                     <?php
                     //looping of products
                        if($products){
                        foreach($products as $product){

                        ?>
                    
                    <div class="col-12 col-sm-6 col-md-3  mb-2 " >
                        <a href="product_details.php?id=<?php echo $product['product_id']?>" class='text-decoration-none'>
                            <div class="card w-100" style="width: 14rem;">
                                <img class="card-img-top w-100 landing" src="upload/<?php echo $product['product_image']?>"alt="chicken">
                        </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['product_name']?></h5>
                                    <p class="card-text ">Price:&#8358;&nbsp;<span class='fw-bold'><?php echo Number_format($product['product_price'])?></span></p>
                                    <p class="card-text text-capitalize">Vendor:&nbsp;<?php echo $product['business_name']?></p>
                                    <button class="btn cart btn-success"  value="<?php echo $product['product_id']?>">add to cart</button>
                                </div>
                            </div>
                    </div>
                        <?php
                        }
                            }else
                                echo " <div class='col-md-12'>
                                <h4 class='alert alert-danger'>No product yet </h4>
                                </div>
                                <div class=row>
                                <div class='col-md-12'>
                                <img src='assets/images/empty cart.png' width='400px'alt='a picture of an empty cart' class='img-fluid'>
                                </div>
                                </div>
                                ";  
                            
                        ?>
                        <!-- looping ends -->
            
                </div>
            </div>
        </div>
    
 
    
<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
    <script>
        // setTimeout(() => {
        //     alert('welcome to foodie go')
        // }, 1000);    
        
        // var m=  document.getElementById('cart_icon').innerHTML ;
        // function shop_cart(){  
        //    m= Number(m)+1 ;
        //   document.getElementById('cart_icon').innerHTML=m;
        // }


        $(document).ready(function(){
            $('.cart').click(function(event){

                event.preventDefault()
               var t= $(this).val()
            
                $.ajax({
                    url:"process/landing_cart.php",
                    method:"post",
                    data:{cart:t,xyz:true},
                    dataType:"text",
                    success:function(response){
                        $('#cart_icon').text(response)
                        alert('added to cart')

                    },
                    error:function(error){
                        alert(error)
                    }

                })
           
           
            })


            $('#state').change(function(){
                var state=$(this).val()
                if(state ==''){
                  //  alert('select a state')
                }else{
                    
                    $('#lga').load("process/homelocation.php?id="+state) 
                }

            })
           
            $('#location').click(function(event){
                event.preventDefault()
                var lga=$('#lga').val()
                var state=$('#state').val()
                
               $('#display').load("process/display_by_location.php", {lga_id:lga, state_id: state})
                
            
        })

        // $('#catty').click(function(event){
        //         event.preventDefault()
        //         var cate=$('#categories').val()
        //         //alert(cate)
                
        //        $('#display').load('process/display_by_category.php',{category:cate})
                
            
        // })

        $('li.categories').click(function(){
                
                var cate=$(this).val()
                
                
               $('#display').load('process/display_by_category.php',{category:cate})
                
            
        })

        $('#btnsearch').click(function(){
            
            var text=$('#navsearch').val()
           // alert (text)
        
            $('#display').load('process/display_by_product.php',{message:text})
        })


        })
    </script>



   <?php require_once "partials/footer.php"?>
  
  
  
  
  
  
  
  
    
  
