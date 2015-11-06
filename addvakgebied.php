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
include ("include/menu.php");
include ("fancybox.js");
?>
</head>
<body onLoad="loading()">

<div class="content">
<?php

	if(isset($_POST['vakgebied'])) {

		$sql = "INSERT INTO vakgebieden (id , vakgebied) VALUES (NULL, '$_POST[vakgebied]')";
        DB::getInstance()->query($sql);
		echo '<meta http-equiv="refresh" content="0"url="admin-vakgebieden">';
	}
	else {
?>
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/icon_vakgebied.png" height="30" /><p>Vakgebied toevoegen</p>
			<a href="deletevakgebieden.php" class="edit3">Vakgebied verwijderen</a>
		</div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="title2"><h4>Vakgebied</h4></div>
				<div class="blocks">
					<div class="label">Vakgebied:</div> <input type="text" id="vakgebied" class="textbox" name="vakgebied" value=""><br />
				</div>
				<input type="submit" class="button" value="Vakgebied toevoegen" />  
			</form>
		<?php
		}
		?>
		</div>
	</div>
</div>
</body>
</html>