<?php

	require_once 'core/init.php';
	$project = $_GET['p'];

$sql = "SELECT projectskills.projectid as projectid, projectskills.skillid as skillid, skills.skill as skill FROM `projectskills`, `skills` WHERE projectskills.skillid = skills.id";
$data = DB::getInstance()->query($sql);
	$whitesmoke = 1;
	$skillslist = array();
foreach ($data->results() as $rij) {
		if($rij->projectid == $project) {
			array_push($skillslist, $rij->skillid);
		}
	}

	$d = $_GET["d"];
	if($d == "-") {
        $sql = "SELECT * FROM `skills` ";
		$data = DB::getInstance()->query($sql);
	}
	else if($d == "Admin: skills verwijderen") {
        $sql = "SELECT * FROM `skills` ";
		$data = DB::getInstance()->query($sql);
		unset($skillslist);
		$skillslist = array();
	}
	else {
        $sql = "SELECT * FROM `skills` WHERE divisie='$d'";
		$data = DB::getInstance()->query($sql);
	}
	if(!empty($data)) {
		
		foreach ($data->results() as $rij) {
		
			//if (in_array($rij["id"], $skillslist, true)) {}     LET OP UITEGEZET MAAR LEGE FUNCTIE???
			
				echo "<div class=\"listitem2 listitem3 ";
				if($whitesmoke == 0) {
					echo "whitesmoke";
					$whitesmoke = 1;
				}
				else {
					$whitesmoke = 0;
				}
				echo "\">";
				echo "<p>" . $rij->skill . "</p>";
				if (isset($_GET["admin"]) == false) {
					echo "<a href=\"addprojectskill.php?t=" . $rij->id  . "&lvl=2&p=". $_GET["p"] . "\" class=\"edit\">professioneel</a><a href=\"addprojectskill.php?t=" . $rij->id  . "&lvl=1&p=". $_GET["p"]."\" class=\"edit\">basis</a><a href=\"addprojectskill.php?t=" . $rij->id  . "&lvl=0&p=". $_GET["p"]."\" class=\"edit\">ontwikkel</a><p class=\"edit\">Skill toevoegen als:</p></div>";
				}
				if (isset($_GET["admin"]) == true) {
					echo "<a href=\"deleteskill.php?t=" . $rij->id  . "\" class=\"edit\">Verwijderen</a></div>";
				}
				
		}
	}
	else {
		echo "<div class=\"listitem2 listitem3\"><p>Nog geen skills in dit vakgebied aanwezig</p></div>";
	}
?>