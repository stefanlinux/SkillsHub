<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");	
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/skills.js"></script>
<link rel="stylesheet" href="css/skills.css" type="text/css" media="screen" />
</head>
<body onLoad="getSkills('-')">
<?php
	//include het menu
	include ("include/clsDatabase.php");
	include ("include/menu.php");
	if($_SESSION["accounttype"] != 2) {
		exit;
	}	
?>
<script>
	function getSkills(divisie) {
		SkillsSearch2(divisie);
	}
</script>
<div class="content">
	<div class="projectlist skillslist2 shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Skills</p>
			<div class="divisie">
				Selecteer vakgebied: &nbsp;
				<select class="textbox" onchange="getSkills(this.value)">
					<option>-</option>
					<?php
						$data = $rs->dataOpvragen("SELECT `id`, `vakgebied` FROM `vakgebieden` ORDER BY `id`");
						foreach ($data as $rij) {	
							echo '<option value="'. $rij["id"] .'">' . $rij["vakgebied"] . '</option>';
						}
					?>
				</select>
			</div>
			<a href="addskill.php" class="edit3">Skills toevoegen</a>
		</div>
		<div id="skillsresults" class="content"></div>
	</div>
</div>
</body>
</html>
