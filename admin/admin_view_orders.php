<?php
    session_start();
    
    require_once "class/Admin.php";
    require_once "admin_guard.php";

$admin= new Admin;
$buyer_order=$admin->buyer_view_deets();
require_once "partials/header.php";
?>
 
    <div class="row" style='min-height:500px'>
    <?php require_once "partials/admin_sidebar.php"?>
                    
      
        <div class="col">
            <h2 class='text-center'>ORDERS</h2>
            <table class='table table-striped' id='dashtable'>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>order date</th>
                        <th>amount </th>  
                        <th>action</th>
                                                                                
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sn=1;
                        if($buyer_order){
                        foreach($buyer_order as $ord){
                    
                    ?>
                        <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php 
                                echo 
                                date('d/F/Y (H:i:s a)',strtotime($ord['order_date']))
                                ?>
                                
                            </td>
                            <td><?php 
                            if($ord['order_amount']==0){
                                echo "<span class='text-danger'>payment failed</span>";
                            }else{
                            echo "&#8358;".Number_format($ord['order_amount']);
                        }
                            
                            ?></td>
                            <td><a href="admin_one_product.php?id=<?php echo $ord['order_id']?>&buyer_id=<?php echo $ord['buyer_id']?>" class='btn btn-success'>view more</a></td>
                            
                        </tr>

                    <?php
                        }
                    }else{
                        echo "<p class='alert alert-danger'>No orders yet</p>";
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
   let table = new DataTable('#dashtable')
   console.log(table);
   <?php require_once "partials/admin_logout.js"?>

   })

</script>


</body>
</html>
