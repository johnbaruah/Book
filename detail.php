<?php include('include/header.php'); ?>
<?php
$error = NULL;
$item_already_in_cart = NULL; 
  $product_id = $_GET['id'];
  if (isset($product_id)) {
    $resultSet = $mysqli->query("select * from product where id = '$product_id'");
    if ($resultSet) {
      $row = $resultSet->fetch_assoc();
      $seller_id = $row['seller_id'];
      if (isset($seller_id)) {
      	$id_product = $row['id'];
        $cat_name = $row['cat_name'];
        $p_name = $row['p_name'];
        $p_author = $row['p_author'];
        $p_publication = $row['p_publication'];
        $p_des = $row['p_des'];
        $p_org_price = $row['p_org_price'];
        $p_price = $row['p_price'];
        $p_quantity = $row['p_quantity'];
        $p_img1 = $row['p_img1'];
        $p_img2 = $row['p_img2'];
        $p_img3 = $row['p_img3'];
        $crdate = $row['crdate'];
        $resultSet2 = $mysqli->query("select * from seller_reg where id = '$seller_id'");
        if ($resultSet2) {
          $row2 = $resultSet2->fetch_assoc();
          $fname = $row2['name'];
          $lname = $row2['lname'];
          $email_2 = $row2['email'];
          $contact_no = $row2['contact_no'];
          $address = $row2['address'];
          $profile_img = $row2['profile_img'];
          $pin = $row2['pin'];
        }
    }else{
      header("location:index.php");
    }}else{
      header("location:index.php");
    }
  }else{
    header("location:index.php");
  }

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
                            $error = '<div class="font-italic text-primary">Item added to cart</div>';
                        }else{
                          echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                        } 
                      }else{
                        $error = '<div class="font-italic text-danger">Product Currently outof stock</div>';
                      }
                    }

   
  }else{
  	echo '<script>alert("Something went wrong please try again after Sometime")</script>';
  }
}

