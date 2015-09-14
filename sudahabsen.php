<?
	include "config/koneksi.php";
	$nik = $_GET[nik];
	$status = $_GET[status];
	$q = mysql_query("select  * from mst_karyawan where nik = '$nik'");
	$t = mysql_fetch_array($q);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?
   switch ($status)
   {
   		case "masuk" 		: 
							echo "$t[nama] Selesai Mengisi Absen Masuk <a href = 'absen.php'>Klik di sini untuk kembali</a>"; 
							break;
   		case "pulang" 		: 
							echo "$t[nama] Selesai Mengisi Absen Pulang<a href = 'absen.php'>Klik di sini untuk kembali</a>"; 
							break;
   		case "sudah" 		: 
							echo "$t[nama] Sudah Mengisi Absen Masuk dan Pulang tidak bisa isi absen lagi
							<a href = 'absen.php'>Klik di sini untuk kembali</a>"; 
							break;
   }
?>
</body>
</html>
