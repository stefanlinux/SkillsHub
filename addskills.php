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
	

	if(isset($_POST['skill'])) {
		$sql = "INSERT INTO skills (id , skill, divisie) VALUES (NULL, '$_POST[skill]', '$_POST[divisie]')";
        
        DB::getInstance()->query($sql);
		echo '<meta http-equiv="refresh" content="0;url=admin-skills">';
	} else {
?>
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Skill toevoegen</p>
			<a href="deleteskill.php" class="edit3">Skills verwijderen</a>
		</div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="">
				<div class="title2"><h4>Skill</h4></div>
				<div class="blocks">
					<div class="label">Benaming:</div>
                                        <input type="text" id="skill" class="textbox" name="skill" value=""><br />
				</div>
				<div class="title2"><h4>Vakgebied</h4></div>
				<div class="blocks">
					<div class="label">Vakgebied:</div>
					<select name="divisie" class="textbox" onchange="getSkills(this.value)">
						<option>-</option>
						<?php
        $data = DB::getInstance()->query("SELECT * FROM `vakgebieden` ORDER BY `id`");
        foreach ($data->results() as $rij) {	
	echo '<option value="' .$rij->id. '">' .$rij->vakgebied. '</option>';
							}
						?>
					</select>
				</div>
				<input type="submit" class="button" value="Skill toevoegen" />  
			</form>
		<?php
		}
		?>
		</div>
	</div>
</div>
</body>
</html>
