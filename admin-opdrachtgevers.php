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
      function ConfirmDelete(opdrachtgeverid,opdrachtgevername) {
          if (confirm("Weet je zeker dat je "+opdrachtgevername+" wilt verwijderen?\n\(inclusief bijhorende contactpersonen en projecten\)"))
              location.href=('deleteopdrachtgever.php?u='+opdrachtgevername);
      }
</script>
</head>
<body>

<div class="content">
<?php
$whitesmoke = 1;
$sql = "SELECT * FROM `markt` ORDER BY `opdrachtgever`";
$data = DB::getInstance()->query($sql);
?>
	<div class="content-left">
		<div class="projectlist shadow">
			<div class="title radius"><img height="30" src="img/icon_opdrachtgever.png"></img><p>Opdrachtgevers</p><a class="edit" href="addopdrachtgevers.php"><img src="img/icon_add.png"></img></a></div>
			<div id="skillsresults" class="content">
			<?php
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
					$opdrachtgever = $rij->opdrachtgever;
					echo "<p>".$opdrachtgever."</p>";
					echo "<a href=\"opdrachtgeverbewerken.php?u=".$rij->id."\" class=\"edit\">Bewerken</a> ";
					echo "<a onclick=\"ConfirmDelete(".$rij->id.",'".$opdrachtgever."');\" href=\"#\" class=\"edit\">Verwijderen</a></div>";
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
		<div class="admin-item admin-selected">
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