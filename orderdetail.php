<div id="view">
<fieldset>
<?php 
	include "koneksi.php";
	$sqla = mysql_query("select * from anggota where emailanggota='$_SESSION[namaang]'");
	$ra = mysql_fetch_array($sqla);
		
		// Tampilkan Status Pesanan
		$sqlo = mysql_query("select * from orders where idorder = '$_GET[ido]'");
		$ro = mysql_fetch_array($sqlo);
		
		
		
			
		// Tampilkan Rincian Produk yang di pesan
		$sqlpr = mysql_query("select * from orderdetail, produk where orderdetail.idproduk=produk.idproduk and orderdetail.idorder='$_GET[ido]'");
		
echo "Nama&nbsp;&nbsp;   : <b>$ro[namaanggota]</b><br>";
echo "Alamat : <b>$ra[alamatanggota]</b><br>";
echo "Email&nbsp;  : <b>$ra[emailanggota]</b><br>";
echo "No Hp&nbsp;  : <b>$ra[nohpanggota]</b><br>";
echo "Alamat Pengiriman : <br><b>$ro[alamatkirim]</b><br>";
echo "Jasa Pengiriman : <b>$ro[pengiriman]</b><br>";
		echo "<h3>No Order : $ro[idorder]</h3>";
				
		echo "<h3>Detail Pesanan : </h3>";
		echo "<form method='post' action='?p=orderdetailstatus'>
		<input type='hidden' name='idorder' value='$ro[idorder]'>
			<table border='0' width='100%'>
			<tr>
				<th>No. </th>
				<th>Foto</th>
				<th>Nama Produk</th>
				<th>Jumlah</th>
				<th width='15%'>Harga</th>
				<th width='15%'>Sub Total</th>
				<th width='15%'>Status</th>
			</tr>";
		$no = 1;
		while($rpr = mysql_fetch_array($sqlpr)){
			$sqlp = mysql_query("select * from penjual where idpenjual='$rpr[idpenjual]'");
			$rp = mysql_fetch_array($sqlp);
			$disk = ($rpr['diskon'] * $rpr['hargaproduk']) / 100;
			$hrgbaru = $rpr['hargaproduk'] - $disk;
			$subtotal = $rpr['jumlahbeli'] * $hrgbaru;
			$tot = $tot + $subtotal;
			$brt = $rpr['jumlahbeli'] * $rpr['berat'];
			$berat = $berat + $brt;
			$st = number_format($subtotal);
			$hrg = number_format($rpr["hargaproduk"]);
			  $hrgbr = number_format($hrgbaru);
			  if($rpr['diskon']>0){
				  $diskon = "Diskon <font color='#FF0000'> $rpr[diskon]% </font>";
				  $hrglama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
			  }else{	  	
				  $diskon = "";
				  $hrglama = "";
			  }	
			echo "<tr>";
				echo "<td>$no <input type='hidden' name='idproduk' value='$rpr[idproduk]'></td>";
				echo "<td><img src='fotoproduk/$rpr[foto1]' width='100px'></td>";
				echo "<td><b>$rpr[namaproduk]</b><br>Dijual oleh <b>$rp[namatoko]</b><br> $diskon $hrglama</td>";
				echo "<td align='center'>$rpr[jumlahbeli]</td>";
				echo "<td align='right'>IDR $hrgbr</td>";
				echo "<td align='right'>IDR $st</td>";
				echo "<td><b>$rpr[statusorder]</b></td>";
				echo "</tr>";
			$no++;
			$sqlj = mysql_query("select * from jasakirim where idjasa='$rpr[idjasa]'");
			$rj = mysql_fetch_array($sqlj);
			$tarif = $berat * $rj["tarif"];
			$trf = number_format($tarif);
			$total = $tot + $tarif;	
			$t = number_format($total);
		}
		
		echo "<tr>
			<td colspan='5' align='right'>TOTAL</td>
			<td align='right'>IDR <b>$t</b></td>
		</tr>";
	echo "</table></form>";
	
			
		
?>
<div align="right"><a href="javascript:window.print()"><button type='button' class='btn btn-more'>Cetak Faktur</button></a></div>
</fieldset>
</div>