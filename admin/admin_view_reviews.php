<?php
    session_start();
    require_once "class/Admin.php";
    
    
$rate= new Admin;
$review=$rate->admin_view_reviews();

// echo "<pre>";
// print_r($review);
// echo "</pre>";

   require_once "partials/header.php";
   
?>
 
    <div class="row" style='min-height:500px'>
    <?php require_once "partials/admin_sidebar.php"?>
               
        <div class="col-md-10">
            <h2 class='text-center'>REVIEWS</h2>
             <table class='table table-striped table_responsive' id='dashtable'>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>product name</th>
                        <th>product image</th>
                        <th>buyer firstname</th>
                        <th>buyer lastname</th>
                        <th>review rating</th>
                        <th>comment</th>
                        <th>review date</th>            
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sn=1;
                        if($review){
                        foreach($review as $rev){
                    
                    ?>
                        <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php echo $rev['product_name']?></td>
                            <td><img src="../upload/<?php echo $rev['product_image']?>" alt="" style="width:64px"></td>
                            <td><?php echo $rev['buyer_fname']?></td>
                            <td><?php echo $rev['buyer_lname']?></td>
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
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
   
    <?php require_once "partials/footer.php"?>
    <script src='admin_assets/jquery-3.7.1.min.js'></script>
    <script src='//cdn.datatables.net/2.2.2/js/dataTables.min.js'></script>
    <script>
        $(document).ready(function(){
            // alert('i am here')
    let table = new DataTable('#dashtable')

   <?php require_once "partials/admin_logout.js"?>
   })

    </script>



    </body>
</html>
