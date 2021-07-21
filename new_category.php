<?php include('include/header.php'); ?>

<?php       
             if (isset($_POST['add_to_cart'])) {
              $cart_add_pro_id = $mysqli->real_escape_string($_POST['cart_add_pro_id']);
              $buy_email = $_SESSION['email'];
              $resultSet10 = $mysqli->query("select id from seller_reg where email = '$buy_email'");
                if ($resultSet10) {
                    $row10 = $resultSet10->fetch_assoc();
                    $buyer_id = $row10['id'];



                    $cart_add_query_check_qty = $mysqli->query("select * from product where id = '$cart_add_pro_id'");
                    if($cart_add_query_check_qty){
                      $row11 =$cart_add_query_check_qty->fetch_assoc();
                      $p_quantity_check = $row11['p_quantity'];
                      if($p_quantity_check != 0){
                         $cart_add_query = $mysqli->query("insert into cart(buyer_id, product_id) values('$buyer_id', '$cart_add_pro_id')");
                         if ($cart_add_query) {
                       header("location:new_category.php");
                        }else{
                          echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                        } 
                      }else{
                        echo '<script>alert("Product Currently outof stock")</script>';
                      }
                    }
 
            


              }else{
                echo '<script>alert("Something went wrong please try again after Sometime")</script>';
              }
            }


            


            $query6 = "select * from product where cat_name = 'new'  LIMIT 30";
            $query7 = mysqli_query($mysqli,$query6);
            $num3 = mysqli_num_rows($query7);
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
                  <li aria-current="page" class="breadcrumb-item active">New Books</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Categories</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column category-menu">
                    <li><a href="old_category.php" class="nav-link">Old Books</a>
                    </li>
                    <li><a href="new_category.php" class="nav-link active">New Books</a>
                    </li>
                  </ul>
                </div>
              </div>
              
              <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner"><a href="#"><img src="img/banner.jpg" alt="sales 2014" class="img-fluid"></a></div>
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>New Books</h1>
                <p>In our New Book department we offer wide selection of the best books we have found and carefully selected worldwide.</p>
              </div>
              <div class="row products">
                <?php
                while($res3 = mysqli_fetch_array($query7)){ 
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="product">
                    <a style="text-decoration: none;" href="detail.php?id=<?php echo $res3['id']; ?>">
                      <div class="flip-container">
                        <div class="flipper">
                          <div class="front"><img style="height: 228px; width: 253px;" src="book_img/<?php echo $res3['p_img1']; ?>" alt="" class="img-fluid"></div>
                          <div class="back"><img style="height: 228px; width: 253px;" src="book_img/<?php echo $res3['p_img2']; ?>" alt="" class="img-fluid"></div>
                        </div>
                      </div><img style="height: 228px; width: 253px;" src="book_img/<?php echo $res3['p_img3']; ?>" alt="" class="img-fluid">
                      <div class="text">
                        <h4 class="text-primary p-0 m-0 pb-1" style="text-align: center;"><?php if(strlen($res3['p_name']) > 22 ){ echo substr($res3['p_name'], 0, 18).'...' ;}else{ echo $res3['p_name']; } ?></h4><h6 class="text-secondary p-0 m-0" style="text-align: center;"><?php if(strlen($res3['p_author']) > 22 ){ echo substr($res3['p_author'], 0, 18).'...' ;}else{ echo $res3['p_author']; } ?></h6>
                        <p class="price p-0 m-0 pb-2"> 
                          <del class="font-italic p-0 m-0" style="font-size: 12px;">Orginal Price <?php echo $res3['p_org_price']; ?><br></del>Sell Price <?php echo $res3['p_price']; ?>
                        </p>
                      </div>
                    </a>
                    <div class="text p-0 m-0">
                      <p class="text-center buttons"><a href="detail.php?id=<?php echo $res3['id']; ?>" class="btn btn-outline-secondary float-left ml-3">View detail</a>
                        <?php
                          if(isset($_SESSION['email'])){
                          $email = $_SESSION['email'];
                          $resultSet11 = $mysqli->query("select id from seller_reg where email = '$email'");
                          if ($resultSet11) {
                              $row11 = $resultSet11->fetch_assoc();
                              $id_buyer_reg = $row11['id'];
                              $query9 = "select product_id from cart where buyer_id = '$id_buyer_reg'";
                              $query10 = mysqli_query($mysqli,$query9);
                              $num11 = mysqli_num_rows($query10);
                              while($res10 = mysqli_fetch_array($query10)){ 
                                  if ($res10['product_id'] === $res3['id']) { ?>    
                                  <form class="text-center" method="post" action="basket.php" style="text-decoration: none; color: inherit; border: 0px none;">
                                    <button class="text-center btn btn-primary mr-2" style="text-decoration: none; color: inherit;" name="my_cart" type="submit" value="submit"><i class="fa fa-shopping-cart"></i>Go to cart?</button>
                                  </form>
                                 <?php }} 
                                 $new_id = $res3['id'];
                                 $resultSet100 = $mysqli->query("select product_id from cart where product_id = '$new_id' and buyer_id = '$id_buyer_reg'");
                                 if($resultSet100->num_rows == 0){
                                 ?>
                                    <form class="text-center mr-2" method="post" action="" style="text-decoration: none; color: inherit; border: 0px none;">
                                      <input type="hidden" name="cart_add_pro_id" value="<?php echo $res3['id']; ?>">
                                      <button class="text-center btn btn-primary" style="text-decoration: none; color: inherit;" name="add_to_cart" type="submit" value="submit"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </form>
                               <?php  
                                }
                              }
                            }else{ ?> <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-shopping-cart"></i> Add to cart</a> <?php } ?></p>
                    </div>
                    <!-- /.text-->
                  </div>
                  <!-- /.product            -->
                </div>
              
               <?php } ?>
                <!-- /.products-->
              </div>
            </div>
            <!-- /.col-lg-9-->
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <?php include('include/footer.php'); ?>