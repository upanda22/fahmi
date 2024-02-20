<?php
include "koneksi.php";

$batas =  4;
$halaman = $_GET['pg'];
if(empty($halaman)){
	$posisi = 0;
	$halaman = 1;
}else{
	$posisi = ($halaman - 1) * $batas;
}

if(!empty($_GET["idk"]) and $_GET["idka"]=='0'){
	$q = " where idkat='$_GET[idk]'";	
}else if(!empty($_GET["idk"]) and !empty($_GET["idka"])){
	$q = " where idkat='$_GET[idk]' and idkategori='$_GET[idka]'";	
}else if($_POST["cari"]){
	$q = " where namaproduk like '%$_POST[cari]%'";	
}else{
	$q = "";	
}

$sqlpr = mysql_query("select * from produk $q order by tglpost desc limit $posisi, $batas");
while($rpr = mysql_fetch_array($sqlpr)){
$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
$ra = mysql_fetch_array($sqla);
$nm = substr($rpr["namaproduk"],0,40);
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
	$hrglama = "<font style='text-decoration:line-through'><small>IDR $hrg</small></font>";
}else{
	$hrgbr = "";
	$diskon = "";
	$hrglama = "<b>$hrg</b>";
}
	echo "<p>
	  <div class='dh3' align='center'>
	  <div id='kat'>
	<fieldset>
	  <img src='fotoproduk/$rpr[foto1]' width='100%'><br>
	  <b>$nm ...............</b><br>
	  <b>IDR $hrgbr</b> $diskon $hrglama<br>
	  $stok<p>
	  <a href='?p=produkdetail&idk=$rpr[idkat]&idp=$rpr[idproduk]'><button type='button' class='btn btn-more'>Detail</button></a>
	  		  <a href='?p=keranjang&idk=$rpr[idkat]&idp=$rpr[idproduk]&ida=$ra[idanggota]'><button type='button' class='btn btn-more'>Beli</button></a>
	</fieldset>
	</div><p>
	</div>";
}

echo "<div class='dh12' align='right'>";

echo "Halaman : ";
		
$sqlhal = mysql_query("select * from produk $q order by tglpost desc");
$jmldata = mysql_num_rows($sqlhal);
$jmlhal = ceil($jmldata/$batas);
	
$angka = ($halaman > 3 ? "<span class='kotak'><a href='$_SERVER[PHP_SELF]?idk=$_GET[idk]&idka=$_GET[idka]&pg=1'>1</a></span> ... " : " ");
		
for($i=$halaman-2; $i<$halaman; $i++){
	if($i < 1)
		continue;
	$angka .= "<span class='kotak'><a href='$_SERVER[PHP_SELF]?idk=$_GET[idk]&idka=$_GET[idka]&pg=$i'>$i</a></span> ";
}
		
	$angka .= " <span class='kotak'><b>$halaman</b></span> ";
		
for($i = $halaman+1; $i<($halaman+3); $i++){
	if($i > $jmlhal)
		break;
		$angka .= "<span class='kotak'><a href='$_SERVER[PHP_SELF]?idk=$_GET[idk]&idka=$_GET[idka]&pg=$i'>$i</a></span> ";
	}
		
$angka .= ($halaman+2 < $jmlhal ? "... <span class='kotak'><a href='$_SERVER[PHP_SELF]?idk=$_GET[idk]&idka=$_GET[idka]&pg=$jmlhal'>$jmlhal</a></span> " : " ");
		
		echo "$angka";

echo "dari Total Produk : <span class='kotak'><b>$jmldata</b></span>";
echo "</div>";
?>