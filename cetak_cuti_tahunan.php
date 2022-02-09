<?php
    include 'config/koneksi.php';
    include 'config/fungsi.php';
    //print_r($_GET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
     $q = mysql_query("select a.*, b.telp_hp,b.nama_lengkap, c.nama_jabatan from t_cuti a,mst_karyawan b, mst_jabatan c 
   where a.nip = b.nip and a.id = '$_GET[id]' and c.kode_jab = b.kode_jab ") or exit(mysql_error());

   $t = mysql_fetch_array($q);

?>
<table width="63%" height="303" border="0" align="center" style="border:double; border-color:#000000">
    <tr>
        <td height="25" colspan="3" align="center" bgcolor="#999999" style="font-size:18px; font-weight:bold">BUKTI PERMOHONAN CUTI</td>
       
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><em>Yang bertanda tangan dibawah ini :</em></td>
	</tr>
    <tr>
        <td width="297" height="25">NO SURAT</td>
        <td width="99">:</td>
        <td width="207"><?php echo date('Y/m/d/').$_GET['no']; ?></td>
    </tr>
	
	<tr>
        <td width="297" height="25">NAMA</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[nama_lengkap]?></td>
    </tr>
	<tr>
        <td width="297" height="25">Telp / HP</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[telp_hp]?></td>
    </tr>
	<tr>
        <td width="297" height="25">Jabatan</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[nama_jabatan]?></td>
    </tr>
	<tr>
        <td width="297" height="25">JENIS CUTI</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[jenis_cuti]?></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	<tr><td colspan="3"><em>Dengan ini menyatakan permohonan cuti dengan ketentuan sebagai berikut :</em></td></tr>
	<tr>
        <td width="297" height="25">TANGGAL CUTI AWAL</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[tanggal_awal]?></td>
    </tr>
	<tr>
        <td width="297" height="25">TANGGAL CUTI AKHIR</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[tanggal_akhir]?></td>
    </tr>
	<tr>
        <td width="297" height="25">Untuk Keperluan</td>
        <td width="99">:</td>
        <td width="207"><?php echo $t[keperluan]?></td>
    </tr>
	<tr>
		<td colspan="3">
		<table style="border:double" width="70%" align="center">
			<tr>
				<td colspan="2" align="center">
					<strong>Relasi / Keluarga yang dapat dihubungi selama cuti :</strong>
				</td>
			</tr>
			<tr>
				<td width="25%">
					Nama :				</td>
				<td width="75%">
					<?php echo $t['relasi_nama']?></td>
			</tr>
			<tr>
				<td width="25%">
					Hubungan dengan Karyawan :				</td>
				<td width="75%">
					<?php echo $t['relasi_hubungan']?></td>
			</tr>
			<tr>
				<td width="25%">
					telp / HP :				</td>
				<td width="75%">
					<?php echo $t['relasi_telepon']?>		</td>
			</tr>
		</table>
		
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>
	<tr>
        <td colspan="3" height="25"><em>Selama cuti, tugas saya dijalankan oleh :</em></td>
        
    </tr>
	<tr>
        <td width="297" height="25">Nama</td>
        <td width="99">:</td>
        <td width="207"><?php
            $s = mysql_query("SELECT * from mst_karyawan where nip='$t[nip_pengganti]'") or exit(mysql_error());
            $ganti = mysql_fetch_array($s);
        echo $ganti[nama_lengkap]?></td>
    </tr>
	<tr><td>&nbsp;</td></tr>
    <tr>
        <td valign="top" height="102" colspan="3">
		
			<table width="91%" height="165" align="center">
			<tr>
				<td width="157" align="left" valign="top">Hormat Saya</td>
				<td width="174">&nbsp;</td>
				<td width="174">&nbsp;</td>
				<td width="279" align="center" valign="top">Disetujui</td>
				<td width="142" align="center" valign="top">Diketahui</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td height="65" align="left" valign="bottom"><u>Pemohon</u></td>
				<td align="center" valign="bottom"><u>Pengganti</u></td>
				<td width="174">&nbsp;</td>
				<td width="279" align="center" valign="bottom"><u>Atasan Langsung</u></td>
				<td width="142" align="center" valign="bottom"><u>Kabag. Kepegawaian</u></td>
			</tr>
			
			</table>
		</td>
        
    </tr>
</table>
<p>
<div align="center"><A href="javascript:window.print()"><IMG 
                  height=32 
                  src="images/ico_alpha_Print_16x16.png" 
                  width=30 border=0></A></div>
</p>
</body>
</html>
