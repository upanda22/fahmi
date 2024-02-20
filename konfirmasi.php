<link rel="stylesheet" type="text/css" href="style.css" />
<div class="grid">
<div class="dh3">&nbsp;</div>
<div class="dh6">
<fieldset>
<h3>KONFIRMASI PEMBAYARAN</h3>
<form name="form1" method="get" action="" enctype="multipart/form-data">
	<div class="dh9">
		<input type="hidden" name="p" value="<?php echo "$_GET[p]"; ?>" />
		<input type="hidden" name="ida" value="<?php echo "$_GET[ida]"; ?>" />
		<input type="text" name="noorder" placeholder="Masukkan No Order" value="<?php echo "$_GET[noorder]"; ?>"/>
	</div>
	<div class="dh3"><input type="submit" value="Cari" /></div>
</form>
<?php 
	include "koneksi.php";
	$sqlo = mysql_query("select * from orders where idorder='$_GET[noorder]'");
	$ro = mysql_fetch_array($sqlo);
	$sqla = mysql_query("select * from anggota where idanggota='$ro[idanggota]'");
	$ra = mysql_fetch_array($sqla);
	$total = number_format($ro["total"]);
?>

<form name="form1" method="post" action="<?php echo "?p=konfirmasiaksi"; ?>" enctype="multipart/form-data">
  <input name="idorder" type="hidden" value="<?php echo "$ro[idorder]"; ?>"> 
  <input name="tglorder" type="text" value="<?php echo "Tanggal Order : $ro[tglorder] WIB"; ?>">  
  <input name="namaanggota" type="text" value="<?php echo "Atas nama : $ra[namaanggota]"; ?>">  
  <input name="total" type="text" value="<?php echo "Sebesar : IDR $total"; ?>">  <p>
  <h3>Dari Rekening</h3>
  <input name="namabankpengirim" type="text" id="namabankpengirim" placeholder="Nama Bank Pengirim">
  <input name="namapengirim" type="text" id="namapengirim" placeholder="Nama Pengirim">
  <input name="jumlahtransfer" type="text" id="jumlahtransfer" placeholder="Jumlah Transfer">
  <input name="tgltransfer" type="text" id="tgltransfer" placeholder="Tanggal Transfer ex : 0000-00-00"><p>
  <h3>Ke Rekening</h3>
  <input name="namabankpenerima" type="text" id="namabankpenerima" placeholder="Nama Bank Penerima">
  <h3>Bukti Transfer</h3>
  <input name="bukti" type="file" placeholder="Nama Bank Penerima">
  <input type="submit" name="Submit" value="REGISTER">
</form>
</fieldset>
</div>
<div class="dh3">&nbsp;</div>
</div>
