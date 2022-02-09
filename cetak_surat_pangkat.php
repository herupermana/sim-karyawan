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
     $q = mysql_query("select b.*, a.nip, a.nama_lengkap, c.id, c.tanggal ,b.nama_jabatan as jabatan_baru
from mst_karyawan a 
inner join mst_jabatan b on a.kode_jab = b.kode_jab 
inner join mst_kenaikan_pangkat c on a.nip = c.nip where c.id='$_GET[id]'") or exit(mysql_error());

   $t = mysql_fetch_array($q);

?>
<table width="70%" height="815" border="0" align="center" style="border:thick; border-color:#000000">
    <tr>
        <td height="25" colspan="3" align="center" style="font-size:18px; font-weight:bold">BALAI BESAR PENGEMBANGAN LATIHAN KERJA DALAM NEGERI</td>
    </tr>
	<tr>
		<td colspan="3" align="center">JLN. JENDRAL GATOT SUBROTO NO. 170 BANDUNG TLP/FAX (022) 7312564</td>
	</tr>
    <tr>
    	<td colspan="3"><hr size="2px" /></td>
    </tr>
	<tr>
		<td colspan="3" align="right"><em><?php echo date('d').' '.date('F').' '.date(Y)?></em></td>
	</tr>
    <tr>
    	<td>
        	<table width="313">
    <tr>
        <td width="101" height="25">N o m o r</td>
        <td width="13">:</td>
        <td width="158"><?php echo date('Y/m/d/').$_GET['no']; ?></td>
    </tr>
	
	<tr>
        <td width="101" height="25">Lampiran</td>
        <td width="13">:</td>
        <td width="158">16 (enam belas) bendel</td>
    </tr>
	<tr>
        <td width="101" height="25">Hal</td>
        <td width="13">:</td>
        <td width="158">Usulan Kenaikan Pangkat Pegawai BBPLKDN Bandung a.n. : <?=$t['nama_lengkap']?></td>
    </tr>
			</table>
   	  </td>
    </tr>
    <tr>
		<td>&nbsp;</td>
	</tr>
	
	<tr><td colspan="3">Yth. Sesditjen Binalattas</td></tr>
    <tr><td colspan="3">Jl. Jend. Gatot Subroto Kav. 51</td></tr>
    <tr><td colspan="3">di <br /> Jakarta</td></tr>
	<tr>
        <td width="297" height="25" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan telah dipenuhinya syarat - syarat tercantum dalam peraturan Pemerintah Republik Indonesia Nomor: 99 Tahun 2000 Bab II Pasal 4 dan Pasal 9 tentang kenaikan Pangkat Pilihan Pegawai Negeri Sipil yang menduduki jabatan struktural dan fungsional. Maka kami sampaikan Usulan Kenaikan Pangkat (UKP) Jabatan Fungsional, Reguler, Penyesuaian Ijazah dan percepatan atas nama pegawai sebagaimana tercantum pada lajur 2 (dua) setingkat lebih tinggi seperti tersebut dalam lajur 4 (empat) pada lampiran surat ini.</td>
    </tr>
    	<tr>
        <td width="297" height="25" colspan="3">Demikian atas perhatian dan bantuannya kami ucapkan terima kasih</td>
    </tr>

	<tr><td colspan="3">&nbsp;</td></tr>
    <tr>
        <td valign="top" height="102" colspan="3">
		
			<table width="91%" height="165" align="center">
			<tr>
				<td width="174">&nbsp;</td>
				<td width="142" align="center" valign="top">Kepala B2PLKDN</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td width="174">&nbsp;</td>
				<td width="142" align="center" valign="bottom"><u>Drs. Dudung Heryadi, MM</u></td>
			</tr>
            <tr>
				<td width="174">&nbsp;</td>
				<td width="142" align="center" valign="bottom">NIP. 196102241983031013</td>
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
