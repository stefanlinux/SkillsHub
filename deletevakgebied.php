<?php
require_once 'core/init.php';
$user = new User();

if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
$v = $_GET["v"];
echo $v;	
$sql = "DELETE FROM vakgebieden WHERE id='$v'";
DB::getInstance()->query($sql);

Redirect::to('admin-vakgebieden.php');
//Redirect::to('projecten.php');
?>
