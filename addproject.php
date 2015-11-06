<?php
require_once 'core/init.php';
$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
?>
</head>
<body onLoad="history.go(-1)">
<div class="content">

<?php
	if (isset($_GET["name"])) {
		$name=$_GET["name"];
	}
	if (isset($_GET["u"])) {
		$u=$_GET["u"];
	}


		$a=$_GET['a'];
$name = $_GET['projectname'];

if (isset($_GET["n"])) {
		$n=$_GET["n"];
	}

	$sql = "INSERT INTO projectsusers (id ,project, usersid, accept, projectid) VALUES (NULL, '$name' , '$u' , '$a', '$n' )";
DB::getInstance()->query($sql);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\"  >";
?>
</div>
</body>
</html>