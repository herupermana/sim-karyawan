<?

   include "config/fungsi.php";
   
	$time[] = '10:50';
    $time[] = '20:50';
    $time[] = '30:40';
    $time[] = '40:20';
	
	foreach ($time as $jm)
	{
    	list($jam,$men) = explode(":",$jm);
		echo $jam.":".$men."<br>";
		$jumjam = $jumjam+$jam;
		$jummen = $jummen+$men;		
	}
	$jummen = round($jummen/60);
	$jumjam = round($jumjam+$jummen);
	echo $jumjam."<br>".$jummen;
	

?>