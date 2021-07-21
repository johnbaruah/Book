<?php include('include/header.php'); ?>
<?php
                    if (isset($_POST['proceed_check'])) {
                      header("location:checkout1.php");
                    }

                    
                   
                    session_regenerate_id( true );
                    if(isset($_SESSION['email'])){
                    	$email = $_SESSION['email'];
                    	$resultSet_check_cart = $mysqli->query("select * from seller_reg where email = '$email'");
	                    	if ($resultSet_check_cart) {
		                        $row_cart = $resultSet_check_cart->fetch_assoc();
		                        $cart_buyer_id = $row_cart['id'];
		                    }
		                    $resultSet_check_cart2 = $mysqli->query("select * from cart where buyer_id = '$cart_buyer_id'");
		                    	if ($resultSet_check_cart2->num_rows == NULL) {
		                    		header("location:index.php");
		                    	}

                    	if (isset($_POST['place_order'])) {
                    		$buyer_id_ord = $_POST['buyer_id_ord'];
                    		$resultSet_add = $mysqli->query("select * from address where buyer_id = '$buyer_id_ord'");
	                    		if ($resultSet_add) {
	                    			$row44 = $resultSet_add->fetch_assoc();
	  
	                              	$fname = $row44['fname'];
								    $lname = $row44['lname'];
								    $address = $row44['address']; 
								    $city = $row44['city'];
								    $landmark = $row44['landmark'];
								    $pin = $row44['pin'];
								    $state = $row44['state'];
								    $country = $row44['country'];
								    $contact_no = $row44['contact_no'];
								    $mail = $row44['mail'];
								    $pay_method = $row44['pay_method'];
	                    		}
                      		foreach ($_POST['pro_ar_id'] as $i => $value) {
            				$pro_ar_id = $_POST['pro_ar_id'][$i];
            				$pro_ar_sel_id = $_POST['pro_ar_sel_id'][$i];
            				$pro_ar_name = $_POST['pro_ar_name'][$i];
            				$pro_ar_qty = $_POST['pro_ar_qty'][$i];
            				$pro_ar_price = $_POST['pro_ar_price'][$i];
            				$p_quantityyy = $_POST['p_quantityyy'][$i];
            				$p_quantityyy_new = ($p_quantityyy - $pro_ar_qty);
            	
            				$order_qry=$mysqli->query("insert into placeorder(fname, lname, address, city, landmark, pin, state, country, contact_no, mail, pay_method, p_id, buyer_id, seller_id, p_quantity, p_price, p_name) values('$fname', '$lname', '$address', '$city', '$landmark', '$pin', '$state', '$country', '$contact_no', '$mail', '$pay_method', '$pro_ar_id', '$buyer_id_ord', '$pro_ar_sel_id', '$pro_ar_qty', '$pro_ar_price', '$pro_ar_name')");
                            if($order_qry){
                              $cart_del_qry=$mysqli->query("delete from cart where buyer_id='$buyer_id_ord'");
	                            if($cart_del_qry){
	                            	$new_cart_up_qry=$mysqli->query("update product set p_quantity = '$p_quantityyy_new' where id = '$pro_ar_id'");
	                            	if ($new_cart_up_qry) {
	                            		header("Location:order_details.php");
	                            	}else{
	                            		echo mysqli_error($mysqli);
	                            	}
	                                
	                            }else{
	                                echo mysqli_error($mysqli);
	                            }
	                        }else{
	                            echo mysqli_error($mysqli);
	                        }


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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Order review</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post" action="">
                  <h1>Checkout - Order review</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout3.php" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th colspan="2">Product</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Discount</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                        <input name='buyer_id_ord' type='hidden' value="<?php echo $id ?>">
                        <?php
                        $totalSum = 0;
                        while($res3 = mysqli_fetch_array($query7)){ 
                            $product_id = $res3['product_id']; 
                            $quantity = $res3['quantity'];
                            $resultSet4 = $mysqli->query("select * from product where id = '$product_id'");
                            if ($resultSet4) {
                              $row4 = $resultSet4->fetch_assoc();
                              $p_name = $row4['p_name'];
                              $seller_id = $row4['seller_id'];
                              $p_price = $row4['p_price']; 
                              $p_quantity = $row4['p_quantity'];
                              $p_img1 = $row4['p_img1'];
                              $product_id_qty = $row4['id'];
                              $total = $quantity * $p_price;
                              $totalSum += $total;    
                            }

                           
                        ?>
                          <tr>
                            <td><a href="detail.php?id=<?php echo $res3['product_id']; ?>"><img src="book_img/<?php  echo $p_img1; ?>" alt="image"></a></td>
                            <td><a href="detail.php?id=<?php echo $res3['product_id']; ?>"><?php  echo $p_name; ?></a></td>
                            <td><?php echo $quantity; ?></td>
                            <td>₹<?php  echo $p_price; ?></td>
                            <td>₹0.00</td>
                            <td>₹<?php  echo $total; ?></td>
                          </tr>
                           <input name='pro_ar_id[]' type='hidden' value="<?php echo $product_id ?>">
                           <input name='pro_ar_sel_id[]' type='hidden' value="<?php echo $seller_id ?>">
                           <input name='pro_ar_name[]' type='hidden' value="<?php echo $p_name ?>">
                           <input name='pro_ar_qty[]' type='hidden' value="<?php echo $quantity ?>">
                           <input name='p_quantityyy[]' type='hidden' value="<?php echo $p_quantity ?>">
                           <input name='pro_ar_price[]' type='hidden' value="<?php echo $total ?>">
                        <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="4"></th>
                            <th>Total</th>
                            <th>₹<?php  echo $totalSum; ?></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.table-responsive-->
                  </div>
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="checkout3.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to payment method</a>
                    <button type="submit" name="place_order" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i></button>
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
                          <th>₹<?php  echo $totalSum; ?></th>
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
                          <th>₹<?php  echo $totalSum; ?></th>
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