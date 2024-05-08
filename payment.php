<?php include('layouts/header.php'); ?>

<?php 



if(isset($_POST['order_pay_button']) ){
  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];
}


?>










    
    
      <!--Payment-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">

        <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
            <?php $amount = strval($_POST['order_total_price']); ?>
            <?php $order_id = $_POST['order_id']; ?>
                <p>Total payment: £<?php echo $_POST['order_total_price']; ?></p>
                <!-- <input class="button" type="submit" value="Pay Now"> -->
                <div id="paypal-button-container" style="display: flex !important; justify-content: center !important;"></div>

          <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0) {?>
            <?php $amount = strval($_SESSION['total']); ?>
            <?php $order_id = $_SESSION['order_id']; ?>
              <p>Total payment: £ <?php echo $_SESSION['total']; ?> </p>
              <!-- <input class="button" type="submit" value="Pay Now"> -->
              <div id="paypal-button-container" style="display: flex !important; justify-content: center !important;"></div>



          <?php } else { ?>

            <p>You don't have an order</p>
            <?php } ?>






            




        </div>
    </section>






    <script src="https://www.paypal.com/sdk/js?client-id=AVUHNrD_Mb6pdvJqUIBKcGRlKDdKPrEO5gTI-4lt0D0TKIURtuqVLhnfVC_12CPUGYmT39FZaC1xB1kH&currency=USD"></script>
   

    <script>
      paypal.Buttons({

        // Order is created on the server and the order id is returned
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units:[{
              amount: {
                value: '<?php echo $amount; ?>'
              }
            }]
          });
        },

        onApprove: function(data, actions){
          return actions.order.capture().then(function(orderData) {

            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            var transaction = orderData.purchase_units[0].payments.captures[0];
            alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available')

            window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id;?>;
          });
        }
       }).render('#paypal-button-container');
    </script>
  

    <?php  include('layouts/footer.php');   ?>