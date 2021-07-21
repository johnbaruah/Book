<?php include('include/header.php'); ?>
    <!-- from here modify 1st john start -->

    <?php
      $error = NULL;
       if(!isset($_SESSION['email'])){
        header('location:index.php');
       }
      session_regenerate_id( true );
      if(isset($_SESSION['email'])){
      $email = $_SESSION['email'];
      $resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
      if ($resultSet) {
          $row = $resultSet->fetch_assoc();
          $verified = $row['verified'];
          }
        if ($verified != 2) {
          header('location:index.php');
        }
        
      

                        $query6 = "select * from seller_reg";
                        $query7 = mysqli_query($mysqli,$query6);
                        $num3 = mysqli_num_rows($query7);
                   
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
                  <li aria-current="page" class="breadcrumb-item active">Profile</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-12">

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
                      <th style="text-align: center;">Verify</th>  
                      <th width="60px;">Image</th>
                      <th>User Name</th>
                      <th>Address</th>
                      <th>Pan Card</th>
                      <th>Address Proof</th>                
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        $totalSum = 0;
                        $sl = 1;
                        while($res = mysqli_fetch_array($query7)){ 
                            ?>

                          <tr class="tbl-bg align-middle">
                            <td class="inpt"><?php echo $sl++; ?></td>
                            <td class="inpt"><?php if ($res['sell_permission'] == 0) { ?>
                              <button class="btn btn-danger"><a style="color: white;" class="p-0 m-0" href="block2.php?id=<?php echo $res['id']; ?>">verify!!</a></button>
                           <?php }elseif ($res['sell_permission'] == 1) { ?>
                              <button class="btn btn-success"><a style="color: white;" class="p-0 m-0" href="#">Verified</a></button>
                           <?php } ?></td>
                            <td class="inpt"><a href="#"><img class="d-block w-100" src="book_img/<?php echo $res['profile_img']; ?>" alt="First slide" width="30px" height="90px"></a></td>
                            <td class="inpt"><?php echo $res['name'].' '.$res['lname'];?></td>
                            <td class="inpt"><?php echo $res['address'].', '.$res['contact_no'].', '.$res['email'].', '.$res['pin']; ?></td>
                            <td class="inpt"><a href="#"><img class="d-block w-100" src="book_img/<?php echo $res['pan_card']; ?>" alt="First slide" width="200px" height="200px"></a></td>
                            <td class="inpt"><a href="#"><img class="d-block w-100" src="book_img/<?php echo $res['address_proof']; ?>" alt="First slide" width="200px" height="200px"></a></td>
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
                  
                     

<!-- admin lte start -->

<!-- admin lte end -->
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- from here modify 1st john end -->
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->

   <?php include('include/footer.php'); ?>
   
