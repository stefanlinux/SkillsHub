<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}


// $user = new User();
// if (!$user->isLoggedIn()) {
//     Redirect::to('login');
// }
$t=$_GET["p"];
//$user = Session::get(Config::get('session/session_name'));
$user = $_GET["u"];

// if (!$user->hasPermission('admin')) {
// 	echo "noadmin"
// }


$sql = "DELETE FROM skillsusers WHERE skill='$t'";
DB::getInstance()->query($sql);

$sql = "DELETE FROM projectskills WHERE skillid='$t'";
DB::getInstance()->query($sql);

$sql = "DELETE FROM skills WHERE id='$t'";
DB::getInstance()->query($sql);

Redirect::to('admin-skills.php');
?>
