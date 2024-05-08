<?php

session_start();

include('config.php');




//if user is not logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../subscribe.php?message=Please login/register to place a subscription');
    exit;



    //if user is logged in 
}else{


                if(isset($_POST['place_subscription'])){

                    //get user info and store it in database
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $city = $_POST['city'];
                    $address = $_POST['address'];
                    $order_cost = $_SESSION['subscribe_total'];
                    $user_id = $_SESSION['user_id'];
                    $order_date = date('Y-m-d');
                    $order_frequency = $_POST['frequency'];
                    $next_order_date = date('Y-m-d', strtotime("$order_date + $order_frequency days"));

                    $stmt = $con->prepare("INSERT INTO subscriptions (order_cost,user_id,user_phone,user_city,user_address,order_date,order_frequency,next_order_date)
                                        VALUES (?,?,?,?,?,?,?,?);");
                    
                    $stmt->bind_param('dissssis',$order_cost,$user_id,$phone,$city,$address,$order_date,$order_frequency,$next_order_date);


                    $stmt_status = $stmt->execute();

                    if(!$stmt_status){
                        header('location: index.php');
                        exit;
                    }

                    $subscription_id = $stmt->insert_id;

                    //get products from cart 
                    foreach($_SESSION['subscribe'] as $key => $value){
                        $product = $_SESSION['subscribe'][$key];
                        $product_id = $product['product_id'];
                        $product_name = $product['product_name'];
                        $product_price = $product['product_price'];
                        $product_image = $product['product_image'];
                        $product_quantity = $product['product_quantity'];

                        $stmt1 = $con->prepare("INSERT INTO subscription_items (subscription_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                                        VALUES (?,?,?,?,?,?,?,?)");
                        
                        $stmt1->bind_param('iissdiis',$subscription_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

                        $stmt1->execute();

                    }


                
                    
                    

                    //remove everything from cart -> delay until payment is done

                    unset($_SESSION['subscribe']);
                    unset($_SESSION['subscribe_quantity']);


                    //inform user whether everything is fine or there is a problem

                    header('location: ../account.php?order_status=subscription placed successfully');



                }

}


?>