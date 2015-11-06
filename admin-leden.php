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
<script type="text/javascript">
      function ConfirmDelete(userid,username) {
            if (confirm("Weet je zeker dat je "+username+" wilt verwijderen?")) location.href=('deleteuser.php?u='+userid);
      }
</script>
</head>
<body>
<div class="content">
<?php
$whitesmoke = 1;
$sql = "SELECT * FROM `users` ORDER BY `name`";
$data = DB::getInstance()->query($sql);
?>
	<div class="content-left">
		<div class="projectlist shadow">
			<div class="title radius"><img height="30" src="img/icon_person.png"></img><p>Leden</p><a class="edit" href="addaccount"><img src="img/icon_add.png"></img></a></div>
			<div id="skillsresults" class="content">
			<?php
      foreach ($data->results() as $rij) {
					echo "<div class=\"listitem2 listitem3 ";
					if ($whitesmoke == 0) {
						echo "whitesmoke";
						$whitesmoke = 1;
					} else {
						$whitesmoke = 0;
					}
                    
					echo "\">";
					$volledigenaam = $rij->name ." ".$rij->tussenvoegsel . " " . $rij->achternaam;
					echo "<p>".$volledigenaam."</p>";
					echo "<a href=\"profielbewerkenadmin.php?u=".$rij->id . "\" class=\"edit\">Bewerken</a> ";
					if($rij->name != "Administrator") {
						echo "<a onclick=\"ConfirmDelete(".$rij->id.",'" . $volledigenaam."');\" href=\"#\" class=\"edit\">Verwijderen</a>";
					}
					echo "</div>";
				}
			?>	
			</div>
		</div>
	</div>
	<div class="content-right">
		<div class="admin-item admin-selected">
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
		<div class="admin-item">
			<a href="admin-skills"><img src="img/icon_skill.png" height="30" /><p>Skills</p></a>
		</div>
	</div>
<?php 
	include("include/global_footer.php");
?>