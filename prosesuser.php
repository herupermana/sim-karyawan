<?
   include "config/koneksi.php";
   $aksi = $_GET[aksi];
   $nama_user = $_POST[nama_user];
   $kata_kunci = $_POST[kata_kunci];
   $nama = $_POST[nama];
   $bagian = $_POST[bagian]; 
   
   switch ($aksi)
   {
      case "tambah"		: mysql_query("insert into mst_user(nama_user,kata_kunci,nama,bagian) values ('$nama_user','$kata_kunci','$nama','$bagian')");
	  					  header("location:index.php?mod=user");
						  break;
      case "ubah"		: mysql_query("update mst_user set nama_user = '$nama_user',kata_kunci='$kata_kunci',nama='$nama',bagian='$bagian' 
	  									where nama_user = '$nama_user' ");
	  					  header("location:index.php?mod=user");
						  break;
      case "hapus"		: mysql_query("delete from mst_user where nama_user = '$nama_user'");
	  					  header("location:index.php?mod=user");
						  break;
  	}					  
?>