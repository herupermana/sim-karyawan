<?
	include "config/koneksi.php";
	include "config/fungsi.php";
	$alamat = "?mod=jabatan";
	$aksi = $_GET[aksi];
    $id = $_GET[id];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Jabatan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
if (empty($aksi))
{
    $q = mysql_query("select * from mst_jabatan order by kode_jab");
	
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr class="tabelsorot">
        <td width="15%" class="tabelheader">Kode</td>
        <td width="41%" class="tabelheader">Nama Jabatan</td>
        <td width="6%" class="tabelheader">&nbsp;</td>
        <td width="6%" class="tabelheader">
		<? echo "<a href='$alamat&aksi=tambah' title='Tambah Data Baru'>"; ?>
		<img src="images/b_insrow.png" width="16" height="16" border="0" /></a></td>
      </tr>
      <?
	     while ($t = mysql_fetch_array($q))
		 {
	  ?>
      <tr class="tabelsorot">
        <td class="tabelisi" align="center"><? echo $t[kode_jab]; ?></td>
        <td class="tabelisi"><? echo $t[nama_jabatan]; ?></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=ubah&id=$t[kode_jab]' title='Ubah'>"; ?>
		<img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=hapus&id=$t[kode_jab]' title='Hapus'>"; ?>
		<img src="images/b_drop.png" width="16" height="16" border="0" /></a></td>
      </tr>
	  <? } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?
} else
if ($aksi == 'tambah')
{
?>
<p>&nbsp;</p>

<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="jabatan" name="jabatan" method="post" action="prosesjabatan.php?aksi=tambah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Isi Data Jabatan </td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Kode</td>
          <td><label>
            <input name="kode_jab" type="text" size="10" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Jabatan </td>
          <td><label>
            <input name="nama_jabatan" type="text" size="30" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Simpan" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<? echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>

<?
} else
if ($aksi == 'ubah')
{
	$qubah = mysql_query("select * from mst_jabatan where kode_jab = '$id'");
	$tubah = mysql_fetch_array($qubah);
?>
<p>&nbsp;</p>

<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="jabatan" name="jabatan" method="post" action="prosesjabatan.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Data Jabatan </td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Kode</td>
          <td><label>
            <input name="kode_jab" type="text" size="10" readonly <? echo "value='$tubah[kode_jab]'"; ?> />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Jabatan </td>
          <td><label>
            <input name="nama_jabatan" type="text" size="30" <? echo "value='$tubah[nama_jabatan]'"; ?>/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Simpan" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<? echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>


<p>&nbsp;</p>
<?
} else
if ($aksi == 'hapus')
{
	$qhapus = mysql_query("select * from mst_jabatan where kode_jab = '$id'");
	$thapus = mysql_fetch_array($qhapus);
?>
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="jabatan" name="jabatan" method="post" action="prosesjabatan.php?aksi=hapus">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Hapus Data Jabatan </td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Kode</td>
          <td><label>
            <input name="kode_jab" type="text" size="10" readonly <? echo "value='$thapus[kode_jab]'"; ?> />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Jabatan </td>
          <td><label>
            <input name="nama_jabatan" type="text" size="30" readonly <? echo "value='$thapus[nama_jabatan]'"; ?>/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Hapus" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<? echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<? } ?>
</body>
</html>
