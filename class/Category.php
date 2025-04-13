<?php
require_once "Connection.php";
class Category extends Connection{
    private $con;
    public function __construct(){
        try{
            $this->con=$this->connect();
        }catch(PDOException $e){
            $e->getMessage();
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

  public function fetch_product_bycategory($id){
    try{
        $sql="SELECT * FROM product JOIN product_category ON product.category_id=product_category.category_id JOIN sellers ON product.seller_id=sellers.seller_id WHERE product_category.category_id=?";
        $stmt=$this->con->prepare($sql);
        $stmt->execute([$id]);
       $prod_cat= $stmt->fetchAll(PDO::FETCH_ASSOC);
       if($prod_cat){
            return $prod_cat;
            exit;
       }else{
            return false;
            exit;
       }

    }catch(PDOException $e){
        echo  $e->getMessage();
         $_SESSION['errormsg']="an error occured";
      }  }



}



?>