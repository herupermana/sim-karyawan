<?
   include "config/koneksi.php";
   include "config/fungsi.php";
   $nip = $_GET[nip];
   $bulan = $_GET[bulan];
   $tahun = $_GET[tahun];
   $nip = $_GET[nip];
   if (empty($tahun)) { $tahun = date("Y"); }
   if (empty($bulan)) { $bulan = date("m"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan</title>
<link rel="stylesheet" type="text/css" href="config/style.css">
</head>

<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td class="bgform"><form id="form1" name="form1" method="get" action="">
      <table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td colspan="2" class="judulform">Laporan Gaji </td>
          </tr>
        <tr>
          <td width="32%" class="labelform">Bulan / Tahun </td>
          <td width="68%"><label>
		    <input name="mod" type="hidden" value="gaji" />
            </label><label>
            <select name="bulan" id="bulan">
			<?
			    for ($bln=1;$bln<=12;$bln++)
				{
				    $bulan1 = get_Bulan($bln);
					if ($bln == $bulan)
					{
				      echo "<option value='$bln' selected>$bulan1</option>";
					} else
					{
					  echo "<option value='$bln'>$bulan1</option>";
					}
				}
			?>
            </select></label><label>
            <input name="tahun" type="text" id="tahun" size="7" <? echo "value='$tahun'"; ?> />
          </label></td>
        </tr>
       <!-- <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip">
			<?
			   echo "<option value='semua'>Semua</option>";
			   $q = mysql_query("select * from mst_karyawan order by nama_lengkap");
			   while ($t = mysql_fetch_array($q))
			   {
			       if ($t[nip]==$nip)
				   {
			         echo "<option value='$t[nip]' selected>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
				   } else
				   {
				    echo "<option value='$t[nip]'>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
				   }
			   }
			?>
            </select>
          </label></td>
        </tr>-->
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip">
			<?
			   echo "<option value='semua'>Pilih Karyawan</option>";
			   $q = mysql_query("select * from mst_karyawan order by nama_lengkap");
			   while ($t = mysql_fetch_array($q))
			   {
			       if ($t[nip]==$nip)
				   {
			         echo "<option value='$t[nip]' selected>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
				   } else
				   {
				    echo "<option value='$t[nip]'>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
				   }
			   }
			?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label>
              <input type="submit" name="Submit" value="Tampilkan" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
  <?
$qcek = mysql_query("select * from t_absensi where extract(month from tanggal) = '$bulan' and extract(year from tanggal) = '$tahun'");
$tcek = mysql_num_rows($qcek);
if ($tcek > 0)
{
  
?>
</p>
<!--<table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="445"><? echo "<a href='laporanglobal_cetak.php?bulan=$bulan&tahun=$tahun' class='versicetak' target='_blank'>"; ?>Versi Cetak</a> </td>
  </tr>
</table>-->

<?
   echo "<iframe width='700' height='500' src='laporangaji.php?bulan=$bulan&tahun=$tahun&nip=$nip'></iframe>";
}
?>
</body>
</html>
