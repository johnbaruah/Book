<?php
include('include/header.php');
session_regenerate_id( true );
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  	$resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
    if ($resultSet) {
        $row = $resultSet->fetch_assoc();
        $seller_id = $row['id'];
    }
}


$id=$_GET['id'];
$resultSet000 = $mysqli->query("select * from placeorder where id = '$id'");
    if ($resultSet000) {
        $row000 = $resultSet000->fetch_assoc();
        $p_id = $row000['p_id'];
        $p_quantity = $row000['p_quantity'];
    }

$resultSet0000 = $mysqli->query("select * from product where id = '$p_id'");
    if ($resultSet0000) {
        $row0000 = $resultSet0000->fetch_assoc();
        $p_quantity2 = $row0000['p_quantity'];
    }
 $new_p_quantity = ($p_quantity + $p_quantity2);
 $ord_cancel_query=$mysqli->query("update placeorder set accept_reject=1 where seller_id = '$seller_id' and id='$id'");
        if($ord_cancel_query){
           $ord_cancel_query_new=$mysqli->query("update product set p_quantity='$new_p_quantity' where id='$p_id'");
           if($ord_cancel_query_new){
            header("Location:my_orders.php");
          }else{
            echo mysqli_error($mysqli);
          }
                
              }else{
          echo mysqli_error($mysqli);
        }
?>
