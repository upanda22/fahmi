<?php	
	session_start();
	function format_rp($angka){
		$rp = number_format($angka, 0, ',', '.');
		return $rp;	
	}
	include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Aplikasi</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
-->
</style>
</head>

<body>
<div class="container1">
	<div class="grid">
		<div class="dh4">
		  <div class='jdl style1'>OCIEK MART</div>
    </div>
	  <div class="dh8" align="right">
		<?php
			include "menuakun.php";
		?>
		</div>
	</div>
</div>
<div class="container3">
	<ul id="menu">
		<?php
			include "koneksi.php";
			$sqlkat = mysql_query("select * from kategoriutama order by namakat asc");
			if($_GET["p"]=="beranda"){
				$pilih = "class='pilih'";
			}else{
				$pilih = "";
			}
			echo "<li><a href='?p=beranda' $pilih>Home</a></li>";
			while($rkat = mysql_fetch_array($sqlkat)){
				if($rkat["idkat"]==$_GET["idk"]){
					$pil = "class='pilih'";
				}else{
					$pil = "";
				}
				echo "<li><a href='?idk=$rkat[idkat]&idka=0' $pil>$rkat[namakat]</a></li>";
			}
		?>
	</ul>
	<div class="grid">	
		<div class="dh12">
		<form action="<?php echo "?p=produkterbaru";?>" method="post" enctype="multipart/form-data">
		<div class="dh11"><input type="text" name="cari" /></div>
		<div class="dh1"><input type="submit" value="Cari" /></div>
		</form>
		</div>
	</div>
</div>

<div class="container3">
	<div class="grid">
		<div class="dh12">
	<?php
	if($_GET["p"]=="produkdetail"){
		include "produkdetail.php";
	}else if($_GET["p"]=="register"){
		include "register.php";
	}else if($_GET["p"]=="registeraksi"){
		include "registeraksi.php";
	}else if($_GET["p"]=="login"){
		include "login.php";
	}else if($_GET["p"]=="loginaksi"){
		include "loginaksi.php";
	}else if($_GET["p"]=="keranjang"){
		include "keranjang.php";
	}else if($_GET["p"]=="keranjangbelanja"){
		include "keranjangbelanja.php";
	}else if($_GET["p"]=="keranjangedit"){
		include "keranjangedit.php";
	}else if($_GET["p"]=="keranjangdel"){
		include "keranjangdel.php";
	}else if($_GET["p"]=="selesaibelanja"){
		include "selesaibelanja.php";
	}else if($_GET["p"]=="selesaibelanjaaksi"){
		include "selesaibelanjaaksi.php";
	}else if($_GET["p"]=="konfirmasi"){
		include "konfirmasi.php";
	}else if($_GET["p"]=="konfirmasiaksi"){
		include "konfirmasiaksi.php";
	}else if($_GET["p"] == "order"){
		include "order.php";		
	}else if($_GET["p"] == "orderdetail"){
		include "orderdetail.php";
	}else if($_GET["p"] == "orderdetailstatus"){
		include "orderdetailstatus.php";	
	}else if($_GET["p"]=="logout"){
		include "logout.php";
	}else{
		if(!empty($_GET["idk"])){
			echo "<div class='dh3'>";		
			include "kategori.php";
			echo "</div>";
			echo "<div class='dh9'>";
			include "terbaru.php";			
			echo "</div>";
			echo "<p>&nbsp;</p>";
			include "produkterbaru.php";
		}else if($_POST["cari"]){
			include "produkterbaru.php";		
		}else{
			include "terbaru.php";
			include "produkterbaru.php";		
		}
	}
		?>
		</div>
	</div>
</div>

<div class="container4">
	<div class="grid"></div>
</div>
</body>
</html>
