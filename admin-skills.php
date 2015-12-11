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
?>

<link rel="stylesheet" href="css/admin.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/skills.js"></script>
<script type="text/javascript">
	function ConfirmDelete(skillid) {
		if (confirm("Weet je zeker dat je "+skillid+" wilt verwijderen?")) {
            //  location.href=('projecten.php');
             //            location.href=('deleteskill.php?p='+skillid);
             //            deleteskill.php?p=".$rij->id.
        }
	}
	function getSkills(divisie) {
		skillsSearch2(divisie);
	}	  
</script>
</head>
<!-- <body onLoad="getSkills('-')"> -->
<body>
<div class="content">
	<?php

		$whitesmoke = 1;
	?>
	<div class="content-left">
		<div class="skillslist shadow">
			<div class="title radius"><img height="30" src="img/icon_person.png"></img><p>Skills</p><a class="edit" href="addskills.php"><img src="img/icon_add.png"></img></a></div>
				<div class="title">Selecteer vakgebied: &nbsp;
					<select class="textbox" onchange="getSkills(this.value)">
						<option>-</option>
						<?php
        $sql = "SELECT `id`, `vakgebied` FROM `vakgebieden` ORDER BY `id`";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {	
								echo '<option value="'. $rij->id .'">' . $rij->vakgebied . '</option>';
							}
						?>
					</select>
				</div>
			
			<div id="skillsresults" class="content">
			<?php
                                $sql = "SELECT * FROM `skills` ORDER BY `skill`";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
					echo "<div class=\"listitem2 listitem3 ";
					if($whitesmoke == 0) {
						echo "whitesmoke";
						$whitesmoke = 1;
					}
					else {
						$whitesmoke = 0;
					}
					echo "\">";
					$naam = utf8_encode($rij->skill);
					echo "<p>".$naam."</p>";
					echo "<a href=\"bewerken-skills.php?p=".$rij->id."\" class=\"edit\">Bewerken</a> ";
                    			 echo "<a href=\"deleteskill.php?p=".$rij->id." \"class=\"edit\">Verwijderen</a></div>";
                                 //	echo "<a onclick=\"ConfirmDelete(" . $rij->id . ");\" href=\"#\" class=\"edit\">Verwijderen</a></div>";

				}
			?>	
			</div>
		</div>
	</div>
	<div class="content-right">
		<div class="admin-item">
			<a href="admin-leden"><img src="img/icon_person.png" height="30" /><p>Leden</p></a>
		</div>	
		<div class="admin-item">
			<a href="admin-projecten"><img src="img/icon_project.png" height="30" /><p>Projecten</p></a>
		</div>
		<div class="admin-item">
			<a href="admin-opdrachtgevers"><img src="img/icon_opdrachtgever.png" height="30" /><p>Opdrachtgevers</p></a>
		</div>
		<div class="admin-item">
			<a href="admin-vakgebieden"><img src="img/icon_vakgebied.png" height="30" /><p>Vakgebieden</p></a>
		</div>
		<div class="admin-item admin-selected">
			<a href="admin-skills"><img src="img/icon_skill.png" height="30" /><p>Skills</p></a>
		</div>
	</div>
<?php 
	include("include/global_footer.php");
?>
