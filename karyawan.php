<?
	include "config/koneksi.php";
	include "config/fungsi.php";
	$alamat = "?mod=karyawan";
	$aksi = $_GET[aksi];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Karyawan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" type="text/JavaScript">
function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}
</script>
<body>
<?
if (empty($aksi))
{
/*   $q = mysql_query("select * from mst_karyawan a,mst_jabatan b,mst_jamkerja c 
   where a.kode_jab = b.kode_jab and a.kode_ship = c.kode_ship order by a.nip");
*/

$q = mysql_query("select * from mst_karyawan a,mst_jabatan b 
   where a.kode_jab = b.kode_jab and a.nip not in (select nip from mutasi_karyawan) order by a.nip")or die(mysql_error());
?>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="ckaryawan.php" class="versicetak" target="_blank">Versi Cetak</a> </td>
  </tr>
</table>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="tabelsorot">
            <td width="26%" class="tabelheader">NIP</td>
            <td width="38%" class="tabelheader">Nama</td>
            <td width="24%" class="tabelheader">Jabatan</td>
            <td width="6%" class="tabelheader">&nbsp;</td>
             <?php if($_SESSION[bagian]!="karyawan"){?>
            <td width="6%" class="tabelheader"><a href="?mod=karyawan&aksi=tambah" title="Tambah Data Baru"><img src="images/b_insrow.png" width="16" height="16" border="0" /></a></td>
            <?php } ?>
          </tr>
<?
   while ($t = mysql_fetch_array($q))
   {
?>
      <tr class="tabelsorot">
        <td class="tabelisi"><a href="?mod=karyawan&aksi=view&id=<?=$t[nip]?>" title="View Detail"><?  echo $t[nip]; ?></a></td>
        <td class="tabelisi"><?  echo $t[nama_lengkap]; ?></td>
        <td class="tabelisi"><?  echo $t[nama_jabatan]; ?></td>
         <?php if($_SESSION[bagian]!="karyawan"){?>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=ubah&id=$t[nip]' title='Ubah'>"; ?><img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=hapus&id=$t[nip]' title='Hapus'>"; ?><img src="images/b_drop.png" width="16" height="16" border="0" /></a></td>
        <?php } ?>
      </tr>
<? } ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<?
} else
if ($aksi == 'tambah')
{
    $qjabatan = mysql_query("select * from mst_jabatan order by kode_jab");
	$qjamkerja = mysql_query("select * from mst_golongan");
	
	$tahunsekarang = date("Y");
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" enctype="multipart/form-data" action="proseskaryawan.php?aksi=tambah">
      <table width="105%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Isi Data Karyawan </td>
          </tr>
        <tr>
          <td width="34%">&nbsp;</td>
          <td width="66%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="error"><? echo $_GET[err]; ?></td>
          </tr>
       <!-- <tr>
          <td class="labelform">Nip</td>
          <td><label>
            <input name="nip" type="text" id="nip" size="40" maxlength="23" />
          </label></td>
        </tr>-->
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <input name="nama_lengkap" type="text" id="nama_lengkap" size="50" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Passwword Akses</td>
          <td><label>
            <input name="password" type="password" id="password" size="50" />
          </label></td>
        </tr>

        <tr>
          <td class="labelform">Alamat KTP</td>
          <td><input name="alamat_ktp" type="text" id="alamat_ktp" size="50" /></td>
        </tr>
		<tr>
          <td class="labelform">Alamat Domisili</td>
          <td><input name="alamat_domisili" type="text" id="alamat_domisili" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Email</td>
          <td><input name="alamat_email" type="text" id="alamat_email" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Telepon / HP</td>
          <td><input name="telp_hp" type="text" id="telp_hp" size="50"  onkeypress="return harusangka(event)" /></td>
        </tr>

        <tr>
          <td class="labelform">Tempat Lahir </td>
          <td><input name="tempat_lahir" type="text" id="tempat_lahir" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Lahir </td>
          <td><label>
            <select name="tanggal" size="1">
              <? for ($tgl = 1; $tgl<=31; $tgl++)
			     {
				   echo "<option value=$tgl>$tgl</option>";
				  }
			  ?>
            </select>
          </label>
            <label>
            <select name="bulan" size="1">
			<?
			  for ($bln = 1; $bln<=12; $bln++)
			  {
			     $bulan = ambilbulan($bln);
                 echo "<option value=$bln>$bulan</option>";
			  } 
			 ?>
            </select>
            </label>
            <label>
            <input name="tahun" type="text" id="tahun" size="10" <? echo "value='$tahunsekarang'"; ?>   onkeypress="return harusangka(event)" maxlength="4"/>
            </label></td>
        </tr>
		<tr>
          <td class="labelform">Jenis Kelamin</td>
          <td><select name="jenis_kelamin">
		  	<option value="Pria">Pria</option>
			<option value="Wanita">Wanita</option>
		  </select></td>
        </tr>
        <tr>
          <td class="labelform">Agama</td>
          <td><label>
            <select name="agama" size="1" id="agama">
              <option value="Islam" selected="selected">Islam</option>
              <option value="Katolik">Katolik</option>
              <option value="Protestan">Protestan</option>
              <option value="Hindu">Hindu</option>
              <option value="Budha">Budha</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Pendidikan</td>
          <td><label>
            <select name="pendidikan" size="1" id="pendidikan">
              <option value="S1" selected="selected">S1</option>
              <option value="S2">S2</option>
              <option value="D3">D3</option>
              <option value="D1">D1</option>
              <option value="SLTA">SLTA</option>
            </select>
          </label></td>
        </tr>
         <script type="application/javascript">
			function test(){
				//alert('test');
				if(document.karyawan.status.value=="Belum Kawin"){
					document.karyawan.jumlah.disabled = true;
					}else{
						document.karyawan.jumlah.disabled = false;
						}
				}
		</script>
		<tr>
          <td class="labelform">Status</td>
          <td><label>
            <select name="status" size="1" id="status" onchange="test()">
              <option value="Kawin" selected="selected">Kawin</option>
              <option value="Belum Kawin">Belum Kawin</option>
            </select>
          </label></td>
        </tr>
        
        <tr>
          <td class="labelform">Jumlah Anggota Keluarga</td>
          <td><input name="jumlah" type="text" id="jumlah" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
            <select name="kode_jab" size="1" id="kode_jab">
			<?
			  while ($tjab = mysql_fetch_array($qjabatan))
			  {
			     echo "<option value=$tjab[kode_jab]>$tjab[nama_jabatan]</option>";
			  }
			?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Golongan</td>
          <td><label>
            <select name="golongan" size="1" id="golongan">
			 <? 
			  while ($tship = mysql_fetch_array($qjamkerja))
			  {
			     echo "<option value=$tship[id_golongan]>$tship[nama_golongan]</option>";
			  }
			 ?>
            </select>
          </label></td>
        </tr>
 <!--<tr>
          <td class="labelform">Gaji</td>
          <td><input name="gaji" type="text" id="gaji" size="50" /></td>
        </tr>-->
<tr>
          <td class="labelform">Photo</td>
          <td><input name="photo" type="file" id="photo" size="50" /></td>
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
if ($aksi == 'ubah')
{
    $id = $_GET[id];
    $qjabatan = mysql_query("select * from mst_jabatan order by kode_jab");
	$qjamkerja = mysql_query("select * from mst_golongan");
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_jabatan c 
	where a.kode_jab = c.kode_jab and a.nip = '$id'");
	$t = mysql_fetch_array($qkaryawan);
	$Ftgl = ambil_tanggal($t[tanggal_lahir]);
	$Fbln = ambil_bulan($t[tanggal_lahir]);
	$Fthn = ambil_tahun($t[tanggal_lahir]);
	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" enctype="multipart/form-data" action="proseskaryawan.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Data Karyawan </td>
          </tr>
        <tr>
          <td width="32%">&nbsp;</td>
          <td width="68%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Nomor Induk Karyawan</td>
          <td><label>
            <input name="nip" type="text" id="nip" size="20" <? echo "value='$t[nip]'"; ?> readonly="" />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <input name="nama_lengkap" type="text" id="nama_lengkap" size="50" <? echo "value='$t[nama_lengkap]'"; ?>/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Password Akses </td>
          <td><label>
            <input name="password" type="password" id="password" size="50"/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Alamat KTP</td>
          <td><input name="alamat_ktp" type="text" id="alamat_ktp" size="50" <? echo "value='$t[alamat_ktp]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Alamat Domisili</td>
          <td><input name="alamat_domisili" type="text" id="alamat_domisili" size="50"<? echo "value='$t[alamat_domisili]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Email</td>
          <td><input name="alamat_email" type="text" id="alamat_email" size="50" <? echo "value='$t[alamat_email]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Telepon / HP</td>
          <td><input name="telp_hp" type="text" id="telp_hp" size="50" <? echo "value='$t[telp_hp]'"; ?>  onkeypress="return harusangka(event)" /></td>
        </tr>

        <tr>
          <td class="labelform">Tempat Lahir </td>
          <td><input name="tempat_lahir" type="text" id="tempat_lahir" size="50" <? echo "value='$t[tempat_lahir]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Lahir </td>
          <td><label>
            <select name="tanggal" size="1">
              <? 
				 for ($tgl = 1; $tgl<=31; $tgl++)
				   if ($tgl == $Ftgl)
			       {
				       echo "<option value=$tgl selected='selected'>$tgl</option>";
				   } else
				   {
				       echo "<option value=$tgl>$tgl</option>";
				   }
			  ?>
            </select>
          </label>
            <label>
            <select name="bulan" size="1">
			<?
			  for ($bln = 1; $bln<=12; $bln++)
			  {			     
				 $bulan = ambilbulan($bln);
                 if ($bln == $Fbln)
				 {
				    echo "<option value=$bln selected>$bulan</option>";
				 } else
				 {
				    echo "<option value=$bln>$bulan</option>";
				 }
			  } 
			 ?>
            </select>
            </label>
            <label>
            <input name="tahun" type="text" id="tahun" size="10" <? echo "value='$Fthn'"; ?>  onkeypress="return harusangka(event)" maxlength="4"/>
            </label></td>
        </tr>
		<tr>
          <td class="labelform">Jenis Kelamin</td>
          <td><select name="jenis_kelamin">
		  	<option value="pria">Pria</option>
			<option value="wanita">Wanita</option>
		  </select></td>
        </tr>
        <tr>
          <td class="labelform">Agama</td>
          <td><label>
            <select name="agama" size="1" id="agama">
              <option value="Islam" selected="selected">Islam</option>
              <option value="Katolik">Katolik</option>
              <option value="Protestan">Protestan</option>
              <option value="Hindu">Hindu</option>
              <option value="Budha">Budha</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </label></td>
        </tr>
                <tr>
          <td class="labelform">Pendidikan</td>
          <td><label>
            <select name="pendidikan" size="1" id="pendidikan">
              <option value="S1" selected="selected">S1</option>
              <option value="S2">S2</option>
              <option value="D3">D3</option>
              <option value="D1">D1</option>
              <option value="SLTA">SLTA</option>
            </select>
          </label></td>
        </tr>
       <script type="application/javascript">
			function test(){
				//alert('test');
				if(document.karyawan.status.value=="Belum Kawin"){
					document.karyawan.jumlah.disabled = true;
					}else{
						document.karyawan.jumlah.disabled = false;
						}
				}
		</script>
		<tr>
          <td class="labelform">Status</td>
          <td><label>
            <select name="status" size="1" id="status"  onchange="test()">
              <option value="Kawin" selected="selected">Kawin</option>
              <option value="Belum Kawin">Belum Kawin</option>
            </select>
          </label></td>
        </tr>
<tr>
          <td class="labelform">Jumlah Keluarga </td>
          <td><input name="jumlah" type="text" id="jumlah" size="50" <? echo "value='$t[jumlah_keluarga]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
            <select name="kode_jab" size="1" id="kode_jab">
			<?
			  while ($tjab = mysql_fetch_array($qjabatan))
			  {
			     if ($tjab[kode_jab] == $t[kode_jab])
				 {
			        echo "<option value=$tjab[kode_jab] selected>$tjab[nama_jabatan]</option>";
				 } else
				 {
			        echo "<option value=$tjab[kode_jab]>$tjab[nama_jabatan]</option>";
				 }
			  }
			?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Golongan</td>
          <td><label>
            <select name="golongan" size="1" id="golongan">
			 <? 
			  while ($tship = mysql_fetch_array($qjamkerja))
			  {
				  if ($tship[id_golongan] == $t[id_golongan])
				 {
			     echo "<option value=$tship[id_golongan] selected>$tship[nama_golongan]</option>";
				 }else{
				echo "<option value=$tship[id_golongan]>$tship[nama_golongan]</option>";		 
					 }
			  }
			 ?>
            </select>
          </label></td>
        </tr>
<!--<tr>
          <td class="labelform">Gaji</td>
          <td><input name="gaji" type="text" id="gaji" size="50" value="<?=$t['gajipokok']?>" /></td>
        </tr>-->
		<tr>
          <td class="labelform">Photo</td>
          <td><input name="photo" type="file" id="photo" size="50" /></td>
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
if ($aksi == 'view')
{
    $id = $_GET[id];
    $qjabatan = mysql_query("select * from mst_jabatan order by kode_jab");
	//$qjamkerja = mysql_query("select * from mst_jamkerja");
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_jabatan c 
	where a.kode_jab = c.kode_jab and a.nip = '$id'");
	$t = mysql_fetch_array($qkaryawan);
	$Ftgl = ambil_tanggal($t[tanggal_lahir]);
	$Fbln = ambil_bulan($t[tanggal_lahir]);
	$Fthn = ambil_tahun($t[tanggal_lahir]);
	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" enctype="multipart/form-data" action="proseskaryawan.php?aksi=ubah">
      <table width="93%" height="546" border="0" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="3" class="judulform">View Detail Karyawan </td>
          </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
        <td width="21%" rowspan="14" valign="top"><img width="100" height="100" src="images/<?php echo $t['photo']?>" /></td>
          <td width="28%" class="labelform">NIP</td>
          <td width="51%"><label>
            <? echo $t[nip]; ?>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <? echo $t[nama_lengkap]; ?>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Alamat KTP</td>
          <td><? echo $t[alamat_ktp]?></td>
        </tr>
        <tr>
          <td class="labelform">Alamat Domisili</td>
          <td><? echo $t[alamat_domisili]; ?></td>
        </tr>
        <tr>
          <td class="labelform">Email</td>
          <td><? echo $t[alamat_email] ?></td>
        </tr>
        <tr>
          <td class="labelform">Telepon / HP</td>
          <td><? echo $t[telp_hp] ?> </td>
        </tr>

        <tr>
          <td class="labelform">Tempat Lahir </td>
          <td><? echo $t[tempat_lahir]?> </td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Lahir </td>
          <td><label>
			<?php echo $t['tanggal_lahir']?>
            </label>
</td>
        </tr>
		<tr>
          <td class="labelform">Jenis Kelamin</td>
          <td><label><?php echo $t['jenis_kelamin']?></label></td>
        </tr>
        <tr>
          <td class="labelform">Agama</td>
          <td><label>
			<?php echo $t['agama']?>
          </label></td>
        </tr>
         <tr>
          <td class="labelform">Pendidikan</td>
          <td><label>
			<?php echo $t['pendidikan']?>
          </label></td>
        </tr>
         <tr>
          <td class="labelform">Status</td>
          <td><label>
			<?php echo $t['status']?>
          </label></td>
        </tr>
         <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
			<?php echo $t['nama_jabatan']?>
          </label></td>
        </tr>
        <!--<tr>
          <td class="labelform">Gaji Pokok</td>
          <td><label>
			<?php echo $t['gajipokok']?>
          </label></td>
        </tr>-->
       <!-- <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
            
			<?
			  echo $tjab[nama_jabatan]
			?>
            
          </label></td>
        </tr>-->
        <tr>
          <td class="labelform">&nbsp;</td>
          <td>&nbsp;</td>
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
    $id = $_GET[id];
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_jabatan c 
	where a.kode_jab = c.kode_jab and a.nip = '$id'") or die ("Salah");	
	$ta = mysql_fetch_array($qkaryawan);	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" action="proseskaryawan.php?aksi=hapus">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Hapus Data Karyawan </td>
          </tr>
        <tr>
          <td width="32%">&nbsp;</td>
          <td width="68%">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelform">Nomor Induk Karyawan</td>
          <td><label>
            <input type="text" name="nip" readonly <? echo "value='$ta[nip]'"; ?>  />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <input name="nama" type="text" size="50" readonly <? echo "value='$ta[nama_lengkap]'"; ?>  />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
            <input type="text" name="jabatan" readonly <? echo "value='$ta[nama_jabatan]'"; ?>  />
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
<? }
 ?>
</body>
</html>
