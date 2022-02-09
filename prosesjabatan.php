<?php

  include 'config/koneksi.php';
  $aksi = $_GET[aksi];
  $kode_jab = $_POST[kode_jab];
  $nama_jabatan = $_POST[nama_jabatan];

  switch ($aksi) {
    case 'tambah': mysql_query("insert into mst_jabatan(kode_jab,nama_jabatan)
									values('$kode_jab','$nama_jabatan')");
                        header('location:index.php?mod=jabatan');
                        break;
    case 'ubah': mysql_query("update mst_jabatan set kode_jab='$kode_jab',nama_jabatan = '$nama_jabatan'
								where kode_jab = '$kode_jab'");
                        header('location:index.php?mod=jabatan');
                        break;
    case 'hapus': mysql_query("delete from mst_jabatan where kode_jab = '$kode_jab'");
                        header('location:index.php?mod=jabatan');
                        break;
  }
