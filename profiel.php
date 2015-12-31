<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
$u=$_GET["u"];
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
?>
<link rel="stylesheet" href="css/profiel.css" type="text/css" media="screen" />
<script type="text/javascript">
	function menu(){
		$('.navleden').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="selecttab('img2', 'lopend', 'tablopend'), menu()">
<div class="content">
<?php

	$whitesmoke = 1;
    //	$data = $rs->dataOpvragen("SELECT * FROM `projects` "); // let op hier moet selct met projectleider komen !!
    $data = DB::getInstance()->query("SELECT * FROM projects");
	$arrayprojects = array();
	if ($data != "") {
	foreach($data as $rij) {
        //		array_push($arrayprojects,$rij["naam"]);
        echo $rij;
	}
}
?>
<div class="content-left">
<?php
    $data = DB::getInstance()->query("SELECT * FROM users");
	foreach($data->results() as $rij) {
        if ($u == $rij->id) { 		
			$id = $rij->id;
			$username = utf8_encode($rij->username);
			$pass = $rij->password;
			$naam = utf8_encode($rij->name);
			$tussenvoegsel = $rij->tussenvoegsel;
			$achternaam = utf8_encode($rij->achternaam);
			$age = $rij->age;
	 		$adres = $rij->adres;
			$woonplaats = $rij->woonplaats;
			$functie = $rij->functie;
			$beschikbaarheid = $rij->beschikbaarheid;
			$motivatie = $rij->motivatie;
			$leerdoel = $rij->leerdoel;
			$site = $rij->site;
			$adres = $rij->adres;
			$woonplaats = $rij->woonplaats;
			$linkedin = $rij->linkedin;
			$email = $rij->email;
			$tel = $rij->tel;
			$accounttype = $rij->accounttype;
			$status = $rij->status;
            
			if ($accounttype == 0) {
                $accounttype = "Projectlid";
            }
			elseif ($accounttype == 2) {
                $accounttype = "SkillsHub Beheerder";
            } 
			else {
             $accounttype = "Projectleider";   
            }

			if ($status == 0) {
				$status = "Actief";
			} else {
				$status = "Non actief";
			}

			echo "<div class=\"profielinfo shadow\">";
            
			//if ("das" == $rij['accounttype'])	{
				echo "<a class=\"edit2\" href=\"profielbewerken?u=" . $id  . "\"><img src=\"img/icon_edit.png\"></a>";
                //}
			 if ($accounttype  == 2) {	
				echo "<a class=\"edit2\" href=\"profielbewerkenadmin?u=" . $id  . "\"><img src=\"img/icon_edit.png\"></a>";
			}
            
			if (file_exists("img/profilepic/" . $id . ".jpg")) {
				/*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
				echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/" . $id . ".jpg\"></a>";
			}else {
				echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
			}
			echo "<div class=\"profielinfo\"><br /><h5>" . $naam . " " . $tussenvoegsel . " " . $achternaam;
			// if(!empty($age) && $age != 0) echo " (" . $age . ")";
			echo "</h5>";
			echo $functie;
			if(!empty($functie) && !empty($accounttype) && $functie != $accounttype) echo " - " . $accounttype;
			echo "<br /><br />";
			
			echo "<div class=\"block\"><h3>Status<br /></h3>" . $status . "</div>";
			echo "<div class=\"block\"><h3>CV/Website<br /></h3>";
			if(isset($linkedin) && $linkedin != "") echo '<a target="_blank" href="' . $linkedin .'">' . $linkedin .'</a><br />';
			if(isset($site) && $site != "") echo '<a target="_blank" href="http://' . $site .'">' . $site .'</a>';
			echo "</div>";
			echo "<div class=\"block\"><h3>CV/Contact<br /></h3>" . $tel . '<br /><a href="mailto:' . $email .'">' . $email .'</a></div>';
			echo "</div>";
			echo "<div class=\"extrainfo\">";
			if($beschikbaarheid != "") {
				echo "<h3>Beschikbaarheid<br /></h3>" . $beschikbaarheid . "<br />";
			}
			if($motivatie != "") {
				if($beschikbaarheid != "") {
					echo "<br />";
				}
				echo "<h3>Motivatie<br /></h3>" . $motivatie;
			}
	 		echo "</div></div>";
			break; 
		}
}	 

if(isset($leerdoel))	{
	?>
	<div class="leerdoel list shadow">
		<div class="title radius"><p>Leerdoel(en)</p>
		<?php
			if($rij->id == Session::get(Config::get('session/session_name')) || $user->hasPermission('admin') )	{
				echo "<a class=\"edit\" href=\"profielbewerken?u=" . $id  . "\"><img src=\"img/icon_edit.png\"></a>";
			}
		?>
		</div>
		<div class="content">
		<?php
			echo $leerdoel;
		?>
		</div>
	</div>
	<?php
	}
	?>

	<div class="skillslist shadow">
		<div class="title radius">
			<img src="img/icon_skill.png" height="30" /><p>Wat ik kan</p>
			<?php
                        global $id;
				if ($id == Session::get(Config::get('session/session_name')) || $user->hasPermission('admin'))	{
					echo "<a class=\"edit\" href=\"skills.php?u=".$u."\"><img src=\"img/icon_edit.png\"></a>";
				}
			?>
			<div class="legenda">
				<div class="color ont"></div><h4>Ontwikkel</h4>
				<div class="color basis"></div><h4>Basis</h4>
				<div class="color prof"></div><h4>Professioneel</h4>
			</div>
		</div>
		<div class="one">
		<?php
                             //$id = Session::get(Config::get('session/session_name'));
                  	$sql = "SELECT `skills`.`id` as `id`, `skills`.`skill` as `skill`, `skillsusers`.`lvl` as `lvl`, skillsusers . id as skillid FROM `skillsusers`, `skills` WHERE `skillsusers`.`usersid`='$u' AND `skillsusers`.`skill` = `skills`.`id` ORDER BY lvl ASC";

//                   $sql = "SELECT * FROM skillsusers WHERE usersid='$u'";
                  $data = DB::getInstance()->query($sql);            
// if $data weggehaald
				foreach ($data->results() as $rij) {
					echo "<div class=\"listitem shadow lvl" . $rij->lvl;
					//echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem shadow lvl" . $rij->lvl;
					if (!$user->hasPermission('admin')) {
						echo " noadmin";
					}
					 echo "\">" . $rij->skill; 
					// if($user == $_SESSION["user"]) {
                     //	 	echo "<a class=\"deleteitem\" href=\"deleteuserskills.php?t=" .  $rij->id ."&u=". $u. "\">xXx</a>";


echo "<a class=\"deleteitem\" href=\"deleteuserskills.php?t=" . $rij->skillid ."&u=".  $u. "\">x</a>";
echo "</div>";  
					
				}
		?>
		</div>
	</div><!-- Einde skills -->

	<div class="skillslist shadow">
		<div class="title radius">
			<img src="img/icon_skill.png" height="30" /><p>Wat ik wil leren</p>
			<?php

                        global $id;
				if ($id == Session::get(Config::get('session/session_name')) || $user->hasPermission('admin') )	{
					echo "<a class=\"edit\" href=\"skillswilleren.php?u=".$u."\"><img src=\"img/icon_edit.png\"></a>";
				}
			?>
			<div class="legenda">
				<div class="color ont"></div><h4>Ontwikkel</h4>
				<div class="color basis"></div><h4>Basis</h4>
				<div class="color prof"></div><h4>Professioneel</h4>
			</div>
		</div>
		<div class="one">
		<?php
                             //$id = Session::get(Config::get('session/session_name'));
//                $sql = "SELECT `skills`.`id` as `id`, `skills`.`skill` as `skill`, `skillsusers`.`lvl` as `lvl`, skillsusers . id as skillid FROM `skillsuserswilleren`, `skills` WHERE `skillsusers`.`usersid`='$u' AND `skillsusers`.`skill` = `skills`.`id` ORDER BY lvl ASC";
                                  	$sql = "SELECT `skills`.`id` as `id`, `skills`.`skill` as `skill`, `skillsuserswilleren`.`lvl` as `lvl`, skillsuserswilleren . id as skillid FROM `skillsuserswilleren`, `skills` WHERE `skillsuserswilleren`.`usersid`='$u' AND `skillsuserswilleren`.`skill` = `skills`.`id`";

                  $data = DB::getInstance()->query($sql);            

				foreach ($data->results() as $rij) {
					echo "<div class=\"listitem shadow lvl" . $rij->lvl;
					//echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem shadow lvl" . $rij->lvl;
					if (!$user->hasPermission('admin')) {
						echo " noadmin";
					}
					 echo "\">" . $rij->skill; 
		
echo "<a class=\"deleteitem\" href=\"deleteskillwilleren.php?t=" . $rij->skillid ."&u=".  $u. "\">x</a>";
echo "</div>";  
                     					
				}
			
		?>
		</div>
	</div><!-- Einde skillswilleren -->


        
	<div class="projectlist shadow">
		<div class="title radius">
			<img src="img/icon_project.png" height="30" /><p>Projecten</p>
			<script type="text/javascript">
				function selecttab(img, status, tab){
				 
					document.getElementById('img1').style.visibility = 'hidden';
					document.getElementById('img2').style.visibility = 'hidden';
					document.getElementById('afgerond').style.color = 'gray';
					document.getElementById('lopend').style.color = 'gray';

					document.getElementById(img).style.visibility = 'visible';
					document.getElementById(status).style.color = 'rgb(36, 137, 187)';
					document.getElementById("tabafgerond").style.display = 'none';
					document.getElementById("tablopend").style.display = 'none';

					document.getElementById(tab).style.display = 'block';
				}
			</script>
			<div class="select">
				<center>	
					<div class="options" id="lopend" onclick="selecttab('img2', 'lopend', 'tablopend')">Lopend<br /><img id="img2" src="img/iSelect.png"></div>
					<div class="options" id="afgerond" onclick="selecttab('img1', 'afgerond', 'tabafgerond')">Afgerond<br /><img id="img1" src="img/iSelect.png"></div>
				</center>
			</div>
		</div>
		<div class="content">
		<?php 
                //$data = $rs->dataOpvragen("SELECT * FROM `projectsusers` WHERE usersid='$u' AND accept=3");
                $data = DB::getInstance()->query("SELECT * FROM projectusers WHERE usersid='$u' AND accept=3");
		?>
			<div id="tabafgerond">
			<?php
			if($data != "") {
				foreach ($data as $rij) {
					$project = $rij->projectid;
                    $sql = "SELECT * FROM `projects` WHERE id='$project' ";
                    $data2 = DB::getInstance()->query($sql);
					if($data2 != "") {
						foreach($data2->results() as $rij2) {
							$status = $rij2->status;		    
							$projectid = $rij2->id;
						}
						if($status == 1) {
							echo "<div class=\"listitem2 ";
							if($whitesmoke == 0) {
								echo "whitesmoke";
								$whitesmoke = 1;
							}
							else {
								$whitesmoke = 0;
							}
							echo "\">" . "<a href=\"project/" . $projectid . "\">";
	
							if (file_exists("img/projectpic/" . $projectid . ".jpg")) {
								echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $projectid . ".jpg\">";
							}
							else {
								echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
							}
							echo "<p>" . $rij["project"] . " <font color=#7b7b7b> - " .$rij["functie"] . "</font></p></a></div>";
						}
					}
				}
			}
			?>
			</div>

			<div id="tablopend">
			<?php
				if($data != "")	{
					foreach ($data as $rij) {
						$project = $rij['projectid'];
						$data2 = $rs->dataOpvragen("SELECT * FROM `projects` WHERE id='$project' ");
						if($data2 != "") {
							foreach($data2 as $rij2) {
								$status = $rij2["status"];
								$projectid = $rij2["id"];
							}
							if($status == 0) {
								echo "<div class=\"listitem2 "; 
								if($whitesmoke == 0) {
									echo "whitesmoke";
									$whitesmoke = 1;
								}
								else {
									$whitesmoke = 0;
								}
								echo "\">" . "<a href=\"project/" . $projectid . "\">";

								if (file_exists("img/projectpic/" . $projectid . ".jpg")) {
									echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $projectid . ".jpg\">";
								}
								else {
									echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
								}
								echo "<p>" . $rij2["naam"];
								if(isset($rij["functie"]) && $rij["functie"] != "") echo " <font color=#7b7b7b> - " .$rij["functie"] . "</font>";
								echo "</p></a></div>";
							}
						}
					}
				}
			?>
			</div>
		</div>
	</div>
	<!-- end content left-->
</div>

<div class="content-right">
	<div class="people shadow">
		<div class="title radius"><img src="img/icon_project.png" height="30" /><p>Aankomende Projecten</p><a class="edit4" href="projectwensen?u=<?php echo Session::get(Config::get('session/session_name')) ?>"><img src="img/icon_edit2.png"></img></a></div>
		<div class="content">
		<?php
		
                //			$data = $rs->dataOpvragen("SELECT * FROM `projects` WHERE status='2' ORDER BY startdatum");
                $data = DB::getInstance()->query("SELECT * FROM projects WHERE status='2' ORDER BY startdatum");
			if($data != "")	{
				foreach($data as $rij) {
					echo "<div class=\"listitem2 ";
					if($whitesmoke == 0) {
						echo "whitesmoke";
						$whitesmoke = 1;
					}
					else {
						$whitesmoke = 0;
					}
					echo "\"><a  href=\"project/" .  $rij["id"] . "\">";
					if (file_exists("img/projectpic/" . $rij["id"] . ".jpg")) {
						echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $rij["id"] . ".jpg\">";
					}
					else {
						echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
					}
					echo '<p>' .$rij["naam"] . '</p>';
					echo "</a></div>";
				}
			}     
			?>
			</div>
		</div>
	
		<div class="requests shadow">
			<div class="title radius"><img src="img/icon_uitnodigingen.png" height="30" /><p>Uitnodigingen</p></div>
			<div class="content">
			<?php 
           $sql = "SELECT `projectsusers`.`id` as id, `projectsusers`.`project` as project, `projects`.`naam` as naam FROM `projectsusers`, `projects` WHERE usersid='$u' AND accept='2' AND `projectsusers`.`projectid` = `projects`.`id`";
            $data = DB::getInstance()->query($sql);
				if($data != "")	{
					foreach ($data as $rij) {
						echo "<div class=\"listitem2 ";
						if($whitesmoke == 0) {
							echo "whitesmoke";
							$whitesmoke = 1;
						}
						else {
							$whitesmoke = 0;
						}
						echo "\">" . "<a href=\"project/" . $rij["project"] . "\">";

						if (file_exists("img/projectpic/" . $rij["project"] . ".jpg")) {
							echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $rij["project"] . ".jpg\">";
						}
						else {
							echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
						}
						echo "<p>" . $rij["naam"] . "</p>";
						echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij['id'] ."  \">Nee</a>";
						echo "<a class=\"edit\" href=\"acceptuserinproject.php?id=" . $rij['id'] ."  \">Ja</a>";
						echo "</div>";
					}
				}
			?>
			</div>
		</div>
	
	</div>
	
</div>
</body>
</html>

