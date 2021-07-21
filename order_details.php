<?php include('include/header.php'); ?>
<?php
                    if (isset($_POST['refresh_page'])) {
                      header("Refresh:0");
                    }
                   
                    session_regenerate_id( true );
                    if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
                    if ($resultSet) {
                        $row = $resultSet->fetch_assoc();
                        $id = $row['id'];
                        $query6 = "select * from placeorder where buyer_id = '$id'";
                        $query7 = mysqli_query($mysqli,$query6);
                        $num3 = mysqli_num_rows($query7);
                    }}else{
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
                  <li aria-current="page" class="breadcrumb-item active">My Orders</li>
                </ol>
              </nav>
            </div> 
            <div id="basket" class="col-lg-12">
              <div class="box">
                  <h1>My Orders</h1>
                  <?php if ($num3 == 0) { ?>
                    <div class="row">
                      <center class="text-primary font-italic pl-3" style="font-size: 16px; font-weight: 600;" ><a href="index.php">Currently You Don't made any Order, Please Add some products to your cart and continue order..</a></center>
                    </div>
                  <?php }else{ ?>
                  
                        <?php
                        $totalSum = 0;
                        while($res3 = mysqli_fetch_array($query7)){ 
                            $product_id = $res3['p_id']; 
                            $ord_id = $res3['id'];
                            $date_time = $res3['date_time'];
                            $address = $res3['address'];
                            $city = $res3['city'];
                            $landmark = $res3['landmark'];
                            $pin = $res3['pin'];
                            $quantity = $res3['p_quantity'];
                            $status = $res3['status'];
                            $accept_reject = $res3['accept_reject'];
                            $resultSet4 = $mysqli->query("select * from product where id = '$product_id'");
                            if ($resultSet4) {
                              $row4 = $resultSet4->fetch_assoc();
                              $p_name = $row4['p_name'];
                              $days = $row4['days'];
                              $p_price = $row4['p_price']; 
                              $p_quantity = $row4['p_quantity'];
                              $p_img1 = $row4['p_img1'];
                              $product_id_qty = $row4['id'];
                              $total = $quantity * $p_price;
                              $totalSum += $total;    
                            }

                           
                        ?>
                       

                      <!-- j1 -->
                      <div class="row border border-primary rounded mt-2 mb-5">
                      <div class="row border border-white rounded p-0" style="margin: 1px;">
                      <div class="row border border-primary rounded p-3 m-0">
                            <div class="col-3 col-sm-1">
                                <a href="detail.php?id=<?php echo $product_id; ?>"><img src="book_img/<?php  echo $p_img1; ?>" max-width="100%" height="auto" style="object-fit: cover;"  class="rounded img-fluid" alt="..."></a>
                            </div>
                            <div class="col-9 col-sm-11">
                              <div class="row">
                                <div class="col-5 col-sm-5 text-capitalize p-0">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <a style="text-decoration: none;" href="detail.php?id=<?php echo $product_id; ?>"><?php echo $p_name; ?></a>
                                    </div>
                                    <div class="col-12 col-sm-12 mt-1 mb-1">
                                      <small>Order No.: <?php echo $ord_id; ?></small> 
                                    </div>
                                    <div class="col-12 col-sm-12">
                                      <small><?php echo $date_time; ?></small>
                                    </div>
                                </div>
                                </div>

                                <div class="col-2 col-sm-2">
                                    <small class="text-success">Quantity: <?php echo $quantity; ?></small>
                                </div>

                                  <div class="col-2 col-sm-2">
                                 <?php
                                if ($status == 0) {
                                 if($accept_reject == 2) {
                                    echo "<div class='col-6 p-0 float-right'><small>Status: <span class='text-info'>Intransit</span></small>
                                    </div>";
                                  }elseif ($accept_reject == 1) {
                                    echo "<div class='col-6 p-0 float-right'><small>Status: <span class='text-danger'>Cancelled</span></small>
                                    </div>";
                                  }else{
                                  echo "<div class='col-6 p-0 float-right'><small>Status: <span class='text-info'>Intransit</span></small>
                                  </div>"; 
                                }}elseif ($status == 1) {
                                  echo "<div class='col-6 p-0 float-right'><small>Status: <span class='text-success'>Delivered</span></small>
                                </div>";  
                                }elseif ($status == 2) {
                                  echo "<div class='col-6 p-0 float-right'><small>Status: <span class='text-danger'>Cancelled</span></small>
                                </div>";  
                                }
                                ?>
                              
                             </div>



                                <div class="col-2 col-sm-2" style="font-size: 14px; float: right !important; padding-left: 160px;"> ₹<?php echo $total; ?>
                                <br>
                                <div class="text-muted"><small>₹<?php echo $p_price; ?>/pc</small></div>
                                </div>
                                
                             </div>
                            </div>

                            <?php if ($status == 0) { ?>
                            <?php if($accept_reject == 2) { ?>
                                <div class="col-5 col-sm-3 p-2 ">
                                  <a href="cancel_order.php?id=<?php echo $ord_id; ?>" class="btn btn-success btn-block p-0">Order Accepted By Seller. Cancle?</a>
                                </div>
                             <?php }elseif ($accept_reject == 1) { ?>
                               <div class="col-5 col-sm-3 p-2 ">
                                  <a href="#" class="btn btn-warning btn-block p-0">Order Rejected By Seller</a>
                                </div>
                            <?php }else{ ?> 
                            <div class="col-5 col-sm-3 p-2 ">
                                <a href="cancel_order.php?id=<?php echo $ord_id; ?>" class="btn btn-danger btn-block p-0">Cancel order</a>
                            </div>

                        <?php }}elseif($status == 1){ ?>

                            <div class="col-3 col-sm-2 p-2 ">
                                <button class="btn btn-success btn-block p-0">Delivered</button>
                            </div>
                            

                            <!-- jhj -->
                           <?php 
                   
                    $data_date1 = strtotime($date_time);
                    $cr_date = date("y-m-d h:i:s");
                    $cr_date1 = strtotime($cr_date);
                    $interval = (($cr_date1) - ($days * ($data_date1)));
                    if ($interval < $cr_date ) { ?>
                      <div class="col-2 col-sm-1 p-2 ">
                                 <a href="Replace.php?id=<?php echo $ord_id; ?>" class="btn btn-warning btn-block p-0">Replace</a>
                          </div>
                  <?php }else{ ?>

                        <div class="col-2 col-sm-1 p-2 float-right">
                                 <a href="#" class="btn btn-success btn-block p-0">Success</a>
                          </div>
                  <?php } ?>
                            <!-- hgjh -->
                      <?php }elseif($status == 2){ ?>

                            <div class="col-5 col-sm-3 p-2 ">
                                <button class="btn btn-primary btn-block p-0">Order Canceled</button>
                            </div>
                        <?php }elseif($status == 9){ ?>

                            <div class="col-5 col-sm-3 p-2 ">
                                <button class="btn btn-primary btn-block p-0">Replace Req.</button>
                            </div>
                        <?php } ?>


                            <div class="col-5 col-sm-5 p-2">
                              <a href="#" class="dropdown-toggle btn btn-block btn-primary p-0" data-toggle="dropdown">Product Deliver Address <b class="caret"></b></a>
                              
                              <ul class="dropdown-menu dropdown-menu-large row">
                                <div class="col-12">
                                  
                                    <small><?php echo $address; ?></small><br>
                                    <small><?php echo $city; ?></small><br>
                                    <small><?php echo $landmark; ?></small><br>
                                    <small><?php echo $pin; ?></small><br>
                                    <small><?php echo $address; ?></small>
                                  
                                </div>
                              </ul>
                                  
                            </div>
                            <div class="col-3 col-sm-3 p-2">
                              <a href="invoice.php?id=<?php echo $ord_id; ?>" class="btn btn-block btn-primary p-0">Invoice<b class="caret"></b></a>
                              
                                  
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- j2 -->

                      <?php } ?>
                     
                <?php } ?>
                  <!-- /.table-responsive-->
                  <form action="" method="post">
                    <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                      <div class="left"><a href="index.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                      <div class="right">
                        <button class="btn btn-outline-secondary" name="refresh_page"><i class="fa fa-refresh"></i> Refresh Page</button>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-lg-12-->
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
   <?php include('include/footer.php'); ?>