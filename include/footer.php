<?php
include ('include/connection.php');
if (isset($_POST['subscribe'])) {
  $sub_email = $_POST['sub_email'];

  $resultSet = $mysqli->query("select sub_email from subscribers where sub_email = '$sub_email' limit 1");
if($resultSet->num_rows == 1){
  echo '<script>alert("You have already Subscribed")</script>';
}else{
  $sub_query = $mysqli->query("insert into subscribers(sub_email) values('$sub_email')");
      if($sub_query){
        echo '<script>alert("Subscribed Successful, Have a Good Day")</script>';
      }else{
        echo '<script>alert("something went wrong, Please try again after sometime")</script>';
      }

}
}
  ?>
<div id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Pages</h4>
            <ul class="list-unstyled">
              <li><a href="about.php">About us</a></li>
              <li><a href="terms_condition.php">Terms and conditions</a></li>
              <li><a href="contact.php">Contact us</a></li>
            </ul>
            <hr>
            <h4 class="mb-3">User section</h4>
            <ul class="list-unstyled">
              <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
              <li><a href="register.php">Regiter</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Top categories</h4>
            <h5>New Books</h5>
            <ul class="list-unstyled">
              <li><a href="new_category.php">New</a></li>
            </ul>
            <h5>Old Books</h5>
            <ul class="list-unstyled">
              <li><a href="old_category.php">old</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Where to find us</h4>
            <p><strong>inv.</strong><br>13/25 New Avenue<br>Tihu<br>781371<br>Nalbari<br><strong>Assam</strong></p><a href="contact.php">Go to contact page</a>
            <hr class="d-block d-md-none">
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Get notifications</h4>
            <p class="text-muted">Subscribe with your Email to get notifications.</p>
            <form action="" method="post">
              <div class="input-group">
                <input type="email" name="sub_email" class="form-control"><span class="input-group-append">
                  <button type="submit" name="subscribe" value="submit" class="btn btn-outline-secondary">Subscribe!</button></span>
              </div>
              <!-- /input-group-->
            </form>
            <hr>
            <h4 class="mb-3">Stay in touch</h4>
            <p class="social"><a href="facebook.com" class="facebook external"><i class="fa fa-facebook"></i></a><a href="twitter.com" class="twitter external"><i class="fa fa-twitter"></i></a><a href="instagram.com" class="instagram external"><i class="fa fa-instagram"></i></a><a href="google.com" class="gplus external"><i class="fa fa-google-plus"></i></a><a href="gmail.com" class="email external"><i class="fa fa-envelope"></i></a></p>
          </div>
          <!-- /.col-lg-3-->
        </div>
        <!-- /.row-->
      </div>
      <!-- /.container-->
    </div>
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->
    
    
    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    <div id="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-2 mb-lg-0">
            <p class="text-center text-lg-left">©2019 inv.</p>
          </div>
          <div class="col-lg-6">
            <p class="text-center text-lg-right">Design & Develop By <a href="https://bootstrapious.com/">John Baruah</a>
              <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- *** COPYRIGHT END ***-->
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="js/front.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
  </body>
</html>

<?php
ob_end_flush();
?>
