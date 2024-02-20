<div id="view">
<fieldset>
<?php
	include "koneksi.php";
	$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
	$ra = mysql_fetch_array($sqla);
	
	$sqlo = mysql_query("select * from orders where idanggota='$ra[idanggota]'");
	
	echo "<br>";
	echo "<table border='0' width='100%'>";
	echo "<tr>";
		echo "<th>No.</th>";
		echo "<th>No Order</th>";
		echo "<th>Nama Pemesan</th>";
		echo "<th>Tanggal Pemesanan</th>";
		echo "<th>Aksi</th>";
	echo "</tr>";
	$no = 1;
	while($ro = mysql_fetch_array($sqlo)){
		$sqlod = mysql_query("select * from orders where idorder='$ro[idorder]'");
		$rod = mysql_fetch_array($sqlod);
		$sqla = mysql_query("select * from anggota where idanggota='$rod[idanggota]'");
		$ra = mysql_fetch_array($sqla);
		$sqlpr = mysql_query("select * from produk where idproduk='$ro[idproduk]'");
		$rpr = mysql_fetch_array($sqlpr);
		echo "<tr>";
			echo "<td>$no</td>";
			echo "<td>$ro[idorder]</td>";
			echo "<td>$ra[namaanggota]</td>";
			echo "<td>$rod[tglorder] WIB</td>";
			echo "<td><a href='?p=orderdetail&ido=$ro[idorder]'><button type='button' class='btn btn-more'>Detail Order</button></a></td>";
		echo "</tr>";
		$no++;
	}
	echo "</table>";
?>
</fieldset>
</div>