<?
   session_start();
   include "config/koneksi.php";
   $nama_user = $_POST[nama_user];
   $kata_kunci = $_POST[kata_kunci];
   $q = mysql_query("select * from mst_user where nama_user = '$nama_user' and kata_kunci='$kata_kunci'")or die(mysql_error());
   $ada = mysql_num_rows($q);
   if ($ada > 0)
   {
       $t = mysql_fetch_array($q);
       $_SESSION[diahuser] = $t[nama_user];
	   $_SESSION[diahpassword] = $t[kata_kunci];
	   $_SESSION[diahnama] = $t[nama];
	   $_SESSION[bagian] = $t[bagian];
	   
	   header("location:index.php");
   } else
   {
       header("location:login.php");
   }
?>