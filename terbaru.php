<?php
	include "koneksi.php";
	if(!empty($_GET["idk"]) and $_GET["idka"]=='0'){
		$q = " where idkat='$_GET[idk]'";	
	}else if(!empty($_GET["idk"]) and !empty($_GET["idka"])){
		$q = " where idkat='$_GET[idk]' and idkategori='$_GET[idka]'";	
	}else{
		$q = "";	
	}
	
	$sqlpr = mysql_query("select * from produk $q order by tglpost desc limit 1");
	while($rpr = mysql_fetch_array($sqlpr)){
	$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
	$ra = mysql_fetch_array($sqla);	
	$sqlb = mysql_query("select * from brand where idbrand='$rpr[idbrand]'");
	$rb = mysql_fetch_array($sqlb);
	$sqlp = mysql_query("select * from penjual where idpenjual='$rpr[idpenjual]'");
	$rp = mysql_fetch_array($sqlp);
	$hrg = number_format($rpr['hargaproduk']);
	if($rpr['stok']>0){
		$stok = "<font color='#00CC00'>Stok Tersedia</font>";
	}else{
		$stok = "<font color='#CCCCCC'>Stok Habis</font>";
	}
	if($rpr['diskon']>0){
		$disk = ($rpr['diskon'] * $rpr['hargaproduk']) / 100;
		$hrgbaru = $rpr['hargaproduk'] - $disk;
		$hrgbr = number_format($hrgbaru);
		$diskon = "<font color='#FF0000'> -$rpr[diskon]% </font>";
		$hrglama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
	}else{
		$hrgbr = "";
		$diskon = "";
		$hrglama = $hrg;
	}
		echo "<div id='kat'>
	<fieldset>
	<div class='dh4' align='center'>
		  <img src='fotoproduk/$rpr[foto1]' width='100%'><p>
		  <img src='logobrand/$rb[logobrand]' width='70%'><br>Brand : $rb[namabrand]
		</div>
		<div class='dh8'>
		  <p>
		  <div class='jdl'>$rpr[namaproduk]</div><p>
		  <div class='hdl'>IDR $hrgbr $diskon $hrglama</div><br>
		  <div class='hdl'>$stok</div><p>
		  <b>Spesifikasi : </b><br>
		  $rpr[spesifikasi] <p>
		  <b>Dijual Oleh : </b><br>
		  $rp[namatoko]<p>
		  <a href='?p=produkdetail&idk=$rpr[idkat]&idp=$rpr[idproduk]'><button type='button' class='btn btn-more'>Lihat Detail</button></a>
		  <a href='?p=keranjang&idk=$rpr[idkat]&idp=$rpr[idproduk]&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>Beli Sekarang</button></a>
		</div>
	</fieldset>
	</div>";
	}
	?>	