<?php  
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$db = "15650078";
	$koneksi = mysqli_connect($hostname, $username, $password, $db);
	if(!$koneksi)
	{
		die("Koneksi Gagal".mysqli_connect_error());
	}
?>