<?php include('layouts/header.php'); ?>

    


     <!--Contact-->
      <!-- <section id="contact" class="container my-5 py-5">
        <div class="container text-center mt-5">
            <h3>Contact Us</h3>
            <p class="w-50 mx-auto">
                Phone number: <span>07867548830</span>
            </p>
            <p class="w-50 mx-auto">
                Email address: <span>SLhair@hotmail.co.uk</span>
            </p>
        </div>
      </section>  -->

      <div class="container mt-5 py-5">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5 py-5">
                    <div class="card-title">
                        <h2 class="text-center py-2"> Contact Us</h2>
                        <hr>
                        <?php 

                            $message = "";
                            if(isset($_GET['error'])){
                                $message = " Please fill in the blank ";
                                echo '<div class="alert alert-danger">'.$message.'</div>';

                            }

                            if(isset($_GET['success'])){

                                $message = " Your Message has been sent ";
                                echo '<div class="alert alert-success">'.$message.'</div>';

                            }
                        
                        
                        
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="message.php" method="POST">
                            <input type="text" name="name" placeholder="Name" class="form-control mb-2">
                            <input type="email" name="email" placeholder="Email" class="form-control mb-2">
                            <input type="text" name="subject" placeholder="Subject" class="form-control mb-2">
                            <textarea name="message" class="form-control mb-2" placeholder="Write your Message"></textarea>
                            <button class="button button-success" name="button-send"> Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>

    


     



      <?php  include('layouts/footer.php');   ?>