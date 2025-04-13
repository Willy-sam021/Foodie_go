<?php
    require_once "Connection.php";
    class Product extends Connection{
        private $con;
        public function __construct(){
            try{
                $this->con=$this->connect();
            }catch(PDOException $e){
                $e->getMessage();
            }

        }


        public function view_all_products(){
            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE sellers.is_deleted=FALSE";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
               $res= $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $res;

            }catch(PDOException $e){
            echo  $e->getMessage();
             $_SESSION['errormsg']="an error occured";
          }
        
        
        }


        public function product_deets($id){
            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE product_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
               $res= $stmt->fetch(PDO::FETCH_ASSOC);   
               if($res){
                return $res;
                exit;
                }else{
                    return false;
                    exit;
                }
            }catch(PDOException $e){
            echo  $e->getMessage();
             $_SESSION['errormsg']="an error occured";
          }
        
        
        }


        public function display_productsby_category($catid,$prodid){
            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id WHERE category_id=? AND product_id NOT IN (?)";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$catid,$prodid]);
               $res= $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($res){
                return $res;
                exit;
                }else{
                    return false;
                    exit;
                }
            }catch(PDOException $e){
            echo  $e->getMessage();
             $_SESSION['errormsg']="an error occured";
          }
        
        
        }

        public function buyer_category($catid){
            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id WHERE category_id=? ";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$catid]);
               $res= $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($res){
                return $res;
                exit;
                }else{
                    return false;
                    exit;
                }
            }catch(PDOException $e){
            echo  $e->getMessage();
             $_SESSION['errormsg']="an error occured";
          }
        
        
        }


        public function get_product_cart($id){

            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id WHERE product.product_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
               $all_products= $stmt->fetchAll(PDO::FETCH_ASSOC);
               if($all_products){
                    return $all_products;
                    exit;
               }else{
                    return false;
                    exit;
               }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }


        }



        public function get_product_cart_order($id,$orderid){

            try{
                $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN order_details ON order_details.product_id=product.product_id WHERE product.product_id=? AND order_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id,$orderid]);
               $all_products= $stmt->fetchAll(PDO::FETCH_ASSOC);
               if($all_products){
                    return $all_products;
                    exit;
               }else{
                    return false;
                    exit;
               }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }


        }


        public function search_all_products($msg){
            try{
            $sql="SELECT * FROM product JOIN product_category ON product.category_id=product_category.category_id JOIN sellers ON product.seller_id=sellers.seller_id WHERE product_name LIKE?";
            $stmt=$this->con->prepare($sql);
            $stmt->execute(["%$msg%"]);
           $search= $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($search){
                return $search;
            }else{
                return false;
            }
          
            }catch(PDOException $e){
              echo   $e->getMessage();
            }
        }



    }


    // $prod= new Product;
    // $products=$prod->view_all_products();
    // echo "<pre>";
    // print_r($products);
    // echo "</pre>";




?>