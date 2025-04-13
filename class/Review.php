<?php
   require_once "Connection.php";

   class Review extends Connection{
       private $con;
       public function __construct(){
           try{
               $this->con=$this->connect();
           }catch(PDOException $e){
            $e->getMessage();
            return false;
           }

       }

   
       public function buyer_review($buyer_id,$prod_id,$comment,$rating){
        try{
            $sql="INSERT INTO review SET buyer_id=?,product_id=?,comment=?,review_rating=?";
            $stmt=$this->con->prepare($sql);
           $rate= $stmt->execute([$buyer_id,$prod_id,$comment,$rating]);
            if($rate){
                return true;
                exit;
            }else{
                return false;
                exit;
            }

        }catch(PDOException $e){
            $e->getMessage();
            return false;
           }
       }
   
       
       public function buyer_view_reviews($buyer_id){
        try{
            $sql="SELECT * FROM review JOIN product ON product.product_id = review.product_id WHERE buyer_id=?";
            $stmt=$this->con->prepare($sql);
            $stmt->execute([$buyer_id]);
           $rate= $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($rate){
                return $rate;
                exit;
            }else{
                return false;
                exit;
            }

        }catch(PDOException $e){
            $e->getMessage();
            return false;
           }
       }
   

   
   
   
   
   
   
   
   
   
   
   
   
    }
       ?>