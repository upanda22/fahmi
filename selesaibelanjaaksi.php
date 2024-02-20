<?php
include "koneksi.php";

// Mengambil semua isi Keranjang Belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sqlc = mysql_query("select * from cart where idanggota='$_POST[ida]'");
		
	while($rc = mysql_fetch_array($sqlc)){
		$isikeranjang[] = $rc;			
	}
	return $isikeranjang;
}

// Simpan Data Order
mysql_query("insert into orders (idanggota, namaanggota, alamatkirim, pengiriman, tglorder) values ('$_POST[ida]', '$_POST[namaanggota]', '$_POST[alamatkirim]', '$_POST[pengiriman]', NOW())");

// Mendapatkan Nomor Order
$idorder = mysql_insert_id();

// Panggil fungsi dan hitung produk yang dipesan
$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);


// Menghapus data dalam tabel Cart
for($i=0; $i<$jml; $i++){
	mysql_query("delete from cart where idcart={$isikeranjang[$i]['idcart']}");
}

// Merubah stok di tabel produk
for($i=0; $i<$jml; $i++){
	$sqlpr = mysql_query("select * from produk where idproduk={$isikeranjang[$i]['idproduk']}");
	$rpr = mysql_fetch_array($sqlpr);
	$stok = $rpr["stok"];
	$jumlahbeli = "{$isikeranjang[$i]['jumlahbeli']}";
	$stokakhir = $stok-$jumlahbeli;
	mysql_query("update produk set stok='$stokakhir' where idproduk={$isikeranjang[$i]['idproduk']}");
}

// Menampilkan Data dan Order dari Anggota
echo "Terima Kasih telah berbelanja di website kami<p><hr>";
echo "Nama&nbsp;&nbsp;   : <b>$_POST[namaanggota]</b><br>";
echo "Alamat : <b>$_POST[alamatanggota]</b><br>";
echo "Email&nbsp;  : <b>$_POST[emailanggota]</b><br>";
echo "No Hp&nbsp;  : <b>$_POST[nohpanggota]</b><br>";
echo "Alamat Pengiriman : <br><b>$_POST[alamatkirim]</b><br>";
echo "Jasa Pengiriman : <br><b>$_POST[pengiriman]</b><br>";
echo "<h3>NO. ORDER : <b>$idorder</b></h3>";

	echo "<table border='0' width='100%'>";
	echo "<tr>";
		echo "<th>No. </th>";
		echo "<th>Foto</th>";
		echo "<th>Nama Produk</th>";
		echo "<th>Jumlah</th>";
		echo "<th width='15%'>Harga</th>";
		echo "<th width='15%'>Sub Total</th>";
	echo "</tr>";
	
for($i=0; $i<$jml; $i++){
	$no = $i + 1;
	$sqlpr = mysql_query("select * from produk where idproduk = {$isikeranjang[$i]['idproduk']}");
	$rpr = mysql_fetch_array($sqlpr);
	$sqlp = mysql_query("select * from penjual where idpenjual = '$rpr[idpenjual]'");
	$rp = mysql_fetch_array($sqlp);
	  $disk = ($rpr['diskon'] * $rpr['hargaproduk']) / 100;
	  $hrgbaru = $rpr['hargaproduk'] - $disk;
	$subtotal = "{$isikeranjang[$i]['jumlahbeli']}" * $hrgbaru;
	$tot = $tot + $subtotal;
	$brt = "{$isikeranjang[$i]['jumlahbeli']}" * $rpr["berat"];
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
	echo "<td>$no </td>";
	echo "<td><img src='fotoproduk/$rpr[foto1]' width='100px'></td>";
	echo "<td><b>$rpr[namaproduk]</b><br>Dijual oleh <b>$rp[namatoko]</b><br> $diskon $hrglama</td>";
	echo "<td align='center'>{$isikeranjang[$i]['jumlahbeli']}</td>";
	echo "<td align='right'>IDR $hrgbr</td>";
	echo "<td align='right'>IDR $st</td>";
	echo "</tr>";
	// Simpan Data Detail Order
	mysql_query("insert into orderdetail (idorder, idproduk, idpenjual, idjasa, jumlahbeli, subtotal, statusorder) values ('$idorder', {$isikeranjang[$i]['idproduk']}, {$isikeranjang[$i]['idpenjual']}, '$_POST[idjasa]', {$isikeranjang[$i]['jumlahbeli']}, '$subtotal', 'Baru')");
}
$sqlj = mysql_query("select * from jasakirim where idjasa='$_POST[idjasa]'");
$rj = mysql_fetch_array($sqlj);
$tarif = $berat * $rj["tarif"];
$trf = number_format($tarif);
$total = $tot + $tarif;	
$t = number_format($total);

echo "<tr>
	<td colspan='5' align='right'>TOTAL</td>
	<td align='right'>IDR <b>$t</b></td>
</tr>";
// Update data total
mysql_query("update orders set total='$total' where idorder='$idorder'");
echo "</table>";

?>
<div align="right"><a href="javascript:window.print()"><button type='button' class='btn btn-more'>Cetak Faktur</button></a></div>