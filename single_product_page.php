<?php include('layouts/header.php'); ?>

<?php

include('server/config.php');

if(isset($_GET['product_id'])){

  $product_id = $_GET['product_id'];

  $stmt = $con->prepare("SELECT * FROM products  WHERE  product_id = ?");
  $stmt->bind_param("i",$product_id);
  $stmt->execute();

  $product = $stmt->get_result();




  // no product id was given
}else{
  header('location: index.php');
}




?>






  <section class="container single-product my-5 pt-5">
    <div class="row mt-5">

      <?php while($row = $product->fetch_assoc())   { ?>
      
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>">
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <h6><?php echo $row['product_category']; ?></h6>
            <h3><?php echo $row['product_name']; ?></h3>
            <h2>£ <?php echo $row['product_price']; ?></h2>

            <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
              <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
              <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
              <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>

                  <input type="number" name="product_quantity" value="1">
                  <button class="buy-now-btn" type="submit" name="add_to_cart">Add To Cart</button>
            </form>

            <form method="POST" action="subscription_cart.php">
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
              <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
              <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
              <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>

                  <input type="number" name="product_quantity" value="1">
                  <button class="sub-now-btn" type="submit" name="add_subscription">Subscribe</button>
            </form>
            
            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $row['product_description']; ?></span>
        </div>

        <?php } ?>

    </div>

  </section>







  <?php  include('layouts/footer.php');   ?>