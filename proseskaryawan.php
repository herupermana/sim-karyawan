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
  $gaji = $_POST[gaji];
  $id_golongan = $_POST[golongan];
  $jenis_kelamin = $_POST[jenis_kelamin];
  $lokasi = $_FILES[photo][tmp_name];
  $photo = $_FILES[photo][name];
  $password = $_POST[password];
  if($jenis_kelamin == "Pria"){
	  $jns = 1;
	  }else{
		  $jns = 2;
		  }
		  
		  	$M = "SELECT max(id) as maxId FROM mst_karyawan";
			$qM = mysql_query($M);
			$tM = mysql_fetch_array($qM);
		
		$nilai = $tM['maxId'];	
		
		$sql = mysql_query("SELECT * FROM mst_karyawan WHERE id='$nilai'")or die(mysql_error());
		$result = mysql_fetch_array($sql);
		
		$noUrut = (int) substr($result['nip'], 18, 21);
		$noUrut++;
		
		

if(empty($result)){
  $newKode = $_POST[tahun]."".$_POST[bulan]."".$_POST[tanggal]."-".date('Y')."".date('m')."-".$jns."-001";
}else{
  $newKode = $_POST[tahun]."".$_POST[bulan]."".$_POST[tanggal]."-".date('Y')."".date('m')."-".$jns."-".sprintf("%03s", $noUrut);
	}
 // print_r($newKode);
  //exit;
  switch ($aksi)
  {
  	case "tambah"	:
					/*if(strlen($nip)<8){ 
						header("location:index.php?mod=karyawan&aksi=tambah&err='NIP tidak boleh kurang dari 8 digit'");
					}else*/
					if (!empty($nip) or !empty($nama_lengkap) or !empty($alamat_ktp))
  					{
						if (!empty($lokasi)){
						move_uploaded_file($lokasi,"images/$photo");
							mysql_query("insert into mst_karyawan(nip,nama_lengkap,tempat_lahir,tanggal_lahir,jenis_kelamin,alamat_ktp,
							alamat_domisili,telp_hp, agama,pendidikan, status, jumlah_keluarga, alamat_email,kode_jab,id_golongan,photo)
							values('$newKode','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin',
							'$alamat_ktp','$alamat_domisili','$telp_hp',
							'$agama','$pendidikan','$status','$jumlah','$alamat_email','$kode_jab','$id_golongan','$photo')")or die(mysql_error());
						}else{
							mysql_query("insert into mst_karyawan(nip,nama_lengkap,tempat_lahir,tanggal_lahir,jenis_kelamin,alamat_ktp,
						    alamat_domisili,telp_hp, agama,pendidikan, status,jumlah_keluarga,alamat_email,kode_jab,id_golongan)
							values('$newKode','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin',
							'$alamat_ktp','$alamat_domisili','$telp_hp',
							'$agama','$pendidikan','$status','$jumlah','$alamat_email','$kode_jab','$id_golongan')")or die(mysql_error());
							}
							
							mysql_query("INSERT INTO mst_user VALUES('$newKode','$password', '$nama_lengkap', 'karyawan')");
						header("location:index.php?mod=karyawan");
					} else
					{
					     header("location:index.php?mod=karyawan&aksi=tambah&err='NIP, Nama dan Alamat Harus di isi'");

					}
						break;
  	case "ubah"		: 
					if(!empty($photo)){	
					move_uploaded_file($lokasi,"images/$photo");
						mysql_query("update mst_karyawan set nama_lengkap='$nama_lengkap',tempat_lahir = '$tempat_lahir',
								tanggal_lahir = '$tanggal_lahir',jenis_kelamin='$jenis_kelamin',
								alamat_ktp = '$alamat_ktp',alamat_domisili='$alamat_domisili' ,telp_hp = '$telp_hp',
								agama = '$agama',pendidikan='$pendidikan', jumlah_keluarga='$jumlah',status='$status',alamat_email='$alamat_email',kode_jab = '$kode_jab',id_golongan = '$id_golongan',photo='$photo'
								where nip = '$nip'");
					}else{
							mysql_query("update mst_karyawan set nama_lengkap='$nama_lengkap',tempat_lahir = '$tempat_lahir',
								tanggal_lahir = '$tanggal_lahir',jenis_kelamin='$jenis_kelamin',
								alamat_ktp = '$alamat_ktp',alamat_domisili='$alamat_domisili' ,telp_hp = '$telp_hp',
								agama = '$agama',pendidikan='$pendidikan', jumlah_keluarga='$jumlah',status='$status',alamat_email='$alamat_email',kode_jab = '$kode_jab',id_golongan = '$id_golongan'
								where nip = '$nip'")or die(mysql_error());
					}
					if(!empty($password)){
						mysql_query("UPDATE mst_user SET password='$password', nama='$nama_lengkap' WHERE nip='$nip'");
						}
						header("location:index.php?mod=karyawan");
						break;
	case "hapus"	: mysql_query("delete from mst_karyawan where nip = '$nip'");
						header("location:index.php?mod=karyawan");
						break;	
  }
?>