<?php
require_once "../class/Buyer.php";
if(isset($_GET['id'])){
    $id= $_GET['id'];

    // echo "<option>$id</option>";
    // exit;

$lg=new Buyer;
$lgs=$lg->fetch_lga($id);

foreach($lgs as $lga){
    $lgaid=$lga['lga_id'];
    echo "<option value='$lgaid'>". $lga['lga_name']."</option>";
}
}
?>