<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    exit;
}

include("include/global_header.php");
include ("include/menu.php");
include ('fancybox.js');
?>
<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" href="css/tags.css" type="text/css" media="screen" />
</head>
<body>
<?php

	$whitesmoke = 1;
$sql = "SELECT * from users T1 WHERE NOT EXISTS (SELECT usersid FROM projectsusers T2 WHERE T1.id = T2.usersid) ORDER BY T1.naam";
$data = DB::getInstance()->query($sql);
?>
<div class="content">
	<div class="projectlist skillslist2 shadow">
		<div class="title radius"><img src="img/icon_person.png" height="30" /><p>Uitnodigen</p><a href="project/<?php echo $_GET['p']; ?>" class="edit3">Terug naar Project</a></div>
		<div id="skillsresults" class="content">
			<?php
      foreach ($data->results() as $rij) {
					if($rij->naam != 'Administrator') {
						echo "<div class=\"listitem2 listitem3 ";
						if($whitesmoke == 0) {
							echo "whitesmoke";
							$whitesmoke = 1;
						}
						else {
							$whitesmoke = 0;
						}
						echo "\">";
						$volledigenaam = $rij->naam." ".$rij->tussenvoegsel." ".$rij->achternaam;
						echo "<p>".$volledigenaam."</p>";
						echo "<a href=\"liduitnodigen.php?u=".$rij->id."&p=".$_GET['p']."\" class=\"edit\">Uitnodigen</a> ";
						echo "</div>";
					}
				}
			?>	
			</div>
	</div>
</div>
</body>
</html>