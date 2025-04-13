<?php
require_once "Connection.php";
class Delivery extends Connection{
    private $con;
    public function __construct(){
        try{
            $this->con=$this->connect();
        }catch(PDOException $e){
            $e->getMessage();
        }

    }

    public function set_delivery_date($order_id,$date){
        try{
            $sql="INSERT INTO delivery_information SET order_id=?,exp_dateofdelivery=?";
            $stmt=$this->con->prepare($sql);
            $res=$stmt->execute([$order_id,$date]);
            if($res){
                return true;
                exit;
            }else{
                return false;
                exit;
            }


        }catch(PDOException $e){
            $e->getMessage();
        }    
    }



        public function update_delivery($delivery_status,$buyerid,$order_id){
            try{
                $sql='UPDATE delivery_information JOIN orders ON orders.order_id=delivery_information.order_id SET delivery_status=? WHERE buyer_id=? AND delivery_information.order_id=?';
                $stmt=$this->con->prepare($sql);
              $res=  $stmt->execute([$delivery_status,$buyerid,$order_id]);
                if($res){
                    return true;
                    exit;
                }else{
                    return false;
                    exit;
                }
            }catch(PDOException $e){
              echo  $e->getMessage();
            }
        }



        public function fetch_delivery($order_id){
            try{
                $sql="SELECT * FROM delivery_information WHERE order_id=?" ;   
                $stmt=$this->con->prepare($sql);
               $stmt->execute([$order_id]);
               $res=$stmt->Fetch(PDO::FETCH_ASSOC);
                if($res){
                    return $res;
                    exit;
                }else{
                    return false;
                    exit;
                }
            }catch(PDOException $e){
              echo  $e->getMessage();
            }
        }





}

// $delivery = new Delivery;
// $delivery_info=$delivery->fetch_delivery(38);
// echo "<pre>";       
// print_r($delivery_info);
//  echo "</pre>"; 