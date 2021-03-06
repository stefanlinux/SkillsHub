<?php
error_reporting(0);
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
include("include/global-header-project.php");
include ("include/menu.php");
include ("fancybox.js");


$n=$_GET["n"];
$userid = Session::get(Config::get('session/session_name'));
$data = Project::get_project($n);//var_dump($datatest);


//$sql = "SELECT * FROM `projects` WHERE id='$n'";
//$data = DB::getInstance()->query($sql);
if ($data != "") {
    foreach ($data->results() as $rij) {
	$projectname = $rij->naam;
	$omschrijving = $rij->omschrijving;
	$evaluatie = $rij->evaluatie;
	$skills = $rij->skills;
	$startdatum = $rij->startdatum;
	$einddatum = $rij->einddatum;
	$opdrachtgever = $rij->opdrachtgever;
	$leider = $rij->projectleider;
	$status = $rij->status;
	$projectid = $rij->id;
	
	if ($rij->projectleider == $userid) {
	    $projectleider = "yes";
	} else {
	    $projectleider = "no";
	}
	
	if ($status == 0) {
	    $status = "lopend";
	} else if ($status == 1) {
	    $status = "afgerond";
	} else {
	    $status = "aankomend";	
	}
    }
}

//$data2 = $rs->dataOpvragen("SELECT `projects`.`id`, `projects`.`naam`, `projects`.`omschrijving`, `projects`.`evaluatie`, `projects`.`startdatum`, `projects`.`einddatum`, `markt`.`opdrachtgever`, `projects`.`projectleider`, `projects`.`status` FROM `projects`, `markt` WHERE `projects`.`id`='$n' AND `projects`.`bedrijf` = `markt`.`id`");
$sql = "SELECT `projects`.`bedrijf`, `markt`.`opdrachtgever` as opdrachtgever FROM `projects`, `markt` WHERE `projects`.`bedrijf`='$opdrachtgever' AND `projects`.`bedrijf` = `markt`.`id`";

$data2  = DB ::getInstance()->query($sql);

$opdrachtgever2 = "";

if($data2 != "") {
    foreach ($data2->results() as $rij2) {
	$opdrachtgever2 = $rij2->opdrachtgever;
    }
}
echo "<div class=\"projectnaam\">" . $projectname . "</div>";
echo "<div class=\"projectopdrachtgever\"><a href=\"opdrachtgever/" . $opdrachtgever . "\">" . $opdrachtgever . "</a></div>";
echo "<div class=\"projectstatus\">Status: " . $status . "</div>";

$sql = "SELECT * FROM `projectsusers` WHERE `usersid`='$userid' AND projectid='$n'";
$data = DB::getInstance()->query($sql);
echo '<div class="connectstatus">';
if($data == "")	{
    echo  "<a class=\"button projectbtn\" href=\"addproject.php?n=" . $n .   "&u=" . $userid . "&a=2" .  " \"> Aanmelden voor project</a> <br/><br/>";
} else {
    foreach ($data->results() as $rij) {
	if($rij->accept == "1") {
	    echo "<a class=\"button projectbtn\" href=\"removeuserfromproject.php?id=" . $rij->id ."  \">aanvraag intrekken</a>";
	    echo "<label class=\"project\">aangevraagd</label>";
	}
	else if($rij->accept == "2") {
	    echo "<a class=\"button projectbtn\" href=\"removeuserfromproject.php?id=" . $rij->id ."  \">weigeren</a>";
	    echo "<a class=\"button projectbtn\" href=\"acceptuserinproject.php?id=" . $rij->id ."  \">accepteren</a> ";
	    echo "<label class=\"project\">Je bent uitgenodigd</label>";
	}
	else {
	    if($projectleider == "no") {
		echo "<label class=\"project\">Je zit in het project</label>";
	    }
	}
    }
}
echo '</div>';




