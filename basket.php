<?php include('include/header.php'); ?>
<?php
                    if (isset($_POST['refresh_page'])) {
                      header("Refresh:0");
                    }
                    if (isset($_POST['proceed_check'])) {
                      header("location:checkout1.php");
                    }
                   
                    session_regenerate_id( true );
                    if(isset($_SESSION['email'])){
                      if (isset($_POST['update'])) { 
                          $product_id_qty1 = $mysqli->real_escape_string($_POST['product_id_qty1']);
                          $buyer_id_qty1 = $mysqli->real_escape_string($_POST['buyer_id_qty1']);
                          $p_quantity1 = $mysqli->real_escape_string($_POST['p_quantity1']);
                          $quantity1 = $mysqli->real_escape_string($_POST['quantity1']);
                           if (($quantity1 > 0) and ($quantity1 <= $p_quantity1)) {     
                                $quantity_up_qy1 = $mysqli->query("update cart set quantity = '$quantity1' where buyer_id = '$buyer_id_qty1' and product_id = '$product_id_qty1'");
                      }else{
                         echo '<script>alert("Item cannot be 0, or grater than > '.$p_quantity1.'")</script>';
                      }
                    }
                    $email = $_SESSION['email'];
                    $resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
                    if ($resultSet) {
                        $row = $resultSet->fetch_assoc();
                        $id = $row['id'];
                        $query6 = "select * from cart where buyer_id = '$id'";
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
                  <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                </ol>
              </nav>
            </div> 
            <div id="basket" class="col-lg-9">
              <div class="box">
                  <h1>Shopping cart</h1>
                  <p class="text-muted"><?php if ($rowcount >1) { ?> You currently have <?php echo $rowcount; ?> item(s) in your cart. <?php }else{ ?> You currently have <?php echo $rowcount; ?> item in your cart. <?php } ?></p>
                  <?php if ($num3 == 0) { ?>
                    <div class="row">
                      <center class="text-primary font-italic pl-3" style="font-size: 16px; font-weight: 600;" ><a href="index.php">Currently You Don't Have any Product in your cart, Please Add some products to your cart and continue..</a></center>
                    </div>
                  <?php }else{ ?>
                  <div class="table-responsive">
                    <table class="table text-center">
                      <thead>
                        <tr>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th>Total</th>
                          <th>Update cart</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
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
                            }

                           
                        ?>
                        <tr>
                          <form method="post" action="">
                            <td><a href="detail.php?id=<?php echo $res3['product_id']; ?>"><img src="book_img/<?php  echo $p_img1; ?>" alt="image"></a></td>
                            <td><a href="detail.php?id=<?php echo $res3['product_id']; ?>"><?php  echo $p_name; ?></a></td>
                            <td>
                              <input type="hidden" name="product_id_qty1" value="<?php echo $product_id_qty ?>">
                              <input type="hidden" name="buyer_id_qty1" value="<?php echo $id ?>">
                              <input type="hidden" name="p_quantity1" value="<?php echo $p_quantity ?>">
                              <input type="text" name="quantity1" value="<?php echo $quantity; ?>" class="form-control text-center">
                            </td>
                            <td>₹<?php  echo $p_price; ?></td>
                            <td>₹<?php  echo $total; ?></td>
                            <td><button name="update" type="submit" style="text-decoration: none; color: inherit; border: 0px none; outline: none; background: none;" class="text-primary"><i class="fa fa-refresh"></i></button></td>
                            <td><a href="delete_product_cart.php?id=<?php echo $res3['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
                          </form>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="5" style="text-align: right;">Total </th>
                          <th colspan="2" style="text-align: right;"> ₹<?php echo $totalSum; ?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                <?php } ?>
                  <!-- /.table-responsive-->
                  <form action="" method="post">
                    <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                      <div class="left"><a href="index.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                      <div class="right">
                        <button class="btn btn-outline-secondary" name="refresh_page"><i class="fa fa-refresh"></i> Refresh cart</button>
                        <?php if ($num3 != 0) { ?>
                        <button type="submit" class="btn btn-primary" name="proceed_check">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                        <?php } ?>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Order summary</h3>
                </div>
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
            <!-- /.col-md-3-->
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
   <?php include('include/footer.php'); ?>