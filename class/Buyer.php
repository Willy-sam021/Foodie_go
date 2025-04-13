<?php
   require_once "Connection.php";

   class Buyer extends Connection{
       private $con;
       public function __construct(){
           try{
               $this->con=$this->connect();
           }catch(PDOException $e){
            $e->getMessage();
            return false;
           }

       }

       public function register_buyer($fname,$lname,$phone,$email,$pass){
            try{
                $hashed=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO buyers SET buyer_fname=?,buyer_lname=?, buyer_phone=?, buyer_email=?,buyer_password=?";
                $stmt=$this->con->prepare($sql);
                $user = $stmt->execute([$fname,$lname,$phone,$email,$hashed]);
                if($user){
                    return $user; 
                    exit;
                }else{
                    $_SESSION['errormsg']="an error occured";
                    return false;
                    exit;
                }
            
            }catch(PDOException $e){
              echo  $e->getMessage();
               $_SESSION['errormsg']="an error occured";
            }

       }


        public function email_exists($email){
           try{ 
                $sql="SELECT *FROM buyers WHERE buyer_email=?";
                $stmt= $this->con->prepare($sql);
                $stmt->execute([$email]);
                $data=$stmt->fetch(PDO::FETCH_ASSOC);
                if($data){
                    return true;//email already in use
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }      
          }

          public function login($email,$pass){
            try{
                $sql="SELECT * FROM buyers WHERE buyer_email=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$email]);
               $buyer= $stmt->fetch(PDO::FETCH_ASSOC);
               if($buyer){
                    $hashed=$buyer['buyer_password'];
                    $password=password_verify($pass,$hashed);
                    if($password===true){
                        return $buyer;
                        exit;
                    }else{
                        $_SESSION['errormsg']="invalid credentials";
                        return false;
                        exit;
                    }

                   
               }else{
                $_SESSION['errormsg']="invalid credentials";
                return false;
               }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }      
          }
       
          

          public function identify_id($id){
            try{
                $sql="SELECT * FROM buyers WHERE buyer_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
               $identity= $stmt->fetch(PDO::FETCH_ASSOC);
                if($identity){
                    return $identity;
                    exit;
                }else{
                    $_SESSION['errormsg']="an error occured";
                    return false;   
                }


            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }


          }


          public function logout(){
            unset($_SESSION['id']);
            unset($_SESSION['role']);
            $_SESSION=[];
            session_unset();
            session_destroy();
          
        }


        public function buyer_order_details($id){
            try{ 
                 $sql="SELECT *FROM orders JOIN order_details ON orders.order_id=order_details.order_id JOIN delivery_information ON delivery_information.order_id JOIN payment ON payment.order_id WHERE buyer_id=?";
                 $stmt= $this->con->prepare($sql);
                 $stmt->execute([$id]);
                 $data=$stmt->fetch(PDO::FETCH_ASSOC);
                 
                            
                 if($data){
                     return $data;//email already in use
                 }else{
                     return false;
                 }
             }catch(PDOException $e){
                 echo  $e->getMessage();
                  $_SESSION['errormsg']="an error occured";
               }      
           }


           public function buyer_order_count($id){
            try{ 
                 $sql="SELECT *FROM orders  WHERE buyer_id=?";
                 $stmt= $this->con->prepare($sql);
                 $stmt->execute([$id]);
                 $data=$stmt->rowcount();
                 
                            
                 if($data){
                     return $data;//email already in use
                 }else{
                     return false;
                 }
             }catch(PDOException $e){
                 echo  $e->getMessage();
                  $_SESSION['errormsg']="an error occured";
               }      
           }
 
 

           public function update_buyer_profile($fname,$lname,$phone,$address,$buyer_id){
            try{
                $sql="UPDATE buyers SET buyer_fname=?, buyer_lname=?,buyer_phone=?,buyer_address=? WHERE buyer_id=?";
            $stmt=$this->con->prepare($sql);
              $chk= $stmt->execute([$fname,$lname,$phone,$address,$buyer_id]);
                if($chk){
                   
                    return true;
                }else{
                   
                    return false;
                }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 
              }


           }
        
        
           public function fetch_all_states(){
            $sql="SELECT * FROM state ";
            $stmt=$this->connect()->prepare($sql);//cant use last insert id 
            $stmt->execute();
            $states=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $states;

        }
        
        public function fetch_allproductby_state($state_id,$lga_id){
            $sql='SELECT * FROM sellers JOIN product ON sellers.seller_id = product.seller_id WHERE seller_state_id=? AND seller_lga=?';
            $stmt=$this->con->prepare($sql);
            $stmt->execute([$state_id,$lga_id]);
            $allprod=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if($allprod){
                return $allprod;
                exit;
            }else{
                return false;
                exit;
            }



        }
        
        public function fetch_lga($stateid){
            $sql="SELECT * FROM lga WHERE state_id =?";
            $stmt=$this->connect()->prepare($sql);//cant use last insert id 
            $stmt->execute([$stateid]);
            $lgas=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lgas;
        }

        
        
        
        
        
        }

   
    //     $test=new Buyer;
    // $buyer= $test->identify_id(7);
    //  echo"<pre>";
    //  print_r($buyer);
    //  echo "</pre>";
   
?>