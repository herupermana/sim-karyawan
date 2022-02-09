<?php
   include 'config/koneksi.php';
   include 'config/fungsi.php';
   $nip = $_GET[nip];
   $bulan = $_GET[bulan];
   $tahun = $_GET[tahun];
   if (empty($tahun)) {
       $tahun = date('Y');
   }
   if (empty($bulan)) {
       $bulan = date('m');
   }
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
          <td colspan="2" class="judulform">Laporan Absensi </td>
          </tr>
        <tr>
          <td width="32%" class="labelform">Bulan / Tahun </td>
          <td width="68%"><label>
		    <input name="mod" type="hidden" value="laporan" />
            </label><label>
            <select name="bulan" id="bulan">
			<?php
                for ($bln = 1; $bln <= 12; $bln++) {
                    $bulan1 = get_Bulan($bln);
                    if ($bln == $bulan) {
                        echo "<option value='$bln' selected>$bulan1</option>";
                    } else {
                        echo "<option value='$bln'>$bulan1</option>";
                    }
                }
            ?>
            </select></label><label>
            <input name="tahun" type="text" id="tahun" size="7" <?php echo "value='$tahun'"; ?> />
          </label></td>
        </tr>
        <tr>
          <td class="labelform">Nama Karyawan </td>
          <td><label>
            <select name="nip">
			<?php
               echo "<option value='semua'>Semua</option>";
               $q = mysql_query('select * from mst_karyawan order by nama_lengkap');
               while ($t = mysql_fetch_array($q)) {
                   if ($t[nip] == $nip) {
                       echo "<option value='$t[nip]' selected>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
                   } else {
                       echo "<option value='$t[nip]'>$t[nip]&nbsp;&nbsp;|&nbsp;&nbsp;$t[nama_lengkap]</option>";
                   }
               }
            ?>
            </select>
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label>
              <input type="submit" name="Submit" value="Pilih" />
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
  <?php
