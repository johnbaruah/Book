<?php
include('include/header.php');
$book_del_id = $_GET['id'];
session_regenerate_id( true );
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  	$resultSet = $mysqli->query("select * from seller_reg where email = '$email'");
    if ($resultSet) {
        $row = $resultSet->fetch_assoc();
        $id = $row['id'];
    }
}

 $delete_query = $mysqli->query("delete from product where id = '$book_del_id' and seller_id = '$id'");
	if($delete_query)
	{
        header("Location:sell_form.php");
    }
	else
	{
		echo mysqli_error($mysqli);
	}
?>