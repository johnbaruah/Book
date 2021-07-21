<?php include('include/header.php'); ?>
    <!-- from here modify 1st john start -->
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

        
                  <?php
                    session_regenerate_id( true );
                    if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
                    if ($resultSet) {
                        $row = $resultSet->fetch_assoc();
                        $id = $row['id'];
                        $pan_card = $row['pan_card'];
                        $sell_permission = $row['sell_permission'];
                        $address_proof = $row['address_proof'];
                        $query = "select * from product where seller_id = '$id'";
                        $query2 = mysqli_query($mysqli,$query);
                        $num = mysqli_num_rows($query2);

                        // insert_doc pan_card address_proof
                        if(isset($_POST['doc_proof'])){

                          $p_img4 = $_FILES['pan_card'];
                          $p_img5 = $_FILES['address_proof']; 

                          $filename4 = $p_img4['name'];
                          $fileerror4 = $p_img4['error'];
                          $filetmp4 = $p_img4['tmp_name'];
                          $filesize4 = $p_img4['size'];
                          $fileext4 = explode('.', $filename4);
                          $filecheck4 = strtolower(end($fileext4));    
                          $fileextstored4 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck4, $fileextstored4)){
                            $temp4 = explode(".", $filename4);
                            $newfilename4 = round(microtime(true)) .'aa'.'.' . end($temp4);
                            $destinationfile4 = 'book_img/'.$newfilename4;
                            move_uploaded_file($filetmp4, $destinationfile4);
                          }

                          $filename5 = $p_img5['name'];
                          $fileerror5 = $p_img5['error'];
                          $filetmp5 = $p_img5['tmp_name'];
                          $filesize5 = $p_img5['size'];
                          $fileext5 = explode('.', $filename5);
                          $filecheck5 = strtolower(end($fileext5));  
                          $fileextstored5 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck5, $fileextstored5)){
                            $temp5 = explode(".", $filename5);
                            $newfilename5 = round(microtime(true)) .'bb'. '.' . end($temp5);
                            $destinationfile5 = 'book_img/'.$newfilename5;
                            move_uploaded_file($filetmp5, $destinationfile5);
                          }

                          $pan_card = $mysqli->real_escape_string($newfilename4);
                          $address_proof = $mysqli->real_escape_string($newfilename5); 
                          $doc_up_qy = $mysqli->query("update seller_reg set pan_card = '$pan_card', address_proof = '$address_proof' where id = '$id'");
                          if($doc_up_qy){
                            echo '<script>alert("Documents Upload Successful Now You Can sell Books")</script>';
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                          }
                        }

                        if(isset($_POST['add_new_book'])){
                          $cat_name = $mysqli->real_escape_string($_POST['cat_name']);
                          $p_name = $mysqli->real_escape_string($_POST['p_name']);
                          $p_author = $mysqli->real_escape_string($_POST['p_author']); 
                          $p_publication = $mysqli->real_escape_string($_POST['p_publication']);
                          $p_des = $mysqli->real_escape_string($_POST['p_des']);
                          $p_org_price = $mysqli->real_escape_string($_POST['p_org_price']);
                          $p_price = $mysqli->real_escape_string($_POST['p_price']);
                          $p_quantity = $mysqli->real_escape_string($_POST['p_quantity']);
                          $days = $mysqli->real_escape_string($_POST['days']);
                          $available = 'yes';
                          $p_img1 = $_FILES['p_img1'];
                          $p_img2 = $_FILES['p_img2'];
                          $p_img3 = $_FILES['p_img3'];


                          $filename1 = $p_img1['name'];
                          $fileerror1 = $p_img1['error'];
                          $filetmp1 = $p_img1['tmp_name'];
                          $filesize1 = $p_img1['size'];
                          $fileext1 = explode('.', $filename1);
                          $filecheck1 = strtolower(end($fileext1));    
                          $fileextstored1 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck1, $fileextstored1)){
                            $temp1 = explode(".", $filename1);
                            $newfilename1 = round(microtime(true)) .'cc'.'.' . end($temp1);
                            $destinationfile1 = 'book_img/'.$newfilename1;
                            move_uploaded_file($filetmp1, $destinationfile1);
                          }

                          $filename2 = $p_img2['name'];
                          $fileerror2 = $p_img2['error'];
                          $filetmp2 = $p_img2['tmp_name'];
                          $filesize2 = $p_img2['size'];
                          $fileext2 = explode('.', $filename2);
                          $filecheck2 = strtolower(end($fileext2));  
                          $fileextstored2 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck2, $fileextstored2)){
                            $temp2 = explode(".", $filename2);
                            $newfilename2 = round(microtime(true)) .'dd'. '.' . end($temp2);
                            $destinationfile2 = 'book_img/'.$newfilename2;
                            move_uploaded_file($filetmp2, $destinationfile2);
                          }

                          $filename3 = $p_img3['name'];
                          $fileerror3 = $p_img3['error'];
                          $filetmp3 = $p_img3['tmp_name'];
                          $filesize3 = $p_img3['size'];
                          $fileext3 = explode('.', $filename3);
                          $filecheck3 = strtolower(end($fileext3));  
                          $fileextstored3 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck3, $fileextstored3)){
                            $temp3 = explode(".", $filename3);
                            $newfilename3 = round(microtime(true)) .'ee'. '.' . end($temp3);
                            $destinationfile3 = 'book_img/'.$newfilename3;
                            move_uploaded_file($filetmp3, $destinationfile3);
                          }

                          $p_img11  = $mysqli->real_escape_string($newfilename1);
                          $p_img22  = $mysqli->real_escape_string($newfilename2);
                          $p_img33  = $mysqli->real_escape_string($newfilename3);
     
                          $add_book_qy = $mysqli->query("insert into product(seller_id, cat_name, p_name, p_author, p_publication, p_des, p_org_price, p_price, p_quantity, p_img1, p_img2, p_img3, available, days) values('$id', '$cat_name', '$p_name', '$p_author', '$p_publication', '$p_des', '$p_org_price', '$p_price', '$p_quantity', '$p_img11', '$p_img22', '$p_img33', '$available', '$days')");
                          if($add_book_qy){
                            // echo '<script>alert("Item added successfuly")</script>';
                            header("location:sell_form.php");
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                             // $mysqli->error;
                          }
                        }

                        // edit book

                        if(isset($_POST['edit_book'])){
                          $product_id = $mysqli->real_escape_string($_POST['product_id']);
                          $seller_id = $mysqli->real_escape_string($_POST['seller_id']);
                          $cat_name = $mysqli->real_escape_string($_POST['cat_name']);
                          $p_name = $mysqli->real_escape_string($_POST['p_name']);
                          $p_author = $mysqli->real_escape_string($_POST['p_author']); 
                          $p_publication = $mysqli->real_escape_string($_POST['p_publication']);
                          $p_des = $mysqli->real_escape_string($_POST['p_des']);
                          $p_org_price = $mysqli->real_escape_string($_POST['p_org_price']);
                          $p_price = $mysqli->real_escape_string($_POST['p_price']);
                          $p_quantity = $mysqli->real_escape_string($_POST['p_quantity']);
                          $available = $mysqli->real_escape_string($_POST['available']);
                          $days = $mysqli->real_escape_string($_POST['days']);
                          $p_img19 = $_FILES['p_img19'];
                          $p_img29 = $_FILES['p_img29'];
                          $p_img39 = $_FILES['p_img39'];
                          
                          $filename19 = $p_img19['name'];
                          $fileerror19 = $p_img19['error'];
                          $filetmp19 = $p_img19['tmp_name'];
                          $filesize19 = $p_img19['size'];
                          $fileext19 = explode('.', $filename19);
                          $filecheck19 = strtolower(end($fileext19));    
                          $fileextstored19 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck19, $fileextstored19)){
                            $temp19 = explode(".", $filename19);
                            $newfilename19 = round(microtime(true)) .'cc'.'.' . end($temp19);
                            $destinationfile19 = 'book_img/'.$newfilename19;
                            move_uploaded_file($filetmp19, $destinationfile19);
                          }

                          $filename29 = $p_img29['name'];
                          $fileerror29 = $p_img29['error'];
                          $filetmp29 = $p_img29['tmp_name'];
                          $filesize29 = $p_img29['size'];
                          $fileext29 = explode('.', $filename29);
                          $filecheck29 = strtolower(end($fileext29));  
                          $fileextstored29 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck29, $fileextstored29)){
                            $temp29 = explode(".", $filename29);
                            $newfilename29 = round(microtime(true)) .'dd'.'.' . end($temp29);
                            $destinationfile29 = 'book_img/'.$newfilename29;
                            move_uploaded_file($filetmp29, $destinationfile29);
                          }

                          $filename39 = $p_img39['name'];
                          $fileerror39 = $p_img39['error'];
                          $filetmp39 = $p_img39['tmp_name'];
                          $filesize39 = $p_img39['size'];
                          $fileext39 = explode('.', $filename39);
                          $filecheck39 = strtolower(end($fileext39));  
                          $fileextstored39 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck39, $fileextstored39)){
                            $temp39 = explode(".", $filename39);
                            $newfilename39 = round(microtime(true)) .'ee'.'.' . end($temp39);
                            $destinationfile39 = 'book_img/'.$newfilename39;
                            move_uploaded_file($filetmp39, $destinationfile39);
                          }

                          $p_img199 = $mysqli->real_escape_string($newfilename19);
                          $p_img299 = $mysqli->real_escape_string($newfilename29);
                          $p_img399 = $mysqli->real_escape_string($newfilename39);
     
                          $edit_book_qy = $mysqli->query("update product set cat_name = '$cat_name', p_name = '$p_name', p_author = '$p_author', p_publication = '$p_publication', p_des = '$p_des', p_org_price = '$p_org_price', p_price = '$p_price', p_quantity = '$p_quantity', available = '$available', p_img1 = '$p_img199', p_img2 = '$p_img299', p_img3 = '$p_img399', days = '$days' where id = '$product_id' and seller_id = '$seller_id'");
                          if($edit_book_qy){
                            // echo '<script>alert("Item added successfuly")</script>';
                            header("location:sell_form.php");
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                             // $mysqli->error;
                          }
                        }


                        if ($num == null) { ?>
                          <div class="row">
                            <div class="col-lg-12">
                              <h4 class="page-header">You don't have any Products yet <?php if($pan_card != NULL && $address_proof != NULL){ if($sell_permission == 0){?> <span class="font-italic text-danger" style="font-size: 12px;">(Wait for documents verification)</span><?php }else{ ?><a href="#" data-toggle="modal" data-target="#add_new-modal">  <i class="fa fa-plus-circle fw-fa"></i>Add Book</a><?php }}else{ ?> <a href="#" data-toggle="modal" data-target="#add_pan-modal" >  <i class="fa fa-plus-circle fw-fa"></i>Add Doc</a> <span class="font-italic text-danger" style="font-size: 12px;">(You have to uplaod Pan Card & Any type of Address proof document, Before sell books)</span>  <?php } ?>
                              </h4>
                            </div>
                            <div id="add_pan-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #4fbfa8; color: #fff;">
                                    <h5 class="modal-title">Documents&nbsp;Upload</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action=" " method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <input id="email-modal" type="file" placeholder="Pan Card" name="pan_card" class="form-control" required="required">
                                      </div>
                                      <div class="form-group">
                                        <input id="password-modal" type="file" name="address_proof" placeholder="Addres Proof" class="form-control" required="required">
                                      </div>
                                      <p class="text-center">
                                        <button class="btn btn-primary" type="submit" value="doc_proof" name="doc_proof"><i class="fa fa-sign-in"></i>Upload</button>
                                      </p>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div id="add_new-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #4fbfa8; color: #fff;">
                                    <h5 class="modal-title">Add Book...</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action=" " method="post" enctype="multipart/form-data">
                                      <div class="card-body">
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_name" class="required">Book Name</label>
                                            <input type="text" name="p_name" class="form-control" required="required" value="">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_author">Author Name</label>
                                            <input type="text" class="form-control" name="p_author" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_publication" class="required">Book Publication</label>
                                            <input type="text" class="form-control" name="p_publication" required="required">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-9">
                                            <label for="p_des" class="required">Book Description</label>
                                            <input type="text" class="form-control" name="p_des" placeholder="Quality/Condition/About" required="required">
                                          </div>
                                          <div class="form-group col-md-3">
                                            <?php
                                              $cat_select_qy = "select * from category";
                                              $cat_select_qy2 = mysqli_query($mysqli, $cat_select_qy);
                                              $num2 = mysqli_num_rows($cat_select_qy2);
                                            ?>
                                            <label for="cat_name" class="required">Category</label>
                                            <select class="form-control" name="cat_name" required="required">
                                              <option value="">Choose...</option>
                                              <?php
                                              while($res = mysqli_fetch_array($cat_select_qy2)){ 
                                              echo "<option value=".$res['cat_name'].">".$res['cat_name']."</option>";  
                                              }
                                              ?>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_org_price">Book original Price</label>
                                            <input type="number" class="form-control" name="p_org_price" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_price">Selling Price</label>
                                            <input type="number" class="form-control" name="p_price" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_quantity">Book Quantity</label>
                                              <select class="form-control" name="p_quantity" required>
                                                  <option value="">Choose...</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_img1">Book Image-1</label>
                                            <input type="file" class="form-control" name="p_img1" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img2">Book Image-2</label>
                                            <input type="file" class="form-control" name="p_img2" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img3">Book Image-3</label>
                                            <input type="file" class="form-control" name="p_img3" required="required">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                          
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="days" style="font-size: 12px">In case of Replace? Buyer can replace under how many days</label>
                                              <select class="form-control" name="days" required>
                                                  <option value="">Choose...</option>
                                                  <option value="0">0</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                           
                                          </div>
                                        </div>
                                      </div>
                                      <p class="text-center">
                                        <button class="btn btn-primary" type="submit" value="add_new_book" name="add_new_book"><i class="fa fa-sign-in"></i>Add New Book</button>
                                      </p>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                      <?php    
                        }else{
                      ?>

                  <div class="row">
                    <div class="col-lg-12">
                      <h4 class="page-header">List of Products  <?php if($pan_card != NULL){ ?> <a href="#" data-toggle="modal" data-target="#add_new-modal">  <i class="fa fa-plus-circle fw-fa"></i>Add New</a><?php }else{ ?> <a href="#" data-toggle="modal" data-target="#add_pan-modal" >  <i class="fa fa-plus-circle fw-fa"></i>Add Doc</a>  <?php } ?>
                      </h4>
                    </div>
          <!-- /.col-lg-12  add_new.php-->
                  </div>
                  <div id="add_new-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #4fbfa8; color: #fff;">
                                    <h5 class="modal-title">Add Book...</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action=" " method="post" enctype="multipart/form-data">
                                      <div class="card-body">
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_name" class="required">Book Name</label>
                                            <input type="text" name="p_name" class="form-control" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_author">Author Name</label>
                                            <input type="text" class="form-control" name="p_author" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_publication" class="required">Book Publication</label>
                                            <input type="text" class="form-control" name="p_publication" required="required">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-9">
                                            <label for="p_des" class="required">Book Description</label>
                                            <input type="text" class="form-control" name="p_des" placeholder="Quality/Condition/About" required="required">
                                          </div>
                                          <div class="form-group col-md-3">
                                            <?php
                                              $cat_select_qy = "select * from category";
                                              $cat_select_qy2 = mysqli_query($mysqli, $cat_select_qy);
                                              $num2 = mysqli_num_rows($cat_select_qy2);
                                            ?>
                                            <label for="cat_name" class="required">Category</label>
                                            <select class="form-control" name="cat_name" required="required">
                                              <option value="">Choose...</option>
                                              <?php
                                              while($res = mysqli_fetch_array($cat_select_qy2)){ 
                                              echo "<option value=".$res['cat_name'].">".$res['cat_name']."</option>";  
                                              }
                                              ?>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_org_price">Book original Price</label>
                                            <input type="number" class="form-control" name="p_org_price" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_price">Selling Price</label>
                                            <input type="number" class="form-control" name="p_price" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_quantity">Book Quantity</label>
                                              <select class="form-control" name="p_quantity" required>
                                                  <option value="">Choose...</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_img1">Book Image-1</label>
                                            <input type="file" class="form-control" name="p_img1" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img2">Book Image-2</label>
                                            <input type="file" class="form-control" name="p_img2" required="required">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img3">Book Image-3</label>
                                            <input type="file" class="form-control" name="p_img3" required="required">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-2">
                                          
                                          </div>
                                          <div class="form-group col-md-8">
                                            <label class="text-warning" for="days" style="font-size: 12px">In case of Replace? Buyer can replace under how many days</label>
                                              <select class="form-control" name="days" required>
                                                  <option value="">Choose...</option>
                                                  <option value="0">0</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-2">
                                           
                                          </div>
                                        </div>
                                      </div>
                                      <p class="text-center">
                                        <button class="btn btn-primary" type="submit" value="add_new_book" name="add_new_book"><i class="fa fa-sign-in"></i>Add New Book</button>
                                      </p>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                  <form action=" " method="post" enctype="multipart/form-data">    
                    <div class="table-responsive"> 
                    <div class="card-header" style="width: 100%;">
                      <div class="row">  
                        <div class="col-md-6">
                          <h6>Total No of products: <?php echo $num; ?></h6> 
                        </div>
                        <div class="col-md-6" style="text-align: right;">  
                          <h6><a href="my_orders.php">Manage Orders<i class="fa fa-bell"></i></a></h6>
                        </div>
                      </div>
                    </div>  

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
                      <th>Edit</th>  
                      <th>Delete</th>
                      <th width="60px;">Image</th>
                      <th>Book Name</th>
                      <th>Book Author</th>
                      <th>Book Publication</th>
                      <th>Book Description</th>  
                      <th>Original Price</th>  
                      <th>Selling Price</th>  
                      <th>Book Quantity</th>
                      <th>Category</th>  
                      <th>Avaiable</th>  
                      <th>Date</th> 
                      <th>Replace Days</th>             
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        $sl = 1;
                          while($res = mysqli_fetch_array($query2)){ 
                        ?>
                          <tr class="tbl-bg align-middle">
                            <td class="inpt"><?php echo $sl++; ?></td>
                            <td class="inpt">
                              <!-- edit -->
                                <div id="modalPort<?php echo$res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #4fbfa8; color: #fff;">
                                    <h5 class="modal-title">Edit Book...</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action=" " method="post" enctype="multipart/form-data">
                                       <input type="hidden" name="product_id" value="<?php echo $res['id']; ?>">
                                      <input type="hidden" name="seller_id" value="<?php echo $res['seller_id']; ?>">
                                      <div class="card-body">
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_name" class="required">Book Name</label>
                                            <input type="text" name="p_name" class="form-control" required="required" value="<?php echo $res['p_name']; ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_author">Author Name</label>
                                            <input type="text" class="form-control" name="p_author" required="required" value="<?php echo $res['p_author']; ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_publication" class="required">Book Publication</label>
                                            <input type="text" class="form-control" name="p_publication" required="required" value="<?php echo $res['p_publication']; ?>">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label for="p_des" class="required">Book Description</label>
                                            <input type="text" class="form-control" name="p_des" placeholder="Quality/Condition/About" required="required" value="<?php echo $res['p_des']; ?>">
                                          </div>
                                          <div class="form-group col-md-3">
                                            <label for="p_name" class="required">Available</label>
                                                <select class="form-control" name="available" required>
                                                  <option value="<?php echo $res['available']; ?>"><?php echo $res['available']; ?></option>
                                                  <option value="no">no</option>
                                                </select>
                                          </div>
                                          <div class="form-group col-md-3">
                                            <?php
                                              $cat_select_qy = "select * from category";
                                              $cat_select_qy2 = mysqli_query($mysqli, $cat_select_qy);
                                              $num2 = mysqli_num_rows($cat_select_qy2);
                                            ?>
                                            <label for="cat_name" class="required">Category</label>
                                            <select class="form-control" name="cat_name" required="required">
                                              <option value="<?php echo $res['cat_name']; ?>"><?php echo $res['cat_name']; ?></option>
                                              <?php
                                              while($res3 = mysqli_fetch_array($cat_select_qy2)){ 
                                              echo "<option value=".$res3['cat_name'].">".$res3['cat_name']."</option>";  
                                              }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_org_price">Book original Price</label>
                                            <input type="number" class="form-control" name="p_org_price" required="required" value="<?php echo $res['p_org_price']; ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_price">Selling Price</label>
                                            <input type="number" class="form-control" name="p_price" required="required" value="<?php echo $res['p_price']; ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_quantity">Book Quantity</label>
                                              <select class="form-control" name="p_quantity" required>
                                                  <option value="<?php echo $res['p_quantity']; ?>"><?php echo $res['p_quantity']; ?></option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label for="p_img19">Book Image-1</label>
                                            <img class="d-block w-100" src="book_img/<?php echo $res['p_img1']; ?>" alt="Third slide" width="40px" height="95px">
                                            <input type="file" class="form-control" name="p_img19">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img29">Book Image-2</label>
                                            <img class="d-block w-100" src="book_img/<?php echo $res['p_img2']; ?>" alt="Third slide" width="40px" height="95px">
                                            <input type="file" class="form-control" name="p_img29">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="p_img39">Book Image-3</label>
                                            <img class="d-block w-100" src="book_img/<?php echo $res['p_img3']; ?>" alt="Third slide" width="40px" height="95px">
                                            <input type="file" class="form-control" name="p_img39">
                                          </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-2">
                                          
                                          </div>
                                          <div class="form-group col-md-8">
                                            <label class="text-warning" for="days" style="font-size: 12px">In case of Replace? Buyer can replace under how many days</label>
                                              <select class="form-control" name="days" required>
                                                  <option value="<?php echo $res['days']; ?>"><?php echo $res['days']; ?></option>
                                                  <option value="0">0</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-2">
                                           
                                          </div>
                                        </div>
                                      </div>
                                      <p class="text-center">
                                        <button class="btn btn-primary" type="submit" value="edit_book" name="edit_book"><i class="fa fa-sign-in"></i>Edit Book</button>
                                      </p>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                              <!-- edit -->
                              <button class="btn btn-primary"><a data-toggle="modal" data-target="#modalPort<?php echo $res['id'];?>" style="color: white;" class="p-0 m-0" ><i class="fa fa-edit"></i></a></button>
                            </td>
                            <td class="inpt"><button class="btn btn-primary"><a style="color: white;" class="p-0 m-0" href="delete_product.php?id=<?php echo $res['id']; ?>"><i class="fa fa-trash fa-lg"></i></a></button></td>
                            <td>
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img class="d-block w-100" src="book_img/<?php echo $res['p_img1']; ?>" alt="First slide" width="40px" height="95px">
                                  </div>
                                  <div class="carousel-item">
                                    <img class="d-block w-100" src="book_img/<?php echo $res['p_img2']; ?>" alt="Second slide" width="40px" height="95px">
                                  </div>
                                  <div class="carousel-item">
                                    <img class="d-block w-100" src="book_img/<?php echo $res['p_img3']; ?>" alt="Third slide" width="40px" height="95px">
                                  </div>
                                </div>
                              </div>
                            </td>  
                            <td class="inpt"><?php echo $res['p_name']; ?></td>
                            <td class="inpt"><?php echo $res['p_author']; ?></td>
                            <td class="inpt"><?php echo $res['p_publication']; ?></td>
                            <td class="inpt"><?php echo $res['p_des']; ?></td>
                            <td class="inpt"><?php echo $res['p_org_price']; ?></td>
                            <td class="inpt"><?php echo $res['p_price']; ?></td>
                            <td class="inpt"><?php echo $res['p_quantity']; ?></td>
                            <td class="inpt"><?php echo $res['cat_name']; ?></td>
                            <td class="inpt"><?php echo $res['available']; ?></td>
                            <td class="inpt"><?php echo $res['crdate']; ?></td>
                            <td class="inpt"><?php echo $res['days']; ?> Days</td>
                          </tr>

                        <?php
                        }}}else{
                            header('location:index.php');
                         }}else{
                            header('location:index.php');
                         }
                      ?>
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
                    </div>
                  </form>




            </div>

<!-- admin lte start -->

<!-- admin lte end -->
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
   
