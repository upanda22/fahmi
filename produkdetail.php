<?php
include "koneksi.php";
$sqlpr = mysql_query("select * from produk where idproduk='$_GET[idp]'");
$rpr = mysql_fetch_array($sqlpr);
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
		$stok = "<font color='#FF0000'>Stok Habis</font>";
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
echo "<div class='dh3' align='center'>";
	echo "<fieldset><img src='logobrand/$rb[logobrand]' width='70%'><br>Brand : $rb[namabrand]</fieldset><p>";
	if(!empty($rpr['foto1'])){
		$foto1 = "<fieldset><img src='fotoproduk/$rpr[foto1]' width='100%'></fieldset><p>";
	}
	if(!empty($rpr['foto2'])){
		$foto2 = "<fieldset><img src='fotoproduk/$rpr[foto2]' width='100%'></fieldset><p>";
	}
	if(!empty($rpr['foto3'])){
		$foto3 = "<fieldset><img src='fotoproduk/$rpr[foto3]' width='100%'></fieldset><p>";
	}
	echo "$foto1 $foto2 $foto3";
echo "</div>
<fieldset><div class='dh12' align='justify'>
  <div class='jdl'>$rpr[namaproduk]</div><p>
  <div class='hdl'>IDR $hrgbr $diskon $hrglama</div><br>
  <div class='hdl'>$stok</div><p>
  Dijual Oleh : <b>$rp[namatoko]</b><p>
  <a href='?p=keranjang&idp=$rpr[idproduk]&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>Beli Sekarang</button></a><p>
  <b>Spesifikasi : </b><br>
  $rpr[spesifikasi] <p>
  <b>Detail Barang : </b><br>
  $rpr[detailproduk] <p>
  <b>Isi dalam Kotak : </b><br>
  $rpr[isikotak] <p>  
</div></fieldset>";
?>

<div class="container3">
	
		
    </div>
		<h3>TOP UP SELLING</h3>
	<?php

			
			include "produkterbaru.php";		
	
		?>
		</div>
	</div>
</div>

<div class="container4">
	<div class="grid"></div>
</div>