if (file_exists("img/projectpic/" . $projectid . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox profielpic projectpic\" href=\"img/projectpic/" . $projectid . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/projectpic/" . $projectid . ".jpg\"></a>";
}
else
{
    echo "<a class=\"fancybox profielpic projectpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
}
if ($projectleider == "yes")
{
    echo '<div class="connectstatus">';
    echo "<a class=\"button projectbtn\" href=\"projectbewerken.php?p=" . $projectid . "\">Project bewerken</a> ";
    echo '</div>';
}
elseif ($user->hasPermission('admin')) 
{
    echo '<div style="margin-top: -1px" class="connectstatus">';
    echo "<a class=\"button projectbtn\" href=\"projectbewerken.php?p=" . $projectid . "\">Project bewerken als admin</a> ";
    echo '</div>';
}
echo '<div class="projectbanner">';
if (file_exists("img/projectbanner/" . $projectid . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox\" href=\"img/projectbanner/" . $projectid . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/projectbanner/" . $projectid . ".jpg\" \></a>";
}
else
{
    echo "<a class=\"fancybox\" href=\"img/noimage.jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/noimage.jpg\" \></a>";
}
echo '</div>';
echo '<div class="projectcontent">';
if($omschrijving != "")
{
    echo '<div class="omschrijving"><h3>Omschrijving</h3>' . $omschrijving . '</div>';
}
if($status == "afgerond")
{
    if($evaluatie != "")
    {
	echo '<div class="omschrijving"><h3>Evaluatie</h3>' . $evaluatie . '</div><br />';
    }
}

echo '<div class="media">';

$sql = "SELECT * FROM `projects` WHERE `projectleider` = '" .$userid. "' ";
$data = DB::getInstance()->query($sql);

$arrayprojectsusers = array();
if ($data != "")
{
    foreach($data->results() as $rij)
    {
        echo $rij->omschrijving;
	array_push($arrayprojectsusers,$rij->naam);
    }
}

$sql = "SELECT * FROM `media` WHERE project='$n' ";
$data = DB::getInstance()->query($sql);
if($data != "")
{
    
    foreach ($data->results() as $rij) 
    {
	echo '<div class="images">';
	echo '<a class="fancybox media" href="data:image/jpeg;base64,' . base64_encode($rij->image)  . '"data-fancybox-group="media" >';
	echo '<img class="media radius2" src="data:image/jpeg;base64,' . base64_encode($rij->image) . '" width="auto" height="90">'; 
	echo '</a>';
	if (in_array($n, $arrayprojectsusers) OR $_SESSION["accounttype"] == 2) {
	    echo '<a href="deletemedia.php?id=' . $rij->id . '&&n=' . $rij->project . '"><div class="delete">X</div></a>';
	}
	echo '</div>';
    }
}

//note		if (in_array($n, $arrayprojectsusers) OR $_SESSION["accounttype"] == 2)
if (in_array($n, $arrayprojectsusers) ) //not accouttype
{
?>
    <script type="text/javascript">
    function Checkfiles(f){
	f = f.elements;
	if(/.*\.(png)|(jpeg)|(jpg))$/.test(f['filename'].value.toLowerCase()))
	    return true;
	alert('Upload alstublieft alleen Jpg of Png afbeeldingen.');
	f['filename'].focus();
	return false;
    };
    </script>
    <div class="uploadform">
	<form enctype="multipart/form-data" action="insert.php?n=<?php echo $n; ?>" method="post" name="changer" onsubmit="return Checkfiles(this);">
	    <input name="MAX_FILE_SIZE" value="10240000" type="hidden">
	    <script>
	    function getFile(){
		document.getElementById("fileup").click();
	    }
	    </script>
	    <div class="uploadbtn" onclick="getFile()">+</div>
	    <input style="height: 35px; display:block;" class="button" value="Uploaden" type="submit">
	    <div style="height: 30px; margin: 0px 0px 0px 0px; display:block; float: left;"><input name="image" id="fileup" accept="image/jpeg,image/png" type="file"></div>
	</form>
    </div>
<?php
}

echo '</div>';

echo '</div>';

?>



<div class="content-left">

    <div class="list peoplelist shadow">
	<div class="title radius">
	    <img src="img/icon_person.png" height="30" /><p>Projectleden</p>
					<?php
					//					if($projectleider == "yes" OR $_SESSION["accounttype"] == 2)
					if($projectleider == "yes" ) // noe accouttype weggehaald
					{
					    echo "<a class=\"edit\" href=\"projectleden.php?p=" . $n  . "\"><img src=\"img/icon_edit.png\"></a>";
					}
					?>
	</div>
	<div class="content">
					<?php 
					$sql = "SELECT * FROM `projectsusers` WHERE projectid='$n' AND accept='3' ";
					$data = DB::getInstance()->query($sql);
					if($data != "") {
					    foreach ($data->results() as $rij) {
						$usersid = $rij->usersid;
						
						$sql = "SELECT * FROM `users` WHERE id='$usersid' ";
						$data2 = DB::getInstance()->query($sql);

						foreach($data2->results() as $rij2) {
						    $naam = $rij2->volledigenaam;
						}
						echo "<div class=\"listitem2\">";
						
						if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) 
						{
						    echo "<a href=\"profiel/" . $rij->usersid . "\">";
						    echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>";
	 					}
	 					else
	 					{
	 					    echo "<a href=\"profiel/" . $rij->id . "\">";
						    echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
	 					}
						//if($projectleider == "yes"  OR $_SESSION["accounttype"] == 2) {
						if ($projectleider == "yes" ) { //note no accouttype
						    if ($rij->usersid != $leider) {
							echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij->id ."  \"> Verwijderen</a>";
						    }
						}
						echo  "<p class=\"omschrijving\">Functie: " . $rij->functie ."<br />Omschrijving: " . $rij->omschrijving  . "</p>";
						echo  "</div>";
					    }
					}
					?>
	</div>
    </div>



    <div class="list skillslist shadow">
	<div class="title radius">
	    <img src="img/icon_skill.png" height="30" /><p>Benodigde skills</p>
					<?php
					//if ($projectleider == "yes" OR $_SESSION["accounttype"] == 2)
					if ($projectleider == "yes" || $user->hasPermission('admin')) // note no accouttype
					{
 echo "<a class=\"edit\" href=\"projectskills.php?p=" . $projectid  . "\"><img src=\"img/icon_edit.png\"></a>";
					}
					?>
	</div>
	<div class="one">
					<?php 
					$sql = "SELECT projectskills.id as id, skills.skill as skill, projectskills.lvl as lvl FROM projectskills, skills WHERE projectskills.projectid='$projectid' AND projectskills.skillid = skills.id";
					$data = DB::getInstance()->query($sql);
					if($data != "") {
					    foreach ($data->results() as $rij) {
						echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem lvl" . $rij->lvl;
						
						
						echo "\">" . $rij->skill; 
						//if($_SESSION["user"] == "Admin") {
						// if ($user->hasPermission('admin')) {
						//    echo "<a class=\"deleteitem\" href=\"deleteprojectskill.php?t=" .  $rij->id. "&p=" . $projectid . "\">x</a>"; 
                                                // } else {
                                                //     echo " noadmin";
                                                // }
                                              
						echo "</div>";
					    }
					}
					?>
	</div>
    </div>
			<?php
                        $projectleider = Session::get(Config::get('session/session_name'));
			$sql = "SELECT * FROM `projects` WHERE projectleider=$projectleider";
			$data = DB::getInstance()->query($sql);
			$arrayprojectsusers = array();
			if ($data != "") {
			    foreach($data->results() as $rij) {
				array_push($arrayprojectsusers,$rij->naam);
			    }
			}
			
			//if (in_array($n, $arrayprojectsusers) OR $_SESSION["accounttype"] == 2) {
