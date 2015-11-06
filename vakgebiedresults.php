<?php
	include("include/simpel_login2.php");
	
	$user = $_SESSION['user'];
	include ("include/clsDatabase.php");
	$data = $rs->dataOpvragen("SELECT * FROM `vakgebieden` ORDER BY `vakgebied`");
	$whitesmoke = 1;

	foreach ($data as $rij) {
		echo "<div class=\"listitem2 listitem3 ";
		if($whitesmoke == 0) {
			echo "whitesmoke";
			$whitesmoke = 1;
		}
		else {
			$whitesmoke = 0;
		}
		echo "\">";
		echo "<p>" . $rij["vakgebied"] . "</p>";
		if (isset($_SESSION['user']) == "Admin") {
			echo "<a href=\"deletevakgebied.php?v=" . $rij["id"]  . "\" class=\"edit\">Verwijderen</a>";
		}
		echo "</div>";
	}
?>