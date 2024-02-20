<link rel="stylesheet" type="text/css" href="style.css" />
<div class="grid">
<div class="dh3">&nbsp;</div>
<div class="dh6">
<fieldset>
<form name="form1" method="post" action="<?php echo "?p=registeraksi"; ?>" enctype="multipart/form-data">
  <h3>FORM REGISTRASI</h3>
  <input name="emailanggota" type="text" id="emailanggota" placeholder="Email">  
  <input name="passwordanggota" type="text" id="passwordanggota" placeholder="Password">
  <input name="namaanggota" type="text" id="namaanggota" placeholder="Nama Lengkap">
  <select name="jkanggota">
    <option value="">Jenis Kelamin</option>
    <option value="L">Laki-Laki</option>
    <option value="P">Perampuan</option>
  </select>
  <select name="tgl">
  	<option value="">Tanggal Lahir</option>
	<?php
	for($i=1; $i<=31; $i++){
	  echo "<option value='$i'>$i</option>";
	}
	?>
  </select>
  <select name="bln">
  	<option value="">Bulan Lahir</option>
	<?php
	for($j=1; $j<=12; $j++){
	  echo "<option value='$j'>$j</option>";
	}
	?>
  </select>
  <input name="thn" type="text" id="thn" placeholder="Tahun Lahir">
  <textarea name="alamatanggota" placeholder="Alamat Lengkap"></textarea>  
  <input name="nohpanggota" type="text" id="nohpanggota" placeholder="Nomor Handphone">
  <input type="submit" name="Submit" value="REGISTER">
</form>
</fieldset>
</div>
<div class="dh3">&nbsp;</div>
</div>
