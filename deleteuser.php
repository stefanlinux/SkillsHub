<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>
<!DOCTYPE html>
<html lang="nl-NL">
<head>
<meta charset="UTF-8" />
<title>SkillsHub | FutureOfFame | Delete User</title>
</head>
<body>
<?php
	$user = $_GET['u'];
	echo $user;
	
	$sql = "DELETE FROM skillsusers WHERE usersid = '$user'";
	echo $sql;
DB::getInstance()->query($sql);
	$sql = "DELETE FROM projectsusers WHERE usersid = '$user'";
	echo $sql;
DB::getInstance()->query($sql);
	$sql = "DELETE FROM users WHERE id = '$user'";
	echo $sql;
DB::getInstance()->query($sql);
?>
<!-- <body onload="history.go(-1);"></body> //-->
<meta http-equiv="refresh" content="0;url=admin_leden.php">
</body>
</html>