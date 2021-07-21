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
$ord_cancel_query=$mysqli->query("update seller_reg set verified=0 where id = '$id'");
				if($ord_cancel_query){
             		header("Location:verify_user.php");
            	}else{
					echo mysqli_error($mysqli);
				}
?>