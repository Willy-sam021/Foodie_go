<?php
    session_start();
    if(empty($_SESSION['cart'])){
        $_SESSION['cart']=[];
    }
    //unset($_SESSION['cart']);
   
    if(isset($_POST['xyz'])){
       
         $lex=$_POST['cart'];
       

        $_SESSION['cart'][$lex]=[
            "productid"=>$lex,
            "quantity"=>1
           
           
        ];
  
       // print_r($_SESSION['cart']);
       //print_r($_SESSION['cart']);
  
  
       echo count($_SESSION['cart']);
  
  
    }
   
   

    //print_r($lex) ;







?>