<?php
    include 'config/koneksi.php';
    include 'config/fungsi.php';
    $alamat = '?mod=cuti';
    $aksi = $_GET[aksi];
   $q = mysql_query('select a.*,b.nama_jabatan, c.nama_golongan from mst_karyawan a,mst_jabatan b, mst_golongan c where a.kode_jab = b.kode_jab and a.id_golongan = c.id_golongan
   order by a.nama_lengkap');

    // Tanggal Sekarang
    $tgls = date('Y-m-d');
    $tanggalsekarang = tgl_indonesia($tgls);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Data Karyawan</title>
<link rel="stylesheet" type="text/css" href="config/style.css">
</head>

<body>
<p class="judul_report">Laporan Data Karyawan</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tabelsorot">
    <td width="5%" class="tabelheader">NIP</td>
    <td width="11%" class="tabelheader">Nama</td>
    <td width="24%" class="tabelheader">Alamat</td>
    <td width="8%" class="tabelheader">Email</td>
    <td width="9%" class="tabelheader">Telepon</td>
    <td width="9%" class="tabelheader">Tempat Lahir</td>
    <td width="9%" class="tabelheader">Tanggal Lahir</td>
    <td width="12%" class="tabelheader">Agama</td>
    <td width="12%" class="tabelheader">Gol</td>
    <td width="13%" class="tabelheader">Jabatan</td>
    <td width="13%" class="tabelheader">Jml Keluarga</td>
  </tr>
  <?php
   while ($t = mysql_fetch_array($q)) {
       $tanggal_lahir = tgl_indonesia($t[tanggal_lahir]); ?>
  <tr class="tabelsorot">
    <td align="center" class="tabelisi"><?php  echo $t[nip]; ?></td>
    <td class="tabelisi"><?php  echo $t[nama_lengkap]; ?></td>
    <td class="tabelisi"><?php  echo $t[alamat_ktp]; ?></td>
    <td class="tabelisi"><?php  echo $t[alamat_email]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[telp_hp]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[tempat_lahir]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $tanggal_lahir; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[agama]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[nama_golongan]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[nama_jabatan]; ?></td>
    <td align="center" class="tabelisi"><?php  echo $t[jumlah_keluarga]; ?></td>
  </tr>
  <?php
   } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21"><div align="right"><A href="javascript:window.print()"><IMG 
                  height=32 
                  src="images/ico_alpha_Print_16x16.png" 
                  width=30 border=0></A></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center">Tanggal, <?php echo $tanggalsekarang; ?>
        <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      ( Ka.Bag SDM )</td>
  </tr>
</table>
</body>
</html>
