<?php include "config/koneksi.php";
include "config/fungsi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table>
<?php
$qkar = mysql_query("select mst_karyawan.* from mst_karyawan")or die(mysql_error());
  $nomor=1;
  $jumhari = date("t",mktime(0,0,0,$bulan+1,0,$tahun));
  //while ($tkar = mysql_fetch_array($qkar))
  //{
  $nip = $tkar[nip];
	$sql = mysql_query("select mst_karyawan.nama_lengkap,t_absensi.tanggal,t_absensi.masuk,
						   if(t_absensi.pulang<>'',t_absensi.pulang,'17:30:00') as pulang,
						   TIMEDIFF(if(t_absensi.pulang<>'',t_absensi.pulang,'16:30:00'),t_absensi.masuk) as jumlah
						   from mst_karyawan left join t_absensi on t_absensi.nip=mst_karyawan.nip 
	                       where month(t_absensi.tanggal) = '04' and
						   year(t_absensi.tanggal) = '2010'
						   group by mst_karyawan.nip")or die(mysql_error());
						   
						   while($tabsen = mysql_fetch_array($sql)){
						   		//var_dump($tabsen);
		//				   }
						   
	//}
?>

 <tr class="tabelisi">
    <td class="tabelisi"><? echo $nomor++; ?></td>
    <td class="tabelisi"><? echo $tabsen[nama_lengkap]; ?></td>
	<?php
	$totjam[] = $tabsen[jumlah];
	$totaljam = total_jam($totjam);
	?>
	 <td class="tabelisi" align="center"><? echo $totaljam ; ?>
	</td>
</tr>
<?php } 

//} ?>
</table>
</body>
</html>
