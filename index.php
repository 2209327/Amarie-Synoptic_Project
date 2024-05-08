
<?php include('layouts/header.php'); ?>




      <!--Home-->
      <section id="home">
        <div class="container">
          <h5>Welcome Offer</h5>
          <h1><span>Unleash</span> the True Potential of Your Hair</h1>
          <p>Subscribe to items of your choice today!</p>
          <a href="shop.php"><button>Shop Now</button></a>
        </div>
      </section>

      <!--Brand-->
      <section id="brand" class="container">
        <div class="row">
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.jpg">
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.jpg">
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.jpg">
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.jpg">
        </div>
      </section>

      <!--New-->
      <section id="new" class="w-100">
        <div class="row p-0 m-0">
          <!--One-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/1.jpg">
            <div class="details">
              <h2>Amazing shampoo</h2>
              <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
            </div>
          </div>
          <!--Two-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/2.jpg">
            <div class="details">
              <h2>Awesome Conditioner</h2>
              <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
            </div>
          </div>
          <!--Three-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/3.jpg">
            <div class="details">
              <h2>Wonderful Hair Oils</h2>
              <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
            </div>
          </div>
        </div>
      </section>

      <!--featured-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our Featured products</h3>
          <hr>
          <p>Check out our featured products</p>
        </div>

        <div class="row mx-auto container-fluid">

        <?php include('server/get_featured_products.php'); ?>

        <?php while($row= $featured_products->fetch_assoc()) { ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
            <div class="star">
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">£ <?php echo $row['product_price']; ?></h4>
            <a href="<?php echo "single_product_page.php?product_id=". $row['product_id'];?>"><button class="buy-now-btn">Buy Now</button></a>
          </div>

          <?php } ?>
        </div>
      </section>


      <?php  include('layouts/footer.php');   ?>

     