<?php include('layouts/header.php'); ?>

<?php



if(isset($_POST['add_to_cart'])){

  // if user has already added a product to cart
  if(isset($_SESSION['cart'])){

    $products_array_ids = array_column($_SESSION['cart'], "product_id");
    // checks if product has been added already to cart or not 
    if( !in_array($_POST['product_id'], $products_array_ids) ){

      $product_id = $_POST['product_id'];

      $product_array = array(
                        'product_id' => $_POST['product_id'],
                        'product_name' => $_POST['product_name'],
                        'product_price' => $_POST['product_price'],
                        'product_image' => $_POST['product_image'],
                        'product_quantity' => $_POST['product_quantity']

      );

      $_SESSION['cart'][$product_id] = $product_array;

      // product has already been added
    }else{

      echo '<script>alert("Product was already added to cart");</script>';
      //echo '<script>window. location="index.php";</script>';

    }



    // if this is the first product 
  }else{

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];


    $product_array = array(
                      'product_id' => $product_id,
                      'product_name' => $product_name,
                      'product_price' => $product_price,
                      'product_image' => $product_image,
                      'product_quantity' => $product_quantity

    );

    $_SESSION['cart'][$product_id] = $product_array;


  }


  //calculate total
  calculateTotalCart();
  





//remove product from cart  
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

//calculate total
calculateTotalCart();


}else if(isset($_POST['edit_quantity'])){

  //we get id and quantity from the form

  $product_quantity = $_POST['product_quantity'];
  $product_id = $_POST['product_id'];

  //get the product array from the session

  $product_array = $_SESSION['cart'][$product_id];

  //update product quantity 

  $product_array['product_quantity'] = $product_quantity;

  //return array back to it's place

  $_SESSION['cart'][$product_id] = $product_array;

  //calculate total 
  calculateTotalCart();






}else{
  //header('location: index.php');
}

function calculateTotalCart(){

  $total_price = 0;
  $total_quantity = 0;


  foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;



  }
  

  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;



}








?>












    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php if(isset($_SESSION['cart'])){?>

            <?php foreach($_SESSION['cart'] as $key => $value) { ?>


            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="">
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span><?php echo $value['product_price']; ?></span></small>
                            <br>
                            <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                              <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form method="POST" action="cart.php">
                    <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                    </form>
                </td>
                <td>
                    <span>£</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price'];?></span>
                </td>
            </tr>

            <?php } ?>
          
            <?php } ?>


        </table>


        <div class="cart-total">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>£1.50</td>
                </tr>     -->
                    <tr>
                        <td>Total</td>
                        <?php if(isset($_SESSION['cart'])){?>
                        <td>£<?php echo $_SESSION['total']; ?></td>
                        <?php } ?>
                    </tr>
                </tr>
            </table>
        </div>
        <div class="checkout-container">
          <form method="POST" action="checkout.php">
          <input type="submit" class="button checkout-btn" value="Checkout" name="checkout">
          </form>
        </div>
    </section>

















    <?php  include('layouts/footer.php');   ?>