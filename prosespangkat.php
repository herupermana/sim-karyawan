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
  $jumlah = $_POST[jumlah];
  $alamat_email = $_POST[alamat_email];
  $kode_jab = $_POST[kode_jab];
  $jabatan_lama = $_POST[jabatan_lama];
  $jabatan_baru = $_POST[jab_baru];
  
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
					if (!empty($jabatan_baru))
  					{
							mysql_query("insert into mst_kenaikan_pangkat					values('','$nip','$jabatan_lama','$jabatan_baru','$tanggal_lahir','-')")or die(mysql_error());
						header("location:index.php?mod=pangkat");
					} else
					{
					     header("location:index.php?mod=pangkat&aksi=tambah&err='Alasan Harus di isi'");

					}
						break;
  	case "ubah"		: 
						mysql_query("update mst_kenaikan_pangkat set alasan='$alasan'
								where nip = '$nip'");
						header("location:index.php?mod=pangkat");
						break;
	case "hapus"	: mysql_query("delete from mst_kenaikan_pangkat where nip = '$nip'");
						header("location:index.php?mod=pangkat");
						break;	
  }
?>