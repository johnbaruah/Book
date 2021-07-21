<?php include('include/header.php'); ?>



<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css"> 
.bg-img{
  background-image: url("book_img/book3.jpg");
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
</style>
</head>
<body class="bg-img">
<div class="container" style="height: 630px;">

<br>
<table style="width:100%;">
  <tr>
    <td class="bg-clr"><center><h4><b>Order Details:</b></h4></center></td>
  </tr>

  <tr>

    <table style="width:100%;">
          <thead>
            <tr>
              <!-- <th style="width:10%;">Photo</th> -->
              <th>Sl No.</th> 
              <th>Order Id</th>               
              <th>Product Name</th>           
              <th>Quantity</th>
              <th>Amount</th>
              <th>Buyer Email</th>
              <th>Seller Email</th>
              <th>Pin No</th>
              <th>Date & Time</th>
              <th>Status</th>
            </tr>
            <br>
            <?php
      $cat_select_qy = "select * from placeorder";
      $cat_select_qy2 = mysqli_query($mysqli, $cat_select_qy);
      $num2 = mysqli_num_rows($cat_select_qy2);
      $sl = 0;
      while($row = mysqli_fetch_array($cat_select_qy2)){ 
              $sl++;
              $id=$row['id'];
              $p_name=$row['p_name'];
              $p_quantity=$row['p_quantity'];
              $p_price=$row['p_price'];
              $pin=$row['pin'];
              $date_time=$row['date_time'];
              $seller_id=$row['seller_id'];
              $buyer_id=$row['buyer_id'];
              $status=$row['status'];
              $accept_reject=$row['accept_reject'];



              $resultSet4 = $mysqli->query("select * from seller_reg where id = '$seller_id'");
              if ($resultSet4) {
                  $row4 = $resultSet4->fetch_assoc();
                  $email_sell = $row4['email'];
                  }

              $resultSet41 = $mysqli->query("select * from seller_reg where id = '$buyer_id'");
              if ($resultSet41) {
                  $row41 = $resultSet41->fetch_assoc();
                  $email_buy = $row41['email'];
                  }




    
    print "<tr>";
    print "<td>";
    print "<br>";
    print $sl;
    print "</td>";       
    print "<td>";
    print "<br>";
    print $id;
    print "</td>";
    print "<td>";
    print "<br>";
    print $p_name;
    print "</td>";
    print "<td>";
    print "<br>";
    print $p_quantity;
    print "</td>";
    print "<td>";
    print "<br>";
    print $p_price;
    print "</td>";
    print "<td>";
    print "<br>";
    print $email_buy;
    print "</td>";
    print "<td>";
    print "<br>";
    print $email_sell;
    print "</td>";
    print "<td>";
    print "<br>";
    print $pin;
    print "</td>";
    print "<td>";
    print "<br>";
    print $date_time;
    print "</td>";
    print "<td>";
    print "<br>";
      if ($status == 1) {
    print "Order Delivered";
      }elseif ($status == 2) {
    print "Canceled by Buyer";
      }elseif($status == 9){
    print "Replace Request";
    }else{
      if ($accept_reject == 2) {
    print "Order on the way!!";
      }elseif ($accept_reject == 1) {
    print "Canceled by Seller";
      }else{
    print "Seller not responding";
    }}

    print "</td>";
    print "</tr>";
      }
      print "<br>";
    ?>
          </thead>
        </table>
  </tr>
  
       
  
</table>

      



<div class="text-center mt-5">
  <button onclick="window.print();" class="btn btn-block btn-primary" id="print-btn">Print report</button>
</div>
</div>
</body>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>