if(isset($_SESSION['email'])){
      $email = $_SESSION['email'];
      $resultSet11 = $mysqli->query("select id from seller_reg where email = '$email'");
      if ($resultSet11) {
          $row11 = $resultSet11->fetch_assoc();
          $id_buyer_reg = $row11['id'];
          $resultSet12 = $mysqli->query("select * from cart where buyer_id = '$id_buyer_reg' and product_id = '$id_product' limit 1");
          if($resultSet12->num_rows == 1){
  			$item_already_in_cart = 1;
          }}} 
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
                  <li aria-current="page" class="breadcrumb-item active"><?php echo $cat_name; ?></li>
                  <li aria-current="page" class="breadcrumb-item active"><?php echo $p_name; ?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
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
                    <li><?php if ($cat_name== 'old') { ?>
                      <a href="old_category.php" class="nav-link active">Old Books</a>
                   <?php  }else{ ?> <a href="old_category.php" class="nav-link">Old Books</a> <?php } ?>
                    </li>
                    <li><?php if ($cat_name== 'new') { ?>
                        <a href="new_category.php" class="nav-link active">New Books</a>
                      <?php  }else{ ?> <a href="new_category.php" class="nav-link">New Books</a> <?php } ?>
                    </li>
                  </ul>
                </div>
              </div>
              
              <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner"><a href="#"><img src="img/banner.jpg" alt="sales 2014" class="img-fluid"></a></div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
              <div id="productMain" class="row">
                <div class="col-md-6">
                  <div data-slider-id="1" class="owl-carousel shop-detail-carousel" style="height: 407px;">
                    <div class="item" style="height: 407px;"> <img src="book_img/<?php echo $p_img1; ?>" alt=""  height="407px"></div>
                    <div class="item" style="height: 407px;"> <img src="book_img/<?php echo $p_img2; ?>" alt=""  height="407px"></div>
                    <div class="item" style="height: 407px;"> <img src="book_img/<?php echo $p_img3; ?>" alt=""  height="407px"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box">
                    <h3 class="text-center"><?php if(strlen($p_name) > 27 ){ echo substr($p_name, 0, 23).'...' ;}else{ echo $p_name; } ?></h3>
                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, &amp; seller information</a></p>
                    <p class="price p-0 m-0"><del class="price p-0 m-0 font-italic" style="font-size: 13px;">Original Price ₹<?php echo $p_org_price; ?></del></p>
                    <p class="price pt-0 mt-0 text-danger" style="font-size: 15px;">Selling Price ₹<?php echo $p_price; ?></p>
                    <p class="text-center buttons"><?php if(isset($_SESSION['email'])){ ?> <?php if ($item_already_in_cart == 1) { ?>
                    	<form class="text-center" method="post" action="basket.php" style="text-decoration: none;padding: 0px;margin: 0px;color: inherit;border: 0px none;">
                    	<button class="text-center btn btn-primary" style="text-decoration: none; color: inherit; border: 0px none; " name="my_cart" type="submit" value="submit"><i class="fa fa-shopping-cart"></i> Go to cart?</button>
                    </form>
                    <?php }else{ ?><form class="text-center" method="post" action="" style="text-decoration: none;padding: 0px;margin: 0px;color: inherit;border: 0px none;">
                    	<input type="hidden" name="cart_add_pro_id" value="<?php echo $id_product; ?>">
                    	<button class="text-center btn btn-primary" style="text-decoration: none; color: inherit; border: 0px none; " name="add_to_cart" type="submit" value="submit"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                    </form><?php } ?> <?php }else{ ?> <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-shopping-cart"></i> Add to cart</a> <?php } ?></p>
                    <center><?php echo $error; ?></center>
                  </div>
                  <div data-slider-id="1" class="owl-thumbs">
                    <button class="owl-thumb-item"><img height="105px" src="book_img/<?php echo $p_img1; ?>" alt=""></button>
                    <button class="owl-thumb-item"><img height="105px" src="book_img/<?php echo $p_img2; ?>" alt=""></button>
                    <button class="owl-thumb-item"><img height="105px" src="book_img/<?php echo $p_img3; ?>" alt=""></button>
                  </div>
                </div>
              </div>
              <div id="details" class="box">
                <p></p>
                <h4>Book details</h4>
                <p><?php echo $p_name; ?></p>
                <h4>Category & Publication</h4>
                <ul>
                  <li><?php echo $cat_name; ?></li>
                  <li><?php echo $p_publication; ?></li>
                </ul>
                <h4>Book Author &amp; Book Quantity</h4>
                <ul>
                  <li><?php echo $p_author; ?></li>
                  <li><?php echo $p_quantity; ?></li>
                </ul>
                <blockquote>
                  <p>Description: <em><?php echo $p_des; ?></em></p>
                </blockquote>
                <div class="row">
                  <div class="col-6">
                    <blockquote>
                      <p>Seller Description:<br><em>Address: <?php echo $address; ?>, <?php echo $pin; ?></em><br>Name: <em><?php echo $fname; ?> <?php echo $lname; ?></em><br>Contact Details: <em><?php echo $email_2; ?>, (<span class="text-primary"><?php echo $contact_no; ?></span>)</em><br>Selling Date:<em> <?php echo $crdate; ?></em></p>
                    </blockquote>
                  </div>
                  <div class="col-6">
                    <div class="float-right mb-0 pb-0 mr-0 pr-0 mt-5">
                      <a href="#"><img class="rounded-circle" src="book_img/<?php if($profile_img != NULL){ echo $profile_img; }else{?>profile.jpg <?php } ?>" width="55px" height="55px" alt="..."></a>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="social">
                  <h4>Show it to your friends</h4>
                  <p><a href="facebook.com" class="external facebook"><i class="fa fa-facebook"></i></a><a href="google.com" class="external gplus"><i class="fa fa-google-plus"></i></a><a href="twitter.com" class="external twitter"><i class="fa fa-twitter"></i></a><a href="gmail.com" class="email"><i class="fa fa-envelope"></i></a></p>
                </div>
              </div>
              <div class="row same-height-row">
                <div class="col-md-2 col-sm-5">
                  <div class="box pt-2" style="height: 212px;">
                    <h3 class="p-0 m-0">You may also like these books</h3>
                  </div>
                </div>
                <?php           
            $query6 = "select * from product ORDER BY rand() LIMIT 30";
            $query7 = mysqli_query($mysqli,$query6);
            $num3 = mysqli_num_rows($query7);
        ?>
        <div class="col-md-10 col-sm-7">
        <div id="hot">
          
          <div class="container">
            <div class="product-slider owl-carousel owl-theme">
              <?php
                while($res3 = mysqli_fetch_array($query7)){ 
              ?>
              <div class="item">
               <a style="text-decoration: none;" href="detail.php?id=<?php echo $res3['id']; ?>">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><img style="height: 120px; width: 180px;" src="book_img/<?php echo $res3['p_img1']; ?>" alt="" class="img-fluid"></div>
                      <div class="back"><img style="height: 120px; width: 180px;" src="book_img/<?php echo $res3['p_img2']; ?>" alt="" class="img-fluid"></div>
                    </div>
                  </div><img style="height: 120px; width: 180px;" src="book_img/<?php echo $res3['p_img3']; ?>" alt="" class="img-fluid">
                  <div class="text pb-0 mb-0">
                    <h4 class="p-0 m-0 text-center" style="font-size: 15px;"><?php if(strlen($res3['p_name']) > 10 ){ echo substr($res3['p_name'], 0, 6).'...' ;}else{ echo $res3['p_name']; } ?></h4>
                    <p class="price p-0 m-0 mb-1" style="font-size: 13px;"> 
                      <del class="font-italic p-0 m-0" style="font-size: 10px;">Org Pr. <?php echo $res3['p_org_price']; ?><br></del>Sell Price <?php echo $res3['p_price']; ?>
                    </p>
                  </div> 
                  <!-- /.ribbon-->
                </div>
               </a>
                <!-- /.product-->
              </div>
            <?php } ?>
              <!-- /.product-slider-->
            </div>
            <!-- /.container-->
          </div>
          <!-- /#hot-->
          <!-- *** HOT END ***-->
        </div>
      </div>
               
               
              </div>
            </div>
            <!-- /.col-md-9-->
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <?php include('include/footer.php'); ?>