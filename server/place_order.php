<?php

session_start();

include('config.php');


//if user is not logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;



    //if user is logged in 
}else{


                if(isset($_POST['place_order'])){

                    //get user info and store it in database
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $city = $_POST['city'];
                    $address = $_POST['address'];
                    $order_cost = $_SESSION['total'];
                    $order_status = "not paid";
                    $user_id = $_SESSION['user_id'];
                    $order_date = date('Y-m-d');

                    $stmt = $con->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                                        VALUES (?,?,?,?,?,?,?);");
                    
                    $stmt->bind_param('dsissss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);


                    $stmt_status = $stmt->execute();

                    if(!$stmt_status){
                        header('location: index.php');
                        exit;
                    }

                    $order_id = $stmt->insert_id;


                




                    //get products from cart 
                    foreach($_SESSION['cart'] as $key => $value){
                        $product = $_SESSION['cart'][$key];
                        $product_id = $product['product_id'];
                        $product_name = $product['product_name'];
                        $product_price = $product['product_price'];
                        $product_image = $product['product_image'];
                        $product_quantity = $product['product_quantity'];

                        $stmt1 = $con->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                                        VALUES (?,?,?,?,?,?,?,?)");
                        
                        $stmt1->bind_param('iissdiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

                        $stmt1->execute();
                    }
                    
                    

                    //remove everything from cart -> delay until payment is done

                    $_SESSION['order_id'] = $order_id;
                    unset($_SESSION['cart']);
                    unset($_SESSION['quantity']);


                    //inform user whether everything is fine or there is a problem

                    header('location: ../payment.php?order_status=order placed successfully');



                }

}


?>