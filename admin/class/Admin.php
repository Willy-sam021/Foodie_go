<?php
    require_once "Connection.php";

    class Admin extends Connection{
        private $con;
        public function __construct(){
            try{
                $this->con=$this->connect();
            }catch(PDOException $e){
             $e->getMessage();
            }

        }

        public function buyer_view_deets(){
            try{
                
                // $sql="SELECT * FROM order_details JOIN product ON order_details.product_id = product.product_id"; 
                $sql="SELECT * FROM orders";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([]);
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


        public function order_count(){
            try{
                $sql="SELECT * FROM orders";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
                $all_orders=$stmt->rowcount();
                if($all_orders){
                    return $all_orders;
                    exit;
                }else{
                    return false;
                    exit;
                }

            }catch(PDOException $e){
                echo   $e->getMessage();
               }
        }

        public function seller_count(){
            try{
                $sql="SELECT * FROM sellers";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
                $all_sellers=$stmt->rowcount();
                if($all_sellers){
                    return $all_sellers;
                    exit;
                }else{
                    return false;
                    exit;
                }

            }catch(PDOException $e){
                echo   $e->getMessage();
               }
        }

        public function buyer_count(){
            try{
                $sql="SELECT * FROM buyers";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
                $all_buyers=$stmt->rowcount();
                if($all_buyers){
                    return $all_buyers;
                    exit;
                }else{
                    return false;
                    exit;
                }

            }catch(PDOException $e){
                echo   $e->getMessage();
               }
        }



        public function admin_order_deets($id){
            try{
                // $sql="SELECT * FROM order_details JOIN product ON order_details.product_id=product.product_id JOIN payment ON payment.order_id=order_details.order_id JOIN orders ON orders.order_id=order_details.order_id WHERE buyer_id=? ORDER BY order_date DESC";
                $sql="SELECT * FROM order_details  JOIN product ON order_details.product_id = product.product_id   WHERE order_details.order_id=? "; 
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
       






        public function login($username,$pass){
            try{
                $sql="SELECT * FROM admin WHERE admin_username=? AND admin_password=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$username,$pass]);
               $admin= $stmt->fetch(PDO::FETCH_ASSOC);
               if($admin){
                        return $admin;
                    }else{
                        $_SESSION['admin_loginerror']="invalid credentials";
                        return false;
                    }

            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['admin_loginerror']="an error occured";
              }      
          }

        public function display_all_buyers(){
            try{
            $sql="SELECT * FROM buyers";
            $stmt=$this->con->prepare($sql);
            $stmt->execute();
           $buyer_detail= $stmt->FetchAll(PDO::FETCH_ASSOC);
           
           return $buyer_detail;
            }catch(PDOException $e){
                 $e->getMessage();
            }
        }

        public function display_all_sellers(){
            try{
            $sql="SELECT * FROM sellers";
            $stmt=$this->con->prepare($sql);
            $stmt->execute();
           $seller_detail= $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($seller_detail){
                return $seller_detail;
            }else{
                return false;
            }
          
            }catch(PDOException $e){
                 $e->getMessage();
            }
        }


        public function search_all_sellers($msg){
            try{
            $sql="SELECT * FROM sellers WHERE business_name LIKE?";
            $stmt=$this->con->prepare($sql);
            $stmt->execute(["%$msg%"]);
           $search= $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($search){
                return $search;
            }else{
                return false;
            }
          
            }catch(PDOException $e){
               echo  $e->getMessage();
            }
        }


        public function logout(){
            unset($_SESSION['admin_id']);
            $_SESSION=[];
            session_unset();
            session_destroy();
          
        }

        public function search_all_products($msg){
            try{
            $sql="SELECT * FROM product WHERE product_name LIKE?";
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



        public function view_product($id){
            try{
            $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE product_id=?";
            $stmt=$this->con->prepare($sql);
            $stmt->execute(["$id"]);
           $product= $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($product){
                return $product;
            }else{
                return false;
            }
          
            }catch(PDOException $e){
              echo   $e->getMessage();
            }
        }






        

        

        public function get_seller_id($id){
            try{
                $sql="SELECT * FROM sellers  WHERE seller_id=?";
                $stmt=$this->con->prepare($sql);
                $stmt->execute([$id]);
                $seller=$stmt->fetch(PDO::FETCH_ASSOC);
                if($seller){
                    return $seller;
                    
                }else{
                   // $_SESSION['admin_error']='Seller does not exist';
                    return false;
                }
               



            }catch(PDOException $e){
                $e->getMessage();
           }      
        
        }

        public function get_buyer_id($id){
            try{
                $sql="SELECT * FROM buyers WHERE buyer_id=?";
                $stmt=$this->con->prepare($sql);
               $res= $stmt->execute([$id]);
               if($res){
                $buyer=$stmt->fetch(PDO::FETCH_ASSOC);
        
                if($buyer){
                    return $buyer; 
                    exit;     
                }
               }else{
                 $_SESSION['admin_error']='Buyer does not exist';
                return false;
               }
               
               

            }catch(PDOException $e){
               echo $e->getMessage();
               $_SESSION['admin_error']='Buyer does not exist';
           }      
        
        }



        public function add_product($produt_name,$prod_desc,$tempname,$to,$unique,$price,$quantity,$seller,$cate){
            try{
                if(move_uploaded_file($tempname,$to)){
                $sql="INSERT INTO product SET product_name=?, product_description=?,product_image=?,product_price=?,product_quantity=?,seller_id=?,category_id=?";
                $stmt=$this->con->prepare($sql);
               $res= $stmt->execute([$produt_name,$prod_desc,$unique,$price,$quantity,$seller,$cate]);
                if($res){
                    $_SESSION['admin_addfeedback']="uploaded successfully";
                    return true;

                }else{
                    $_SESSION['admin_adderror']="failed to upload";
                    return false;
                }
             }else{
                $_SESSION['admin_adderror']="failed to upload";
                    return false;
             }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['admin_adderror']="an error occured";
              }
          }

          public function admin_view_reviews(){
            try{
                $sql="SELECT * FROM review JOIN product ON product.product_id = review.product_id  JOIN buyers ON buyers.buyer_id = review.buyer_id ";
                $stmt=$this->con->prepare($sql);
                $stmt->execute();
               $rate= $stmt->FetchAll(PDO::FETCH_ASSOC);
                if($rate){
                    return $rate;
                    exit;
                }else{
                    return false;
                    exit;
                }
    
            }catch(PDOException $e){
               echo $e->getMessage();
                return false;
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
                    $_SESSION['admin_error']="an error occured";
                }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['admin_error']="an error occured";
              }
          }


          public function add_category($tmpfilename,$to,$categoryname,$unique){
            try{
                if(move_uploaded_file($tmpfilename,$to)){
                $sql="INSERT INTO product_category SET category_names=?,category_photos=?";
                $stmt=$this->con->prepare($sql);
                $res=$stmt->execute([$categoryname,$unique]);
                if($res){
                    $_SESSION['cat_feedback']='added successfully';
                    return true;
                }else{
                    $_SESSION['cat_error']='error occured';
                    return false;
                }
            }
            }catch(PDOException $e){
                echo  $e->getMessage();
                 $_SESSION['cat_error']="an error occured";
             }         
            
            
            }


            public function delete_category($id){
                try{
                    $sql="DELETE FROM product_category WHERE category_id =?";
                    $stmt=$this->con->prepare($sql);
                    $delete=$stmt->execute([$id]);
                    if($delete){
                        return true;
                        exit;
                    }else{
                        return false;
                        exit;
                    }

                }catch(PDOException $e){
                    echo  $e->getMessage();
                     $_SESSION['cat_error']="an error occured";
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
                 $_SESSION['admin_error']="an error occured";
              }
            
            
            
            
            }



            public function view_a_product($id){
                try{
                    $sql="SELECT * FROM product JOIN sellers ON product.seller_id=sellers.seller_id JOIN product_category ON product.category_id=product_category.category_id WHERE product.product_id=?";
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



                public function fetch_all_sellers(){
                    try{
                        $sql="SELECT * FROM sellers ";
                        $stmt=$this->con->prepare($sql);
                        $stmt->execute();
                       $sellers= $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
    
                            //delete 
            
        public function deactivate_seller($id){
                try{
                    $sql=" UPDATE  sellers SET is_deleted=TRUE, deleted_at=NOW() WHERE seller_id=?";
                    $stmt=$this->con->prepare($sql);
                    $res= $stmt->execute([$id]);
                    if($res){
                        $_SESSION['admin_feedback']='Seller deleted';
                        return true;
                        exit;     
                    }
                    else{
                        $_SESSION['admin_error']='unable to delete seller';
                    return false;
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $_SESSION['admin_error']='unable to delete seller';
                }      
            
            }



            public function activate_seller($id){
                try{
                    $sql=" UPDATE  sellers SET is_deleted=FALSE, deleted_at=NOW() WHERE seller_id=?";
                    $stmt=$this->con->prepare($sql);
                    $res= $stmt->execute([$id]);
                    if($res){
                        $_SESSION['admin_feedback']='Seller Activated';
                        return true;
                        exit;     
                    }
                    else{
                        $_SESSION['admin_error']='unable to Activate seller';
                    return false;
                    }
                    
                }catch(PDOException $e){
                     $e->getMessage();
                    $_SESSION['admin_error']='unable to Activate seller';
                }      
            
            }




            public function delete_buyer($id){
                try{
                    $sql=" DELETE FROM buyers WHERE buyer_id=?";
                    $stmt=$this->con->prepare($sql);
                    $res= $stmt->execute([$id]);
                    if($res){
                        $_SESSION['admin_feedback']='Beller deleted';
                        return true;
                        exit;     
                    }
                    else{
                        $_SESSION['admin_error']='unable to delete buyer';
                    return false;
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $_SESSION['admin_error']='unable to delete buyer';
                }      
            
            }
    
            public function delete_product($id){
                try{
                    $sql=" DELETE FROM product WHERE product_id=?";
                    $stmt=$this->con->prepare($sql);
                    $res= $stmt->execute([$id]);
                    if($res){
                        $_SESSION['admin_feedback']='product deleted';
                        return true;
                        exit;     
                    }
                    else{
                        $_SESSION['admin_error']='unable to delete product';
                    return false;
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $_SESSION['admin_error']='unable to delete product';
                }      
            
            }


            public function update_buyer($fname,$lname,$phone,$address,$buyer_id){
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
            
            


































    
            public function update_seller($fname,$lname,$phone,$address,$business,$id){
                try{
                    $sql="UPDATE sellers SET seller_fname=?, seller_lname=?, seller_phone=?, seller_address=?, business_name=? WHERE seller_id=?";
                    $stmt=$this->con->prepare($sql);
                    $seller=$stmt->execute([$fname,$lname,$phone,$address,$business,$id]);
                    
                    if($seller){
                        $_SESSION['admin_update_seller_feeback']='update successful';
                        return true;
                        exit;
                    }else{
                        $_SESSION['admin_update_seller_error']='Seller does not exist';
                        return false;
                    }
                   
    
    
    
                }catch(PDOException $e){
                    $e->getMessage();
                    $_SESSION['admin_update_seller_error']='Seller does not exist';
                    return false;
               }      
            
            }









    }

    // $rex=new Admin;
    // $mef=$rex->fetch_all_sellers();
    // echo "<pre>";
    // print_r($mef);
    // echo "</pre>";


?>