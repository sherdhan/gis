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

	$sql ="SELECT * FROM user WHERE username-'".$_POST['username']."' and password='".$_POST['password']."'";

	$hasil = mysqli_query($koneksi, $sql);
	if($hasil)
	{
		header("location:admin/home.php");
	}
	else
	{
		header("location:index.php");
	}
?>