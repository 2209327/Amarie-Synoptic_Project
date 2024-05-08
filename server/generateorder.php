<?php

include('config.php');



function generateorder($con,$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date){
    

        $stmt = $con->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                                        VALUES (?,?,?,?,?,?,?);");
                    
        $stmt->bind_param('dsissss', $order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);


        $stmt->execute();


        $order_id = $stmt->insert_id;

        return $order_id;
        

}

function generate_order_details($con,$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date){
    
    $stmt = $con->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                                        VALUES (?,?,?,?,?,?,?,?)");
                        
    $stmt->bind_param('iissdiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

    $stmt->execute();

}

function UpdateNextOrderDate($con,$next_order_date,$subscription_id){

    $stmt = $con->prepare("UPDATE subscriptions SET next_order_date = ? WHERE subscription_id = ?");

    $stmt->bind_param('si', $next_order_date,$subscription_id);

    $stmt->execute();

}

$stmt = $con->prepare("SELECT * FROM subscriptions WHERE next_order_date = CURDATE()");
$stmt->execute();
$subscription = $stmt->get_result();



if ($subscription->num_rows > 0){
    while($row = $subscription->fetch_assoc()){
        $order_status = "not paid";
        $order_frequency = $row['order_frequency'];
        $order_date = date('Y-m-d');
        $subscription_id = $row['subscription_id'];
        $order_id = generateorder($con,$row['order_cost'], $order_status, $row['user_id'], $row['user_phone'], $row['user_city'], $row['user_address'], $order_date);


        $stmt1 = $con->prepare("SELECT * FROM subscription_items WHERE subscription_id = ?");
        $stmt1->bind_param('i',$subscription_id);
        $stmt1->execute();
        $subscription_details = $stmt1->get_result();



        if ($subscription_details->num_rows > 0){
            while($row1 = $subscription_details->fetch_assoc()){
                generate_order_details($con,$order_id,$row1['product_id'],$row1['product_name'],$row1['product_image'],$row1['product_price'],$row1['product_quantity'],$row1['user_id'],$order_date);
            }
        }else{
            echo("error occured");
        
        }

        $next_order_date = date('Y-m-d', strtotime("$order_date + $order_frequency days"));

        UpdateNextOrderDate($con,$next_order_date,$row['subscription_id']);
    }
}else{
    echo("No subscriptions to process today");
}


?>