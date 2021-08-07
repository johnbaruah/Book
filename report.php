<?php include('include/header.php'); ?>



<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css"> 
.bg-img{
  background-image: url("book_img/book3.jpg");
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
</style>

</head>




<body class="bg-img">
<div class="row pt-5">
  <div class="col-md-3"></div>
    <div class="col-md-6 font-italic" style="font-size: 18px; font-weight: 600;">
        <form action="report_print.php" method="POST">
            <div class="form-group row">
        <label for="product-name" class="col-sm-4 col-form-label">Start date:</label>
        <div class="col-sm-8">
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><img src="images2/cal.gif" onclick="javascript:NewCssCal('dob3','YYYYMMDD','','','','','')" style="cursor:pointer;"/></div>
            </div>
            <input type="text" name="s_date" required class="form-control" id="dob3" required="">
         </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="product-name" class="col-sm-4 col-form-label">End date:</label>
        <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><img src="images2/cal.gif" onclick="javascript:NewCssCal('dob2','YYYYMMDD','','','','','')" style="cursor:pointer;"/></div>
                </div>
                <input type="text" name="e_date" required class="form-control" id="dob2" required="">
             </div>
            </div>
        </div>
     
      
      <div class="form-group row">
        <div class="col-sm-12">
          <button type="submit" name="submit" class="btn float-right btn-primary">Submit</button>
        </div>
      </div>
    </form>
     </div>
    </div>

    


</body>
<script src="datetimepicker_css.js"></script>
  <?php include('include/footer.php'); ?>
