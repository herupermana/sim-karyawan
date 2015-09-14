<?
	include "config/koneksi.php";
	include "config/fungsi.php";
	$alamat = "?mod=pangkat";
	$aksi = $_GET[aksi];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Karyawan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript">
function buka() {
	
	if($("#lamp1").attr('checked') == true && $("#lamp2").attr('checked') == true && $("#lamp3").attr('checked') == true && $("#lamp4").attr('checked') == true && $("#lamp5").attr('checked') == true && $("#lamp6").attr('checked') == true && $("#lamp7").attr('checked') == true){
		$("#submit").removeAttr('disabled');	
	}else{
		$("#submit").attr('disabled', 'disabled');
		}
	
	}
</script>
<body>
<?
if (empty($aksi))
{
/*   $q = mysql_query("select * from mst_karyawan a,mst_jabatan b,mst_jamkerja c 
   where a.kode_jab = b.kode_jab and a.kode_ship = c.kode_ship order by a.nip");
*/

$q = mysql_query("select b.*, a.nip, a.nama_lengkap, c.id, c.tanggal ,b.nama_jabatan as jabatan_baru
from mst_karyawan a 
inner join mst_jabatan b on a.kode_jab = b.kode_jab 
inner join mst_kenaikan_pangkat c on a.nip = c.nip")or die(mysql_error());
?>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
 <!-- <tr>
    <td><a href="ckaryawan.php" class="versicetak" target="_blank">Versi Cetak</a> </td>
  </tr>-->
</table>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="tabelsorot">
            <td width="26%" class="tabelheader">NIP</td>
            <td width="38%" class="tabelheader">Nama</td>
            <td width="24%" class="tabelheader">Jabatan Lama</td>
            <td width="24%" class="tabelheader">Jabatan Baru</td>
            <td width="6%" class="tabelheader">Tanggal</td>
          <td width="6%" colspan="2" class="tabelheader"><a href="?mod=pangkat&aksi=tambah" title="Tambah Data Baru"><img src="images/b_insrow.png" width="16" height="16" border="0" /></a></td>
          </tr>
<?
   while ($t = mysql_fetch_array($q))
   {
?>
      <tr class="tabelsorot">
        <td class="tabelisi"><!--<a href="?mod=pangkat&aksi=view&id=<?=$t[nip]?>" title="View Detail">--><?  echo $t[nip]; ?><!--</a>--></td>
        <td class="tabelisi"><?  echo $t[nama_lengkap]; ?></td>
        <td class="tabelisi"><?  echo $t[nama_jabatan]; ?></td>
        <td class="tabelisi"><?  echo $t[jabatan_baru]; ?></td>
        <td class="tabelisi"><?  echo $t[tanggal]; ?></td>
       <!-- <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=ubah&id=$t[id]' title='Ubah'>"; ?><img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=hapus&id=$t[id]' title='Hapus'>"; ?><img src="images/b_drop.png" width="16" height="16" border="0" /></a></td>-->
        <td class="tabelisi"><? echo "<a href='cetak_surat_pangkat.php?id=$t[id]' target='_blank' title='Hapus'>"; ?>cetak</a></td>
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
    <td class="bgform">
    <form method="post" action="">
    <table>
        <tr>
          <td class="labelform">Cari Nip Karyawan</td>
          <td><label>
            <input name="nip" type="text" id="nip" size="40" maxlength="23" />
            <input type="submit" name="Submit" value="Cari" />
          </label></td>
        </tr>
    </table>
    </form>
    <?php if(isset($_POST['nip'])){
		$id = $_POST['nip'];
    
	$qjamkerja = mysql_query("select * from mst_golongan");
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_jabatan c 
	where a.kode_jab = c.kode_jab and a.nip = '$id' and a.nip not in(select nip from mutasi_karyawan)");
	$t = mysql_fetch_array($qkaryawan);
	$cek = mysql_num_rows($qkaryawan);
	if($cek <= 0){
		echo "<p align='center'>NIP Tidak Ditemukan</p>";
	}else{
		?>
    <form id="karyawan" name="karyawan" method="post" enctype="multipart/form-data" action="prosespangkat.php?aksi=tambah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Data Karyawan Kenaikan Pangkat</td>
          </tr>
        <tr>
          <td width="34%">&nbsp;</td>
          <td width="66%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="error"><? echo $_GET[err]; ?></td>
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
            <input name="nama_lengkap" type="text" disabled="disabled" id="nama_lengkap" size="50" <? echo "value='$t[nama_lengkap]'"; ?>/>
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Alamat KTP</td>
          <td><input name="alamat_ktp" type="text" disabled="disabled" id="alamat_ktp" size="50" <? echo "value='$t[alamat_ktp]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Alamat Domisili</td>
          <td><input name="alamat_domisili" type="text" disabled="disabled" id="alamat_domisili" size="50"<? echo "value='$t[alamat_domisili]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Email</td>
          <td><input name="alamat_email" type="text" disabled="disabled" id="alamat_email" size="50" <? echo "value='$t[alamat_email]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Telepon / HP</td>
          <td><input name="telp_hp" type="text" disabled="disabled" id="telp_hp" size="50" <? echo "value='$t[telp_hp]'"; ?> /></td>
        </tr>

        <tr>
          <td class="labelform">Tempat Lahir </td>
          <td><input name="tempat_lahir" disabled="disabled" type="text" id="tempat_lahir" size="50" <? echo "value='$t[tempat_lahir]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Lahir </td>
          <td><label>
<input name="tempat_lahir" disabled="disabled" type="text" id="tempat_lahir" size="50" <? echo "value='$t[tanggal_lahir]'"; ?> />            </label></td>
        </tr>
		<tr>
          <td class="labelform">Jenis Kelamin</td>
          <td><input name="tempat_lahir" type="text" id="tempat_lahir" size="10" readonly="readonly" <? echo "value='$t[jenis_kelamin]'"; ?> disabled="disabled" /></td>
        </tr>
    
        <tr>
          <td class="labelform">Jabatan</td>
          <td><label>
            <select name="kode_jab" size="1" id="kode_jab" disabled="disabled">
			<?
			$qjabatan = mysql_query("select * from mst_jabatan order by kode_jab");
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
            <select name="golongan" size="1" id="golongan" disabled="disabled">
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
        <tr>
        	<td valign="top">Data Yang Dilampirkan : </td>
            <td>
            	<table>
                	<tr>
                    	<td><input type="checkbox" id="lamp1" name="lamp[1]" value="PhotoCopy Kartu Pegawai" onclick="buka()" />PhotoCopy Kartu Pegawai</td>
                    </tr>
                                    	<tr>
                    	<td><input type="checkbox" id="lamp2" name="lamp[2]" value="PhotoCopy SK Terakhir" onclick="buka()"/>PhotoCopy SK Terakhir</td>
                    </tr>

                	<tr>
                    	<td><input type="checkbox" id="lamp3" name="lamp[3]" value="PhotoCopy KGB" onclick="buka()"/>PhotoCopy KGB</td>
                    </tr>
                	<tr>
                    	<td><input type="checkbox" id="lamp4" name="lamp[4]" value="PhotoCopy Ijazah Terakhir" onclick="buka()"/>PhotoCopy Ijazah Terakhir</td>
                    </tr>
                	<tr>
                    	<td><input type="checkbox" id="lamp5" name="lamp[5]" value="PhotoCopy Ujian Dinas" onclick="buka()"/>PhotoCopy Ujian Dinas</td>
                    </tr>
                	<tr>
                    	<td><input type="checkbox" id="lamp6" name="lamp[6]" value="UPKP" onclick="buka()"/>UPKP</td>
                    </tr>
                	<tr>
                    	<td><input type="checkbox" id="lamp7" name="lamp[7]" value="DP3" onclick="buka()"/>DP3</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
          <td class="labelform">Jabatan Baru</td>
          <td>&nbsp; <select name="jab_baru" size="1" id="kode_jab">
			<?
			$qjab = mysql_query("select * from mst_jabatan where kode_jab <> '$t[kode_jab]' order by kode_jab ")or die(mysql_error());
			  while ($tjab = mysql_fetch_array($qjab))
			  {
			     
				 
			        echo "<option value=$tjab[kode_jab]>$tjab[nama_jabatan]</option>";
				 
			  }
			?>
            </select></td>
        </tr>
                <tr>
          <td class="labelform">Tanggal Kenaikan Pangkat </td>
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
            <input name="tahun" type="text" id="tahun" size="10" <? echo "value='$tahunsekarang'"; ?> />
            </label></td>
        </tr>
<tr>
	<td colspan="2">Tekan Simpan Jika Sudah Memenuhi Persyaratan Kenaikan Pangkat</td>
</tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
          <input type="hidden" name="jabatan_lama" value="<?=$t[kode_jab]?>" />
            <input type="submit" name="Submit" id="submit" value="Simpan" disabled="disabled" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<? echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
        <?php } ?>
    </td>
  </tr>
</table>
<?php } ?>
<p>&nbsp;</p>
<?
} else
if ($aksi == 'ubah')
{
    $id = $_GET[id];
    //$qjabatan = mysql_query("select * from mst_jabatan order by kode_jab");
	//$qjamkerja = mysql_query("select * from mst_golongan");
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_kenaikan_pangkat c 
	where a.nip = c.nip and c.id = '$id'");
	
	$t = mysql_fetch_array($qkaryawan);
	$Ftgl = ambil_tanggal($t[tanggal_lahir]);
	$Fbln = ambil_bulan($t[tanggal_lahir]);
	$Fthn = ambil_tahun($t[tanggal_lahir]);
	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" enctype="multipart/form-data" action="prosespangkat.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Data Kenaikan Pangkat </td>
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
          <td class="labelform">Alasan</td>
          <td><textarea name="alasan" cols="50" rows="5"><? echo "value='$t[alasan]'"; ?></textarea></td>
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
    $id = $_GET[id];
	$qkaryawan = mysql_query("select * from mst_karyawan a,mst_jabatan c 
	where a.kode_jab = c.kode_jab and a.nip = '$id'") or die ("Salah");	
	$ta = mysql_fetch_array($qkaryawan);	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="karyawan" name="karyawan" method="post" action="prosespangkat.php?aksi=hapus">
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
          <td class="labelform">Alasan</td>
          <td><label>
            <textarea name="alasan" cols="50" rows="5"><? echo "value='$ta[alasan]'"; ?></textarea>
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
