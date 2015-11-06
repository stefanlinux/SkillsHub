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
	if(isset($_POST['vakgebied'])) {
		include ("include/clsDatabase.php");
		$sql = "INSERT INTO vakgebieden (id , vakgebied) VALUES (NULL, '$_POST[vakgebied]')";
		$data = $rs->dataSchrijven($sql);
		echo '<meta http-equiv="refresh" content="0;url=admin-vakgebieden">';
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