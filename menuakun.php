<?php
	if(empty($_SESSION["namaang"]) and empty($_SESSION["passang"])){
		echo "<a href='?p=login'><button type='button' class='btn btn-more'>SIGN IN</button></a>
		<a href='?p=register'><button type='button' class='btn btn-more'>SIGN UP</button></a>";
	}else{
		$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
		$ra = mysql_fetch_array($sqla);
		echo "<button type='button' class='btn btn-more'>Selamat Datang, <b>$ra[namaanggota]</b></button>&nbsp;";
		echo "<a href='?p=konfirmasi&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>Konfirmasi Bayar</button></a>
		<a href='?p=order&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>Pesanan Saya</button></a>
		<a href='?p=keranjangbelanja&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>CART</button></a>
		<a href='?p=logout'><button type='button' class='btn btn-more'>LOGOUT</button></a>";
	}
?>