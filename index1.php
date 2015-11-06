<html>
<head>
<title>SkillsHub | FutureOfFame</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="css/fonts.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="img/favicon.ico" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<?php
require_once 'core/init.php';
?>

			</div>
			<a class="welkom" href="profiel/<?php echo $_SESSION['id']; ?>">Welkom, <?php echo $_SESSION['naam']; ?><br />Opties</a>
			<div class="menuopties">
				<div class="box"></div>
				<ul>
					<div class="seperator">Account</div>
					<a href="profiel/<?php echo $_SESSION['id']?>"><li>Profiel bekijken</li></a>
					<a href="logout"><li>Uitloggen</li></a>
					<?php 
						if($_SESSION["accounttype"] == 1 OR $_SESSION["accounttype"] == 2) {
							echo '<div class="seperator">Toevoegen</div>';
							echo '<a href="addprojects"><li>Projecten</li></a>';
							echo '<a href="addopdrachtgevers"><li>Opdrachtgevers</li></a>';
						}
						if($_SESSION["accounttype"] == 2) {
							echo '<a href="addvakgebied"><li>Vakgebieden</li></a>';
							echo '<a href="addskills"><li>Skills</li></a>';
							echo '<a href="addaccount"><li>Accounts</li></a>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="nav">
	<div class="menucontent">
		<a class="navprojecten" href="projecten">Projecten</a>
		<a class="navopdrachtgevers" href="opdrachtgevers">Opdrachtgevers</a>
		<a class="navleden" href="leden">Leden</a>
		<a class="navsearch" href="search">Zoeken</a>
		<?php
			if($_SESSION["accounttype"] == 2) { 
				echo '<a class="navadmin" href="admin-leden">Admin Menu</a>';
			}
		?>
	</div>
</div>
#include ("fancybox.js");
#echo "<meta http-equiv=\"refresh\" content=\"0;url=profiel/" . $_SESSION['id'] . "\" >";
?>
<div class="content">
</div>
</body>
</html>