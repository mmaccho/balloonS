<?php
//Thanks to: TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
if (isset($_GET["pic"])) {
	$pic = strip_tags($_GET["pic"]);
	
	if ( (is_numeric($pic)) && ($pic >= 0) ) {
		require_once "gpio_pinout.php";	
		system("gpio mode ".$pinout_array[$pic]." out");
		exec ("gpio read ".$pinout_array[$pic], $status, $return );
		if ($status[0] == "0" ) { $status[0] = "1"; }
		else if ($status[0] == "1" ) { $status[0] = "0"; }
		system("gpio write ".$pinout_array[$pic]." ".$status[0] );
		exec ("gpio read ".$pinout_array[$pic], $status, $return);
		echo($status[0]);
		
	}
	else { echo ("fail"); }
}
else { echo ("fail"); }
?>