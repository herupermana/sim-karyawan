<?php
	include "config/koneksi.php";
	include "config/fungsi.php";
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
	 $q = mysql_query("select * from mst_karyawan a,mst_jabatan b , mutasi_karyawan c, mst_golongan d
   where a.kode_jab = b.kode_jab and a.nip = c.nip and c.id='$_GET[id]' and d.id_golongan = a.id_golongan")or die(mysql_error());	 
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
		<td colspan="3" align="right"><em><?php echo date('d') . " " . date('F')." ". date(Y)?></em></td>
	</tr>
    <tr>
    	<td>
        	<table width="313">
    <tr>
        <td width="101" height="25">N o m o r</td>
        <td width="13">:</td>
        <td width="158"><?php echo date('Y/m/d/').$_GET['no'];?></td>
    </tr>
	
	<tr>
        <td width="101" height="25">Lampiran</td>
        <td width="13">:</td>
        <td width="158">Satu Berkas</td>
    </tr>
	<tr>
        <td width="101" height="25">Hal</td>
        <td width="13">:</td>
        <td width="158">Permohonan Pindah Tugas Antar Instansi</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    	<tr>
        <td width="101" height="25">Yth.</td>
        <td width="158" colspan="2">Kepala Biro Organisasi dan Kepegawaian Kementrian Tenaga Kerja dan Transmigrasi Jakarta</td>
    </tr>

			</table>
   	  </td>
    </tr>
    <tr>
		<td>&nbsp;</td>
	</tr>
	
	<tr><td colspan="3">Memperhatikan Surat Kepala BBPLKDN Bandung Nomor : B. 279/BBPLKDN/111/2012 tanggal <?php echo tgl_indonesia($t['tanggal'])?> perihal tersebut pada pokok surat, dengan ini kami sampaikan bahwa permohonan pindah tugas pegawai dari BBPLKDN <?=$t[darimana]?> ke Pemda Kabupaten <?=$t[kemana]?> atas nama : </td></tr>
	<tr>
    <tr>
    <td>
    	<table>
        	<tr>
            	<td>Nama </td>
                <td>:</td>
                <td><?=$t[nama_lengkap]?></td>
            </tr>
            <tr>
            	<td>NIP </td>
                <td>:</td>
                <td><?=$t[nip]?></td>
            </tr>
            <tr>
            	<td>pangkat/Gol </td>
                <td>:</td>
                <td><?=$t[nama_golongan]?></td>
            </tr>
            <tr>
            	<td>Jabatan </td>
                <td>:</td>
                <td><?=$t[nama_jabatan]?></td>
            </tr>
            <tr>
            	<td>Unit Kerja</td>
                <td>:</td>
                <td>BBPLKDN Bandung, Ditjen Binalattas</td>
            </tr>
        </table>
    </td>
    </tr>
        <td width="297" height="25" colspan="3">Pada prinsipnya disetujui, mengingat kepindahan yang bersangkutan telah mendapat persetujuan dan tidak keberatan dari Kepala Badan Kepegawaian Daerah Pemerintah Kabupaten <?=$t[kemana]?>.</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
        </tr>
        <td width="297" height="25" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berkenaan dengan Hal tersebut diatas, dan karena pindah tugas antar instansi menjadi kewenangan Saudara, maka kami mohon bantuan kiranya dapat diproses lebih lanjut permohonan pindah tugas yang bersangkutan dan sebagai bahan pertimbangan terlampir kami sampaikan kelengkapan berkas-berkas sebagai berikut : </td>
    </tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td valign="top">
	<table>
    <tr>
	<td>1.</td>
    <td>Foto copy Surat Permohonan Pindah dari yang bersangkutan kepada pimpinan</td>
    </tr>
    <tr>
	<td>2.</td>
    <td>Foto copy SK Pengangkatan CPNS</td>
    </tr>
    
    <tr>
	<td>3.</td>
    <td>Foto copy SK Pengangkatan CPNS menjadi PNS</td>
    </tr>
    <tr>
	<td>4.</td>
    <td>Foto copy SK Kenaikan Pangkat Terakhir</td>
    </tr>
    <tr>
	<td>5.</td>
    <td>Foto copy Ijazah dan transkrip Pendidikan terakhir</td>
    </tr>
    <tr>
	<td>6.</td>
    <td>Foto copy Kartu Pegawai</td>
    </tr>
    <tr>
	<td>7.</td>
    <td>Foto copy KTP</td>
    </tr>
    <tr>
	<td>8.</td>
    <td>Foto copy Surat Nikah</td>
    </tr>
    <tr>
	<td>9.</td>
    <td>Daftar Riwayat Hidup</td>
    </tr>
    <tr>
	<td>10.</td>
    <td>Foto copy DP3 Terakhir</td>
    </tr>
    <tr>
	<td>11.</td>
    <td>Surat Keterangan tidak mempunyai utang piutang kepada pihak Bank dan Koperasi (KPRI)</td>
    </tr>
    <tr>
	<td>12.</td>
    <td>Surat Keterangan tidak pernah dijatuhi hukuman disiplin tingkat sedang/berat</td>
    </tr>
    
    </table>
    </td>
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
				<td width="142" align="center" valign="top">Direktorat Jendral</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td width="174">&nbsp;</td>
				<td width="142" align="center" valign="bottom"><u>Dr. Reyna Usman</u></td>
			</tr>
            <tr>
				<td width="174">&nbsp;</td>
				<td width="142" align="center" valign="bottom">NIP. 196102241983031002</td>
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
