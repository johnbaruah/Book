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
          $id = $row['id'];
          $name = $row['name'];
          $lname = $row['lname'];
          $email = $row['email'];
          $contact_no = $row['contact_no'];
          $address = $row['address'];
          $pan_card = $row['pan_card'];
          $profile_img = $row['profile_img'];
          $address_proof = $row['address_proof'];
          $password = $row['password'];
          $pin = $row['pin'];
          $verified = $row['verified'];
          }
        if (isset($_POST['update_pass'])) {
          $name = $mysqli->real_escape_string($_POST['name']);
          $lname = $mysqli->real_escape_string($_POST['lname']);
          $contact_no = $mysqli->real_escape_string($_POST['contact_no']);
          $address = $mysqli->real_escape_string($_POST['address']);
          $pin = $mysqli->real_escape_string($_POST['pin']);
          $password1 = $mysqli->real_escape_string($_POST['password1']);
          $conf_password1 = $mysqli->real_escape_string($_POST['conf_password1']);

          if ($password1 == NULL || $conf_password1 == NULL) {
             $update_seller = $mysqli->query("update seller_reg set name = '$name', lname = '$lname', contact_no = '$contact_no', address = '$address', pin = '$pin' where id = '$id' and email = '$email'");
             if($update_seller){
              echo '<script>alert("Update Successful")</script>';
             }else{
              echo '<script>alert("Something went wrong please try again after Sometime")</script>';
             }
          }else{
            $uppercase = preg_match('@[A-Z]@', $conf_password1);
            $lowercase = preg_match('@[a-z]@', $conf_password1);
            $number    = preg_match('@[0-9]@', $conf_password1);
            $specialChars = preg_match('@[^\w]@', $conf_password1);
            $password1 = md5($password1);
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($conf_password1) < 8){
                    $error = '<div class="font-italic text-danger">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</div>';
                  }elseif($password1 != $password){
                      $error = '<div class="font-italic text-danger">You have entered a wrong password !</div>';
                  }else{
                    $conf_password1 = md5($conf_password1);
                    $update_seller1 = $mysqli->query("update seller_reg set password = '$conf_password1', name = '$name', lname = '$lname', contact_no = '$contact_no', address = '$address', pin = '$pin' where id = '$id' and email = '$email'");
                    if($update_seller1){
                        echo '<script>alert("Update Successful")</script>';
                       }else{
                        echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                       }
                     }
          }


            
        }
      }

                          if(isset($_POST['profile_img_btn'])){

                          $p_img4 = $_FILES['profile_img']; 

                          $filename4 = $p_img4['name'];
                          $fileerror4 = $p_img4['error'];
                          $filetmp4 = $p_img4['tmp_name'];
                          $filesize4 = $p_img4['size'];
                          $fileext4 = explode('.', $filename4);
                          $filecheck4 = strtolower(end($fileext4));    
                          $fileextstored4 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck4, $fileextstored4)){
                            $temp4 = explode(".", $filename4);
                            $newfilename4 = round(microtime(true)) .'gg'.'.' . end($temp4);
                            $destinationfile4 = 'book_img/'.$newfilename4;
                            move_uploaded_file($filetmp4, $destinationfile4);
                          }
                        
                          $profile_img = $mysqli->real_escape_string($newfilename4);
                          $doc_up_qy1 = $mysqli->query("update seller_reg set profile_img = '$profile_img' where id = '$id'");
                          if($doc_up_qy1){
                            echo '<script>alert("Profile photo updated")</script>';
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                          }
                        }
    

                          if(isset($_POST['pan_card_up'])){

                          $p_img4 = $_FILES['pan_card']; 

                          $filename4 = $p_img4['name'];
                          $fileerror4 = $p_img4['error'];
                          $filetmp4 = $p_img4['tmp_name'];
                          $filesize4 = $p_img4['size'];
                          $fileext4 = explode('.', $filename4);
                          $filecheck4 = strtolower(end($fileext4));    
                          $fileextstored4 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck4, $fileextstored4)){
                            $temp4 = explode(".", $filename4);
                            $newfilename4 = round(microtime(true)) .'gg'.'.' . end($temp4);
                            $destinationfile4 = 'book_img/'.$newfilename4;
                            move_uploaded_file($filetmp4, $destinationfile4);
                          }
                        
                          $pan_card = $mysqli->real_escape_string($newfilename4);
                          $doc_up_qy1 = $mysqli->query("update seller_reg set pan_card = '$pan_card' where id = '$id'");
                          if($doc_up_qy1){
                            echo '<script>alert("Documents Upload Successful")</script>';
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                          }
                        }

                         if(isset($_POST['address_proof'])){

                          $p_img5 = $_FILES['address_proof']; 

                          $filename5 = $p_img5['name'];
                          $fileerror5 = $p_img5['error'];
                          $filetmp5 = $p_img5['tmp_name'];
                          $filesize5 = $p_img5['size'];
                          $fileext5 = explode('.', $filename5);
                          $filecheck5 = strtolower(end($fileext5));  
                          $fileextstored5 = array('png', 'jpg', 'jpeg');
                          if(in_array($filecheck5, $fileextstored5)){
                            $temp5 = explode(".", $filename5);
                            $newfilename5 = round(microtime(true)) .'hh'. '.' . end($temp5);
                            $destinationfile5 = 'book_img/'.$newfilename5;
                            move_uploaded_file($filetmp5, $destinationfile5);
                          }

                          $address_proof = $mysqli->real_escape_string($newfilename5); 
                          $doc_up_qy = $mysqli->query("update seller_reg set address_proof = '$address_proof' where id = '$id'");
                          if($doc_up_qy){
                            echo '<script>alert("Documents Upload Successful")</script>';
                          }else{
                             echo '<script>alert("Something went wrong please try again after Sometime")</script>';
                          }
                        }
                      
    ?>

