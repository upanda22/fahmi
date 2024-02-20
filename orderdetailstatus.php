<?php
	include "koneksi.php";
	$sqlo = mysql_query("update orderdetail set statusorder='$_POST[statusorder]' where idorder='$_POST[idorder]' and idproduk='$_POST[idproduk]'");
	if($sqlo){
		echo "Status order sudah berhasil diubah";
	}else{
		echo "Gagal merubah status order";
	}
	echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=orderdetail&ido=$_POST[idorder]'>";
?>