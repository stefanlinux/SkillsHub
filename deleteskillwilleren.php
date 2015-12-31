<?php
require_once 'core/init.php';
//$user = new User();
// if (!$user->isLoggedIn()) {
//     Redirect::to('login');
// }

//if($_SESSION["accounttype"] != 2) exit;
$t = Input::get('t');
$u = Input::get('u');
echo $t;
echo $u;
//var_dump($t);
//var_dump($u);
	$sql = "DELETE FROM skillsuserswilleren WHERE id='$t' AND usersid='$u'";
DB::getInstance()->query($sql);
?>
<body onload="history.go(-1);"></body>
</html>