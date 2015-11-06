<?php
include("include/simpel_login.php");
?>
<?php
$p=$_GET["p"];
$l=$_GET["l"];
$user = $_SESSION['user'];
include ("include/clsDatabase.php");

$sql = "DELETE FROM projects WHERE projectleider='$l' AND naam='$p' ";
$rs->dataSchrijven($sql);
$sql = "DELETE FROM projectsusers WHERE project='$p' ";
$rs->dataSchrijven($sql);
?>

<meta http-equiv="refresh" content="2;url=opdrachten.php">