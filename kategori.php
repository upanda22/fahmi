<?php
	include "koneksi.php";
	if(!empty($_GET["idk"])){
		$q = " where idkat='$_GET[idk]'";	
	}else{
		$q = "";	
	}
	$sqlk = mysql_query("select * from kategoriutama $q");
	$rk = mysql_fetch_array($sqlk);
	$sqlkt = mysql_query("select * from kategoritambahan $q order by namakategori asc");
	echo "<fieldset>";
	echo "<h3>$rk[namakat]</h3>";
	while($rkt = mysql_fetch_array($sqlkt)){
		$sqlpr = mysql_query("select * from produk where idkat='$rk[idkat]' and idkategori='$rkt[idkategori]'");
		$rowpr = mysql_num_rows($sqlpr);
		echo "<a href='?idk=$rk[idkat]&idka=$rkt[idkategori]'>$rkt[namakategori]</a> ($rowpr)<br>";
	}
	echo "</fieldset><p>";
?>