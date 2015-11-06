<?php
	include("include/simpel_login.php");
	if($_SESSION["accounttype"] == 0) {
		exit;
	}
?>
<?php
	$user=$_GET["u"];
	$project=$_GET["p"];
	include("include/clsDatabase.php");
	$sql = "INSERT INTO projectsusers (id, project, usersid, omschrijving, functie, accept, projectid) VALUES (NULL, '$project', '$user', '', '', '2', '$project')";
	$data = $rs->dataSchrijven($sql);
?>
<meta http-equiv="refresh" content="0;url=uitnodigen/<?php echo $project; ?>">