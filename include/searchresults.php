<?php 
	include ("include/clsDatabase.php");
	$rs = new clsDatabase();
	$rs->kiesDB("skillshub");
	$data = $rs->dataOpvragen("SELECT * FROM `users` ");
	foreach($data as $rij) {
		echo $rij["naam"] . " " . $rij["tussenvoegsel"] . " " . $rij["achternaam"] . "<br />";
	}
?>