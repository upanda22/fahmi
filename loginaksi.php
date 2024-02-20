<?php
	include "koneksi.php";
	$sqla = mysql_query("select * from anggota where emailanggota='$_POST[emailanggota]' and passwordanggota='$_POST[passwordanggota]'");
	$rowa = mysql_num_rows($sqla);
	$ra = mysql_fetch_array($sqla);
	if($rowa > 0){
		session_start();
		$_SESSION["namaang"]=$ra["emailanggota"];
		$_SESSION["passang"]=$ra["passwordanggota"];
	}else{
	}
	echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=beranda'>";
?> 