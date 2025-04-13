<?php
   require_once "Connection.php";

   class Seller extends Connection{
       private $con;
       public function __construct(){
           try{
               $this->con=$this->connect();
           }catch(PDOException $e){
            $e->getMessage();
            return false;
           }

       }

       public function register_seller($fname,$lname,$phone,$email,$pass,$vendor){
            try{
                $hashed=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO sellers SET seller_fname=?,seller_lname=?, seller_phone=?, seller_email=?,seller_password=?,business_name=?";
                $stmt=$this->con->prepare($sql);
                $user = $stmt->execute([$fname,$lname,$phone,$email,$hashed,$vendor]);
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
            $sql="SELECT *FROM sellers WHERE seller_email=?";
            $stmt= $this->con->prepare($sql);
            $stmt->execute([$email]);
            $data=$stmt->fetch();
            if($data){
                return true;//email already in use
            }else{
                return false;
            }
        }

        public function login($email,$pass){
            try{
                $sql="SELECT * FROM sellers WHERE seller_email=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$email]);
               $seller= $stmt->fetch(PDO::FETCH_ASSOC);
               if($seller){
                    $hashed=$seller['seller_password'];
                    $password=password_verify($pass,$hashed);
                    if($password===true){
                        return $seller;
                    }else{
                        $_SESSION['errormsg']="invalid credentials";
                        return false;
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
                $sql="SELECT * FROM sellers WHERE seller_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
               $identity= $stmt->fetch(PDO::FETCH_ASSOC);
                if($identity){
                    return $identity;
                }else{
                    $_SESSION['errormsg']="an error occured";
                    return false;   
                }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }

          }




          public function identify_seller_update($id){
            try{
                $sql="SELECT * FROM sellers LEFT JOIN state On sellers.seller_state_id=state.state_id JOIN lga ON sellers.seller_lga=lga.lga_id WHERE seller_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
               $identity= $stmt->fetch(PDO::FETCH_ASSOC);
                if($identity){
                    return $identity;
                }else{
                    $_SESSION['errormsg']="an error occured";
                    return false;   
                }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }

          }


















          public function verify_product($product_id,$business){
            try{
                $sql="SELECT * FROM sellers JOIN product ON sellers.seller_id=product.seller_id WHERE product_id=? AND business_name=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$product_id,$business]);
               $sellers= $stmt->fetch(PDO::FETCH_ASSOC);
               if($sellers){
                    return $sellers['seller_id'];
                    exit;
               }else{
                $_SESSION['admin_error']="an error occured";
                return false;
                exit;
               }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['admin_error']="an error occured";
              }
       
            }










          public function add_product($produt_name,$prod_desc,$tempname,$to,$unique,$price,$quantity,$seller,$cate){
            try{
                if(move_uploaded_file($tempname,$to)){
                $sql="INSERT INTO product SET product_name=?, product_description=?,product_image=?,product_price=?,product_quantity=?,seller_id=?,category_id=?";
                $stmt=$this->con->prepare($sql);
               $res= $stmt->execute([$produt_name,$prod_desc,$unique,$price,$quantity,$seller,$cate]);
                if($res){
                    return true;
                    exit;

                }else{
                  
                    return false;
                    exit;
                }
             }else{
                $_SESSION['errormsg']="failed to upload file";
                    return false;
             }
            }catch(PDOException $e){
                 $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }
          }

          public function fetch_category(){
            try{
                $sql="SELECT * FROM product_category";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
                $category=$stmt->fetchAll(PDO::FETCH_ASSOC);
                if($category){
                    return $category;
                }else{
                    $_SESSION['errormsg']="an error occured";
                }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }
          }


          public function logout(){
            unset($_SESSION['id']);
            unset($_SESSION['role']);
            session_destroy();
          
        }


        public function fetch_all_sellers(){
            try{
                $sql="SELECT * FROM sellers";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
               $sellers= $stmt->fetchAll(PDO::FETCH_ASSOC);
               if($sellers){
                    return $sellers;
               }else{
                    
               }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['errormsg']="an error occured";
              }
       
            }

            

            public function update_seller_profile($fname,$lname,$phone,$address,$stateid,$lgaid,$seller_id){
                try{
                    $sql="UPDATE sellers SET seller_fname=?, seller_lname=?,seller_phone=?,seller_address=?,seller_state_id=?,seller_lga=? WHERE seller_id=?";
                $stmt=$this->con->prepare($sql);
                  $chk= $stmt->execute([$fname,$lname,$phone,$address,$stateid,$lgaid,$seller_id]);
                    if($chk ==1){
                       
                        return true;
                    }else{
                       
                        return false;
                    }
    
                }catch(PDOException $e){
                    echo  $e->getMessage();
                     
                  }
    
            }

            public function fetch_all_states(){
                $sql="SELECT * FROM state";
                $stmt=$this->connect()->prepare($sql);//cant use last insert id 
                $stmt->execute();
                $states=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $states;
    
            }
    
            
            public function fetch_lga($stateid){
                $sql="SELECT * FROM lga WHERE state_id =?";
                $stmt=$this->connect()->prepare($sql);//cant use last insert id 
                $stmt->execute([$stateid]);
                $lgas=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $lgas;
            }

            
            public function view_all_products(){
                try{
                    $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id";
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute();
                   $res= $stmt->fetchAll(PDO::FETCH_ASSOC);

                    return $res;

                }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['admin_error']="an error occured";
              }
            
            
            
            
            }

            public function seller_view_products($id){
                try{
                    $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE sellers.seller_id=?";
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id]);
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
                 $_SESSION['admin_error']="an error occured";
              }
            
            
            
            
            }

           public function is_deleted($id){
                try{
                    $sql="SELECT is_deleted FROM sellers WHERE seller_id=?";
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id]);
                    $res=$stmt->fetch(PDO::FETCH_ASSOC);
                    if($res){
                        return $res;
                        exit;
                    }else{
                        return false;
                        exit;
                    }
                }catch(PDOException $e){
                    echo  $e->getMessage();
                     $_SESSION['admin_error']="an error occured";


           }
        }


            public function seller_edit_products($id){
                try{
                    $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE product.product_id=?";
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$id]);
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
                 $_SESSION['admin_error']="an error occured";
              }
            
            
            
            
            }






















            public function vendor_name_fetch($product_id){
                try{
                    $sql="SELECT business_name FROM sellers JOIN product ON sellers.seller_id=product.seller_id WHERE product_id=?";
                    $stmt=$this->con->prepare($sql);
                    $stmt->execute([$product_id]);
                   $sellers= $stmt->fetch(PDO::FETCH_ASSOC);
                   if($sellers){
                        return $sellers;
                        exit;
                   }else{
                    $_SESSION['admin_error']="an error occured";
                    return false;
                    exit;
                   }
    
                }catch(PDOException $e){
                    echo  $e->getMessage();
                     $_SESSION['admin_error']="an error occured";
                  }
           
                }





                public function update_product($tempname,$to,$name,$description,$unique,$price,$quantity,$catid,$product_id){
                    try{
                    if(move_uploaded_file($tempname,$to)){
                        $sql="UPDATE product  SET product.product_name=?,product.product_description=?,product.product_image=?,product.product_price=?,product.product_quantity=?,product.category_id=? WHERE product.product_id=? ";
                        $stmt=$this->con->prepare($sql);
                        $update=$stmt->execute([$name,$description,$unique,$price,$quantity,$catid,$product_id]);
                        
                        return $update ;
                        exit;
    
                        if($update){
                            return $update;
                            $_SESSION['admin_updatefeedback']="Updated successfully";
                            
                            exit;
                        }else{
                            $_SESSION['admin_updateerror']="an error occured";
                            return false;
                            exit;
                        }
    
                    }else{
                        $_SESSION['admin_updateerror']="an error occured";
                            return false;
                            exit;
                    }
                    }catch(PDOException $e){
                        echo  $e->getMessage();
                         $_SESSION['admin_updateerror']="an error occured";
                      
                     }
    
                    }
    












   }

    


?>