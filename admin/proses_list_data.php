<?php  
	$host="localhost";
	$username="root";
	$password="";
	$db="15650078";
	$conn = mysqli_connect($host, $username, $password, $db) or die("Koneksi gagal dibangun");;

	$sql="SELECT * FROM data_location ORDER BY id DESC";
	$hasil=mysqli_query($conn, $sql);
?>