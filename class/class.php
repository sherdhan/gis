
<?php
error_reporting(1);

$today = date("j-n-Y");
$cbulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$cnobl  = array("01","02","03","04","05","06","07","08","09","10","11","12");
$nthm = date("Y") - 10;
$ntha = date("Y") + 10;
$nthini = date("Y");
$ntgini = date("j") -1 ;

?>

<?php

 	$kon= mysqli_connect("localhost","root","");
    mysqli_select_db($kon,"apotek");

?>

<?php if ($_GET['page']=='hapusdokter') {
?>

	<?php

		mysqli_query($kon,"DELETE FROM dokter WHERE kode_dokter = '".$_GET['kode_dokter']."'");
		mysqli_query($kon,"DELETE FROM dokter_fee WHERE kode_dokter = '".$_GET['kode_dokter']."'");
		echo "<script language=javascript>parent.location.href='../../index.php?page=resepdokter';</script>";

	?>

<?php } else if ($_GET['page']=='editdokter') {
?>

	<?php  
	if(isset($_POST['update']))
	{

		$sql="UPDATE dokter SET  kode_dokter = '".$_POST['kode']."',nama_dokter = '".$_POST['nama_dokter']."', alamat_praktek = '".$_POST['alamat']."',telp = '".$_POST['no_hp']."' WHERE kode_dokter = '".$_GET['kode_dokter']."'";
		$query=mysqli_query($kon,$sql);
		echo "<script language=javascript>parent.location.href='../../index.php?page=resepdokter';</script>";
	}

	?>

<?php } else if ($_GET['page']=='setdokter') {
?>

	<?php  
	if(isset($_POST['update']))
	{ 
		mysqli_query($kon,"UPDATE dokter SET  fee = '".$_POST['fee']."' WHERE kode_dokter = '".$_GET['kode_dokter']."'");
		echo "<script language=javascript>parent.location.href='../../index.php?page=resepdokter';</script>"; 
	}
	?>


<?php } else if ($_GET['page']=='tambahobat') {
?>

	<?php

	if(isset($_POST['tambah']))
		{

		$tgl=date("Y-m-d h:i:s");

			$query=mysqli_query($kon,"insert into obat (kode_obat,no_batch,nama_obat,kode_golongan,kode_jenis,kode_bentuk,kemasan,harga_kemasan,harga_resep,harga_nonresep,jumlah,expired,stock_obat) values ('".$_POST['kode']."','".$_POST['no_batch']."','".$_POST['nama_obat']."','".$_POST['golongan']."','".$_POST['jenis']."','".$_POST['bentuk']."','".$_POST['kemasan']."','".$_POST['harga_kemasan']."','".$_POST['harga_resep']."','".$_POST['harga_nonresep']."','".$_POST['jumlah']."','".$_POST['expired']."',0)");

			$query=mysqli_query($kon,"insert into stock_masuk (tanggal,no_batch,kode_obat,nama_obat,stock_masuk,kardaluarsa) values ('".$tgl."','".$_POST['no_batch']."','".$_POST['kode']."','".$_POST['nama_obat']."','".$_POST['jumlah']."','".$_POST['expired']."')");

		 	$sql=mysqli_query($kon,"UPDATE obat a, stock_masuk b SET stock_obat = stock_obat + b.stock_masuk where kode_obat = b.kode_obat");

		 	echo "<script language=javascript>parent.location.href='../../index.php?page=obatstok';</script>";

		}

	?>

<?php } else if ($_GET['page']=='updateobat') {
?>

	<?php  
	if(isset($_POST['update']))
	{

		$sql="UPDATE obat SET  kode_obat = '".$_POST['kode']."',no_batch = '".$_POST['no_batch']."',nama_obat = '".$_POST['nama_obat']."', kode_golongan = '".$_POST['golongan']."',kode_jenis = '".$_POST['jenis']."', harga_resep = '".$_POST['harga_resep']."', harga_nonresep = '".$_POST['harga_nonresep']."', harga_kemasan = '".$_POST['harga_kemasan']."', expired = '".$_POST['expired']."' WHERE kode_obat = '".$_GET['kode_obat']."'";
		$query=mysqli_query($kon,$sql);
		echo "<script language=javascript>parent.location.href='../../index.php?page=obatstok';</script>";
	}

	?>


	<?php } else if ($_GET['page']=='hapusobat') {
	?>

	<?php

	mysqli_query($kon,"DELETE FROM obat WHERE kode_obat = '".$_GET['kode_obat']."'");
	mysqli_query($kon,"DELETE FROM stock_masuk WHERE kode_obat = '".$_GET['kode_obat']."'");
	mysqli_query($kon,"DELETE FROM stock_keluar WHERE kode_obat = '".$_GET['kode_obat']."'");
	echo "<script language=javascript>parent.location.href='../index.php?page=obatstok';</script>";
	?>


<?php } else if ($_GET['page']=='tambahjual') {
?>
<?php

            $kdobat=implode(",",$_POST['item']);
            $jumlah=implode(",",$_POST['jumlah_item']);

            $kon=mysqli_connect("localhost","root","");
            mysqli_select_db($kon,"apotek");

            if(isset($_POST['submit']))
              {

                // konsumen

                $sql="INSERT INTO konsumen (tanggal,kode_pembelian,nama_konsumen,umur,jenis_kelamin,alamat,telp,kode_dokter,biaya_racikan) VALUES ('".$_POST['tanggal']."','".$_POST['kode']."','".$_POST['nama']."','".$_POST['umur']."','".$_POST['jenis_kelamin']."','".$_POST['alamat']."','".$_POST['no_hp']."','".$_POST['dokter']."','".$_POST['biaya_racikan']."')";
                $query=mysqli_query($kon,$sql);

                //dokter fee

                $sql="INSERT INTO dokter_fee (tanggal,kode_resep,kode_pembelian,kode_dokter) VALUES (CURRENT_TIMESTAMP,'".$_POST['k_resep'].$_POST['kode_resep']."','".$_POST['kode']."','".$_POST['dokter']."')";
                $query=mysqli_query($kon,$sql);

                // pembelian array
                $tgl=date("Y-m-d h:i:s");

                $sql="INSERT INTO pembelian_array (tanggal,kode_pembelian,kode_obat,jumlah) VALUES ('".$tgl."','".$_POST['kode']."','".$kdobat."','".$jumlah."') ";
                $query=mysqli_query($kon,$sql);
                
                // stok keluar
                
                $tgl=date("Y-m-d h:i:s");

                $sql="INSERT INTO stock_keluar (tanggal,kode_obat,kode_pembelian,stock_keluar,tag) VALUES ('".$tgl."','".$kdobat."','".$_POST['kode']."','".$jumlah."','Y') ";
                $query=mysqli_query($kon,$sql);
                
                               
                // obat

                $sql=mysqli_query($kon,"UPDATE obat a, stock_keluar b SET a.jumlah=a.jumlah-b.stock_keluar WHERE a.kode_obat=b.kode_obat AND tag='Y'");

                
                // UPDATE STOK

                $sql=mysqli_query($kon,"UPDATE stock_keluar set tag='N' ");


                //PEMBELIAN

                $m=mysqli_query($kon,"SELECT tanggal,kode_pembelian,kode_obat,jumlah FROM pembelian_array");
                  
                  while ($rw=mysqli_fetch_array($m)) {
                  $tgl = $rw['tanggal'];
                  $reg = $rw['kode_pembelian'];
                  $jmlh = explode(',',$rw['jumlah']);
                  $para = explode(',',$rw['kode_obat']);
                  $pp = count($para);

                  $indeks=0; 

                    while($indeks < count($para)){ 

                    $sql11="insert ignore pembelian (tanggal,kode_obat,kode_pembelian,jumlah) values ('".$tgl."','".$para[$indeks]."','".$reg."','".$jmlh[$indeks]."')";
                    $query1=mysqli_query($kon,$sql11); 

                    $indeks++; 
                    }
                  }

                $sql2=mysqli_query($kon,"UPDATE pembelian a, obat b SET a.harga_satuan=b.harga_resep WHERE a.kode_obat = b.kode_obat AND a.kode_pembelian ='".$_POST['kode']."' ");
                $sql3=mysqli_query($kon,"UPDATE pembelian SET total= jumlah * harga_satuan where kode_pembelian ='".$_POST['kode']."'");

                  echo "<script language=javascript>parent.location.href='../../page/cetak_mini.php';</script>";

              }
          ?>        

<?php } else if ($_GET['page']=='tambahjualbiasa') {
?>
<?php

            $kdobat=implode(",",$_POST['item']);
            $jumlah=implode(",",$_POST['jumlah_item']);

            $kon=mysqli_connect("localhost","root","");
            mysqli_select_db($kon,"apotek");

            if(isset($_POST['submit']))
              {


                // pembelian array
                $tgl=date("Y-m-d h:i:s");

                $sql="INSERT INTO pembelian_array (tanggal,kode_pembelian,kode_obat,jumlah) VALUES ('".$tgl."','".$_POST['kode']."','".$kdobat."','".$jumlah."') ";
                $query=mysqli_query($kon,$sql);

                
                // stok keluar
                
                $tgl=date("Y-m-d h:i:s");

                $sql="INSERT INTO stock_keluar (tanggal,kode_obat,kode_pembelian,stock_keluar,tag) VALUES ('".$tgl."','".$kdobat."','".$_POST['kode']."','".$jumlah."','Y') ";
                $query=mysqli_query($kon,$sql);
                
                               
                // obat

                $sql=mysqli_query($kon,"UPDATE obat a, stock_keluar b SET a.jumlah=a.jumlah-b.stock_keluar WHERE a.kode_obat=b.kode_obat AND tag='Y'");

                
                // UPDATE STOK

                $sql=mysqli_query($kon,"UPDATE stock_keluar set tag='N' ");
               
                
                //PEMBELIAN

                $m=mysqli_query($kon,"SELECT tanggal,kode_pembelian,kode_obat,jumlah FROM pembelian_array");
                  
                  while ($rw=mysqli_fetch_array($m)) {
                  $tgl = $rw['tanggal'];
                  $reg = $rw['kode_pembelian'];
                  $jmlh = explode(',',$rw['jumlah']);
                  $para = explode(',',$rw['kode_obat']);
                  $pp = count($para);

                  $indeks=0; 

                    while($indeks < count($para)){ 

                    $sql11="insert ignore pembelian (tanggal,kode_obat,kode_pembelian,jumlah) values ('".$tgl."','".$para[$indeks]."','".$reg."','".$jmlh[$indeks]."')";
                    $query1=mysqli_query($kon,$sql11); 

                    $indeks++; 
                    }
                  }

                $sql2=mysqli_query($kon,"UPDATE pembelian a, obat b SET a.harga_satuan=b.harga_resep WHERE a.kode_obat = b.kode_obat AND a.kode_pembelian ='".$_POST['kode']."' ");
                $sql3=mysqli_query($kon,"UPDATE pembelian SET total= jumlah * harga_satuan where kode_pembelian ='".$_POST['kode']."'");

                  echo "<script language=javascript>parent.location.href='../../page/cetak_mini.php';</script>";

              }
          ?>        



<?php 
} else   {
}
?>