<link rel="stylesheet" type="text/css" href="style.css" />
<div id="kat">
<fieldset>
<?php
	include "koneksi.php";
	$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
	$ra = mysql_fetch_array($sqla);
?>
<form name="form1" method="post" action="<?php echo "?p=selesaibelanjaaksi"; ?>" enctype="multipart/form-data">
  <h3>PROSES CHECKOUT</h3>
  <input type="hidden" name="ida" value="<?php echo "$ra[idanggota]"; ?>" />
  <input name="emailanggota" type="text" value="<?php echo "$ra[emailanggota]"; ?>">
  <input name="namaanggota" type="text" value="<?php echo "$ra[namaanggota]"; ?>">
  <textarea name="alamatanggota"><?php echo "$ra[alamatanggota]"; ?></textarea>
  <input name="nohpanggota" type="text"value="<?php echo "$ra[nohpanggota]"; ?>"> 
  <textarea name="alamatkirim" placeholder="Alamat Pengiriman"></textarea>
 <select name="pengiriman">
<option value="JNE">JNE</option>
<option value="JNT">JNT</option>
<option value="POS INDONESIA">POS INDONESIA</option>
</select>
  <input type="submit" name="Submit" value="CHECKOUT">
</form>
</fieldset>
</div>
