<?php 
session_start();
require_once "seller_guard.php";
require_once "class/Seller.php";
require_once "seller_deleted_guard.php";
$id =$_SESSION['id'];
$seller=new Seller;
$states=$seller->fetch_all_states();
$sell=$seller->identify_id($id['seller_id']);
$se=$seller->identify_seller_update($id['seller_id']);

require_once "partials/header.php";

?>

<div class="row" style='min-height: 400px;'>
    <?php require_once "partials/seller_sidebar.php"?>  
        <div class="col-md-6 offset-md-1 mt-3  shadow shadow-md">
            <button class="btn btn-primary mt-1 d-block d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                 Menu
            </button>
                <h1 class='text-center'>Profile update</h1>
                <?php 
                    if(isset($_SESSION['seller_profile'])){
                        echo "<p class='alert alert-info'>".$_SESSION['seller_profile']."</p>";
                        unset($_SESSION['seller_profile']);
                    }
                
                ?>
                <form id='myform '>
                    <div class='row'>
                        <div class="col-md-3">
                        <label class='form-label'>First Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="firstname" value="<?php echo ucfirst($sell['seller_fname'])?>" class="form-control border text-capitalize border-success mt-1" id="firstname"> 
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class="col-md-3">
                            <label>Last Name</label> 
                        </div>  
                        <div class="col-md-6">  
                            <input type="text" name="lastname" value="<?php echo ucfirst($sell['seller_lname'])?>" class="form-control  border text-capitalize border-success mt-1" id="lastname">
                        </div>   
                    </div>   
                    <div class='row mt-2'>
                        <div class="col-md-3">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control border border-success mt-1"value="<?php echo $sell['seller_phone']?>" id="phone" name="phone">  
                        </div>
                    </div>

                    <div class='row mt-2'>
                        <div class="col-md-3">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control border border-success mt-1"  id="address" name="address"><?php echo $sell['seller_address']?></textarea>
                        </div>
                    </div>       
                    <div class='row mt-2'>
                        <div class="col-md-3">
                            <label for="state">Select state</label>
                        </div>
                        <div class="col-md-6">
                            <select name="state" id="state" class='form-select border border-success'>
                             <?php if(isset($se['state_name'])){
                               echo" <option value='$se[state_id]'> $se[state_name]</option>";
                            }else{
                                echo "<option value=''>select state</option>";
                            }
                            
                            
                            ?>
                                

                               
                                <?php
                                    if($states){
                                    foreach($states as $state){
                                  ?>
                                    <option value="<?php echo $state['state_id']?>"><?php echo $state['state_name']?></option>

                                <?php
                                }
                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class="col-md-3">
                        
                            <label for="lg">Select LG</label>
                        </div>
                        <div class="col-md-6">
                            <select name="lg" id="lg" class='form-select border border-success'>
                            <?php
                                if(isset($se['lga_name'])){
                                    echo "<option value='$se[lga_id]'>$se[lga_name]</option>";
                                }
                                ?>
                               
                                <option value=''>select lg</option>
                            </select>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class="col mt-2">
                            <p class='text-center'> <button type="submit" id="btnupdate"name="btnupdate" class="btn btn-success ">Update Account</button></p>
                        </div>
                    </div>
                </form>
            </div>  
        </div> 
</div>

<?php require_once "partials/footer.php"?>

<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src='assets/jquery-3.7.1.min.js'></script>
<script>
    $(document).ready(function(){
       
        <?php require_once "partials/seller_logout.js"?>
        $('#btnupdate').click(function(){
            
            var firstname=$('#firstname').val()
            var lastname=$('#lastname').val()
        
            var phone=$('#phone').val()
            var address=$('#address').val()
            var state=$('#state').val()
            var lg=$('#lg').val()
            
        
            $.ajax({
                url:"seller_process/process_profile_update.php",
                method:"post",
                data:{
                    firstname:firstname,
                    lastname:lastname,
                    phone:phone,
                    address:address,
                    state:state,
                    lg:lg

                },
                dataType:"text",
                success:function(response){
                    console.log(response)
                 
                
                },
                error:function(error){
                    console.log(error)
                }
            })

        })

    
        $("#state").change(function(){

            var state_id=$('#state').val()
            
           $.ajax({
            url:"seller_process/process_location.php",
            method:"post",
            dataType:'text',
            data:{state:state_id,xyz:true},
            success:function(response){
                console.log (response)
                $('#lg').empty()
                $('#lg').append(response)
            
            },
            error:function(error){
                console.log(error)
            }


           })


        })


    })
</script>

</body>
</html>

