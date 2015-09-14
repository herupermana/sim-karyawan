<?
   include "config/koneksi.php";
   include "config/fungsi.php";
   $bulan = $_GET[bulan];
   $tahun = $_GET[tahun];
    $nip = $_GET[nip];
   $namabulan = get_bulan($bulan);
   $jumhari = date("t",mktime(0,0,0,$bulan,1,$tahun));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Rekapitulasi Gaji ::.</title>
<link rel="stylesheet" type="text/css" href="config/style.css">
</head>

<body>
<p class="judul_report">LAPORAN GAJI KARYAWAN</p>
<table class="bgform" width="700" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td width="445" colspan="3"><? echo "<a href='claporan_gaji.php?bulan=$bulan&tahun=$tahun&nip=$nip' class='versicetak' target='_blank'>"; ?>Cetak Kwitansi</a> </td>
  </tr>
  <tr>
    <td colspan="2" class="tabelheader">BULAN : <? echo $namabulan." ".$tahun; ?></td>
	<?
	  for ($tgl=1; $tgl<= $jumhari; $tgl++)
	  //{
	?>
    
    <? //} ?>
	
  </tr>
  <?php 
  $qkar = mysql_query("select mst_karyawan.* from mst_karyawan where nip='$nip'")or die(mysql_error());
  $row_karyawan = mysql_fetch_array($qkar);
  ?>
  <tr class="tabelisi">
    <td class="tabelsorot" width="53" >NIP.</td>
    <td class="tabelsorot">:</td>
    <td class="tabelsorot"><?php echo $row_karyawan['nip']?></td>
    </tr>
    <tr class="tabelisi">
    <td class="tabelsorot" width="252">NAMA</td>
        <td class="tabelsorot">:</td>
    <td class="tabelsorot"><?php echo $row_karyawan['nama_lengkap']?></td>

  </tr>
  <tr class="tabelisi">
    <td class="tabelsorot" width="252">GAJI POKOK</td>
        <td class="tabelsorot">:</td>
    <td class="tabelsorot"><?php echo "Rp. " . number_format($row_karyawan['gajipokok'])?></td>

  </tr>
  <?php 
  $ab = mysql_query("Select count(t_absensi.masuk) as jumlah_hadir from mst_karyawan left join t_absensi on t_absensi.nip=mst_karyawan.nip where MONTH(t_absensi.tanggal)='$bulan' AND YEAR(t_absensi.tanggal)='$tahun'  AND t_absensi.nip='$nip'")or die(mysql_error());
  $jl = mysql_fetch_array($ab);
  
  $akumulasi = $row_karyawan['gajipokok'] - (22 - $jl[jumlah_hadir])*500;
  ?>
  <tr class="tabelisi">
    <td width="252" class="tabelsorot">POTONGAN</td>
        <td class="tabelsorot">:</td>
    <td class="tabelsorot"><?php echo "Rp. " . number_format((22 - $jl['jumlah_hadir']) * 500)?></td>

  </tr>
<tr><td>&nbsp;</td></tr>  
    <tr class="tabelisi">
    <td class="tabelsorot" width="252">GAJI TERIMA BULAN INI</td>
        <td class="tabelsorot">:</td>
    <td class="tabelsorot"><?php echo "Rp. " . number_format($akumulasi)?></td>

  </tr>
  
</table>
</body>
</html>
