<?

	function total_jam($time)
	{
		foreach ($time as $jm)
		{
    		list($jam,$men) = explode(":",$jm);
			$jumjam = $jumjam+$jam;
			$jummen = $jummen+$men;		
		}
		$jummen = round($jummen/60);
		$jumjam = round($jumjam+$jummen);
		return "$jumjam:$jummen";
	}
	
   function jumlah_jam($time1,$time2)
   {
   		$time1_unix = strtotime(date('Y-m-d').' '.$time1.':00');
		$time2_unix = strtotime(date('Y-m-d').' '.$time2.':00');

		$begin_day_unix = strtotime(date('Y-m-d').' 00:00:00');

		$jumlah_time = date('H:i', ($time1_unix + ($time2_unix - $begin_day_unix)));
		return $jumlah_time;
   }
   
   function selisih_jam($awal,$akhir)
   {
      list($h,$m,$s) = explode(":",$awal);
	  $dtawal = mktime($h,$m,$s,"1","1","1");
      list($h,$m,$s) = explode(":",$akhir);
	  $dtakhir = mktime($h,$m,$s,"1","1","1");
	  $dtselisih = $dtakhir-$dtawal;
	  
	  $totalmenit = $dtselisih/60;
	  
	  $jam = explode(".",$totalmenit/60);
	  $sisamenit = ($totalmenit/60)-$jam[0];
	  $sisamenit2 = $sisamenit*60;
	  
	  return "$jam[0]:$sisamenit2";
   }

   function ambilbulan($bln)
   {
       $namabulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
	   return $namabulan[$bln-1];
   }
   
  function tgl_indonesia($tanggal)
  {  
  	 $tgl = substr($tanggal,8,2);
	 $bln = get_bulan(substr($tanggal,5,2));
	 $thn = substr($tanggal,0,4);
	 return $tgl." ".$bln." ".$thn;
  }
  function tgl_indo($tanggal){
  	 $tgl = substr($tanggal,8,2);
	 $bln = substr($tanggal,5,2);
	 $thn = substr($tanggal,0,4);
	 return $tgl."-".$bln."-".$thn;
  }
  
  function ambil_tanggal($tanggal)
  {
  	 $tgl = substr($tanggal,8,2);
	 return $tgl;  
  }

  function ambil_bulan($tanggal)
  {
  	 $tgl = substr($tanggal,5,2);
	 return $tgl;  
  }

  function ambil_tahun($tanggal)
  {
  	 $tgl = substr($tanggal,0,4);
	 return $tgl;  
  }
  
  function nama_hari($hr)
  {
     $nm = explode("/","Minggu/Senin/Selasa/Rabu/Kamis/Jumat/Sabtu");
	 return $nm[$hr];
  }
  
  function get_bulan($bln)
  {
  	switch($bln)
	{
  	 case 1:
	 	return "Januari";
	 break;
	 case 2:
	 	return "Februari";
	 break;
	 case 3:
	 	return "Maret";
	 break;
	 case 4:
	 	return "April";
	 break;
	 case 5:
	 	return "Mei";
	 break;
	 case 6:
	 	return "Juni";
	 break;
	 case 7:
	 	return "Juli";
	 break;
	 case 8:
	 	return "Agustus";
	 break;
	 case 9:
	 	return "September";
	 break;
	 case 10:
	 	return "Oktober";
	 break;
	 case 11:
	 	return "November";
	 break;
	 case 12:
	 	return "Desember";
	 break;
	 }
  }
   
?>