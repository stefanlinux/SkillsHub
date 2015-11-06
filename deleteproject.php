<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
	include ("include/menu.php");
?>
<?php
	$n=$_GET["n"];

	$sql = "DELETE FROM projectsusers WHERE projectid='$n' ";
DB::getInstance()->query($sql);
	$sql = "DELETE FROM projectskills WHERE projectid='$n' ";
DB::getInstance()->query($sql);
	$sql = "DELETE FROM projects WHERE id='$n' ";
DB::getInstance()->query($sql);


Redirect::to('admin-projecten.php');
?>
