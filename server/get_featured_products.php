<?php

include('config.php');

$stmt = $con->prepare("SELECT * FROM products LIMIT 4 ");

$stmt->execute();

$featured_products = $stmt->get_result();



?>