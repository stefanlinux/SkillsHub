<?php
//	include("include/simpel_login2.php");
	
$user = $_GET['u'];

	include ("include/clsDatabase.php");
	$data = $rs->dataOpvragen("SELECT * FROM `skillsuserswilleren` ORDER BY skill ASC");
	$whitesmoke = 1;
	$skillslist = array();
	foreach ($data as $rij) {
		if($rij["usersid"] == $user) {
			array_push($skillslist, $rij["skill"]);
		}
	}

	$d = $_GET["d"]; 
	if($d == "-") {
		$data = $rs->dataOpvragen("SELECT * FROM `skills` ORDER BY skill ASC");
	}
	else if($d == "Admin: skills verwijderen") {
		$data = $rs->dataOpvragen("SELECT * FROM `skills` ORDER BY skill ASC");
		unset($skillslist);
		$skillslist = array();
	}
	else {
		$data = $rs->dataOpvragen("SELECT * FROM `skills` WHERE divisie='$d' ORDER BY skill ASC");
        
	}
	if(!empty($data)) {
		
		foreach ($data as $rij) {
		
			//if (in_array($rij["id"], $skillslist, true)) {echo "test-check";}
			//else {			
				echo "<div class=\"listitem2 listitem3 ";
				if($whitesmoke == 0) {
					echo "whitesmoke";
					$whitesmoke = 1;
				}
				else {
					$whitesmoke = 0;
				}
				echo "\">";
                $utfencoded = utf8_encode($rij["skill"]);
                // var_dump($utfencoded);
				//echo "<p>" . $utfencoded . "</p>";
                echo "<p>" . $rij["skill"] . "</p>";
				if (isset($_GET["admin"]) == false) {
					echo "<a href=\"addskillwilleren.php?t=" . $rij["id"] . "&u=" . $user . "&lvl=2\" class=\"edit\">professioneel</a><a href=\"addskillwilleren.php?t=" . $rij["id"]  . "&u=" . $user . "&lvl=1\" class=\"edit\">basis</a><a href=\"addskillwilleren.php?t=" . $rij["id"]  . "&u=" . $user . "&lvl=0\" class=\"edit\">ontwikkel</a><p class=\"edit\">Skill toevoegen als:</p></div>";
				}
				if (isset($_GET["admin"]) == true) {	
					echo "<a href=\"deleteskillwilleren.php?t=" . $rij["id"] . "&u=" . $user  . "\" class=\"edit\">Verwijderen</a></div>";
				}
			//}	
		}
	}
	else {
		echo "<div class=\"listitem2 listitem3\"><p>Nog geen skills in dit vakgebied aanwezig</p></div>";
	}
	//var_dump($data);
?>