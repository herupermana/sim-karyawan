<?
	$alamat = "?mod=cuti&cuti=cuti_tahunan";
	$aksi = $_GET[aksi];
	$tahunsekarang = date("Y");
	$mod = $_GET[cuti];
   switch ($mod)
   {
      default 				: $namafile = "cuti_tahunan.php"; $judul = "Data Pegawai"; break;
      case "cuti_tahunan" 	: $namafile = "cuti_tahunan.php"; $judul = "Data Karyawan"; break;
	  case "cuti_hamil" 	: $namafile = "cuti_hamil.php"; $judul = "Data Karyawan"; break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Cuti Karyawan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="175"><a href="?mod=cuti&cuti=cuti_tahunan" class="versicetak">Cuti Tahunan</a> </td>
	<td width="525"><a href="?mod=cuti&cuti=cuti_hamil" class="versicetak">Cuti Hamil</a> </td>
  </tr>
  <tr>
  	<td colspan="2">
		<? include $namafile;  ?>
	</td>
  </tr>
</table>
</html>
