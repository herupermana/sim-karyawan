<?php

  include 'config/koneksi.php';
  $aksi = $_GET[aksi];
  $id = $_POST[id];
  $nip = $_POST[nip];
  $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, $_POST[bulan_awal], $_POST[tanggal_awal], $_POST[tahun_awal]));
   $tanggal_akhir = date('Y-m-d', mktime(0, 0, 0, $_POST[bulan_awal], $_POST[tanggal_awal] + 89, $_POST[tahun_awal]));
  $tanggal_masuk = date('Y-m-d', mktime(0, 0, 0, $_POST[bulan_masuk], $_POST[tanggal_masuk], $_POST[tahun_masuk]));
  $keperluan = $_POST[keperluan];
  $relasi_nama = $_POST[relasi_nama];
  $relasi_telepon = $_POST[relasi_telepon];
  $relasi_hubungan = $_POST[relasi_hubungan];
  $nip_pengganti = $_POST[nip_pengganti];
  $tahun = date('Y');
    $hamil = 'hamil';

  $qjumlahcuti = mysql_query("SELECT nip,sum(Datediff(tanggal_akhir,tanggal_awal)+1) as jumlah FROM `t_cuti`
								where nip = '$nip' group by nip");
  $tjum = mysql_fetch_array($qjumlahcuti);

  $tgl1 = date('d', mktime(0, 0, 0, $_POST[bulan_awal], $_POST[tanggal_awal], $_POST[tahun_awal]));
  $tgl2 = date('d', mktime(0, 0, 0, $_POST[bulan_akhir], $_POST[tanggal_akhir], $_POST[tahun_akhir]));

  $t1 = $_POST['bulan_awal'].''.$_POST['tanggal_awal'];
  $t2 = $_POST['bulan_akhir'].''.$_POST['tanggal_akhir'];

//  echo $t2;exit;

  //if($t2<$t1){
    //header("location:index.php?mod=cuti&cuti=cuti_tahunan&aksi=tambah&err='Invalid Tanggal'");
  //}else{

  $jumtgl = $tgl2 - $tgl1;

  $sql = mysql_query("SELECT DATEDIFF('$tanggal_akhir', '$tanggal_awal') as selisih") or exit(mysql_error());
  $date_selisih = mysql_fetch_array($sql);
  //echo $jumtgl;

  $jumlahcuti = $tjum[jumlah];
  $jumlahcuti = $jumlahcuti + $jumtgl;
  $sisacuti = 12 - $jumlahcuti;

  $sql = mysql_query("SELECT nip, count(sisa) as sisa FROM t_cuti WHERE nip='$nip' group by nip") or exit(mysql_error());
  $cek = mysql_fetch_array($sql);
  $s = $cek['sisa'];

  if ($s > 90) {
      header("location:index.php?mod=cuti&cuti=cuti_hamil&aksi=tambah&err='Waktu Cuti anda sudah habis'");
  } else {
      switch ($aksi) {
    case 'tambah':
                        if ($date_selisih['selisih'] >= 90) {
                            header("location:index.php?mod=cuti&cuti=cuti_hamil&aksi=tambah&err='Waktu Cuti melebihi batas'");
                        } else {
                            mysql_query("insert into t_cuti(nip,tanggal_awal,tanggal_akhir,keperluan,relasi_nama,relasi_telepon,relasi_hubungan,
									nip_pengganti,sisa,jenis_cuti)
									
									values('$nip','$tanggal_awal','$tanggal_akhir','$keperluan','$relasi_nama','$relasi_telepon',
									'$relasi_hubungan','$nip_pengganti','$s','$hamil')");

                            header('location:index.php?mod=cuti&cuti=cuti_hamil');
                        }
                        break;
    case 'ubah': mysql_query("update t_cuti set nip = '$nip',tanggal_awal='$tanggal_awal',tanggal_akhir='$tanggal_akhir',
													 keperluan = '$keperluan',
													 relasi_nama = '$relasi_nama',relasi_telepon='$relasi_telepon',
													 relasi_hubungan='$relasi_hubungan',nip_pengganti='$relasi_pengganti'
													 where id = $id");
                        header('location:index.php?mod=cuti&cuti=cuti_hamil');
                        break;
    case 'hapus': mysql_query("delete from t_cuti where id = $id");
                        header('location:index.php?mod=cuti&cuti=cuti_hamil');
                        break;
  }
  }
 // }
