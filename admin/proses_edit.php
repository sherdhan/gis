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

	session_start();
	
	$uploaddir='../images/';
	$filename=$_FILES['gambar']['name'];
	$tmpName=$_FILES['gambar']['tmp_name'];

	$id=$_SESSION['id'];
	$deskripsi=$_POST['des'];
	$lat=$_POST['lat'];
	$lon=$_POST['lon'];
	$keterangan=$_POST['ket'];
	
	$query="UPDATE data_location SET gambar='$filename', des='$deskripsi', lat='$lat', lon='$lon', ket='$keterangan' WHERE id='$id'";
	mysqli_query($koneksi, $query);


	$targetfile=$uploaddir.$filename;
	move_uploaded_file($_FILES['gambar']['tmp_name'], $targetfile);

	header("location:manage_data.php");

?>