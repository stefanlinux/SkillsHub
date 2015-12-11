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
$vakgebiedid = $_GET['p'];

$sql = "SELECT vakgebied FROM vakgebieden WHERE id='$vakgebiedid'";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $row) {
   $vakgebied =  $row->vakgebied;
}

	if(isset($_POST['vakgebied'])) {
        $nieuwenaam = $_POST['vakgebied'];
		$sql = "UPDATE vakgebieden SET vakgebied='$nieuwenaam' WHERE id='$vakgebiedid'";
		$data = DB::getInstance()->query($sql);
		echo '<meta http-equiv="refresh" content="0;url=admin-vakgebieden">';
	}
 
?>
</head>
<body onLoad="loading()">
<div class="content">
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/icon_vakgebied.png" height="30" /><p>Vakgebied toevoegen</p>
			<a href="admin-vakgebieden.php" class="edit3">Vakgebieden</a>
		</div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="">
				<div class="title2"><h4>Vakgebied</h4></div>
				<div class="blocks">
					<div class="label">Vakgebied:</div> <input type="text" id="vakgebied" class="textbox" name="vakgebied" value="<?php echo $vakgebied; ?>"><br />
				</div>
				<input type="submit" class="button" value="Update vakgebied" />  
			</form>
	
		</div>
	</div>
</div>
</body>
</html>