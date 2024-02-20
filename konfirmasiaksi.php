<?php
	session_start();
	include "koneksi.php";
	
	$bukti  = $_FILES['bukti']['name'];
	$lokbukti = $_FILES['bukti']['tmp_name'];
	
	move_uploaded_file($bukti, "buktibayar/$bukti");
	
	$sqlbyr = mysql_query("insert into pembayaran (idorder, namabankpengirim, namapengirim, jumlahtransfer, tgltransfer, namabankpenerima, bukti) values ('$_POST[idorder]', '$_POST[namabankpengirim]', '$_POST[namapengirim]', '$_POST[jumlahtransfer]', '$_POST[tgltransfer]', '$_POST[namabankpenerima]', '$bukti')");
	
	if($sqlbyr){
		echo "Pembayaran telah dikonfirmasi";
	}else{
		echo "Konfirmasi Gagal";
	}
	echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=beranda'>";
?>