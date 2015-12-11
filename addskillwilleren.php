<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLoggedIn()) {
   	include("include/global_header.php");
} else {
    Redirect::to('login.php');
  }

	$t=$_GET["t"];
	$lvl=$_GET["lvl"];
	$user = $_GET["u"];

$sql = "INSERT INTO skillsuserswilleren (id, usersid, skill, lvl) VALUES (NULL, '$user', '$t', '$lvl')";

$data = DB::GetInstance()->query($sql);
?>
<meta http-equiv="refresh" content="0;url=skills.php?u=<?php echo $user; ?>">


