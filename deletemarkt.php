<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
$u=$_GET["u"];

 $sql = "SELECT FROM projects WHERE opdrachtgever='$u'";
// DB::getInstance()->query($sql);

// foreach ($data->results() as $rij) {
// 		$opdrachtgever = $rij->opdrachtgever;
// 		$sql = "DELETE FROM projectskills WHERE projectid='".$opdrachtgever."'";
//         DB::getInstance()->query($sql);
// 		$sql = "DELETE FROM projectsusers WHERE projectid='" .$opdrachtgever. "'";
//         DB::getInstance()->query($sql);		
// 	}
			
// 	$sql = "DELETE FROM projects WHERE opdrachtgever='$u'";
// DB::getInstance()->Query($sql);
	
// 	$sql = "DELETE FROM opdrachtgevers WHERE opdrachtgever='$u'";
// DB::getInstance()->query($sql);
	
$sql = "DELETE FROM markt WHERE id='$u'";
DB::getInstance()->query($sql);
?>
<meta http-equiv="refresh" content="2;url=markt.php">