<?php
	include("include/simpel_login.php");
?>
<?php
	$t=$_GET["t"];
	$user = $_GET['u'];
	include ("include/clsDatabase.php");
	$sql = "DELETE FROM skillsusers WHERE usersid= '$user' AND skill='$t' ";
	$rs->dataSchrijven($sql);
?>
<body onload="history.go(-1);"></body>
</html>