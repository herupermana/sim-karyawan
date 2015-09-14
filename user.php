<?
	include "config/koneksi.php";
	include "config/fungsi.php";
	$alamat = "?mod=user";
	$aksi = $_GET[aksi];
    $id = $_GET[id];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Data User</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
if (empty($aksi))
{
    $q = mysql_query("select * from mst_user order by nama_user");
	
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr class="tabelsorot">
        <td width="15%" class="tabelheader">Nama User</td>
        <td width="41%" class="tabelheader">Nama</td>
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
        <td class="tabelisi"><? echo $t[nama_user]; ?></td>
        <td class="tabelisi"><? echo $t[nama]; ?></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=ubah&id=$t[nama_user]' title='Ubah'>"; ?>
		<img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=hapus&id=$t[nama_user]' title='Hapus'>"; ?>
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
    <td class="bgform"><form id="formuser" name="formuser" method="post" action="prosesuser.php?aksi=tambah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Isi Data User</td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">User ID</td>
          <td><label>
            <input name="nama_user" type="text" size="20" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Kata Kunci</td>
          <td><label>
            <input name="kata_kunci" type="password" size="20" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Lengkap</td>
          <td><label>
            <input name="nama" type="text" size="30" />
          </label></td>
        </tr>

        <tr>
          <td class="labelform">Bagian</td>
          <td><label>
            <select name="bagian" size="1">
			     <option value="Administrator">Administrator</option>
				 <option value="HRD">H R D</option>
			</select>
          </label></td>
        </tr>

        <tr>
          <td class="labelform">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Tambah" />
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
	$qubah = mysql_query("select * from mst_user where nama_user = '$id'");
	$tubah = mysql_fetch_array($qubah);
?>
<p>&nbsp;</p>

<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="formuser" name="formuser" method="post" action="prosesuser.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Data User</td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Nama User</td>
          <td><label>
            <input name="nama_user" type="text" size="20" readonly <? echo "value='$tubah[nama_user]'"; ?> />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Kata Kunci</td>
          <td><label>
            <input name="kata_kunci" type="password" size="20" <? echo "value='$tubah[kata_kunci]'"; ?>/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Lengkap</td>
          <td><label>
            <input name="nama" type="text" size="30" readonly <? echo "value='$tubah[nama]'"; ?> />
          </label></td>
        </tr>

        <tr>
          <td class="labelform">Bagian</td>
          <td><label>
            <select name="bagian" size="1">
				 <?
				 	$bag = explode("/","Administrator/HRD"); 
					foreach ($bag as $bagian)
					{
					   if ($bagian == $tubah[bagian])
					   {
				          echo "<option value='$bagian' selected>$bagian</option>"; 
					   } else
					   {
					   	  echo "<option value='$bagian'>$bagian</option>"; 
					   }
					 }
			     ?>
			</select>
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
	$qhapus = mysql_query("select * from mst_user where nama_user = '$id'");
	$thapus = mysql_fetch_array($qhapus);
?>
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="formuser" name="formuser" method="post" action="prosesuser.php?aksi=hapus">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Hapus Data User</td>
          </tr>
        <tr>
          <td width="40%">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Nama User</td>
          <td><label>
            <input name="nama_user" type="text" size="10" readonly <? echo "value='$thapus[nama_user]'"; ?> />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Bagian</td>
          <td><label>
            <input name="bagian" type="text" size="30" readonly <? echo "value='$thapus[bagian]'"; ?>/>
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
