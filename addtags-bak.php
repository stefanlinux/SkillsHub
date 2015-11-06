<?php
	include("include/simpel_login.php");
	include("include/global_header.php");
?>
</head>
<body onLoad="loading()">
<?php
	//include het menu
	include ("include/menu.php");
?>
<div class="content">
<?php
	$user= $_SESSION['user'];
	include ("include/clsDatabase.php");
	if(isset($_POST['skill'])) {
		$sql = "INSERT INTO tags (id , tag, divisie) VALUES (NULL, '$_POST[skill]', '$_POST[divisie]')";
		$data = $rs->dataSchrijven($sql);
		echo '<meta http-equiv="refresh" content="0;url=addtags.php">';
	}
	else {
?>
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Skill toevoegen</p>
			<a href="deleteskill.php" class="edit3">Skills verwijderen</a>
		</div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="title2"><h4>Skill</h4></div>
				<div class="blocks">
					<div class="label">Benaming:</div> <input type="text" id="skill" class="textbox" name="skill" value=""><br />
				</div>
				<div class="title2"><h4>Vakgebied</h4></div>
				<div class="blocks">
					<div class="label">Vakgebied:</div>
					<select name="divisie" class="textbox" onchange="getTags(this.value)">
						<option>-</option>
						<?php
							$data = $rs->dataOpvragen("SELECT * FROM `vakgebieden` ORDER BY `id`");
							foreach ($data as $rij) {	
								echo '<option value="'.$rij["id"].'">' . $rij["vakgebied"] . '</option>';
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