<style type="text/css">

     .card_body_img2{
      width: 250px;
      background-color: #ffffff;
     }
     .card_body_img3{
      display: none;
     }
     .card_body_img4{
      width: 250px;
      height: 150px;
      object-fit: cover;
    }
    .card_body_img5{
      position: relative;
      height: 30px;
      margin-top: -30px;
      background:rgba(0,0,0,0.5);
      text-align: center;
      line-height: 40px;
      font-size: 13px;
      color: #f5f5f5;
      font-weight: 600;
      width: 250px;
    }
    .card_body_img6{
      font-size: 30px;
    }
  </style>
      
     





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

        
                  
                          <div class="row">
                            <div class="col-lg-12">
                              <?php if ($verified == 2) { ?>
                                <div class="row">
                                <div class="col-3"></div>
                                <div class="col-2">
                                <form method="post" action="verify_user.php" enctype="multipart/form-data">
                                  <button name="verify_user" type="submit" class="btn btn-primary">Block Unblock User</button>
                                </form>
                              </div>
                              <div class="col-2">
                                <form method="post" action="verify_seller.php" enctype="multipart/form-data">
                                  <button class="btn btn-primary">Verify Seller</button>
                                </form>
                              </div>
                              <div class="col-2">
                                <form method="post" action="report_print.php" enctype="multipart/form-data">
                                  <button class="btn btn-primary">Check Report</button>
                                </form>
                              </div>
                            </div>
                              <?php } ?>
                              <h5 class="page-header font-italic text-warning mt-2">If You don't want to be a seller, don't need to upload Pan card and address Proof just ignore it...
                              </h5>
                            </div>
                            <div id="add_pan-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color: #4fbfa8; color: #fff;">
                                    <h5 class="modal-title">Profile&nbsp;Photo</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="col-md-12 mt-2">
                                      <center>
                                        <form method="post" action="" enctype="multipart/form-data">
                                          <div class="form-element card_body_img2" style="width: 150px;">
                                            <input class="card_body_img3" type="file" id="file-3" name="profile_img" accept="image/*" value="<?php echo $profile_img; ?>">
                                            <label for="file-3" id="file-3-preview" style="height:150px; border: 0px; padding: 0px; box-shadow: 0px 0px 20px 5px rgba(100,100,100,0.1);">
                                              <img class="card_body_img4" style="width: 150px; height: 150px;" src="book_img/<?php if($profile_img != NULL){ echo $profile_img; }else{echo "profile.jpg"; } ?>" alt="upload image">
                                              <div class="card_body_img5" style="width: 150px;">
                                                <span class="card_body_img6">+</span>
                                              </div>
                                            </label>
                                            <?php if($profile_img != NULL){ echo '<button class="btn btn-primary btn-block" type="submit" value="picup" name="profile_img_btn">Edit</button>'; }else{echo '<button class="btn btn-primary btn-block" type="submit" value="picup" name="profile_img_btn">submit</button>'; } ?>    
                                          </div>
                                        </form>
                                      </center>
                                     </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2"></div>
                              <div class="col-md-4 mb-4" style="border: 1px solid #4fbfa8; border-radius: 5px;">
                               <form action="" method="POST">
                                <div class="col-12 mt-1">
                                  <div class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#add_pan-modal"><img src="book_img/<?php if($profile_img != NULL){ echo $profile_img; }else{?>profile.jpg <?php } ?>" width="65px" height="65px" class="rounded-circle" alt="..."></a>
                                  </div>
                                </div>
                                <hr>
                                <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-6">
                                    <input type="text" name="name" placeholder="First name" class="form-control" value='<?php echo $name; ?>'>
                                  </div>
                                  <div class="col-6">
                                    <input type="text" name="lname" class="form-control" value='<?php echo $lname; ?>' placeholder="Last name">
                                  </div>
                                </div>
                                <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-12">
                                    <p class="form-control  m-0"><strong><?php echo $email; ?></strong></p>
                                  </div>
                                </div>
                                <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-12">
                                    <input type="number" name="contact_no" class="form-control" value='<?php echo $contact_no; ?>' placeholder="contact no">
                                  </div>
                                </div>
                                <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-12">
                                    <input type="textarea" class="form-control" name="address" value='<?php echo $address; ?>' placeholder="Address" row="3" id="comment">
                                  </div>
                                </div>
                                <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-12">
                                    <label class="font-italic text-warning" style="font-size: 11px;">If you also want to change password</label>
                                    <input type="password" class="form-control" name="password1"  placeholder="Privious Password" row="3" id="comment">
                                  </div>
                                </div>
                                  <div class="form-row pl-3 pr-3 pb-3 pt-0">
                                  <div class="col-8">
                                    <input type="password" name="conf_password1" class="form-control"  placeholder="New Password">
                                  </div>
                                  <div class="col-4">
                                    <input type="number" name="pin" class="form-control" value='<?php echo $pin; ?>' placeholder="Pin">
                                  </div>
                                </div>
                                <div class="form-row p-3">
                                <button class="btn btn-primary btn-block" type="submit" name="update_pass" value="update_pass">Update</button>
                              </div>
                              </form>
                              <center>
                                <div class="font-italic" style="font-size: 12px;"><?php echo $error; ?></div>
                              </center>
                            </div>



                  <div class="col-md-4 mb-4 ml-2" style="border: 1px solid #4fbfa8; border-radius: 5px;">
                     <div class="col-md-12 mt-2">
                      <center>
                        <form method="post" action="" enctype="multipart/form-data">
                          <span class="font-italic">PAN Card:</span>
                          <div class="form-element card_body_img2">
                            
                            <label for="file-1" id="file-1-preview" style="height:150px; border: 0px; padding: 0px; box-shadow: 0px 0px 20px 5px rgba(100,100,100,0.1);">
                              <img class="card_body_img4" src="book_img/<?php if($pan_card != NULL){ echo $pan_card; }else{echo "other.jpg"; } ?>">
                              
                            </label>
                                
                          </div>
                        </form>
                      </center>
                     </div>
                     <div class="col-md-12 mt-4">
                      <center>
                        <form method="post" action="" enctype="multipart/form-data">
                          <span class="font-italic">Address Proof:</span>
                          <div class="form-element card_body_img2">
                            
                            <label for="file-2" id="file-2-preview" style="height:150px; border: 0px; padding: 0px; box-shadow: 0px 0px 20px 5px rgba(100,100,100,0.1);">
                              <img class="card_body_img4" src="book_img/<?php if($address_proof != NULL){ echo $address_proof; }else{echo "other.jpg"; } ?>">
                              
                            </label>
                               
                          </div>
                        </form>
                      </center>
                     </div>
                  </div>
                        
                  




            </div>

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
    <script type="text/javascript">
    function previewBeforeUpload(id){
      document.querySelector("#"+id).addEventListener("change",function(e){
        if (e.target.files.length == 0) {
          return;
        }
        let file = e.target.files[0];
        let url = URL.createObjectURL(file);
        let fsize = file.size;
        let fsizee = Math.round((fsize / 1024));
        if(fsizee <= 20){
          alert("file is too small");
          return false;
        }else if(fsizee >= 1024){
          alert("file is too big");
          return false;
        }
         if(file.name.length < 14){
          document.querySelector("#"+id+"-preview div").innerText = file.name;
        }else{
          document.querySelector("#"+id+"-preview div").innerText = file.name.substring(0, 13) + "...";
        }
        document.querySelector("#"+id+"-preview img").src = url;
      });
    }
    previewBeforeUpload("file-1");
    previewBeforeUpload("file-2");
    previewBeforeUpload("file-3");
  </script>

   <?php include('include/footer.php'); ?>
   
