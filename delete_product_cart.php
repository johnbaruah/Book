<?php
include('include/header.php');
session_regenerate_id( true );
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  	$resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
    if ($resultSet) {
        $row = $resultSet->fetch_assoc();
        $id = $row['id'];
    }
}

$cart_item_del = $_GET['id'];
$delete_query1 = $mysqli->query("delete from cart where id = '$cart_item_del' and buyer_id = '$id'");
    if($delete_query1)
    {
        header("Location:basket.php");
    }
    else
    {
        echo mysqli_error($mysqli);
    }
?>