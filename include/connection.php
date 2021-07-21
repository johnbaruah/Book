<!-- <?php
// $con=mysqli_connect("localhost","root","");
// mysqli_select_db("job",$con);
?> -->
<?php
$mysqli = NEW MySQLi('localhost','root','','book');
if ($mysqli) {
	// echo "connection successful";
}else{
	echo "connection error";
}
?>