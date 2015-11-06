<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");
?>
</head>
<body onLoad="history.go(-1)">
<div class="content">
<?php
	//include het menu
	include ("include/menu.php");

	if (isset($_GET["ontvanger"])) {
		$ontvanger = $_GET["ontvanger"];
	}
	if (isset($_GET["bericht"])) {
		$bericht = $_GET["bericht"];
	}
	$user = $_SESSION['user'];
	include ("include/clsDatabase.php");
	$sql = "INSERT INTO chat (id ,verzender, ontvanger, bericht) VALUES (NULL, '$_SESSION[user]' , '$ontvanger' , '$bericht' )";
	$data = $rs->dataSchrijven($sql);
?>
</div>
</body>
</html>