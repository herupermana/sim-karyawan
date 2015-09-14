<?
	include "config/koneksi.php";
	include "config/fungsi.php";
	$alamat = "?mod=ijin&ijin=ijin_harian";
	$aksi = $_GET[aksi];
	$tahunsekarang = date("Y");
	$jamsekarang = date("H:m:s");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Karyawan</title>
<link href="config/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
if (empty($aksi))
{
   $q = mysql_query("select a.*,b.nama_lengkap from t_ijin a,mst_karyawan b 
   where a.nip = b.nip order by a.tanggal desc");
?>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="cijin.php" class="versicetak" target="_blank">Versi Cetak</a> </td>
  </tr>
</table>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="tabelsorot">
        <td width="11%" class="tabelheader">NIP</td>
        <td width="28%" class="tabelheader">Nama</td>
        <td width="20%" class="tabelheader">Tanggal</td>
        <td width="20%" class="tabelheader">Alasan</td>
        <td width="31%" class="tabelheader">Keterangan</td>
		
        <td width="4%" class="tabelheader">&nbsp;</td>
        <td width="6%" class="tabelheader">
		<? echo "<a href='$alamat&aksi=tambah' title='Tambah Data Baru'>"; ?>
		<img src="images/b_insrow.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelheader">Cetak</td>
      </tr>
<?
	$no=0;
   while ($t = mysql_fetch_array($q))
   {
      $tanggal = tgl_indonesia($t[tanggal]);
?>
      <tr class="tabelsorot">
        <td class="tabelisi"><?  echo $t[nip]; ?></td>
        <td class="tabelisi"><?  echo $t[nama_lengkap]; ?></td>
        <td class="tabelisi"><?  echo $tanggal; ?></td>
        <td class="tabelisi"><?  echo $t[keperluan]; ?></td>
        <td class="tabelisi"><?  echo $t[jenis_ijin]; ?></td>
        <td class="tabelisi" align="center">
		<? echo "<a href='$alamat&aksi=ubah&id=$t[id]' title='Ubah'>"; ?>
		<img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<? $no++; echo "<a href='$alamat&aksi=hapus&id=$t[id]' title='Hapus'>"; ?>
		<img src="images/b_drop.png" width="16" height="16" border="0" /></a></td>
	<td class="tabelisi" align="center">
		<? echo "<a href='cetak_permohonan_ijin_harian.php?id=$t[id]&no=$no' target='_blank' title='Hapus'>"; ?>cetak</a></td>
<? } ?>
      <tr>
        <td>&nbsp;</td>
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

      $qkary = mysql_query("select * from mst_karyawan order by nama_lengkap");
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' harus angka\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' harus disi\n'; }
  } if (errors) alert('Warning..!!\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="ijin" name="ijin" method="post" action="prosesijin.php?aksi=tambah" onSubmit="MM_validateForm('ijin_untuk','','R', 'keperluan','','R');return document.MM_returnValue">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Form Ijin Karyawan</td>
          </tr>
           <tr>
          <td colspan="2" class="error"><? echo $_GET[err]; ?></td>
          </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip" size="1">
              <? while ($tkary = mysql_fetch_array($qkary))
			     {
				   echo "<option value=$tkary[nip]>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
				  }
			  ?>
            </select>
            </label></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Ijin</td>
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
            <input name="tahun" type="text" id="tahun" size="3" <? echo "value='$tahunsekarang'"; ?>/>
            </label> 
			
        </td>
        </tr>
         <tr>
          <td class="labelform">Alasan</td>
          <td>
          	<select name="jenis">
            	<option value="sakit">Sakit</option>
                <option value="ijin">ijin</option>
            </select>
          </td>
        </tr>
     <!--  <tr>
          <td class="labelform">Ijin Untuk</td>
          <td><input name="ijin_untuk" type="text" id="ijin_untuk" size="50" /></td>
        </tr>-->
       <tr>
          <td class="labelform">Keperluan</td>
          <td><input name="keperluan" type="text" id="keperluan" size="50" /></td>
        </tr>

        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2">Relasi yang dapat dihubungi</td>
        </tr>

        <tr>
          <td class="labelform">Nama</td>
          <td><input name="relasi_nama" type="text" id="relasi_nama" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Alamat</td>
          <td><input name="relasi_alamat" type="text" id="relasi_alamat" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Telepon</td>
          <td><input name="relasi_telepon" type="text" id="relasi_telepon" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Hubungan</td>
          <td><select name="relasi_hubungan">
          	<option value="Istri">Istri</option>
            <option value="Adik">Adik</option>
            <option value="Kakak">Kakak</option>
            <option value="Paman">Paman</option>
            <option value="Bibi">Bibi</option>
            <option value="Orang Tua">Orang Tua</option>
            <option value="Sodara">Sodara</option>
            
          </select>
          </td>
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
	$qijin = mysql_query("select * from t_ijin where id = $id");
	$t = mysql_fetch_array($qijin);
	$Ftgl = ambil_tanggal($t[tanggal]);
	$Fbln = ambil_bulan($t[tanggal]);
	$Fthn = ambil_tahun($t[tanggal]);
	
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="ijin" name="ijin" method="post" action="prosesijin.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Ijin Harian Pegawai</td>
          </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%"><input type="hidden" name="id" <? echo "value='$t[id]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Nama Pegawai </td>
          <td><label>
          <select name="nip" size="1">
            <? 
			     $qkary = mysql_query("select nip,nama_lengkap from mst_karyawan order by nama_lengkap");
				 while ($tkary = mysql_fetch_array($qkary))
			     {
				   if ($tkary[nip] == $t[nip])
				   {
				      echo "<option value=$tkary[nip] selected>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
					} else
					{
					 echo "<option value=$tkary[nip]>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
					}
				  }
			  ?>
          </select>
          </label></td>
        </tr>

        <tr>
          <td class="labelform">Tanggal Ijin</td>
          <td><label>
            <select name="tanggal" size="1">
              <? for ($tgl = 1; $tgl<=31; $tgl++)
			     {
				   if ($tgl == $Ftgl)
				   {
				   echo "<option value=$tgl selected>$tgl</option>";
				   } else
				   {
				   echo "<option value=$tgl>$tgl</option>";
				   }
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
            <input name="tahun" type="text" id="tahun" size="3" <? echo "value='$Fthn'"; ?> />
            </label> 
			   </td>
        </tr>
         <tr>
          <td class="labelform">Alasan</td>
          <td>
          	<select name="jenis">
            	<option value="sakit">Sakit</option>
                <option value="ijin">ijin</option>
            </select>
          </td>
        </tr>
      <!-- <tr>
          <td class="labelform">Ijin Untuk</td>
          <td><input name="ijin_untuk" type="text" id="ijin_untuk" size="50" <? echo "value='$t[ijin_untuk]'"; ?>/></td>
        </tr>-->
       <tr>
          <td class="labelform">Keperluan</td>
          <td><input name="keperluan" type="text" id="keperluan" size="50" <? echo "value='$t[keperluan]'"; ?>/></td>
        </tr>

        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2">Relasi yang dapat dihubungi</td>
        </tr>

        <tr>
          <td class="labelform">Nama </td>
          <td><input name="relasi_nama" type="text" id="relasi_nama" size="50" <? echo "value='$t[relasi_nama]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Alamat</td>
          <td><input name="relasi_alamat" type="text" id="relasi_alamat" size="50" <? echo "value='$t[relasi_alamat]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Telepon</td>
          <td><input name="relasi_telepon" type="text" id="relasi_telepon" size="50" <? echo "value='$t[relasi_telepon]'"; ?>/></td>
        </tr>
        <tr>
          <td class="labelform">Hubungan</td>
          <td><input name="relasi_hubungan" type="text" id="relasi_hubungan" size="50" <? echo "value='$t[relasi_hubungan]'"; ?>/></td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Ubah" />
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
if ($aksi == "hapus")
{
    $id = $_GET[id];
	$q = mysql_query("select a.*,b.nama_lengkap from t_ijin a,mst_karyawan b where a.id = $id and a.nip = b.nip");
	$t = mysql_fetch_array($q);	
	$tanggal = tgl_indonesia($t[tanggal]);
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="ijin" name="ijin" method="post" action="prosesijin.php?aksi=hapus">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Hapus Ijin</td>
          </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%"><input type="hidden" name="id" <? echo "value='$t[id]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Nama Pegawai </td>
          <td><? echo $t[nama_lengkap]; ?></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal</td>
          <td><? echo $tanggal; ?></td>
        </tr>

        <tr>
          <td class="labelform">Jam</td>
          <td><? echo $t[jam_ijin]; ?></td>
        </tr>
        <tr>
          <td class="labelform">Keperluan</td>
          <td><? echo $t[keperluan]; ?></td>
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
