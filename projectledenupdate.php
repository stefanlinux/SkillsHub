<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>
<?php
	$o=$_GET["o"];
	$f=$_GET["f"];
	$id =$_GET["id"];
	
	$sql = "UPDATE  projectsusers SET omschrijving='$o', functie='$f' WHERE id= '$id'";
DB::getInstance()->query($sql);
?>
<body onload="history.go(-2);">
</body>
</html>