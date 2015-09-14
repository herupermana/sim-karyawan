<?
  include "config/koneksi.php";
  $aksi = $_GET[aksi];
  $nip = $_POST[nip];
  $nama_lengkap = $_POST[nama_lengkap];
  $tempat_lahir = $_POST[tempat_lahir];
  $tanggal_lahir = date("Y-m-d",mktime(0,0,0,$_POST[bulan],$_POST[tanggal],$_POST[tahun]));
  $alamat_ktp = $_POST[alamat_ktp];
  $alamat_domisili = $_POST[alamat_domisili];
  $telp_hp = $_POST[telp_hp];
  $agama = $_POST[agama];
  $pendidikan = $_POST[pendidikan];
  $status = $_POST[status];
  $dari = $_POST[dari];
  $kmn = $_POST[kmn];
  $kode_jab = $_POST[kode_jab];
  $alasan = $_POST[alasan];
  $id_golongan = $_POST[golongan];
  $jenis_kelamin = $_POST[jenis_kelamin];
  $lokasi = $_FILES[photo][tmp_name];
  $photo = $_FILES[photo][name];
  
  switch ($aksi)
  {
  	case "tambah"	:
					/*if(strlen($nip)<8){ 
						header("location:index.php?mod=karyawan&aksi=tambah&err='NIP tidak boleh kurang dari 8 digit'");
					}else*/
					$tgl = date('Y-m-d');
					if (!empty($alasan))
  					{
							mysql_query("insert into mutasi_karyawan					values('','$nip','$dari','$kmn','$alasan','$tanggal_lahir')")or die(mysql_error());
						header("location:index.php?mod=mutasi");
					} else
					{
					     header("location:index.php?mod=mutasi&aksi=tambah&err='Alasan Harus di isi'");

					}
						break;
  	case "ubah"		: 
						mysql_query("update mutasi_karyawan set alasan='$alasan', darimana='$dari', kemana='$kmn'
								where nip = '$nip'");
						header("location:index.php?mod=mutasi");
						break;
	case "hapus"	: mysql_query("delete from mutasi_karyawan where nip = '$nip'");
						header("location:index.php?mod=mutasi");
						break;	
  }
?>