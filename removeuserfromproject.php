<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>
</head>
<body  onLoad="history.go(-1)">

<div class="content">
<?php
	if (isset($_GET["id"])) {
		$id=$_GET["id"];
	}

if (isset($_GET["p"])) {
		$p=$_GET["p"];
	}


	$sql = "DELETE FROM projectsusers WHERE id='$id' AND projectid='$p'";
DB::getInstance()->query($sql);
?>
</body>
</html>