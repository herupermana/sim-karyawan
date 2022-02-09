<?php

  include 'config/koneksi.php';
  $aksi = $_GET[aksi];
  $id_golongan = $_POST[id_golongan];
  $nama_golongan = $_POST[nama_golongan];

  switch ($aksi) {
    case 'tambah': mysql_query("insert into mst_golongan(id_golongan,nama_golongan)
									values('$id_golongan','$nama_golongan')");
                        header('location:index.php?mod=golongan');
                        break;
    case 'ubah': mysql_query("update mst_golongan set nama_golongan = '$nama_golongan'
								where id_golongan = '$id_golongan'");
                        header('location:index.php?mod=golongan');
                        break;
    case 'hapus': mysql_query("delete from mst_golongan where id_golongan = '$id_golongan'");
                        header('location:index.php?mod=golongan');
                        break;
  }
