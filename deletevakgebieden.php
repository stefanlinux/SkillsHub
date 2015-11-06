<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");	
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/vakgebieden.js"></script>
<link rel="stylesheet" href="css/skills.css" type="text/css" media="screen" />
</head>
<body onLoad="getVakgebieden()">
<?php
	//include het menu
	include ("include/clsDatabase.php");
	include ("include/menu.php");
	if($_SESSION["accounttype"] != 2) {
		exit;
	}	
?>
<script>
	function getVakgebieden() {
		vakgebiedSearch();
	}
</script>
<div class="content">
	<div class="projectlist skillslist2 shadow">
		<div class="title radius">
			<img src="img/icon_vakgebied.png" height="30" /><p>Vakgebieden</p>
			<a href="addvakgebied.php" class="edit3">Vakgebied toevoegen</a>
		</div>
		<div id="vakgebiedresults" class="content"></div>
	</div>
</div>
</body>
</html>