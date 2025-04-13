<?php
 require_once "Connection.php";

 class Payment extends Connection{
     private $con;
     public function __construct(){
         $this->con=$this->connect();
     }

     public function paystack_verify_step2($ref){
        $url="https://api.paystack.co/transaction/verify/$ref";
        $headers=[ 
            'Content-Type: application/json',
            "Authorization: Bearer sk_test_a3d5d350fb62005aeb4c1e3c55c63cf3f2f500df"
        ];

        #step1:initialize
        $curlobj = curl_init($url);
        #step2: set options
       
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlobj, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
       
        #step3
        //execute the call and collect response from api
        $apirsp = curl_exec($curlobj);

        #step4 &5
        if($apirsp){
            curl_close($curlobj);
            return json_decode($apirsp);

        }else{
            $r = curl_error($curlobj);
            //echo $r
            return false;
        }



     }



     public function paystack_initialize_step1($email,$amt,$ref){
        $url= "https://api.paystack.co/transaction/initialize";

        $fields = [
            'email' => $email,
            'amount' => $amt*100,
            'reference'=> $ref,
            'callback_url' => "http://localhost/foodie_go/paystack_landing.php",
            
          ];

          $headers=[ 
            'Content-Type: application/json',
            "Authorization: Bearer sk_test_a3d5d350fb62005aeb4c1e3c55c63cf3f2f500df"
        ];
        #step1:initialize
        $curlobj = curl_init($url);
        #step2: set options
        curl_setopt($curlobj, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlobj, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
       
        #step3
        //execute the call and collect response from api
        $apirsp = curl_exec($curlobj);

        #step4 &5
        if($apirsp){
            curl_close($curlobj);
            return json_decode($apirsp);

        }else{
            $r = curl_error($curlobj);
            echo $r;
            return false;
        }


     }



     public function insert_payment($orderid,$amount_paid,$transaction_id){
            try{
                $sql="INSERT INTO payment SET order_id=?,amount_paid=?,payment_transaction_id=?";
                $stmt=$this->con->prepare($sql);
                $confirm=$stmt->execute([$orderid,$amount_paid,$transaction_id]);
                if($confirm){
                    return true;
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

     public function update_payment($paystatus,$data,$ref){
        try{
            $sql= "UPDATE payment SET payment_status=?,payment_data=? WHERE payment_transaction_id=?";
            $stmt=$this->con->prepare($sql);
           $chk= $stmt->execute([$paystatus,$data,$ref]);

           if($chk){
            return true;
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


     
     

    }



 








?>