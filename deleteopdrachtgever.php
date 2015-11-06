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
<?php
$u=$_GET["u"];
$sql = "SELECT * FROM markt WHERE opdrachtgever='$u' ";
$data = DB::getInstance()->query($sql);
if ($data != "") {
	foreach ($data->results() as $rij) {
        // $sql = "DELETE FROM projectskills WHERE projectid='" .$rij->id. "'";
        $sql = "DELETE FROM markt WHERE opdrachtgever = '" .$rij->opdrachtgever. "'";
		DB::getInstance()->query($sql);
		//DB::getInstance()->query($sql);
		///$sql = "DELETE FROM projectusers WHERE projectid='" .$rij->id. "'";
		//DB::getInstance()->query($sql);
	}



$sql = "DELETE FROM opdrachtgevers WHERE opdrachtgever='$u'";

		DB::getInstance()->query($sql);    
}

// $sql = "DELETE FROM projects WHERE bedrijf='$id'";
// 		DB::getInstance()->query($sql);


// 		DB::getInstance()->query($sql);


?>
