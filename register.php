<?php include('include/header.php'); ?>
    <!-- from here modify 1st john start -->
<?php
$error = NULL;
include ('include/connection.php');
if (isset($_POST['seller'])) {
  $name = $_POST['name'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $contact_no = $_POST['contact_no'];
  $address = $_POST['address'];
  $pin = $_POST['pin'];
  $password = $_POST['password'];
  $conf_password = $_POST['conf_password'];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

  $resultSet = $mysqli->query("select email from seller_reg where email = '$email' and verified = 1 limit 1");
  $resultSet2 = $mysqli->query("select email from seller_reg where email = '$email' and verified = 0 limit 1");

if($resultSet->num_rows == 1){
  $error = '<div class="font-italic text-danger">Email :-<span class="text-primary">( '."$email".' )</span> already registered, If you forgot your password, Please reset your password</div>';
}elseif($resultSet2->num_rows == 1){
  $error = '<div class="font-italic text-danger">Email already registered, Please activate it using the link sent to your email :- <span class="text-primary">( '."$email".' )</span> and login to continue filling the application</div>';
}elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
  $error = '<div class="font-italic text-danger">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</div>';
}elseif($password != $conf_password){
    $error = '<div class="font-italic text-danger">Password not Matching !</div>';
}else{
      $name = $mysqli->real_escape_string(strtoupper($name));
      $lname = $mysqli->real_escape_string(strtoupper($lname));
      $email = $mysqli->real_escape_string($email);
      $contact_no = $mysqli->real_escape_string($contact_no);
      $address = $mysqli->real_escape_string(strtoupper($address));
      $password  = $mysqli->real_escape_string($password);
      $custom_verified = 1;
      $pin = $mysqli->real_escape_string($pin);
      $password = md5($password);
      $reg_query = $mysqli->query("insert into seller_reg(name, lname, email, contact_no, address, password, pin, verified) values('$name', '$lname', '$email', '$contact_no', '$address', '$password', '$pin', '$custom_verified')");
      if($reg_query){
        echo '<script>alert("Thank You, For Register..")</script>';
      }else{
        $error = "Somthing went Wrong Please Try Again After Sometime";
      }
  }
}

?>
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <div class="box">
                <h1>New account</h1>
                <p>With registration you can sell or buy old/new books, The whole process will not take you more than a minute!</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, 24/7.</p>
                <hr>
                <form action=" " method="post">
                  <div class="form-row">
                    <div class="col-6">
                      <label for="name">First name</label>
                      <input name="name" type="text" class="form-control" required="required">
                    </div>
                    <div class="col-6">
                      <label for="lname">Last name</label>
                      <input name="lname" type="text" class="form-control" required="required">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-6">
                      <label for="email">Email</label>
                      <input name="email" type="email" class="form-control" required="required">
                    </div>
                    <div class="col-6">
                      <label for="contact_no">Contact No.</label>
                      <input name="contact_no" type="number" class="form-control" required="required">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-9">
                      <label for="address">Address</label>
                      <input name="address" type="text-area" class="form-control" required="required">
                    </div>
                    <div class="col-3">
                      <label for="pin">Pin no.</label>
                      <input name="pin" type="number" class="form-control" required="required">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-6">
                      <label for="password">Password</label>
                      <input name="password" type="password" class="form-control" required="required">
                    </div>
                    <div class="col-6">
                      <label for="conf_password">Conf. Password</label>
                      <input name="conf_password" type="password" class="form-control" required="required">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" value="submit" name="seller" class="btn btn-block btn-primary mt-4"><i class="fa fa-user-md"></i> Register</button>
                  </div>
                </form>
                <center>
                    <?php
                      echo $error;
                    ?>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- from here modify 1st john end -->
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
   <?php include('include/footer.php'); ?>
