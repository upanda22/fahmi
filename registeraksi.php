<?php
include "koneksi.php";
	
if(!empty($_POST["emailanggota"]) and !empty($_POST["passwordanggota"]) and !empty($_POST["namaanggota"]) and !empty($_POST["jkanggota"]) and !empty($_POST["tgl"]) and !empty($_POST["bln"]) and !empty($_POST["thn"]) and !empty($_POST["alamatanggota"]) and !empty($_POST["nohpanggota"])){
	$sqlreg = mysql_query("insert into anggota (emailanggota, passwordanggota, namaanggota, jkanggota, tgllahiranggota, alamatanggota, nohpanggota, tgldaftar) values ('$_POST[emailanggota]', '$_POST[passwordanggota]', '$_POST[namaanggota]', '$_POST[jkanggota]', '$_POST[thn]-$_POST[bln]-$_POST[tgl]', '$_POST[alamatanggota]', '$_POST[nohpanggota]', NOW())");
}
	
	if($sqlreg){
		echo "Proses Registrasi Berhasil";
		echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=login'>";
	}else{
		echo "Proses Registrasi Gagal";
		echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=register'>";
	}
?>