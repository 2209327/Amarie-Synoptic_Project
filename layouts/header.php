<?php 

session_start();

//include('../server/config.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/icons//font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary py-3 fixed-top">
        <div class="container">
          <img src="assets/imgs/disso.jpeg" alt=""/>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>

        
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>

              <li class="nav-item">
                <a href="account.php"><i class="fa fa-user" aria-hidden="true"></i></a>
                <a href="cart.php">
                  <i class="fa fa-shopping-cart" aria-hidden="true">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) {?>
                            <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                      <?php } ?>
                  </i>
                </a>
                <a href="subscription_cart.php">
                  <i class="fa fa-cart-plus" aria-hidden="true">
                     <?php if(isset($_SESSION['subscribe_quantity']) && $_SESSION['subscribe_quantity'] !=0) {?>
                            <span class="cart-quantity"><?php echo $_SESSION['subscribe_quantity']; ?></span>
                      <?php } ?>
                  </i>
                </a>

              </li>


            </ul>
          </div>
        </div>
      </nav>