$qcek = mysql_query("select * from t_absensi where extract(month from tanggal) = '$bulan' and extract(year from tanggal) = '$tahun'");
$tcek = mysql_num_rows($qcek);
if ($tcek > 0) {
    if (($nip != 'semua') and (!empty($nip))) {
        $q = mysql_query("select a.nip,a.nama_lengkap,b.nama_jabatan from mst_karyawan a,mst_jabatan b,
	  mst_jamkerja c where a.kode_jab = b.kode_jab and nip = '$nip'") or exit(mysql_error());
        $t = mysql_fetch_array($q); ?>
</p>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="445"><?php echo "<a href='claporan.php?bulan=$bulan&tahun=$tahun&nip=$nip' class='versicetak' target='_blank'>"; ?>Versi Cetak</a> </td>
  </tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td class="bgform"><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="30%" class="labelform">NIP</td>
        <td width="70%"><?php echo $t[nip]; ?></td>
      </tr>
      <tr>
        <td class="labelform">Nama</td>
        <td><?php echo $t[nama_lengkap]; ?></td>
      </tr>
      <tr>
        <td class="labelform">Jabatan</td>
        <td><?php echo $t[nama_jabatan]; ?></td>
      </tr>
<!--
      <tr>
        <td class="labelform">SHIP / Jam Kerja </td>
        <td><?php // echo $t[nama_ship]." / ".$t[jam_masuk]." s/d ".$t[jam_pulang];?></td>
      </tr>
-->
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="349" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="24" bgcolor="#FF0000" class="tabelisi">&nbsp;</td>
        <td width="126" class="tabelisi">Libur </td>
        <td width="26">&nbsp;</td>
        <td width="24" bgcolor="#FFFF00" class="tabelisi">&nbsp;</td>
        <td width="137" class="tabelisi">Tidak Masuk </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="34" class="tabelheader">Hari</td>
        <td class="tabelheader">Tanggal</td>
        <td class="tabelheader">Jam Masuk </td>
        <td class="tabelheader">Jam Pulang </td>
        <td class="tabelheader">Jumlah Jam </td>
        <td class="tabelheader">Keterangan</td>
      </tr>
<?php
    // Menghitung Jumlah Hari

   $jumhari = date('t', mktime(0, 0, 0, $bulan + 1, 0, $tahun));
        $tt = $tahun.'-'.$bulan.'-'.$hr;
        for ($hr = 1; $hr <= $jumhari; $hr++) {
            $qabsen = mysql_query("select tanggal,masuk,keterangan,
						   if(pulang<>'',pulang,'00:00:00') as pulang,
						   TIMEDIFF(if(pulang<>'',pulang,'00:00:00'),masuk) as jumlah
						   from t_absensi 
	                       where nip = '$t[nip]' and day(tanggal) = '$hr' and month(tanggal) = '$bulan' and
						   year(tanggal) = '$tahun'
						   order by tanggal");

            $qabsen2 = mysql_query("SELECT (count(tanggal)*TIMEDIFF(pulang, masuk)) as jmlh FROM t_absensi where month(tanggal)='$bulan' and year(tanggal)='$tahun' and nip='$t[nip]'") or exit(mysql_error());

            $tabsen = mysql_fetch_array($qabsen);
            //	print_r($tabsen['jumlah']);
            $tanggal = date('d m Y', mktime(0, 0, 0, $bulan, $hr, $tahun));

            // Hitung Jumlah JAM
            $totjam[] = $tabsen['jumlah'];

            // Cek Hari Libur
            $cektanggal = date('Y-m-d', mktime(0, 0, 0, $bulan, $hr, $tahun));

            //$qlibur = mysql_query("select * from mst_libur where tanggal = '$cektanggal'");
            //$adalibur = mysql_num_rows($qlibur);

            $qcuti = mysql_query("select count(nip) as tgl_awal,nip,keperluan, tanggal_awal,tanggal_akhir, jenis_cuti from t_cuti where nip = '$t[nip]'
							and '$cektanggal' between date(tanggal_awal) and date(tanggal_akhir) group by nip") or exit(mysql_error());
            $que_cuti = mysql_fetch_array($qcuti);
            /*var_dump("select count(nip) as tgl_awal,nip,keperluan, tanggal_awal,tanggal_akhir, jenis_cuti from t_cuti where nip = '$t[nip]'
                                    and '$cektanggal' between date(tanggal_awal) and date(tanggal_akhir) group by nip");*/

            $adacuti = mysql_num_rows($qcuti);

            //$qijin = mysql_query("select * from t_ijin where nip = '$t[nip]' and tanggal = '$cektanggal'");
            //$adaijin = mysql_num_rows($qijin);

            //$qlembur = mysql_query("select count(nip) as jlh from t_lembur where nip = '$t[nip]'
            //and extract(month from tanggal) = '$bulan' and extract(year from tanggal) = '$tahun'");
            //$tlembur = mysql_fetch_array($qlembur);
            //print_r($tlembur);
            //$l=1;
            //if(!empty($tlembur)){
            //$l++;
            //}
            //$lem = $l * $tlembur['jlh'];

            $keterangan = $tabsen[keterangan];
            if (!empty($tabsen[masuk])) {
                $totalmasuk++;
            }

            /*if ($adaijin > 0)
            {
                $tijin = mysql_fetch_array($qijin);
                $keterangan = $tijin[keperluan];
                $totalijin++;
            }*/

            if ($adacuti > 0) {
                if (!empty($que_cuti['nip'])) {
                    echo "<tr bgcolor='yellow'>";
                    $keterangan = 'Cuti';
                    $total_cuti++;
                } else {
                    echo '<tr>';
                }
            }

            /*if ($adalibur > 0)
            {
              $tlibur = mysql_fetch_array($qlibur);
              $keterangan = $tlibur[keterangan];
            }*/

            $nhari = date('w', mktime(0, 0, 0, $bulan, $hr, $tahun));
            $hari = nama_hari($nhari);
            $jammasuk = $tabsen[masuk];
            $jampulang = $tabsen[pulang];

            if (empty($jampulang)) {
                $jampulang = '17:30:00';
            }
            if (($nhari == 0) or ($adalibur > 0)) {
                echo "<tr bgcolor='red'>";
            } elseif (empty($tabsen[tanggal])) {
                echo "<tr bgcolor='yellow'>";
                $tidakmasuk++;
            } else {
                echo '<tr>';
            } ?>
        <td class="tabelisi" align="center"><?php echo $hari; ?></td>
        <td class="tabelisi" align="center"><?php echo $tanggal; ?></td>
        <td class="tabelisi" align="center"><?php echo $tabsen[masuk]; ?></td>
        <td class="tabelisi" align="center"><?php echo $tabsen[pulang]; ?></td>
        <td class="tabelisi" align="center"><?php echo $tabsen[jumlah];
            $j = $j + $tabsen[jumlah]; ?></td>
        <td class="tabelisi"><?php echo $keterangan; ?></td>
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
      <tr>
	  <?php
          $totaljam = total_jam($totjam);
        //echo $totaljam;
        //$total_cuti =?>
        <td colspan="6">&nbsp;</td>
        </tr>
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
<table width="308" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="304" class="bgform"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
          <tr>
            <td colspan="2" class="tabelheader">Rekapitulasi Absensi </td>
        </tr>
          <tr>
            <td width="210" class="tabelisi">Jumlah Jam Masuk (jam) </td>
            <td width="76" class="tabelisi">
			<?php
            $tabsen2 = mysql_fetch_array($qabsen2);
        echo round($tabsen2[jmlh]); ?>            </td>
          </tr>
          <tr>
            <td class="tabelisi">Jumlah Tidak Masuk (hari) </td>
            <td class="tabelisi"><?php echo $tidakmasuk; ?></td>
          </tr>
          <tr>
            <td class="tabelisi">Jumlah Kehadiran (hari) </td>
            <td class="tabelisi"><?php echo $totalmasuk; ?></td>
          </tr>
          <tr>
            <td class="tabelisi">Jumlah Ijin (hari) </td>
            <td class="tabelisi"><?php echo $totalijin; ?></td>
          </tr>
          <tr>
            <td class="tabelisi">Jumlah Cuti (hari) </td>
            <td class="tabelisi"><?php echo $total_cuti; ?></td>
          </tr>
          <tr>
            <td class="tabelisi">Jumlah Lembur (Jam)</td>
            <td class="tabelisi"><?php echo $lem; ?></td>
          </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>

<?php
    } elseif ($nip == 'semua') {
        ?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td width="445"><?php echo "<a href='laporanglobal_cetak.php?bulan=$bulan&tahun=$tahun' class='versicetak' target='_blank'>"; ?>Versi Cetak</a> </td>
  </tr>
</table>

<?php
   echo "<iframe width='700' height='500' src='laporanglobal.php?bulan=$bulan&tahun=$tahun'></iframe>";
    }
}?>
</body>
</html>
