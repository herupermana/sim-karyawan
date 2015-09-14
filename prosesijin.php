<?
  include "config/koneksi.php";
  $aksi = $_GET[aksi];
  $id = $_POST[id];
  $nip = $_POST[nip];
  $tanggal = date("Y-m-d",mktime(0,0,0,$_POST[bulan],$_POST[tanggal],$_POST[tahun]));
  $jam_ijin = $_POST[jam_ijin];
  $keperluan = $_POST[keperluan];
  $ijin_untuk = $_POST[ijin_untuk];
  $relasi_nama = $_POST[relasi_nama];
  $relasi_alamat = $_POST[relasi_alamat];
  $relasi_hubungan = $_POST[relasi_hubungan];
  $relasi_telepon = $_POST[relasi_telepon];
  $jenis_ijin = $_POST[jenis];
  switch ($aksi)
  {
  	case "tambah"	: 
	$sql = mysql_query("SELECT * FROM t_ijin WHERE nip='$nip' and tanggal='$tanggal'");
	$cek = mysql_num_rows($sql);
	if($cek > 0){
		 header("location:index.php?mod=ijin&ijin=ijin_harian&aksi=tambah&err='Karyawan Sudah Ijin Sebelumnya Ditanggal yang anda pilih!'");
	}else{
	mysql_query("insert into t_ijin(nip,tanggal,keperluan,relasi_nama,relasi_alamat,relasi_hubungan,
									relasi_telepon,jenis_ijin)
									values('$nip','$tanggal','$keperluan','$relasi_nama','$relasi_alamat','$relasi_hubungan',
									'$relasi_telepon','$jenis_ijin')")or die(mysql_error());
									
						header("location:index.php?mod=ijin");
	}
						break;
  	case "ubah"		: 
	/*var_dump("update t_ijin set nip='$nip',tanggal='$tanggal',jam_ijin='$jam_ijin',keperluan='$keperluan',
									ijin_untuk='$ijin_untuk',relasi_nama='$relasi_nama',relasi_alamat='$relasi_alamat',
									relasi_hubungan='$relasi_hubungan',relasi_telepon='$relasi_telepon'
													 where id = '$id'");
													 exit;*/
	mysql_query("update t_ijin set nip='$nip',tanggal='$tanggal',keperluan='$keperluan',
									relasi_nama='$relasi_nama',relasi_alamat='$relasi_alamat',jenis_ijin='$jenis_ijin',
									relasi_hubungan='$relasi_hubungan',relasi_telepon='$relasi_telepon'
													 where id = '$id'")or die(mysql_error());
						header("location:index.php?mod=ijin&ijin=ijin_harian");
						break;
	case "hapus"	: mysql_query("delete from t_ijin where id = '$id'");
						header("location:index.php?mod=ijin");
						break;	
  }
  
?>