<?
   session_start();
   date_default_timezone_set('Asia/Jakarta');
   if (empty($_SESSION[diahuser]) and (empty($_SESSION[diahpassword])))
   {
      header("location:login.php");
   }
   $tanggal = date("D, d M y");
   $j = date('H');
   $jj = $j-1;
   $jam = $jj.":".date("i:s");
   $mod = $_GET[mod];
   switch ($mod)
   {
      default 			: $namafile = "karyawan.php"; $judul = "Data Pegawai"; break;
      case "karyawan" 	: $namafile = "karyawan.php"; $judul = "Data Karyawan"; break;
      case "jabatan"	: $namafile = "jabatan.php"; $judul = "Jabatan Karyawan"; break;	  
      case "cuti"		: $namafile = "cuti.php"; $judul = "Data Cuti Karyawan"; break;	  
	  case "user"		: $namafile = "user.php"; $judul = "Data User"; break;
	  case "ijin"		: $namafile = "ijin_harian.php"; $judul = "Ijin Karyawan"; break;
	  case "gaji"		: $namafile = "gaji.php"; $judul = "laporan Gaji"; break;
	  case "lembur"		: $namafile = "lembur.php"; $judul = "Lembur"; break;
	  case "ship"		: $namafile = "ship.php";	$judul = "Ship / Jam Kerja"; break;
	  case "mutasi"		: $namafile = "mutasi.php";	$judul = "Mutasi"; break;
	  case "pangkat"		: $namafile = "pangkat.php";	$judul = "Kenaikan Pangkat"; break;
	  case "laporan"	: $namafile = "laporan.php"; $judul = "Laporan Absensi"; break;
	  case "golongan"	: $namafile = "golongan.php"; $judul = "Data Golongan"; break;
	  case "cetak_peringatan"	: $namafile = "catatan_peringatan.php"; $judul = "Catatan Peringatan"; break;
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistem Informasi Kepegawaian</title>
<script type="text/javascript" src="config/jquery.js"></script>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #063;
}
.bgheader {
	background-image: url(images/header2.gif);
	background-repeat: no-repeat;
}
.bgtengah {
	background-image: url(images/kotaktengah.gif);
	background-repeat: repeat-y;
}
.menu1:link {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #F0F0F0;
	text-decoration: none;
	background-image: url(images/menu2.gif);
	background-repeat: no-repeat;
	display: block;
	background-position: center center;
	padding: 5px;
	height: 31px;
	width: 208px;
	line-height: 30px;
	text-indent: 15px;
}

.menu1:visited {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #F0F0F0;
	text-decoration: none;
	background-image: url(images/menu1.gif);
	background-repeat: no-repeat;
	display: block;
	background-position: center center;
	padding: 5px;
	height: 31px;
	width: 208px;
	line-height: 30px;
	text-indent: 15px;
}
.menu1:hover {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #F0F0F0;
	text-decoration: none;
	background-image: url(images/menu2.gif);
	background-repeat: no-repeat;
	display: block;
	background-position: center center;
	padding: 5px;
	height: 31px;
	width: 208px;
	line-height: 30px;
	text-indent: 15px;
}
.bgjudul {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight: bold;
	color: #333333;
	text-decoration: none;
	background-image: url(images/judul.gif);
	background-repeat: no-repeat;
	text-indent: 40px;
	display: block;
	padding: 5px;
	height: 54px;
	width: 455px;
	line-height: 30px;
}
-->
</style>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="130" valign="bottom" class="bgheader">
    <table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="29%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="21%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td><? echo "$tanggal || $jam"; ?> </td>
        <td>&nbsp;</td>
        <td align="right">User ID : <? echo $_SESSION[diahnama]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24%" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/kotakatas.gif" width="242" height="32" /></td>
          </tr>
          <tr>
            <td valign="top" class="bgtengah"><table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
            <?php if($_SESSION[bagian]=="karyawan"){?>
            
              <tr>
                <td><a href="?mod=karyawan" class="menu1" style="color:#00F">Data Karyawan </a> </td>
              </tr>
               <tr>
                <td><a href="?mod=laporan" class="menu1" style="color:#00F">Laporan Absensi</a> </td>
              </tr>
            <?php }else{?>
              <tr>
                <td><a href="?mod=karyawan" class="menu1" style="color:#00F">Data Karyawan </a> </td>
              </tr>
              <tr>
                <td><a href="?mod=jabatan" class="menu1" style="color:#00F">Jabatan</a> </td>
              </tr>
              <tr>
                <td><a href="?mod=golongan" class="menu1" style="color:#00F">Golongan</a> </td>
              </tr>

              <tr>
                <td><a href="?mod=cuti" class="menu1" style="color:#00F">Cuti</a> </td>
              </tr>
               <tr>
                <td><a href="?mod=ijin" class="menu1" style="color:#00F">Pengajuan Ijin</a> </td>
              </tr>
              <tr>
                <td><a href="?mod=mutasi" class="menu1" style="color:#00F">Mutasi</a> </td>
              </tr>
               <tr>
                <td><a href="?mod=laporan" class="menu1" style="color:#00F">Laporan Absensi</a> </td>
              </tr>
             <!-- <tr>
                <td><a href="?mod=gaji" class="menu1">Laporan Gaji</a> </td>
              </tr>-->
             
              <tr>
                <td><a href="?mod=pangkat" class="menu1" style="color:#00F">Kenaikan Pangkat</a> </td>
              </tr>
 <tr>
                <td><a href="?mod=user" class="menu1" style="color:#00F">Data User</a> </td>
              </tr>
              <?php } ?>
			  <tr>
                <td><a href="logout.php" class="menu1">Logout</a> </td>
              </tr>
             <tr>
                <td><p>&nbsp;</p>
                  </td>
              </tr>
            </table>
              </td>
          </tr>
          <tr>
            <td><img src="images/kotakbawah.gif" width="242" height="39" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="76%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div class="bgjudul"><? echo $judul; ?></div> </td>
          </tr>
          <tr>
            <td><? include $namafile;  ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="footerisi" align="center"><br />
      <p>(c) Deden :: Univeristas Komputer 2012<br />
        S1 Manajemen Informatika<br /> </p>
    </td>
  </tr>
</table>
</body>
</html>
