<?php
	include("include/simpel_login2.php");
?>
<?php
	$id=$_GET["id"];
	$n=$_GET["n"];
	$user = $_SESSION['user'];
	include ("include/clsDatabase.php");
	$sql = "DELETE FROM media WHERE id='$id' ";
	$rs->dataSchrijven($sql);
	echo '<meta http-equiv="refresh" content="0;url=project.php?n='.$n.'">';
?>


