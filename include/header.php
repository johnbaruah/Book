
<!DOCTYPE html>
<?php
ob_start();
?>

<?php 
$error = NULL;
$rowcount = NULL;
include('include/connection.php');
if(isset($_POST['seller_login'])){
  //connect to database
  //get form data
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']); 
  $password = md5($password);
  // query the database
  $resultSet = $mysqli->query("select * from seller_reg where email = '$email' and password = '$password' limit 1");
  if($resultSet->num_rows == 1){
    // process login
    $row = $resultSet->fetch_assoc();
    $verified = $row['verified'];
    $email = $row['email'];
    $date = $row['crdate'];
    $name = $row['name'];
    $date = strtotime($date);
    $date = date('M d Y', $date);
    if ($verified == 1 || $verified == 2) {
      //continue processing
      session_start();
      $_SESSION['email'] = $email;
      session_regenerate_id( false );
      header('location:index.php');
    }elseif($verified == 0){
      $error = '<div class="font-italic text-danger">Hello your acccount has been Suspended</div>';
    }else{
      $error = '<div class="font-italic text-danger">Hello <span class="text-primary"> '."$name".' </span> your acccount has not yet been verified. An email was sent to:- <span class="text-primary">( '."$email".' )</span> on date:- <span class="text-primary">( '."$date".' )</span></div>';
    }
  }else{
    // invalid cradentials
    $error = '<div class="font-italic text-danger">The Email Id :- <span class="text-primary">( '."$email".' )</span> or Password you entered is incorrect</div>';
  }
}

$name = "User";
session_start();
session_regenerate_id( true );
 if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $resultSet44 = $mysqli->query("select id from seller_reg where email = '$email'");
  if ($resultSet44) {
    $row44 = $resultSet44->fetch_assoc();
    $buyer_id = $row44['id'];

    $sql=$mysqli->query("SELECT id FROM cart WHERE buyer_id = '$buyer_id'");
    if ($sql)
      {
        $rowcount=mysqli_num_rows($sql);
      }
  }
  $resultSet = $mysqli->query("select name from seller_reg where email = '$email'");
  if ($resultSet) {
    $row = $resultSet->fetch_assoc();
    $name = $row['name'];
  }else{
    $name = "User";
  }
 }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Old/ New Book Selling site</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">



    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header mb-5">
      <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
      <div id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"><a href="#" class="btn btn-success btn-sm">Book selling site</a><a href="#" class="ml-1">You can Sell you can Buy</a>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
              <ul class="menu list-inline mb-0">
                <?php if(isset($_SESSION['email'])){ 
                echo '<li class="list-inline-item"><a href="include/logout.php">Logout</a></li>';
                echo '<li class="list-inline-item"><a href="order_details.php">My Orders</a></li>';
                }else{
                echo '<li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                <li class="list-inline-item"><a href="register.php">Register</a></li>';
                }
                ?>  
                <li class="list-inline-item"><a <?php if(isset($_SESSION['email'])){ echo 'href="sell_form.php"'; }else{ echo 'href="#" data-toggle="modal" data-target="#login-modal"'; } ?> >Sell books</a></li>
                <li class="list-inline-item"><a href="contact.php">Contact</a></li>
                <li class="list-inline-item"><?php if(isset($_SESSION['email'])){ ?><a href="profile_update.php">Welcome <?php echo $name; ?></a><?php }else{ ?> <a href="">Welcome <?php echo $name; ?></a> </li><?php } ?></li>
              </ul>
            </div>
          </div>
          <div style="font-size: 11px;" class="row p-0 m-0">
            <center>
              <p class="text-danger"><?php echo $error; ?></p>
            </center>
          </div>
        </div>
        <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <form action=" " method="post">
                  <div class="form-group">
                    <input id="email-modal" type="email" placeholder="email" name="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <input id="password-modal" type="password" name="password" placeholder="password" class="form-control">
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary" type="submit" value="seller" name="seller_login"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1 minute!</p>
              </div>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        
        
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="index.php" class="navbar-brand home"><img height="55px" width="55px" src="img/logo.jpg" alt="Book" class="d-none d-md-inline-block rounded-circle"><img height="50px" width="50px" src="img/logo.jpg" alt="Book" class="d-inline-block d-md-none rounded-circle"><span class="sr-only">Home Page</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
              <li class="nav-item dropdown menu-large"><a href="old_category.php" data-delay="200" class="nav-link">Old Books<b class="caret"></b></a>
              </li>
              <li class="nav-item dropdown menu-large"><a href="new_category.php" data-delay="200" class="nav-link">New Books<b class="caret"></b></a>
              </li>
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><?php if ($rowcount >1) { ?>
                <span><?php echo $rowcount; ?> item's in cart</span>
              <?php }else{ ?><span><?php echo $rowcount; ?> item in cart</span><?php } ?></a></div>
            </div>
          </div>
        </div>
      </nav>
    </header>