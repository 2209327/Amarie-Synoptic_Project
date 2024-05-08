<?php

include('config.php');

$stmt = $con->prepare("SELECT * FROM products");

$stmt->execute();

$shop_products = $stmt->get_result();



?>