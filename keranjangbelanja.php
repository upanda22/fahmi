<div id="view">
<fieldset>
<?php
	include "koneksi.php";
	$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
	$ra = mysql_fetch_array($sqla);

	$sqlc = mysql_query("select * from cart where idanggota='$ra[idanggota]'");
	echo "<form action='?p=keranjangedit' method='post' enctype='multipart/form-data'>";
	echo "<table border='0' width='100%' cellpadding='10px'>";
	echo "<tr>";
		echo "<th>No. <input type='hidden' name='ida' value='$ra[idanggota]'></th>";
		echo "<th>Foto</th>";
		echo "<th>Nama Produk</th>";
		echo "<th>Jumlah</th>";
		echo "<th width='15%'>Harga</th>";
		echo "<th width='15%'>Sub Total</th>";
		echo "<th>Aksi</th>";
	echo "</tr>";
	$no = 1;
	while($rc = mysql_fetch_array($sqlc)){
	  $sqlpr = mysql_query("select * from produk where idproduk='$rc[idproduk]'");
	  $rpr = mysql_fetch_array($sqlpr);
	$sqlp = mysql_query("select * from penjual where idpenjual = '$rpr[idpenjual]'");
	$rp = mysql_fetch_array($sqlp);
	  $disk = ($rpr['diskon'] * $rpr['hargaproduk']) / 100;
	  $hrgbaru = $rpr['hargaproduk'] - $disk;
	  $subtotal = $hrgbaru * $rc["jumlahbeli"];
	  $total = $total + $subtotal;
	  $st = number_format($subtotal);
	  $t = number_format($total);
	  $hrg = number_format($rpr["hargaproduk"]);
	  $hrgbr = number_format($hrgbaru);
	  $brt = $rc["jumlahbeli"] * $rpr["berat"];
      $berat = $berat + $brt;
	  if($rpr['diskon']>0){
		  $diskon = "Diskon <font color='#FF0000'> $rpr[diskon]% </font>";
		  $hrglama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
	  }else{	  	
		  $diskon = "";
		  $hrglama = "";
	  }
		echo "<tr>";
			echo "<td>$no <input type='hidden' name='id[$no]' value='$rc[idcart]'> 
			<input type='hidden' name='idp[$no]' value='$rc[idpenjual]'></td>";
			echo "<td><img src='fotoproduk/$rpr[foto1]' width='100px'></td>";
		   echo "<td><b>$rpr[namaproduk]</b><br>Dijual oleh <b>$rp[namatoko]</b><br> $diskon $hrglama</td>";
			echo "<td><input type='text' name='jml[$no]' value='$rc[jumlahbeli]' size='5' style='text-align:center'></td>";
			echo "<td align='right'>IDR $hrgbr</td>";
			echo "<td align='right'>IDR $st <input type='hidden' name='total[$no]' value='$subtotal'></td>";
			echo "<td><a href='?p=keranjangdel&idc=$rc[idcart]'><button type='button' class='btn btn-more'>X</button></a></td>";
		echo "</tr>";
		$no++;
	}
	
	echo "<tr>
		<td colspan='5' align='right'>TOTAL</td>
		<td align='right'>IDR <b>$t</b><input type='hidden' name='total' value='$total'></td>
		<td>&nbsp;</td>
	</tr>";
	echo "</table>";
	echo "<div class='dh4'>
		<a href='?p=beranda'><button type='button' class='btn btn-more'>Lanjut Belanja</button></a>
	</div>";
	echo "<div class='dh4' align='center'>
		<input type='submit' value='Edit Keranjang' class='btn btn-more'>
	</div>";
	echo "<div class='dh4' align='right'>
		<a href='?p=selesaibelanja'><button type='button' class='btn btn-more'>Selesai Belanja</button></a>
	</div>";
	echo "</form>";
?>
</fieldset>
</div>