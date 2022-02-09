<?php
    include 'config/koneksi.php';
    include 'config/fungsi.php';
    $alamat = '?mod=cuti&cuti=cuti_tahunan';
    $aksi = $_GET[aksi];
    $tahunsekarang = date('Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Cuti Karyawan</title>
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
<p>
  <?php
if (empty($aksi)) {
    $q = mysql_query("select a.*, b.*, a.id as id_cuti from t_cuti a,mst_karyawan b 
   where a.nip = b.nip and a.jenis_cuti = 'tahunan' order by  a.nip, a.tanggal_awal desc") or exit(mysql_error()); ?>
</p>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="ccuti.php" class="versicetak" target="_blank">Versi Cetak</a> </td>
  </tr>
</table>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="tabelsorot">
        <td width="11%" class="tabelheader">NIP</td>
        <td width="28%" class="tabelheader">Nama</td>
        <td width="29%" class="tabelheader">Tanggal</td>
        <td width="22%" class="tabelheader">Keterangan</td>
		        <td width="22%" class="tabelheader">Sisa Cuti</td>
		
        <td width="4%" class="tabelheader">&nbsp;</td>
        <td colspan="2" width="6%" class="tabelheader">
		<?php echo "<a href='$alamat&aksi=tambah' title='Tambah Data Baru'>"; ?>
		<img src="images/b_insrow.png" width="16" height="16" border="0" /></a></td>
      </tr>
<?php
    $no = 0;
    while ($t = mysql_fetch_array($q)) {
        $tanggal_awal = tgl_indonesia($t[tanggal_awal]);
        $tanggal_akhir = tgl_indonesia($t[tanggal_akhir]); ?>
      <tr class="tabelsorot">
        <td class="tabelisi"><?php  echo $t[nip]; ?></td>
        <td class="tabelisi"><?php  echo $t[nama_lengkap]; ?></td>
        <td class="tabelisi"><?php  echo $tanggal_awal.' s.d. '.$tanggal_akhir; ?></td>
        <td class="tabelisi"><?php  echo $t[keperluan]; ?></td>
		<td class="tabelisi"><?php  echo $t[sisa].' hari'; ?></td>
        <td class="tabelisi" align="center">
		<?php echo "<a href='$alamat&aksi=ubah&id=$t[id_cuti]' title='Ubah'>"; ?>
		<img src="images/b_edit.png" width="16" height="16" border="0" /></a></td>
        <td class="tabelisi" align="center">
		<?php $no++;
        echo "<a href='$alamat&aksi=hapus&id=$t[id_cuti]' title='Hapus'>"; ?>
		<img src="images/b_drop.png" width="16" height="16" border="0" /></a></td>
		 <td class="tabelisi" align="center">
		<?php echo "<a href='cetak_cuti_tahunan.php?id=$t[id_cuti]&no=$no' target='_blank' title='Hapus'>"; ?>cetak</a></td>
      
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
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php
} elseif ($aksi == 'tambah') {
        $qkary = mysql_query('select * from mst_karyawan order by nama_lengkap'); ?>
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
    <td class="bgform"><form id="cuti" name="form1" method="post" action="prosescuti.php?aksi=tambah" onSubmit="MM_validateForm('keperluan','','R');return document.MM_returnValue">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Isi Cuti Tahunan Karyawan</td>
          </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="error"><?php echo $_GET[err]; ?></td>
          </tr>
                 	<script language="JavaScript" type="text/JavaScript">
 
 function display()
 {
 //alert("test");
 <?php
 //require_once('admin/conn.php');

 $query1 = 'SELECT * FROM mst_karyawan';
        $hasil = mysql_query($query1);

        while ($data = mysql_fetch_array($hasil)) {
            $nip = $data['nip'];

            echo 'if (document.form1.nip.value == "'.$nip.'")';
            echo '{';

            $query2 = "SELECT sum(sisa) as sisa FROM t_cuti WHERE nip='$nip'";
            $hasil2 = mysql_query($query2);
            $r = mysql_fetch_array($hasil2);
            if ($r['sisa'] == 0) {
                $s = 7;
            } else {
                $s = 7 - $r['sisa'];
            }
            $content = "document.getElementById('tampilSisa').innerHTML = \"";
            if ($s <= 0) {
                $content .= "<option value=''>Karyawan ini tidak bisa Ambil cuti lagi</option>";
            } else {
                for ($tgl = 1; $tgl <= $s; $tgl++) {
                    $content .= "<option value=$tgl>$tgl</option>";
                }
            }
            $content .= '";';
            echo $content;

            $content2 = "document.getElementById('tampilGanti').innerHTML = \"";
            $q = mysql_query("select * from mst_karyawan where nip <> '$nip'");
            while ($t = mysql_fetch_array($q)) {
                $content2 .= "<option value='$t[nip]'>$t[nip] &nbsp;&nbsp;|&nbsp; $t[nama_lengkap]</option>";
            }
            //while ($data2 = mysql_fetch_array($hasil2))
            //{
            //  $content .= "<option value='".$data2['id_kota']."'>".$data2['kota']."</option>";
            //}
            $content2 .= '"';
            echo $content2;

            echo "}\n";
        } ?> 
 }
</script>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip" size="1" onchange="display()">
            <option value="">-- Pilih Karyawan --</option>
              <?php while ($tkary = mysql_fetch_array($qkary)) {
            echo "<option value=$tkary[nip]>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
        } ?>
            </select>
            </label></td>
        </tr>
        <tr>
          <td class="labelform">Lama Cuti</td>
          <td><label>
          <select name="lama_cuti" id="tampilSisa" class="required"></select>
           <!-- <select name="lama_cuti" size="1">
              <?php

              for ($tgl = 1; $tgl <= 10; $tgl++) {
                  echo "<option value=$tgl>$tgl</option>";
              } ?>
            </select>--> Hari
            </label>
            </td>
            </tr>
        <tr>
          <td class="labelform">Tanggal Cuti</td>
          <td><label>
            <select name="tanggal_awal" size="1">
              <?php for ($tgl = 1; $tgl <= 31; $tgl++) {
                  echo "<option value=$tgl>$tgl</option>";
              } ?>
            </select>
          </label>
            <label>
            <select name="bulan_awal" size="1">
			<?php
              for ($bln = 1; $bln <= 12; $bln++) {
                  $bulan = ambilbulan($bln);
                  echo "<option value=$bln>$bulan</option>";
              } ?>
            </select>
            </label>
            <label>
            <input name="tahun_awal" type="text" id="tahun" size="3" <?php echo "value='$tahunsekarang'"; ?> onkeypress="return harusangka(event)" maxlength="4" />
            </label> 
            <!--S.d. 
            <label>
            <select name="tanggal_akhir" size="1">
              <?php for ($tgl = 1; $tgl <= 31; $tgl++) {
                  echo "<option value=$tgl>$tgl</option>";
              } ?>
            </select>
          </label>
            <label>
            <select name="bulan_akhir" size="1">
			<?php
              for ($bln = 1; $bln <= 12; $bln++) {
                  $bulan = ambilbulan($bln);
                  echo "<option value=$bln>$bulan</option>";
              } ?>
            </select>
            </label>
            <label>
            <input name="tahun_akhir" type="text" id="tahun" size="3" <?php echo "value='$tahunsekarang'"; ?>/>
            </label>-->			</td>
        </tr>

       
        <tr>
          <td class="labelform">Keperluan</td>
          <td><input name="keperluan" type="text" id="keperluan" size="50" /></td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2">Relasi Keluarga yang dapat dihubungi selama Cuti :</td>
        </tr>

        <tr>
          <td class="labelform">Nama</td>
          <td><input name="relasi_nama" type="text" id="relasi_nama" size="50" /></td>
        </tr>
        <tr>
          <td class="labelform">Telepon</td>
          <td><input name="relasi_telepon" type="text" id="relasi_telepon" size="50" onkeypress="return harusangka(event)" /></td>
        </tr>
        <tr>
          <td class="labelform">Hubungan</td>
          <td>
          <select name="relasi_hubungan">
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
          <td class="labelform">Pengganti</td>
          <td><label>
            <select name="nip_pengganti" size="1" id="tampilGanti">
              <?php
              /*	 $qkary = mysql_query("select * from mst_karyawan order by nama_lengkap");
                   while ($tkary = mysql_fetch_array($qkary))
                 {
                   echo "<option value=$tkary[nip]>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
                  }*/
              ?>
            </select>
            </label></td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Simpan" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<?php echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
    } elseif ($aksi == 'ubah') {
        $id = $_GET[id];
        $qcuti = mysql_query("select * from t_cuti where id = '$id'");
        $t = mysql_fetch_array($qcuti);
        $Ftglawal = ambil_tanggal($t[tanggal_awal]);
        $Fblnawal = ambil_bulan($t[tanggal_awal]);
        $Fthnawal = ambil_tahun($t[tanggal_awal]);

        $Ftglakhir = ambil_tanggal($t[tanggal_akhir]);
        $Fblnakhir = ambil_bulan($t[tanggal_akhir]);
        $Fthnakhir = ambil_tahun($t[tanggal_akhir]);

        $Ftglmasuk = ambil_tanggal($t[tanggal_masuk]);
        $Fblnmasuk = ambil_bulan($t[tanggal_masuk]);
        $Fthnmasuk = ambil_tahun($t[tanggal_masuk]); ?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="cuti" name="cuti" method="post" action="prosescuti.php?aksi=ubah">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Ubah Cuti Tahunan Karyawan</td>
          </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%"><input type="hidden" name="id" <?php echo "value='$t[id]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip" size="1">
              <?php
                 $qkary = mysql_query('select nip,nama_lengkap from mst_karyawan order by nama_lengkap');
        while ($tkary = mysql_fetch_array($qkary)) {
            if ($tkary[nip] == $t[nip]) {
                echo "<option value=$tkary[nip] selected>$tkary[nip] | $tkary[nama_lengkap]</option>";
            } else {
                echo "<option value=$tkary[nip]>$tkary[nip] | $tkary[nama_lengkap]</option>";
            }
        } ?>
            </select>
            </label></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Cuti</td>
          <td><label>
            <select name="tanggal_awal" size="1" disabled="disabled">
              <?php for ($tgl = 1; $tgl <= 31; $tgl++) {
            if ($tgl == $Ftglawal) {
                echo "<option value=$tgl selected>$tgl</option>";
            } else {
                echo "<option value=$tgl>$tgl</option>";
            }
        } ?>
            </select>
          </label>
            <label>
            <select name="bulan_awal" size="1" disabled="disabled">
			<?php
              for ($bln = 1; $bln <= 12; $bln++) {
                  $bulan = ambilbulan($bln);
                  if ($bln == $Fblnawal) {
                      echo "<option value=$bln selected>$bulan</option>";
                  } else {
                      echo "<option value=$bln>$bulan</option>";
                  }
              } ?>
            </select>
            </label>
            <label>
            <input name="tahun_awal" type="text" id="tahun" size="3" <?php echo "value='$Fthnawal'"; ?> readonly="readonly" />
            </label> 
           <!-- S.d. 
            <label>
            <select name="tanggal_akhir" size="1" disabled="disabled">
              <?php for ($tgl = 1; $tgl <= 31; $tgl++) {
                  if ($tgl == $Ftglakhir) {
                      echo "<option value=$tgl selected>$tgl</option>";
                  } else {
                      echo "<option value=$tgl>$tgl</option>";
                  }
              } ?>
            </select>
          </label>
            <label>
            <select name="bulan_akhir" size="1" disabled="disabled">
			<?php
              for ($bln = 1; $bln <= 12; $bln++) {
                  $bulan = ambilbulan($bln);
                  if ($bln == $Fblnakhir) {
                      echo "<option value=$bln selected>$bulan</option>";
                  } else {
                      echo "<option value=$bln>$bulan</option>";
                  }
              } ?>
            </select>
            </label>
            <label>
            <input name="tahun_akhir" type="text" id="tahun" size="3" <?php echo "value='$Fthnakhir'"; ?> readonly="readonly" />
            </label>	-->		</td>
        </tr>

      
        <tr>
          <td class="labelform">Keperluan</td>
          <td><input name="keperluan" type="text" id="keperluan" size="50" <?php echo "value='$t[keperluan]'"; ?>/></td>
        </tr>
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td colspan="2">Relasi Keluarga yang dapat dihubungi selama Cuti :</td>
        </tr>

        <tr>
          <td class="labelform">Nama</td>
          <td><input name="relasi_nama" type="text" id="relasi_nama" size="50"<?php echo "value='$t[relasi_nama]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Telepon</td>
          <td><input name="relasi_telepon" type="text" id="relasi_telepon" size="50" <?php echo "value='$t[relasi_telepon]'"; ?> onkeypress="return harusangka(event)"/></td>
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
          <td class="labelform">Pengganti</td>
          <td><label>
            <select name="nip_pengganti" size="1">
              <?php
                 $qkary = mysql_query("select * from mst_karyawan where nip <> '$t[nip]' order by nama_lengkap");
        while ($tkary = mysql_fetch_array($qkary)) {
            if ($tkary[nip] == $t[nip_pengganti]) {
                echo "<option value=$tkary[nip] selected>$tkary[nama_lengkap]</option>";
            } else {
                echo "<option value=$tkary[nip]>$tkary[nip] &nbsp;&nbsp;|&nbsp; $tkary[nama_lengkap]</option>";
            }
        } ?>
            </select>
            </label></td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Ubah" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<?php echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>

<p>&nbsp;</p>
<?php
    } elseif ($aksi == 'hapus') {
        $id = $_GET[id];
        $q = mysql_query("select a.*,b.nama_lengkap from t_cuti a,mst_karyawan b where a.id = $id and a.nip = b.nip");
        $t = mysql_fetch_array($q);
        $tanggal_awal = tgl_indonesia($t[tanggal_awal]);
        $tanggal_akhir = tgl_indonesia($t[tanggal_akhir]);
        $tanggal_masuk = tgl_indonesia($t[tanggal_masuk]); ?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="bgform"><form id="cuti" name="cuti" method="post" action="prosescuti.php?aksi=hapus">
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
        <tr>
          <td colspan="2" class="judulform">Hapus Cuti Karyawan</td>
          </tr>
        <tr>
          <td width="24%">&nbsp;</td>
          <td width="76%"><input type="hidden" name="id" <?php echo "value='$t[id]'"; ?> /></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><?php echo $t[nama_lengkap]; ?></td>
        </tr>
        <tr>
          <td class="labelform">Tanggal Cuti</td>
          <td><?php echo $tanggal_awal.' s.d. '.$tanggal_akhir; ?></td>
        </tr>

        <tr>
          <td class="labelform">Tanggal Masuk</td>
          <td><?php echo $tanggal_masuk; ?></td>
        </tr>

        <tr>
          <td class="labelform">Keperluan</td>
          <td><?php echo $t[keperluan]; ?></td>
        </tr>
        <tr>
          <td colspan="2" class="labelform" align="right"><label>
            <input type="submit" name="Submit" value="Hapus" />
          </label>
            <label>
            <input type="button" name="Submit2" value="Batal" onclick="location.href='<?php echo $alamat; ?>'" />
            </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<?php
    } ?>
</body>
</html>
