<?php
include('include/connection.php');
 session_start();
?>
<!DOCTYPE HTML>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css"> 
</style>
</head>
<body class="bg-img">
<div class="container" style="height: 630px;">
 <div class="mt-5 pt-4"><center><h4><b>Order Details:</b></h4></center></div>
<br>
<table style="width:100%;">
  <tr>

            <?php
      $order_id = $_GET['id'];
      $cat_select_qy = "select * from placeorder where id = '$order_id'";
      $cat_select_qy2 = mysqli_query($mysqli, $cat_select_qy);
      $num2 = mysqli_num_rows($cat_select_qy2);
      while($row = mysqli_fetch_array($cat_select_qy2)){ 
              $id=$row['id'];
              $fname=$row['fname'];
              $lname=$row['lname'];
              $p_name=$row['p_name'];
              $p_quantity=$row['p_quantity'];
              $p_price=$row['p_price'];
              $address=$row['address'];
              $city=$row['city'];
              $landmark=$row['landmark'];
              $pin=$row['pin'];
              $date_time=$row['date_time'];
              $status=$row['status'];
              $accept_reject=$row['accept_reject'];

?>

<div class="row">
  <div class="col-5"></div>
  <div class="col-4">
    <div class="row">
      <small><label>Order Id : </label> <?php echo $id; ?></small>
    </div>
    <div class="row">
      <small><label>Name : </label> <?php echo $fname; ?> <?php echo $lname; ?></small>
    </div>
    <div class="row">
      <small><label>Book Name : </label> <?php echo $p_name; ?></small>
    </div>
    <div class="row">
      <small><label>Book Quantity : </label> <?php echo $p_quantity; ?></small>
    </div>
    <div class="row">
      <small><label>Total Payable : </label> ₹<?php echo $p_price; ?></small>
    </div>
    <div class="row">
      <small><label>Address : </label> <?php echo $address; ?>, <?php echo $city; ?>, <?php echo $landmark; ?>.</small>
    </div>
    <div class="row">
      <small><label>Pin : </label> <?php echo $pin; ?></small>
    </div>
    <div class="row">
      <small><label>Order Date/Time : </label> <?php echo $date_time; ?></small>
    </div>
    <div class="row">
      <label>Status : <?php if ($status == 1) { ?>
                                                <small>Order Delivered</small>
                                              <?php }elseif ($status == 2) { ?>
                                                <small>Canceled by Buyer</small>
                                              <?php }elseif($status == 9){ ?>
                                                <small>Replace Request</small>
                                              <?php }else{
                                                  if ($accept_reject == 2) { ?>
                                                <small>Order on the way!!</small>
                                              <?php }elseif ($accept_reject == 1) { ?>
                                                <small>Canceled by Seller</small>
                                              <?php }else{ ?>
                                                <small>Seller not responding</small>
                                              <?php }} ?>
      </label>
    </div>
  </div>
  <div class="col-3"></div>
</div>
<?php } ?>
</tr>  
</table>

<div class="text-center mt-3">
  <button onclick="window.print();" class="btn btn-sm btn-primary" id="print-btn">Print Invoice</button>
</div>
</div>
</body>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>
</html>