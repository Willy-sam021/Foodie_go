<?php

require_once "../class/Seller.php";

if(isset($_POST['xyz'])){

    $state_id=$_POST['state'];
    $seller = new Seller;
    $lgas=$seller->fetch_lga($state_id);
        
    foreach($lgas as $lga){
         $lgaid=$lga['lga_id'];
        echo "<option value='$lgaid'>". $lga['lga_name']."</option>";
    }
  
}
    









?>