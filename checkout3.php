<?php include('include/header.php'); ?>

<?php
$error = null;
$payment = null;
session_regenerate_id( true );
if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
  if ($resultSet) {
      $row = $resultSet->fetch_assoc();
      $id = $row['id'];
    }else{
      header("location:index.php");
    }
  $resultSet2 = $mysqli->query("select * from address where buyer_id = '$id'");
  if ($resultSet2) {
      $row2 = $resultSet2->fetch_assoc();
      $id2 = $row2['id'];
      $pay_method1 = $row2['pay_method'];
      if ($id2 == null) {
        header("location:checkout1.php");
      }
     }else{
      header("location:index.php");
    }
  if(isset($_POST['order_review'])){
    if (empty($_POST['payment'])) {
      $error = "Select a Payment Method";
    }else{
     $pay_method = $mysqli->real_escape_string($_POST['payment']);
     $pay_method_query = $mysqli->query("update address set pay_method = '$pay_method' where id = '$id2' and buyer_id = '$id'");
      if($pay_method_query){
        header("location:checkout4.php");
      }else{
        $error = "Somthing went Wrong Please Try Again After Sometime";
      }
    }
  }

                   
$query6 = "select * from cart where buyer_id = '$id'";
$query7 = mysqli_query($mysqli,$query6);
$num3 = mysqli_num_rows($query7);

 $totalSum = 0;
 while($res3 = mysqli_fetch_array($query7)){ 
     $product_id = $res3['product_id']; 
                            // $cart_del_id = $res3['id'];
     $quantity = $res3['quantity'];
     $resultSet4 = $mysqli->query("select * from product where id = '$product_id'");
     if ($resultSet4) {
       $row4 = $resultSet4->fetch_assoc();
       $p_name = $row4['p_name'];
       $p_price = $row4['p_price']; 
       $p_quantity = $row4['p_quantity'];
       $p_img1 = $row4['p_img1'];
       $product_id_qty = $row4['id'];
       $total = $quantity * $p_price;
       $totalSum += $total;    
     }}

                   
}else{
  header("location:index.php");
}
?>

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Payment method</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post" action="">
                  <h1>Checkout - Payment method</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout3.php" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>UPI</h4>
                          <p>Paytm/ Google Pay/ Phone pay etc.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment" value="upi">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Payment gateway</h4>
                          <p>VISA and Mastercard only.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment" value="card">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Cash on delivery</h4>
                          <p>You pay when you get it.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="payment" value="cash">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                  </div>
                  <center class="text-center text-danger" ><?php echo $error; ?></center>
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="checkout1.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to address</a>
                    <button type="submit" name="order_review" class="btn btn-primary">Continue to Order Review<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
                <!-- /.box-->
              </div>
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                  <h3 class="mt-4 mb-4">Order summary</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Order subtotal</td>
                          <th>₹<?php echo $totalSum; ?></th>
                        </tr>
                        <tr>
                          <td>Shipping and handling</td>
                          <th>₹0.00</th>
                        </tr>
                        <tr>
                          <td>Tax</td>
                          <th>₹0.00</th>
                        </tr>
                        <tr class="total">
                          <td>Total</td>
                          <th>₹<?php echo $totalSum; ?></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
   <?php include('include/footer.php'); ?>