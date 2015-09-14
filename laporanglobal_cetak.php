<?
   include "config/koneksi.php";
   include "config/fungsi.php";
   $bulan = $_GET[bulan];
   $tahun = $_GET[tahun];
   $namabulan = get_bulan($bulan);
   $jumhari = date("t",mktime(0,0,0,$bulan,1,$tahun));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Rekapitulasi Absen ::.</title>
<link rel="stylesheet" type="text/css" href="config/style.css">
</head>

<body>
<p class="judul_report">LAPORAN REKAPITULASI KEHADIRAN PEGAWAI</p>
<table echo width="1000" align="center" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td colspan="2" class="tabelheader">BULAN : <? echo $namabulan." ".$tahun; ?></td>
	<?
	  for ($tgl=1; $tgl<= $jumhari; $tgl++)
	  //{
	?>
    
    <? //} ?>
	<td width="163" rowspan="2" class="tabelheader">Jumlah Jam Masuk(Jam)</td>
	    <td width="169" rowspan="2" class="tabelheader">Jumlah Hari Kerja</td>
        <td width="169" rowspan="2" class="tabelheader">Jumlah OHK</td>
       
			    <td width="155" colspan="4"  class="tabelheader">Tidak Hadir</td>
				    
						
    
  </tr>
  <tr>
    <td width="53" class="tabelheader">NO.</td>
    <td width="252" class="tabelheader">NAMA</td>
    <td width="252" class="tabelheader">ALPA</td>
    <td width="252" class="tabelheader">IZIN</td>
    <td width="252" class="tabelheader">SAKIT</td>
    <td width="252" class="tabelheader">CUTI</td>
    
  </tr>
<?
  $qkar = mysql_query("select mst_karyawan.* from mst_karyawan")or die(mysql_error());
							  /*var_dump("select mst_karyawan.*, count(t_ijin.nip) as ijin_hari from mst_karyawan 
  						left join t_ijin on t_ijin.nip = mst_karyawan.nip where t_ijin.tanggal = '$bulan'
						    
							  group by mst_karyawan.nip");*/
  $nomor=1;
  $jumhari = date("t",mktime(0,0,0,$bulan+1,0,$tahun));
  while ($tkar = mysql_fetch_array($qkar))
  {
  	 $nip = $tkar[nip];
							  
	      	$ij = mysql_query("select mst_karyawan.*, 
			(select count(t_ijin.nip) from mst_karyawan 
  						left join t_ijin on t_ijin.nip = mst_karyawan.nip where month(t_ijin.tanggal) = '$bulan' and t_ijin.nip = '$nip' and t_ijin.jenis_ijin='ijin') as ijin_aja,
			(select count(t_ijin.nip) from mst_karyawan 
  						left join t_ijin on t_ijin.nip = mst_karyawan.nip where month(t_ijin.tanggal) = '$bulan' and t_ijin.nip = '$nip' and t_ijin.jenis_ijin='sakit') as ijin_sakit			 
			
			from mst_karyawan 
  						left join t_ijin on t_ijin.nip = mst_karyawan.nip where month(t_ijin.tanggal) = '$bulan' and t_ijin.nip = '$nip'
						    
							  group by mst_karyawan.nip")or die(mysql_error());
	$ijj = mysql_fetch_array($ij);
	
 $jumhari = date("t",mktime(0,0,0,$bulan+1,0,$tahun));
   $tt = $tahun."-".$bulan."-".$hr;
   for ($hr=1;$hr<=$jumhari;$hr++)
   {
    $qabsen2 = mysql_query("select tanggal,masuk,
						   if(pulang<>'',pulang,'17:30:00') as pulang,
						   TIMEDIFF(if(pulang<>'',pulang,'17:30:00'),masuk) as jumlah
						   from t_absensi 
	                       where nip = '$nip' and day(tanggal) = '$hr' and month(tanggal) = '$bulan' and
						   year(tanggal) = '$tahun'
						   order by tanggal");
			
$t = mysql_fetch_array($qabsen2);
$j = $j + $t[jumlah];
//echo $j;

}
		$qabsen = mysql_query("SELECT (count(tanggal)*TIMEDIFF(pulang, masuk)) as jmlh FROM t_absensi where month(tanggal)='$bulan' and year(tanggal)='$tahun' and nip='$nip'")or die(mysql_error());	
		//var_dump("SELECT count(tanggal) as jmlh FROM t_absensi where month(tanggal)='$bulan' and year(tanggal)='$tahun' and nip='$nip'");
    	while($tabsen = mysql_fetch_array($qabsen)){
				
		 
		$ab = mysql_query("Select count(t_absensi.masuk) as jumlah_hadir from mst_karyawan left join t_absensi on t_absensi.nip='$nip' where MONTH(t_absensi.tanggal)='$bulan'")or die(mysql_error());
		//var_dump("Select count(t_absensi.masuk) as jumlah_hadir from mst_karyawan left join t_absensi on t_absensi.nip='$nip'");
		while($masuk = mysql_fetch_array($ab)){
		
		$tgl = date('Y-m-d');
		$cut = mysql_query("Select datediff(date(t_cuti.tanggal_akhir), date(t_cuti.tanggal_awal)) +1 as jumlah_cuti from mst_karyawan left join t_cuti on t_cuti.nip='$nip' where month(tanggal_awal) = '$bulan'")or die(mysql_error());
		/*var_dump("Select datediff(date(t_cuti.tanggal_akhir), date(t_cuti.tanggal_awal)) as jumlah_cuti from mst_karyawan left join t_cuti on t_cuti.nip='$nip' where month(tanggal_awal) = '$bulan'");*/
		$cuti = mysql_fetch_array($cut);
		//print_r($cuti);
		//while($cuti = mysql_fetch_array($cut)){
		
		
		
?>
   <tr class="tabelisi">
    <td class="tabelisi"><? echo $nomor++; ?></td>
    <td class="tabelisi"><? echo $tkar[nama_lengkap]; ?></td>
	<?php
	//$totaljam = total_jam($totjam);
	//echo $totaljam;
	?>
	 <td class="tabelisi" align="center"><? echo round($tabsen[jmlh]); ?></td>
    <td class="tabelisi" align="center"><? echo round($masuk[jumlah_hadir]/12); ?></td>
    <td class="tabelisi" align="center"><? echo round($masuk[jumlah_hadir]/12); ?></td>
    
     <td class="tabelisi" align="center">
		<? echo 22 - round($masuk[jumlah_hadir]/12); ?></td>
    <td class="tabelisi" align="center"><? 
		if(empty($ijj[ijin_aja])){
			echo "0";
		}else{
	echo $ijj[ijin_aja]; }?></td>
    <td class="tabelisi" align="center"><? 
		if(empty($ijj[ijin_sakit])){
			echo "0";
		}else{
	echo $ijj[ijin_sakit]; }?></td>
    <td class="tabelisi" align="center"><? echo round($cuti[jumlah_cuti]); ?></td>
    
  </tr>
  <?php 
  }
  }
  
  
  }
  
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="6" align="center">Tanggal, <? 
		$d = date('Y-m-d');
		$tanggalsekarang = tgl_indonesia($d);
		echo $tanggalsekarang;  ?>
        <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        ( Ka.Bag SDM )</td>
      </tr>
	  <tr>
    <td height="21"><div align="right"><A href="javascript:window.print()"><IMG 
                  height=32 
                  src="images/ico_alpha_Print_16x16.png" 
                  width=30 border=0></A></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
