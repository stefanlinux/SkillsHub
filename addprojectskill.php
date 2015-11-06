<?php
	include("include/simpel_login.php");
?>
<?php
	$t=$_GET["t"];
	$lvl=$_GET["lvl"];
	$project=$_GET["p"];
	include("include/clsDatabase.php");
	$sql = "INSERT INTO projectskills (id, projectid, skillid, lvl) VALUES (NULL, '$project', '$t', '$lvl')";
	$data = $rs->dataSchrijven($sql);
?>
<meta http-equiv="refresh" content="0;url=projectskills.php?p=<?php echo $project; ?>">