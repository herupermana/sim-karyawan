<?php
    include 'config/koneksi.php';
    include 'config/fungsi.php';
    $alamat = '?mod=cuti';
    $aksi = $_GET[aksi];
   $q = mysql_query("select * from t_cuti a,mst_karyawan b 
   where a.nip = b.nip and a.jenis_cuti='tahunan' order by a.tanggal_awal desc");

    // Tanggal Sekarang
    $tgls = date('Y-m-d');
    $tanggalsekarang = tgl_indonesia($tgls);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan Cuti</title>
<link rel="stylesheet" type="text/css" href="config/style.css">
</head>

<body>
<p class="judul_report">Laporan Cuti Karyawan</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="tabelsorot">
        <td width="11%" class="tabelheader">NIP</td>
        <td width="28%" class="tabelheader">Nama</td>
        <td width="29%" class="tabelheader">Tanggal</td>
        <td width="22%" class="tabelheader">Keterangan</td>
      </tr>
<?php
   while ($t = mysql_fetch_array($q)) {
       $tanggal_awal = tgl_indonesia($t[tanggal_awal]);
       $tanggal_akhir = tgl_indonesia($t[tanggal_akhir]); ?>
      <tr class="tabelsorot">
        <td class="tabelisi"><?php  echo $t[nip]; ?></td>
        <td class="tabelisi"><?php  echo $t[nama_lengkap]; ?></td>
        <td class="tabelisi"><?php  echo $tanggal_awal.' s.d. '.$tanggal_akhir; ?></td>
        <td class="tabelisi"><?php  echo $t[keperluan]; ?></td>
      </tr>
<?php
   } ?>
      <tr>
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
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="center">Tanggal, <?php echo $tanggalsekarang; ?>
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
</body>
</html>
