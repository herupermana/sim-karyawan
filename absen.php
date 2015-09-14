<?
   session_start();
   date_default_timezone_set('Asia/Jakarta');
   $_SESSION[angka] = $_GET[angka];
   $nilai = $_SESSION[angka];
   $hasil = explode(" ",$nilai);
   foreach ($hasil as $isi)
   {
      $isinilai = $isinilai.$isi;
   }
   $pesan = $_GET[pesan];
   $pesan_pulang = $_GET['pesan_pulang'];
   $pesan3 = $_GET['pesan3'];
   $nip = $_GET[nip];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="30">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Absensi Karyawan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.lingangka:link {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
	background-color: #333333;
	text-align: center;
	display: block;
	margin: 5px;
	padding: 5px;
	height: 17px;
	width: 17px;
	border: 2px solid #FFFFFF;
}
.lingangka:visited {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
	background-color: #333333;
	text-align: center;
	display: block;
	margin: 5px;
	padding: 5px;
	height: 17px;
	width: 17px;
	border: 2px solid #FFFFFF;
}
.lingangka:hover {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	font-weight: bold;
	color: #333333;
	text-decoration: none;
	background-color: #CCCCCC;
	text-align: center;
	display: block;
	margin: 5px;
	padding: 5px;
	height: 17px;
	width: 17px;
	border: 2px solid #FFFFFF;
}
.isitulisan {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 26px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
	background-color: #333333;
	text-align: center;
	display: block;
	margin: 5px;
	padding: 5px;
	height: 35px;
	width: 250px;
	border: 3px solid #FFFF00;
}
.tombolenter {
	background-image: url(images/enter.gif);
	background-repeat: no-repeat;
	height: 98px;
	width: 109px;
	margin: 5px;
}
body {
	/*background-image: url(images/bg.gif);*/
	background-repeat: no-repeat;
	padding-top:70px;
}

.hurup {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	color: #333333;
	text-decoration: none;
	background-color: #CCCCCC;
	margin: 5px;
	padding: 5px;
	border: 1px solid #333333;
	text-align: center;
	width: 200px;
}


-->
</style>


</head>

<body>
<script language="JavaScript">

<!--
// please keep these lines on when you copy the source
// made by: Nicolas - http://www.javascript-page.com

var clockID = 0;

function UpdateClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }

   var tDate = new Date();

   document.theClock.theTime.value = "" 
                                   + tDate.getHours() + ":" 
                                   + tDate.getMinutes() + ":" 
                                   + tDate.getSeconds();
   
   clockID = setTimeout("UpdateClock()", 1000);
}
function StartClock() {
   clockID = setTimeout("UpdateClock()", 500);
}

function KillClock() {
   if(clockID) {
      clearTimeout(clockID);
      clockID  = 0;
   }
}

//-->

</script>

<p align="center"><img src="images/bg.gif" width="991" height="121"/></p>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="185" align="center" class="hurup"><? $tanggal= date("j m Y");  echo $tanggal; ?></td>
    <td width="209" align="center"><? include "coba.php";  ?></td>
  </tr>
</table>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%"><table bgcolor="#006633" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><? echo "<a href='?angka=$nilai 1' class='lingangka'>"; ?>1</a></td>
            <td><? echo "<a href='?angka=$nilai 2' class='lingangka'>"; ?>2</a></td>
            <td><? echo "<a href='?angka=$nilai 3' class='lingangka'>"; ?>3</a></td>
          </tr>
          <tr>
            <td><? echo "<a href='?angka=$nilai 4' class='lingangka'>"; ?>4</a></td>
            <td><? echo "<a href='?angka=$nilai 5' class='lingangka'>"; ?>5</a></td>
            <td><? echo "<a href='?angka=$nilai 6' class='lingangka'>"; ?>6</a></td>
          </tr>
          <tr>
            <td><? echo "<a href='?angka=$nilai 7' class='lingangka'>"; ?>7</a></td>
            <td><? echo "<a href='?angka=$nilai 8' class='lingangka'>"; ?>8</a></td>
            <td><? echo "<a href='?angka=$nilai 9' class='lingangka'>"; ?>9</a></td>
          </tr>
          <tr>
            <td><? echo "<a href='?angka=' class='lingangka'>"; ?>C</a></td>
            <td><? echo "<a href='?angka=$nilai 0' class='lingangka'>"; ?>0</a></td>
            <td><? echo "<a href='?angka=' class='lingangka'>"; ?>C</a></td>
          </tr>
        </table></td>
        <td width="68%"><form id="form1" name="form1" method="post" action="prosesabsen.php">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2">&nbsp;
			  
			  
			  </td>
              </tr>
            <tr>
              <td colspan="2">
			            <label>
                        <?php 
						$t = date("h:i");
						//echo $t;
						if(($t > "01:00")&&($t < "04:00")){
							?>
                    <input name="nilai" type="text" class="isitulisan" id="angka" disabled="disabled" maxlength="23" <? echo "value='$isinilai'"; ?> />
                  
                         <?php   
						}else{
						?>
          <input name="nilai" type="text" class="isitulisan" id="angka" onfocus="" maxlength="23" <? echo "value='$isinilai'"; ?> />
          <?php } ?>
          </label>			  </td>
              </tr>
            <tr>
              <td width="50%">&nbsp;</td>
              <td width="50%" rowspan="2" align="right"><label>
                <input name="Submit" type="submit" class="tombolenter" value="" />
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
                </form>
        </td>
      </tr>
    </table></td>
  </tr>
</table>

<?
	 include "config/koneksi.php";
	 $cekpegawai = mysql_query("select * from mst_karyawan where nip = '$nip'");
   $data = mysql_fetch_array($cekpegawai);

   if ((!empty($pesan))||(!empty($nik))){
   ?>
<table width="782" border="0" align="center" cellpadding="0" cellspacing="2">
<tr>
	<td class="judul_report"><?php echo "Selamat Pagi, " . $data['nama_lengkap'] ?></td>
</tr>
<tr>
	<td class="error"><img src="<?php echo 'images/'.$data['photo'] ?>" width="136" height="125" /></td>
</tr>

  <tr>
    <td class="pesan"><? echo $pesan; ?></td>
  </tr>
</table>
<? }elseif(!empty($pesan_pulang)){ ?>
	<table width="782" border="0" align="center" cellpadding="0" cellspacing="2">
	<tr>
	<td class="judul_report">Selamat Sore, <?php echo $data['nama_lengkap'] ?></td>
</tr>
<tr>
	<td class="error"><img src="<?php echo 'images/'.$data['photo'] ?>" width="135" height="129" /></td>
</tr>
  <tr>
    <td class="pesan_pulang"><? echo $pesan_pulang; ?></td>
  </tr>
</table>


<? }elseif(!empty($pesan3)){ ?>
	<table width="782" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td class="pesan_pulang"><? echo $pesan3; ?></td>
  </tr>
</table>

<?php }?>
</body>
</html>
