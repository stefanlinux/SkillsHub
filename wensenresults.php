<?php
require_once 'core/init.php';
$user = new User();
$u = $_GET['u'];
if ($user->isLoggedIn()) {	
//    include ("include/clsDatabase.php");
$skill = $_GET['skill'];
$user = $_GET['user'];
$whitesmoke = 1;
$skillslist = array();


 // $data = $rs->dataOpvragen("SELECT * FROM `projects` WHERE skillid='$skill' ");
// $sql = "SELECT projectskills.id as id, skills.skill as skill, projectskills.lvl as lvl FROM projectskills, skills WHERE projectskills.projectid='$projectid' AND projectskills.skillid = skills.id";
// $sql = "SELECT * FROM projects";
// $data = $rs->dataOpvragen($sql);

$sql = "SELECT * FROM `projectskills` WHERE skillid='$skill'";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
		if($rij->usersid == $user) {
			array_push($skillslist, $rij->skill);
		}
	}

	$d = $_GET["d"]; 
    
    
	if ($d == "-") {
		 $sql = "SELECT * FROM skills";
         $data = DB::getInstance()->query($sql);
	}

	else if ($d == "Admin: skills verwijderen") {
		 $sql = "SELECT * FROM skills ";
         $data = DB::getInstance()->query($sql);
		unset($skillslist);
		$skillslist = array();

	} else {
		 $sql = "SELECT * FROM `projectskills` WHERE skillid='$skill'";
         $data = DB::getInstance()->query($sql);
	}

	if (!empty($data)) {
		
		foreach ($data->results() as $rij) {
		
			//if (in_array($rij["id"], $skillslist, true)) {echo "test-check";}
			//else {			
				echo "<div class=\"listitem2 listitem3 ";
				if ($whitesmoke == 0) {
					echo "whitesmoke";
					$whitesmoke = 1;
				}
				else {
					$whitesmoke = 0;
				}

				echo "\">";
				echo "<p>" . $rij->skill . "</p>";
				
                if (isset($_GET["admin"]) == false) {
					echo "<a href=\"addskill.php?t=" . $rij->id . "&u=" . $user . "&lvl=2\" class=\"edit\">professioneel</a><a href=\"addskill.php?t=" . $rij->id  . "&u=" . $user . "&lvl=1\" class=\"edit\">basis</a><a href=\"addskill.php?t=" . $rij->id  . "&u=" . $user . "&lvl=0\" class=\"edit\">ontwikkel</a><p class=\"edit\">Skill toevoegen als:</p></div>";
				}

				if (isset($_GET["admin"]) == true) {	
					echo "<a href=\"deleteskill.php?t=" . $rij->id . "&u=" . $user  . "\" class=\"edit\">Verwijderen</a></div>";
				}
			//}	
		}
	}
	else {
		echo "<div class=\"listitem2 listitem3\"><p>Nog geen skills in dit vakgebied aanwezig</p></div>";
	}
	//var_dump($data);
?>