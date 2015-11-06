<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
include("include/datumselect.php");	
?>
<script type="text/javascript" src="js/checkform.js"></script>
</head>
<body onLoad="myTimer()">
<?php
$p=$_GET["p"];
$sql = "SELECT * FROM `projects` WHERE naam='$p' ";
$data = DB::getInstance()->query($sql);
foreach($data->results() as $rij) {
	   $projectleider = $rij->projectleider;
	   $projectnaam = $rij->naam;
       $id = $rij->id;
	}
?>
<div class="content">
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30"><p><?php echo $p;?>Projectleden</p>
			<a href="project/<?php echo $id;?>" class="edit3">Project pagina bekijken</a>
		</div>
		<div class="content">
			<?php
    $sql = "SELECT * FROM `projectsusers` WHERE project='$p' AND accept= 3";
    $data = DB::getInstance()->query($sql);
				if($data != "") {
                    foreach($data->results() as $rij) {
					$id = $rij->id;
					$usersid = $rij->usersid;
					$functie = $rij->functie;
					$omschrijving = $rij->omschrijving;

                    $sql = "SELECT * FROM `users` WHERE id='$usersid' ";
					$data2 = DB::getInstance()->query($sql);
					foreach($data2->results() as $rijj) {
						$naam = $rijj->username;
						if(!empty($rijj->tussenvoegsel)) $naam .= " ".$rijj->tussenvoegsel;
						if(!empty($rijj->achternaam)) $naam .= " ".$rijj->achternaam;
					}
			?> 
				<div class="title2"><h4><?php echo $naam; ?></h4></div>
                    <form>
				<div class="blocks">
					<?php
						if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) {
							echo "<a href=\"profiel.php?u=" . $rij->usersid . "\">";
							echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"98px\" width=\"98px\" style=\"float:left; margin-right: 10px\" ></a>";
						}
						else {
							echo "<a href=\"profiel.php?u=" . $rij->usersid . "\">";
							echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"98px\" width=\"98px\" style=\"float:left; margin-right: 10px\" ></a>";
						}
					?>
					<div class="label">Functie:</div> <input type="text" id="functie<?php echo $id; ?>" name="naam" class="textbox" value="<?php echo $functie; ?>" /><br/>
					<div class="label">Omschrijving:</div> <textarea id="omschrijving<?php echo $id; ?>" class="textbox" ><?php echo $omschrijving; ?></textarea><br />
					<a onclick="update('<?php echo $id; ?>')" style="margin-top: 10px" class="button">Opslaan</a>
				</div>
			</form><br /><br />
			<?php
				}
			}
			else {
				echo 'er zijn nog geen projectleden';
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function update(id){
		var link = "projectledenupdate.php?o="+ document.getElementById("omschrijving" + id).value + "&&f=" + document.getElementById("functie" + id).value + "&&id=" + id;
		window.location.href = link;
		//window.open(link);
	}
</script>
</body>
</html>