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
$skillid = $_GET['p'];

$sql = "SELECT skill FROM skills WHERE id='$skillid'";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $row) {
   $skill =  $row->skill;
}

	if(isset($_POST['skill'])) {
        $nieuwenaam = $_POST['skill'];
		$sql = "UPDATE skills SET skill='$nieuwenaam' WHERE id='$skillid'";
		$data = DB::getInstance()->query($sql);
		echo '<meta http-equiv="refresh" content="0;url=admin-skills">';
	}
 
?>
</head>
<body onLoad="loading()">
<div class="content">
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/icon_vakgebied.png" height="30" /><p>Skills bewerken</p>
			<a href="admin-skills.php" class="edit3">Skillls</a>
		</div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="">
				<div class="title2"><h4>Skills</h4></div>
				<div class="blocks">
					<div class="label">Skills:</div> <input type="text" id="vakgebied" class="textbox" name="skill" value="<?php echo $skill; ?>"><br />
				</div>
				<input type="submit" class="button" value="Update skillnaam" />  
			</form>
	
		</div>
	</div>
</div>
</body>
</html>