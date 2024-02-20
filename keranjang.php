<?php
session_start();
if(empty($_SESSION["namaang"]) and empty($_SESSION["passang"])){
	echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=login'>";
}else{
	$sqlpr = mysql_query("select idproduk from cart where idproduk='$_GET[idp]' and idanggota='$_GET[ida]'");
	$rowpr = mysql_num_rows($sqlpr);
	$sqlpd = mysql_query("select * from produk where idproduk='$_GET[idp]'");
	$rpd = mysql_fetch_array($sqlpd);
	if($rpd['stok'] == 0){
		echo "<fieldset style='text-align:center; background-color:#FFFFD2'><b>STOK HABIS</b><br>Untuk produk <b>$rpd[namaproduk]</b></fieldset>";
	}else{
		if($rowpr == 0){
			mysql_query("insert into cart (idproduk, idanggota, idpenjual, jumlahbeli, tglcart) values ('$_GET[idp]', '$_GET[ida]', '$rpd[idpenjual]', 1, NOW())");
		}else{
			$sqlc = mysql_query("select * from cart where idproduk='$_GET[idp]'");
			$rc = mysql_fetch_array($sqlc);
			if($rc['jumlahbeli'] >= $rpd['stok']){
				echo "<fieldset style='text-align:center; background-color:#FFFFD2'><b>STOK TIDAK MENCUKUPI</b><br>Untuk produk <b>$rpd[namaproduk]</b></fieldset>";		
			}else{			
				mysql_query("update cart set jumlahbeli=jumlahbeli+1 where idproduk='$_GET[idp]' and idanggota='$_GET[ida]'");
			}
		}
	}
	echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=keranjangbelanja&ida=$_GET[ida]'>";
}
?>