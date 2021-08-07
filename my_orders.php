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
                        $query6 = "select * from placeorder where seller_id = '$id'";
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
                  <li aria-current="page" class="breadcrumb-item active">Seller Dasboard</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-12">

               <?php if ($num3 == 0) { ?>
                    <div class="row">
                      <center class="text-primary font-italic pl-3" style="font-size: 16px; font-weight: 600;" ><a href="index.php">Currently You Don't made any Order, Please Add some products to your cart and continue order..</a></center>
                    </div>
                  <?php }else{ ?>



                     

    <section class="content p-0 m-0 pb-4" style="width: 100%;">
      <div class="container-fluid p-0 m-0" style="width: 100%;">
        <div class="row p-0 m-0" style="width: 100%;">
          <div class="col-12 p-0 m-0" style="width: 100%;">
            <!-- /.card -->

            <div class="card  p-0 m-0" style="width: 100%;">
              
              <!-- /.card-header -->
              <div class="card-body" style="width: 100%;">
                <table id="example1" class="table table-bordered table-striped p-0 m-0" style="width: 100%;">
                  <thead>
                    <tr> 
                      <th width="5px;">#</th>
                      <th colspan="2" style="text-align: center;" width="100px;">Action</th>  
                      <th width="60px;">Invoice</th>
                      <th width="60px;">Image</th>
                      <th>Category</th>
                      <th>Book Name</th>
                      <th>Book Author</th>
                      <th>Book Publication</th>
                      <th>Buyer Name</th>  
                      <th>Buyer Details</th>  
                      <th>Book Quantity</th>
                      <th>Price Collect</th>  
                      <th>Order Date & Time</th>              
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        $totalSum = 0;
                        $sl = 1;
                        while($res = mysqli_fetch_array($query7)){ 
                        	$product_id = $res['p_id'];
                        	$resultSet4 = $mysqli->query("select * from product where id = '$product_id'");
                            if ($resultSet4) {
                              $row4 = $resultSet4->fetch_assoc();
                              $p_img1 = $row4['p_img1'];
                              $cat_name = $row4['cat_name'];
							                $p_author = $row4['p_author'];
                              $p_publication = $row4['p_publication'];    
                            }

                            ?>

                          <tr class="tbl-bg align-middle">
                            <td class="inpt"><?php echo $sl++; ?></td>
                            <?php if ($res['status'] == 1) { ?>
                            	<td class="inpt"><button class="btn btn-success"><a style="color: white;" class="p-0 m-0" href="#">Order Delivered</a></button></td>
                            	<td class="inpt"></td>
                          <?php  }elseif ($res['status'] == 2) { ?>
                          	<td class="inpt" width="160px;"><button class="btn btn-danger"><a style="color: white;" class="p-0 m-0" href="#">Canceled by Buyer</a></button></td>
                          	<td class="inpt"></td>
                         <?php }elseif($res['status'] == 9){ ?>
                            <td class="inpt" width="160px;"><button class="btn btn-secondary"><a style="color: white;" class="p-0 m-0" href="response_replace.php?id=<?php echo $res['id']; ?>">Replace Request</a></button></td>
                            <td class="inpt"></td>
                        <?php }else{ ?>
                         	<?php if ($res['accept_reject'] == 2) {  ?>
                         		<td class="inpt" width="160px;"><button class="btn btn-warning"><a style="color: white;" class="p-0 m-0" href="on_the_way.php?id=<?php echo $res['id']; ?>">Order on the way!!</a></button></td>
                            	<td class="inpt"></td>
                         	<?php }elseif ($res['accept_reject'] == 1) { ?>
                         		<td class="inpt" width="160px;"><button class="btn btn-danger"><a style="color: white;" class="p-0 m-0" href="#">Order Rejected</a></button></td>
                          		<td class="inpt"></td>
                         <?php	}else{ ?>
                            <td class="inpt"><button class="btn btn-success"><a style="color: white;" class="p-0 m-0" href="Accept.php?id=<?php echo $res['id']; ?>">Accept</a></button></td>
                            <td class="inpt"><button class="btn btn-danger"><a style="color: white;" class="p-0 m-0" href="Reject.php?id=<?php echo $res['id']; ?>">Reject</a></button></td>
                          <?php }} ?>
                            <td class="inpt"><button class="btn btn-primary"><a style="color: white;" class="p-0 m-0" href="invoice.php?id=<?php echo $res['id']; ?>">Invoice</a></button></td>
                            <td><a href="detail.php?id=<?php echo $res['p_id']; ?>"><img class="d-block w-100" src="book_img/<?php echo $p_img1; ?>" alt="First slide" width="40px" height="85px"></a></td>  
                            <td class="inpt"><?php echo $cat_name; ?></td>
                            <td class="inpt"><?php echo $res['p_name']; ?></td>
                            <td class="inpt"><?php echo $p_author; ?></td>
                            <td class="inpt"><?php echo $p_publication; ?></td>
                            <td class="inpt"><?php echo $res['fname'].' '.$res['lname'];?></td>
                            <td class="inpt"><?php echo $res['address'].', '.$res['city'].', '.$res['landmark'].', '.$res['pin'].', '.$res['state'].', '.$res['country'].', '.$res['contact_no'].', '.$res['mail']; ?></td>
                            <td class="inpt"><?php echo $res['p_quantity']; ?></td>
                            <td class="inpt"><?php echo $res['p_price']; ?></td>
                            <td class="inpt"><?php echo $res['date_time']; ?></td>
                          </tr>
                       <?php } ?>
                        </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
     <?php } ?>
                    </div>
                




            </div>

<!-- admin lte start -->

<!-- admin lte end -->
          </div>
        </div>
      </div>
    <!-- from here modify 1st john end -->
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
   <?php include('include/footer.php'); ?>
   
