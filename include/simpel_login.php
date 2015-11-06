<?php
//session werkt als volgt
session_start();
if (isset($_SESSION["login"])) { }
else {
	$array = array();
	$_SESSION['user'] = '0';
	$_SESSION['array'] = $array;
	/*$_SESSION['user']='round';*/
	/* echo "<meta http-equiv=\"refresh\" content=\"0;url=home.html\"  >"; */
}
?>