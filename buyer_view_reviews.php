<?php
    session_start();
    require_once "class/Order.php";
    
    require_once "class/Review.php";
    require_once "buyer_guard.php";
    require_once "userguard.php";

$id= $_SESSION['id'];

$rate= new Review;
$review=$rate->buyer_view_reviews($_SESSION['buyer_id']);

// echo "<pre>";
// print_r($review);
// echo "</pre>";

   require_once "partials/header.php";
   
?>
 
<div class="row" style='min-height:500px'>
    <?php require_once "partials/buyer_navbar.php"?>
                    
      
    <div class="col-md-10">
        <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            Menu
        </button>
        
            <h2 class='text-center'>REVIEWS</h2>
            <div class='d-none d-md-block'>
             <table class='table  table-striped table_responsive' id='dashtable'>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>product name</th>
                        <th>product image</th>
                        <th>review rating</th>
                        <th>comment</th>
                        <th>review date</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sn=1;
                        // loop starts
                        if($review){
                        foreach($review as $rev){
                    
                    ?>
                        <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php echo $rev['product_name']?></td>
                            <td><img src="upload/<?php echo $rev['product_image']?>" alt="" class="sixtyfour"></td>
                            <td><?php echo $rev['review_rating']?></td>
                            <td><?php echo $rev['comment'] ?></td>
                            
                            <td><?php 
                                echo 
                                date('d/F/Y',strtotime($rev['review_date']))
                                ?>
                                
                            </td>
                           
                            
                        </tr>

                    <?php
                        }
                    }else{
                        echo "<p class='alert alert-danger'>No reviews made yet</p>";
                    }
                    // loop ends
                    ?>
                </tbody>
            </table>
            </div>
    </div>

    <div class="col d-md-none">
        
    <?php 
        $sn=1;
        if($review){
        foreach($review as $rev){
    
    ?>
    <h3 class='text-center'><?php echo $sn++?></h3>
    <div class="row border">
        <div class="col-md-6">
            
            <p>product name :<span class='fw-bold'><?php echo $rev['product_name']?></span></p>
            <p>Review rating :<span class='fw-bold'><?php echo $rev['review_rating']?></span></p>
            
            <p>Review date <span class='fw-bold'><?php echo date('d/F/Y',strtotime($rev['review_date']))?></span></p>

        </div>
        <div class="col-md-6">
            <img src="upload/<?php echo $rev['product_image']?>"  class='img-fluid' alt="" >
        </div>
       
    </div>
    <div class="row">
        <div class="col-12 p-3">
            <p class='fw-bold text-muted'>Review made on this product</p>
            <textarea name="" class='form-control my-3' readonly cols='3' rows='3' id=""><?php echo $rev['comment'] ?></textarea>
        </div>
        <hr>
    </div>
    <?php
        }
    }else{
        echo "<p class='alert alert-danger'>No reviews made yet</p>";
    }
    ?>
       
        
    </div>

</div>


<?php require_once "partials/footer.php"?>
    
    <script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
    <script src='assets/jquery-3.7.1.min.js'></script>
    <script>
         <?php require_once "partials/buyer_logout.js"?>
    </script>
    <script src='//cdn.datatables.net/2.2.2/js/dataTables.min.js'></script>

<script>
    $(document).ready(function(){
        
        let table = new DataTable('#dashtable')
    })
</script>

    </body>
</html>
