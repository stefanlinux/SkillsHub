<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
		exit;
	}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
include("include/global_header.php");


?>
</head>
<body onLoad="history.go(-1)">
<div class="content">
<?php
	if (isset($_GET["id"])) {
		$id=$_GET["id"];
	}

	$sql = "UPDATE projectsusers SET accept='3' WHERE usersid='$id'";
DB::getInstance()->query($sql);
?>
</body>
</html>