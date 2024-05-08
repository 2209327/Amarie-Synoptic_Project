<?php include('layouts/header.php'); ?>

<?php 



include('server/config.php');


if(isset($_POST['search'])){

  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt = $con->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? ");

  $stmt->bind_param("sd",$category, $price);

  $stmt->execute();

  $shop_products = $stmt->get_result();


}else{
  $stmt = $con->prepare("SELECT * FROM products");

  $stmt->execute();

  $shop_products = $stmt->get_result();

}



?>






  <section id="search" class="my-5 py-5 ms-2">
    <div class="container mt-5 py-5">
      <p>Search Products</p>
    </div>


        <form action="shop.php" method="POST">
          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">


              <p>Category</p>
                <div class="form-check">
                  <input class="form-check-input" value="Hair Oil" type="radio" name="category" id="category_one">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Oil
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" value="Shampoo" type="radio" name="category" id="category_two">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Shampoo
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" value="Conditioner" type="radio" name="category" id="category_three" checked>
                  <label class="form-check-label" for="flexRadioDefault3">
                    Conditioner
                  </label>
                </div>

            </div>
          </div>


          <div class="row mx-auto container mt-5">.
            <div class="col-lg-12 col-md-12 col-sm-12">

            <p>Price</p>
            <input type="range" class="form-range w-50" name="price" value="10" min="1" max="100" id="customRange2">
            <div class="w-50">
              <span style="float: left;">1</span>
              <span style="float: right;">1000</span>
              </div>
            </div>
          </div>

          <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="button button=primary">
          </div>

        </form>

  </section>











<!--Featured-->
<section id="shop" class="my-5 py-5">
    <div class="container text-center mt-5 py-5">
      <h3>Products</h3>
      <hr class="mx-auto">
      <p>Check out our amazing products</p>
    </div>
    <div class="row mx-auto container-fluid">

        <?php while($row= $shop_products->fetch_assoc()) { ?>



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