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

	$uploaddir='../images/';
	$filename=$_FILES['gambar']['name'];
	$tmpName=$_FILES['gambar']['tmp_name'];

	$deskripsi=$_POST['des'];
	$lat=$_POST['lat'];
	$lon=$_POST['lon'];
	$keterangan=$_POST['ket'];

	$sql ="INSERT INTO data_location (des,lat,lon,gambar,ket) VALUES ('$deskripsi', '$lat', '$lon', '$filename', '$keterangan')";
	mysqli_query($koneksi, $sql);

	$targetfile=$uploaddir.$filename;
	move_uploaded_file($_FILES['gambar']['tmp_name'], $targetfile);
	mysqli_close();
	header("location:manage_data.php");

?>