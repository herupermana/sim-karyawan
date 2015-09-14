<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
.categoryitems{display: none}
</style><style type="text/css">
.subcategoryitems{display: none}
</style>

<style type="text/css">

.arrowlistmenu{
width: 150px; /*width of accordion menu*/
}

.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
	color: white;
	background: black url(images/application/ddaccordionmenu-bullet_files/titlebar.png) repeat-x center left;
	margin-bottom: 10px;
	padding: 4px 0 4px 10px; /*header text is indented 10px*/
	cursor: hand;
	cursor: pointer;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
background-image: url(images/application/ddaccordionmenu-bullet_files/titlebar-active.png);
}

.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
list-style-type: none;
list-style-image: none;
margin: 0;
padding: 0;
margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}

.arrowlistmenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.arrowlistmenu ul li a{
	color: #333333;
	border-right: 1px solid #778;
	background: url(images/application/ddaccordionmenu-bullet_files/arrowbullet.png) no-repeat center left; /*custom bullet list image*/
	display: block;
	padding: 2px 0;
	padding-left: 19px; /*link text is indented 19px*/
	text-decoration: none;
	border-bottom: 1px solid #dadada;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}

.arrowlistmenu ul li a:visited{
color: #333333;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
color: #333333;
background-color: #F3F3F3;
}

.arrowlistmenu ul li .opensubheader{ /*Open state CSS for sub menu header*/
background: lightblue !important;
}

.arrowlistmenu ul li .closedsubheader{ /*Closed state CSS for sub menu header*/
background: lightgreen !important;
}

.arrowlistmenu ul li a.subexpandable:hover{ /*hover state CSS for sub menu header*/
background: lightblue;
}

</style>

</head>

<body>
<h3 headerindex="0h" class="menuheader expandable"><span class="accordprefix"></span>Mahasiswa &raquo;<span class="accordsuffix"></span></h3>
<ul style="display: none;" contentindex="0c" class="categoryitems">
<li>
	<div id="menu">

			<ul>
			  <li>
				<ul>
				  
				  <li><a href="#">Kalender Akademik &raquo;</a>
						<ul>
							<li><a href="#">Kelas Reguler</a>
								<ul>
							<li><a href="images/index.php?mod=mahasiswa&amp;func=0070&amp;k=reguler">Semua Semester</a></li>
							<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Ganjil&amp;k=reguler">Semester Ganjil</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Genap&amp;k=reguler">Semester Genap</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Pendek&amp;k=reguler">Semester Pendek</a></li>
								</ul>
							</li>
							<li><a href="#">Kelas Karyawan</a>
								<ul>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0070&amp;k=karyawan">Semua Semester</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Ganjil&amp;k=karyawan">Semester Ganjil</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Genap&amp;k=karyawan">Semester Genap</a></li>
								</ul>
							</li>
							<li><a href="#">Kelas Eksekutif</a>
								<ul>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0070&amp;k=eksekutif">Semua Semester</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Ganjil&amp;k=eksekutif">Semester Ganjil</a></li>
								<li><a href="images/index.php?mod=mahasiswa&amp;func=0071&amp;x=Genap&amp;k=eksekutif">Semester Genap</a></li>
								</ul>
							</li>
						</ul>
				  </li>
				  
				</ul>
			  </li>
			</ul>							
		</div>
</li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0003">Daftar Matakuliah</a></li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0009">Jadwal</a></li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0004">Pengisian KRS</a></li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0002">Nilai Matakuliah</a></li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0005">Transkrip</a></li>
<li><a href="#">Keuangan</a></li>
<li><a href="images/index.php?mod=mahasiswa&amp;func=0001">Absen Mahasiswa</a></li>

</body>
</html>