//			if (in_array($n, $arrayprojectsusers)) { // note off accouttype
if(true ) { 
			?>
			    <div class="list request shadow">
				<div class="title radius"><img src="img/icon_project-aanvragen.png" height="30" /><p>Projectaanvragen</p>
				</div>
				<div class="content">
						<?php 
						$sql = "SELECT * FROM `projectsusers` WHERE `projectid`='$n' AND `accept`='1' ";
						$data = DB::getInstance()->query($sql);
						if ($data != "")	{
						    foreach ($data->results() as $rij) {
							$usersid = $rij->usersid;

							$sql = "SELECT * FROM `users` WHERE `id`='$usersid' ";
							$data2 = DB::getInstance()->query($sql);

							foreach ($data2 as $rij2) {
							    $naam = $rij2["volledigenaam"];
							}

							echo "<div class=\"listitem2\">";
							if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) {
							    echo "<a href=\"profiel/" . $rij->usersid . "\">";
							    echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
	 						}
	 						else {
		 					    echo "<a href=\"profiel/" . $rij->usersid . "\">";
							    echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
		 					}
							echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij->usersid ."  \">Weigeren</a>";
							echo " <a class=\"edit\" href=\"acceptuserinproject.php?id=" . $rij->usersid ."  \">Accepteren</a>";
							
							echo "</div>";
						    }
						}
						?>
				</div>
			    </div>

			<?php 
}
//if (in_array($n, $arrayprojectsusers)  OR $_SESSION["accounttype"] == 2) note UITGEZET
if (in_array($n, $arrayprojectsusers))
{
		
?>
<div class="list request shadow">
<div class="title radius"><img src="img/icon_project-genodigden.png" height="30" /><p>Genodigden</p>
<?php
	if($projectleider == "yes" OR $_SESSION["accounttype"] == 2) echo "<a class=\"edit\" href=\"uitnodigen/".$n."\"><img src=\"img/icon_add.png\"></img></a>";
?>
</div>
<div class="content">
<?php 
$data = $rs->dataOpvragen("SELECT * FROM `projectsusers` WHERE projectid='$n' AND accept='2' ");
if($data != "")
{
	foreach ($data as $rij) 
	{
		$usersid = $rij['usersid'];
		$data2 = $rs->dataOpvragen("SELECT * FROM `users` WHERE id='$usersid' ");
     	foreach($data2 as $rij2)
	    {
	        $naam = $rij2["volledigenaam"];
	    }
		echo "<div class=\"listitem2\">";
		if (file_exists("img/profilepic/" . $rij['usersid'] . ".jpg")) {
			echo "<a href=\"profiel/" . $rij["usersid"] . "\">";
			echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij['usersid'] . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
 		}
 		else
 		{
	 		echo "<a href=\"profiel/" . $rij["usersid"] . "\">";
			echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
	 	}
			echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij['id'] ."  \">Uitnodiging intrekken</a>";
		
		echo "</div>";
	}
}
?>
</div>
</div>
<?php
	}
