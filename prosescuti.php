<?
  include "config/koneksi.php";
  $aksi = $_GET[aksi];
  $id = $_POST[id];
  $nip = $_POST[nip];
  $tanggal_awal = date("Y-m-d",mktime(0,0,0,$_POST[bulan_awal],$_POST[tanggal_awal],$_POST[tahun_awal]));
  //$tanggal_akhir = date("Y-m-d",mktime(0,0,0,$_POST[bulan_akhir],$_POST[tanggal_akhir],$_POST[tahun_akhir]));
  
  $tanggal_akhir = date('Y-m-d', mktime(0,0,0, $_POST[bulan_awal], $_POST[tanggal_awal] + $_POST[lama_cuti], $_POST[tahun_awal]));
  
  $t_insert1 = $tanggal_awal." ". date('H:i:s');
  $t_insert2 = $tanggal_akhir." ". date('H:i:s');
  
  $tanggal_masuk = date("Y-m-d",mktime(0,0,0,$_POST[bulan_masuk],$_POST[tanggal_masuk],$_POST[tahun_masuk]));
  $keperluan = $_POST[keperluan];
  $relasi_nama = $_POST[relasi_nama];
  $relasi_telepon = $_POST[relasi_telepon];
  $relasi_hubungan = $_POST[relasi_hubungan];
  $nip_pengganti = $_POST[nip_pengganti];
  $tahunan = "tahunan";
  $tahun = date("Y");
  
  $qjumlahcuti = mysql_query("SELECT nip,sum(Datediff(tanggal_akhir,tanggal_awal)+1) as jumlah FROM `t_cuti`
								where nip = '$nip' group by nip");
  $tjum = mysql_fetch_array($qjumlahcuti);

  $tgl1 = date("d",mktime(0,0,0,$_POST[bulan_awal],$_POST[tanggal_awal],$_POST[tahun_awal]));
  $tgl2 = date("d",mktime(0,0,0,$_POST[bulan_akhir],$_POST[tanggal_akhir],$_POST[tahun_akhir]));
  
  
  $t1 = $_POST['bulan_awal']."".$_POST['tanggal_awal'];
  $t2 = $_POST['bulan_akhir']."".$_POST['tanggal_akhir'];
  
  $sql = mysql_query("SELECT DATEDIFF('$tanggal_akhir', '$tanggal_awal') as selisih")or die (mysql_error());
  $date_selisih = mysql_fetch_array($sql);
 
  
  $jumtgl = $tgl2-$tgl1;
  
 
		  
   
  $sql = mysql_query("SELECT sum(sisa) as sisa, jenis_cuti FROM t_cuti WHERE nip='$nip' group by nip")or die(mysql_error());
  $cek = mysql_fetch_array($sql);
  $s = $cek['sisa'];
					    if(empty($s)){
		  					$sel = 8 - $date_selisih['selisih'];
						}else{
					        $sel = $s - $date_selisih['selisih']-1;
						}	

  
  switch ($aksi)
  {
case "tambah"	: 
//if ($date_selisih['selisih'] > 12){
  //    header("location:index.php?mod=cuti&cuti=cuti_tahunan&aksi=tambah&err='Waktu Cuti melebihi batas'");
//}else
//if($t2<$t1){
  	//header("location:index.php?mod=cuti&cuti=cuti_tahunan&aksi=tambah&err='Invalid Tanggal'");
//}else{
	
if($_POST['lama_cuti']==""){
  header("location:index.php?mod=cuti&cuti=cuti_tahunan&aksi=tambah&err='Maaf, Karyawan dengan Nip $nip tidak bisa mengambil Cuti'");
}elseif($cek['jenis_cuti']=="hamil"){
		header("location:index.php?mod=cuti&cuti=cuti_tahunan&aksi=tambah&err='Anda tidak bisa cuti dikarenakan sudah mengambil cuti hamil'");

	
	}else{
		
		$lama_cuti = $_POST[lama_cuti];
				mysql_query("insert into t_cuti(nip,tanggal_awal,tanggal_akhir,keperluan,relasi_nama,relasi_telepon,
									relasi_hubungan,nip_pengganti,sisa,jenis_cuti)
									values('$nip','$t_insert1','$t_insert2','$keperluan','$relasi_nama','$relasi_telepon',
									'$relasi_hubungan','$nip_pengganti','$lama_cuti','$tahunan')")or die(mysql_error());
						header("location:index.php?mod=cuti");		
		}
//print_r($_POST);exit;
/*if(!empty($cek)){
$lama_cuti = $s - $_POST[lama_cuti];
	}else{
						 
						mysql_query("insert into t_cuti(nip,tanggal_awal,tanggal_akhir,keperluan,relasi_nama,relasi_telepon,
									relasi_hubungan,nip_pengganti,sisa,jenis_cuti)
									values('$nip','$t_insert1','$t_insert2','$keperluan','$relasi_nama','$relasi_telepon',
									'$relasi_hubungan','$nip_pengganti','$lama_cuti','$tahunan')")or die(mysql_error());
						header("location:index.php?mod=cuti");
		 }
 }else{
	 $lama_cuti = 7 - $_POST[lama_cuti];
						mysql_query("insert into t_cuti(nip,tanggal_awal,tanggal_akhir,keperluan,relasi_nama,relasi_telepon,
									relasi_hubungan,nip_pengganti,sisa,jenis_cuti)
									values('$nip','$t_insert1','$t_insert2','$keperluan','$relasi_nama','$relasi_telepon',
									'$relasi_hubungan','$nip_pengganti','$lama_cuti','$tahunan')")or die(mysql_error());
								
						header("location:index.php?mod=cuti"); 
// }
		
}
*/		break;
  	case "ubah"		: mysql_query("update t_cuti set nip = '$nip',
													 keperluan = '$keperluan',
													 relasi_nama = '$relasi_nama',relasi_telepon='$relasi_telepon',
													 relasi_hubungan='$relasi_hubungan',nip_pengganti='$relasi_pengganti'
													 where id = $id");
						header("location:index.php?mod=cuti");
						break;
	case "hapus"	: mysql_query("delete from t_cuti where id = $id");
						header("location:index.php?mod=cuti");
						break;	
 
  }
 
?>