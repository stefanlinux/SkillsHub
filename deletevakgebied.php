<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

	$v=$_GET["v"];

	
	
	$sql = "DELETE FROM vakgebieden WHERE id='$v' ";
DB::getInstance()->query($sql);
?>
<body onload="history.go(-1);"></body>
</html>