?>
</div>

<div class="content-right">

<div class="people shadow">
<div class="title radius">
<img src="img/icon_aanspreekpunten.png" height="30" /><p>Contactpersonen</p>
</div>
	<div class="content">
		<div class="title2 title4"><h4>Projectleider</h4></div>
		<div class="projectleider">
		<?php

	//	$sql = "SELECT * FROM `projects` WHERE `id`='$n' ";
    $sql = "SELECT projectleider FROM projects WHERE id=$n";
		$data = DB::getInstance()->query($sql);

		if ($data != "") {
			foreach ($data->results() as $rij) {
				
				$usrid = intval( $rij->projectleider);
                
                $sql = "SELECT * FROM `users` WHERE `id` =  '".$usrid."'";
                $data2 = DB::getInstance()->query($sql);

			 	foreach ($data2->results() as $rij2) {
                    
                    $userid = $rij2->id;
			    	$naam = $rij2->volledigenaam;
			    		$email = $rij2->email;
					
			    	if ($email == "") {
			    		$email = "-";
			    	}
					
			    	$tel = $rij2->tel;
					
			    	if ($tel == 0) {
			    		$tel = "-";
			    	}
					
			    	$functie = $rij2->functie;

			    	if (file_exists("img/profilepic/" . $rij2->id . ".jpg")) {
						echo "<a href=\"profiel/" . $userid . "\">";
						echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $userid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
			 		}
			 		else {
				 		echo "<a href=\"profiel/" . $usersid . "\">";
						echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
				 	}

				 	echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $email . '</div>';
				 	echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
				 	echo '<div class="contactinfo"><div class="content-left">Functie: </div>' . $functie . '</div>';
				 	
			    }
			}

		}
		?>
		</div>
		<br />
		<div class="title2 title4"><h4>Contactpersoon</h4></div>
		<div class="projectleider">
		<?php
		$sql = "SELECT * FROM `projects` WHERE id='$n'";
		$data = DB::getInstance()->query($sql);
		
		if ($data != "")	{
			foreach ($data->results() as $rij) {
$opdrachtgever = $rij->opdrachtgever;
                            //				$sql = "SELECT opdrachtgevers.voornaam, opdrachtgevers.tussenvoegsel, `opdrachtgevers`.`achternaam`, `opdrachtgevers`.`mail`, `opdrachtgevers`.`tel`, `markt`.`opdrachtgever` FROM `opdrachtgevers`, `markt` WHERE `opdrachtgevers`.`id`='$rij->opdrachtgever' AND `opdrachtgevers`.`opdrachtgever` = `markt`.`oprachtgever`";
                //$opdrachtgever = $rij->opdrachtgever;
                $sql = "SELECT * FROM opdrachtgevers WHERE project_rel ='$n'";

				$data2 = DB::getInstance()->query($sql);

				if($data2 != "") {
				 	foreach ($data2->results() as $rij2) {	
				    	$voornaam = $rij2->voornaam;
				    	$tussenvoegsel = $rij2->tussenvoegsel;
				    	$achternaam = $rij2->achternaam;
				    	$naam = $voornaam . " " . $tussenvoegsel . " " . $achternaam;
				    	$mail = $rij2->email;
						
				    	if ($mail == "") {
				    		$mail = "-";
				    	}
						
				    	$tel = $rij2->tel;
						
				    	if ($tel == 0) {
				    		$tel = "-";
				    	}
						
				    	$opdrachtgever = $rij2->opdrachtgever;
						echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  /><p>" . $naam . "</p></a>" ;
					 	echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $mail . '</div>';
					 	echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
					 	echo '<div class="contactinfo"><div class="content-left">Bedrijf: </div>' . $opdrachtgever . '</div>';
				    }
			    }


                 $sql = "SELECT * FROM contactpersonen WHERE opdrachtgever ='$opdrachtgever'";

				$data2 = DB::getInstance()->query($sql);

				if($data2 != "") {
				 	foreach ($data2->results() as $rij2) {	
				    	$voornaam = $rij2->voornaam;
				    	$tussenvoegsel = $rij2->tussenvoegsel;
				    	$achternaam = $rij2->achternaam;
				    	$naam = $voornaam . " " . $tussenvoegsel . " " . $achternaam;
				    	$mail = $rij2->email;
						
				    	if ($mail == "") {
				    		$mail = "-";
				    	}
						
				    	$tel = $rij2->tel;
						
				    	if ($tel == 0) {
				    		$tel = "-";
				    	}
						
				    	$opdrachtgever = $rij2->opdrachtgever;
						echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  /><p>" . $naam . "</p></a>" ;
					 	echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $mail . '</div>';
					 	echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
					 	echo '<div class="contactinfo"><div class="content-left">Berijf: </div>' . $opdrachtgever . '</div>';
				    }
			    }





                
			}
		}
		?>
		</div>
	</div>
</div>
</div>
</div>
 
<script type="text/javascript">
function menu(){
	$('.navprojecten').addClass('selectedmenu');
}
</script>
</body>
</html>

