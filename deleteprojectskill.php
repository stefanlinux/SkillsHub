<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

$t = $_GET["t"];
	
	
	$sql = "DELETE FROM projectskills WHERE id= '$t'";
	DB::getInstance()->query($sql);
?>
<body onload="history.go(-1);"></body>
</html>