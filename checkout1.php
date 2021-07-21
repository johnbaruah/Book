<?php include('include/header.php'); ?>

<?php
$error = null;
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
  if ($resultSet2->num_rows != 0) {
      $row2 = $resultSet2->fetch_assoc();
      $id2 = $row2['id'];

      $fname1 = $row2['fname'];
      $lname1 = $row2['lname'];
      $address1 = $row2['address']; 
      $city1 = $row2['city'];
      $landmark1 = $row2['landmark'];
      $pin1 = $row2['pin'];
      $state1 = $row2['state'];
      $country1 = $row2['country'];
      $contact_no1 = $row2['contact_no'];
      $mail1 = $row2['mail'];

    if(isset($_POST['continue_pay'])){
    $fname = $mysqli->real_escape_string($_POST['fname']);
    $lname = $mysqli->real_escape_string($_POST['lname']);
    $address = $mysqli->real_escape_string($_POST['address']); 
    $city = $mysqli->real_escape_string($_POST['city']);
    $landmark = $mysqli->real_escape_string($_POST['landmark']);
    $pin = $mysqli->real_escape_string($_POST['pin']);
    $state = $mysqli->real_escape_string($_POST['state']);
    $country = $mysqli->real_escape_string($_POST['country']);
    $contact_no = $mysqli->real_escape_string($_POST['contact_no']);
    $mail = $mysqli->real_escape_string($_POST['mail']);

     $address_query = $mysqli->query("update address set fname = '$fname', lname = '$lname', address = '$address', city = '$city', landmark = '$landmark', pin = '$pin', state = '$state', country = '$country', contact_no = '$contact_no', mail = '$mail' where id = '$id2' and buyer_id = '$id'");
      if($address_query){
        header("location:checkout3.php");
      }else{
        $error = "Somthing went Wrong Please Try Again After Sometime for update";
      }
  }

    }else{
  if(isset($_POST['continue_pay'])){
    $fname = $mysqli->real_escape_string($_POST['fname']);
    $lname = $mysqli->real_escape_string($_POST['lname']);
    $address = $mysqli->real_escape_string($_POST['address']); 
    $city = $mysqli->real_escape_string($_POST['city']);
    $landmark = $mysqli->real_escape_string($_POST['landmark']);
    $pin = $mysqli->real_escape_string($_POST['pin']);
    $state = $mysqli->real_escape_string($_POST['state']);
    $country = $mysqli->real_escape_string($_POST['country']);
    $contact_no = $mysqli->real_escape_string($_POST['contact_no']);
    $mail = $mysqli->real_escape_string($_POST['mail']);

     $address_query = $mysqli->query("insert into address(fname, lname, address, city, landmark, pin, state, country, contact_no, mail, buyer_id) values('$fname', '$lname', '$address', '$city', '$landmark', '$pin', '$state', '$country', '$contact_no', '$mail', '$id')");
      if($address_query){
        header("location:checkout3.php");
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


// $address_query = $mysqli->query("update address set fname = '$fname', lname = '$lname', address = '$address', city = '$city', landmark = '$landmark', pin = '$pin', state = '$state', country = '$country' contact_no = 'contact_no', mail = '$mail' where id = '$id'");
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
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Address</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post" action="">
                  <h1>Checkout - Address</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center"><a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker">                  </i>Address</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="firstname">Firstname</label>
                          <input id="firstname" name="fname" type="text" class="form-control" required="required" value="<?php if(isset($fname1)){ echo $fname1; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="lastname">Lastname</label>
                          <input id="lastname" name="lname" type="text" class="form-control" required="required" value="<?php if(isset($lname1)){ echo $lname1; } ?>">
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="company">Address</label>
                          <input id="company" name="address" type="text" class="form-control" required="required" value="<?php if(isset($address1)){ echo $address1; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="street">City/ Town</label>
                          <input id="street" name="city" type="text" class="form-control" required="required" value="<?php if(isset($city1)){ echo $city1; } ?>">
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="city">Landmark</label>
                          <input id="city" name="landmark" type="text" class="form-control" required="required" value="<?php if(isset($landmark1)){ echo $landmark1; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="zip">PIN</label>
                          <input id="zip" type="number" name="pin" class="form-control" required="required" value="<?php if(isset($pin1)){ echo $pin1; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="state">State</label>
                          <select id="state" class="form-control"  name="state" required="required" >
                          <option value="<?php if(isset($state1)){ echo $state1; } ?>"><?php if(isset($state1)){ echo $state1; }else{ echo "select";} ?></option>
                          <option value="ASSAM">ASSAM</option>
                          <option value="ARUNACHAL">ARUNACHAL</option>
                          <option value="MEGHALAYA">MEGHALAYA</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="country">Country</label>
                          <select id="country" class="form-control" name="country" required="required" >
                          <option value="<?php if(isset($country1)){ echo $country1; } ?>"><?php if(isset($country1)){ echo $country1; }else{ echo "select";} ?></option>
                          <option value="INDIA">INDIA</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">Contact No.</label>
                          <input id="phone" type="number" name="contact_no" class="form-control" required="required" value="<?php if(isset($contact_no1)){ echo $contact_no1; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input id="email" type="email" name="mail" class="form-control" required="required" value="<?php if(isset($mail1)){ echo $mail1; } ?>">
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <center class="text-center text-danger" ><?php echo $error; ?></center>
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="basket.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to Basket</a>
                    <button type="submit" name="continue_pay" class="btn btn-primary">Continue to Payment Method<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
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