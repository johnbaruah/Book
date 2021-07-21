
<?php include('include/header.php'); ?>
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div id="main-slider" class="owl-carousel owl-theme">
                <div class="item" style="height: 550px;"><img src="img/book3.jpg" height="500px" alt="" class="img-fluid"></div>
                <div class="item" style="height: 550px;"><img src="img/book4.jpg" height="500px" alt="" class="img-fluid"></div>
                <div class="item" style="height: 550px;"><img src="img/book5.jpg" height="500px" alt="" class="img-fluid"></div>
                <div class="item" style="height: 550px;"><img src="img/book6.jpg" height="500px" alt="" class="img-fluid"></div>
              </div>
              <!-- /#main-slider-->
            </div>
          </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
          <div class="container">
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-heart"></i></div>
                  <h3><a href="#">We love our customers</a></h3>
                  <p class="mb-0">We are known to provide best possible service ever</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-tags"></i></div>
                  <h3><a href="#">Best prices</a></h3>
                  <p class="mb-0">You can gift some books to your close one as a token of love.</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                  <h3><a href="#">100% satisfaction guaranteed</a></h3>
                  <p class="mb-0">Free returns on everything for 3 months.</p>
                </div>
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        
       
        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
     

         <?php           
            $query3 = "select * from product where cat_name = 'old' ORDER BY rand() LIMIT 30";
            $query4 = mysqli_query($mysqli,$query3);
            $num2 = mysqli_num_rows($query4);
        ?>
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">Old Books</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="product-slider owl-carousel owl-theme">
              <?php
                while($res2 = mysqli_fetch_array($query4)){ 
              ?>
              <div class="item">
               <a style="text-decoration: none;" href="detail.php?id=<?php echo $res2['id']; ?>">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res2['p_img1']; ?>" alt="" class="img-fluid"></div>
                      <div class="back"><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res2['p_img2']; ?>" alt="" class="img-fluid"></div>
                    </div>
                  </div><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res2['p_img3']; ?>" alt="" class="img-fluid">
                  <div class="text pb-0 mb-0">
                    <h3 class="p-0 m-0"><?php if(strlen($res2['p_name']) > 13 ){ echo substr($res2['p_name'], 0, 12).'...' ;}else{ echo $res2['p_name']; } ?><br><?php if(strlen($res2['p_author']) > 13 ){ echo substr($res2['p_author'], 0, 12).'...' ;}else{ echo $res2['p_author']; } ?></h3>
                    <p class="price p-0 m-0 mb-1" style="font-size: 15px;"> 
                      <del class="font-italic p-0 m-0" style="font-size: 12px;">Orginal Price <?php echo $res2['p_org_price']; ?><br></del>Sell Price <?php echo $res2['p_price']; ?>
                    </p>
                  </div>
                  <!-- /.text $res['crdate']-->
                  <?php 
                    $data_date = $res2['crdate'];
                    $data_date1 = strtotime($data_date);
                    $cr_date = date("y-m-d h:i:s");
                    $cr_date1 = strtotime($cr_date);
                    $interval = (($cr_date1) - ($data_date1));
                    if ($interval < 86400 ) { ?>
                      <div class="ribbon sale">
                        <div class="theribbon">NEW</div>
                        <div class="ribbon-background"></div>
                      </div>
                      <!-- /.ribbon-->
                      <div class="ribbon new">
                        <div class="theribbon">Buy</div>
                        <div class="ribbon-background"></div>
                      </div>
                  <?php } ?>
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
         <?php           
            $query6 = "select * from product where cat_name = 'new' ORDER BY rand() LIMIT 30";
            $query7 = mysqli_query($mysqli,$query6);
            $num3 = mysqli_num_rows($query7);
        ?>
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">New Books</h2>
                </div>
              </div>
            </div>
          </div>
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
                      <div class="front"><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res3['p_img1']; ?>" alt="" class="img-fluid"></div>
                      <div class="back"><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res3['p_img2']; ?>" alt="" class="img-fluid"></div>
                    </div>
                  </div><img style="height: 228px; width: 180px;" src="book_img/<?php echo $res3['p_img3']; ?>" alt="" class="img-fluid">
                  <div class="text pb-0 mb-0">
                    <h3 class="p-0 m-0"><?php if(strlen($res3['p_name']) > 13 ){ echo substr($res3['p_name'], 0, 12).'...' ;}else{ echo $res3['p_name']; } ?><br><?php if(strlen($res3['p_author']) > 13 ){ echo substr($res3['p_author'], 0, 12).'...' ;}else{ echo $res3['p_author']; } ?></h3>
                    <p class="price p-0 m-0 mb-1" style="font-size: 15px;"> 
                      <del class="font-italic p-0 m-0" style="font-size: 12px;">Orginal Price <?php echo $res3['p_org_price']; ?><br></del>Sell Price <?php echo $res3['p_price']; ?>
                    </p>
                  </div>
                  <!-- /.text $res['crdate']-->
                  <?php 
                    $data_date = $res3['crdate'];
                    $data_date1 = strtotime($data_date);
                    $cr_date = date("y-m-d h:i:s");
                    $cr_date1 = strtotime($cr_date);
                    $interval = (($cr_date1) - ($data_date1));
                    if ($interval < 86400 ) { ?>
                      <div class="ribbon sale">
                        <div class="theribbon">NEW</div>
                        <div class="ribbon-background"></div>
                      </div>
                      <!-- /.ribbon-->
                      <div class="ribbon new">
                        <div class="theribbon">Buy</div>
                        <div class="ribbon-background"></div>
                      </div>
                  <?php } ?>
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
        <!-- *** GET INSPIRED END ***-->
        <!--
        *** BLOG HOMEPAGE ***
        _________________________________________________________
        -->
        <div class="container">
          <div class="col-md-12">
            <div class="box slideshow">
              <h3>Get Inspired</h3>
              <p class="lead">Get the inspiration from our world class book lovers</p>
              <div id="get-inspired" class="owl-carousel owl-theme">
                <div class="item" style="height: 550px;"><a href="#"><img src="img/book1.jpg" height="500px" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item" style="height: 550px;"><a href="#"><img src="img/book2.jpg" height="500px" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item" style="height: 550px;"><a href="#"><img src="img/book3.jpg" height="500px" alt="Get inspired" class="img-fluid"></a></div>
              </div>
            </div>
          </div>
        </div>

        <div class="box text-center">
          <div class="container">
            <div class="col-md-12">
              <h3 class="text-uppercase">Our Motivation</h3>
              <p class="lead mb-0">Re-use of books & save environment?<a href="#">Why we doing this</a></p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="col-md-12">
            <div id="blog-homepage" class="row">
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="about_new_book.php">What is new Book</a></h4>
                  <p class="author-category">By <a href="#">John Baruah</a> in <a href="#">About Us</a></p>
                  <hr>
                  <p class="intro">You want Know about what is new book category contain and how it works; You want Know about what is new book category contain and how it works; You want Know about what is new book category contain and how it works</p>
                  <p class="read-more"><a href="about_new_book.php" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="about_old_book.php">What is old Book</a></h4>
                  <p class="author-category">By <a href="#">John Baruah</a> in <a href="#">About Us</a></p>
                  <hr>
                  <p class="intro">You want Know about what is old book category contain and how it works; You want Know about what is old book category contain and how it works; You want Know about what is old book category contain and how it works</p>
                  <p class="read-more"><a href="about_old_book.php" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
            </div>
            <!-- /#blog-homepage-->
          </div>
        </div>
        <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <?php include('include/footer.php'); ?>
