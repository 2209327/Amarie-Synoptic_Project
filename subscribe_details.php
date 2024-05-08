<?php include('layouts/header.php'); ?>

<?php 

/* 
    not paid 
    delivered 
    shipped
*/

include('server/config.php');

if(isset($_POST['subscribe_details_button']) && isset($_POST['subscription_id'])){
    $subscription_id = $_POST['subscription_id'];
    $order_frequency = $_POST['order_frequency'];
    $stmt = $con->prepare("SELECT * FROM subscription_items WHERE subscription_id=?");
    $stmt->bind_param('i',$subscription_id);
    $stmt->execute();
    $subscription_details = $stmt->get_result();
    
}else{
    header('location: account.php');
    exit;
}



?>






<!--Subscriptions details-->
<section id="orders" class="orders container my-5 py-3">
      <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Subscription details</h2>
        <hr class="mx-auto">
      </div>

      <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Product</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
        <tr>

        <?php while($row = $subscription_details->fetch_assoc() ) { ?>

                <tr>
                    <td>
                         <div class="product-info"> 
                           <img src="assets/imgs/<?php echo $row['product_image']; ?>"/> 
                          <div>
                              <p class="mt-3"><?php echo $row['product_name']; ?></p>
                          </div>
                        </div>
                        
                    </td>

                    <td>
                      <span>£<?php echo $row['product_price'] ?></span>
                    </td>

                    <td>
                      <span><?php echo $row['product_quantity'] ?></span>
                    </td>

                </tr>
            <?php } ?>

     </table>
    
    </section>



    <?php  include('layouts/footer.php');   ?>
    