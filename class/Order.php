<?php
     require_once "Connection.php";
     class Order extends Connection{
         private $con;
         public function __construct(){
             try{
                 $this->con=$this->connect();
             }catch(PDOException $e){
                 $e->getMessage();
             }
 
         }
 

         public function Insert_into_order($buyer_id,$order_amt){
            try{
                $sql="INSERT INTO orders SET buyer_id=?,order_amount=?";
                $stmt=$this->con->prepare($sql);
               $stmt->execute([$buyer_id,$order_amt,]);
               $last_id= $this->con->LastInsertId();
                if($last_id){
                    return $last_id;
                    exit;
                }else{
                    return false;
                    exit;
                }



            }catch(PDOException $e){
             echo   $e->getMessage();
            }catch(Exeception $e){
                echo $e->getMessage();
            }
         }


         public function update_order_total($order_id,$grand_total){
            try{
                $sql="UPDATE orders SET order_amount=? WHERE order_id=?";
                $stmt=$this->con->prepare($sql);
                $res=$stmt->execute([$grand_total,$order_id]);
                if($res){
                    return true;
                    exit;
                }else{
                    return false;
                    exit;
                }


            }catch(Exeception $e){
                echo $e->getMessage();
            }   
        }









         public function fetch_order_details($id){
            try{
                $sql="SELECT * FROM order_details JOIN product ON order_details.product_id=product.product_id JOIN sellers ON product.seller_id = sellers.seller_id WHERE order_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
                $order_details=$stmt->fetchAll(PDO::FETCH_ASSOC);
                if($order_details){
                    return $order_details;
                    exit;
                }else{
                    return false;
                    exit;
                }

            }catch(PDOException $e){
                echo   $e->getMessage();
               }catch(Exeception $e){
                   echo $e->getMessage();
               }
         }














         public function Insert_into_orderdetails($order_id,$quantity,$product_id,$total_amt){
            try{
                $sql="INSERT INTO order_details SET order_id=?,quantity_purchased=?,product_id=?,total_amount=?";
                $stmt=$this->con->prepare($sql);
               $order_details= $stmt->execute([$order_id,$quantity,$product_id,$total_amt]);
                if($order_details){
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


            public function buyer_order_deets($id){
                try{
                    // $sql="SELECT * FROM order_details JOIN product ON order_details.product_id=product.product_id JOIN payment ON payment.order_id=order_details.order_id JOIN orders ON orders.order_id=order_details.order_id WHERE buyer_id=? ORDER BY order_date DESC";
                    $sql="SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id WHERE orders.buyer_id=? ORDER BY order_date DESC"; 
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id]);
                   $order= $stmt->fetchAll(PDO::FETCH_ASSOC);
                   if($order){
                        return $order;
                        exit;
                   }else{
                        return false;
                        exit;
                   }



                }catch(PDOException $e){
                 echo   $e->getMessage();
                }           
            }

            public function buyer_view_deets($id){
                try{
                     $sql="SELECT * FROM order_details JOIN product ON order_details.product_id=product.product_id  JOIN orders ON orders.order_id=order_details.order_id WHERE orders.order_id=? ORDER BY order_date DESC";
                    //$sql="SELECT * FROM order_details WHERE order_id=? "; 
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id]);
                   $order= $stmt->fetchAll(PDO::FETCH_ASSOC);
                   if($order){
                        return $order;
                        exit;
                   }else{
                        return false;
                        exit;
                   }
                }catch(PDOException $e){
                 echo   $e->getMessage();
                }           
            }


            public function buyer_order_success($id,$status){
                try{
                   
                    $sql="SELECT * FROM orders JOIN buyers ON orders.buyer_id=buyers.buyer_id JOIN order_details ON orders.order_id=order_details.order_id JOIN payment ON payment.order_id=orders.order_id WHERE orders.buyer_id=? AND payment_status=? ORDER BY order_date DESC"; 
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id,$status]);
                   $order= $stmt->fetchAll(PDO::FETCH_ASSOC);
                   if($order){
                        return $order;
                        exit;
                   }else{
                        return false;
                        exit;
                   }



                }catch(PDOException $e){
                 echo   $e->getMessage();
                }           
            }



                public function seller_orders($id){
                    try{
                        $sql="SELECT * FROM orders JOIN buyers ON orders.buyer_id=buyers.buyer_id JOIN payment ON payment.order_id=orders.order_id JOIN order_details ON orders.order_id = order_details.order_id JOIN product ON product.product_id=order_details.product_id WHERE payment_status=? AND seller_id=?" ;
                        $stmt=$this->con->prepare($sql);
                        $stmt->execute(['successful',$id]);
                       $seller= $stmt->fetchAll(PDO::FETCH_ASSOC);
                       if($seller){
                            return $seller;
                            exit;
                       }else{
                        return false;
                        exit;
                       }

                    }catch(PDOException $e){
                       echo $e->getMessage();
                    }
                }






        }

?>