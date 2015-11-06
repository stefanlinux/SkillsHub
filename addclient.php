<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");
?>
<script type="text/javascript">
	function menu(){
		$('.navmarkt').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu()">
<?php
	//include het menu
	include ("include/menu.php");
	if($_SESSION["accounttype"] == 2 OR $_SESSION["accounttype"] == 1) {}
	else {
		exit;
	}
?>
<div class="content">
<?php
	$user= $_SESSION['user'];
	if(isset($_POST['opdrachtgever'])) {
		include ("include/clsDatabase.php");
		$data = $rs->dataOpvragen("SELECT * FROM `markt` WHERE opdrachtgever='$_POST[opdrachtgever]' ");
		if($data == "") {
			$sql = "INSERT INTO markt (id , opdrachtgever, tel, plaats, straat, postcode, website) VALUES (NULL, '$_POST[opdrachtgever]', '$_POST[tel]', '$_POST[plaats]', '$_POST[straat]', '$_POST[postcode]', '$_POST[website]')";
			$data = $rs->dataSchrijven($sql);
			echo "<meta http-equiv=\"refresh\" content=\"0;url=opdrachtgever.php?u=" . $_POST["opdrachtgever"] .  "\"  >";
		}
		else {
			echo '<div class="error"><a style="margin:30px 20px 0px 0px" onclick="history.go(-1);" class="button">Ga terug</a><p><b>LET OP!<br /></b> Opdrachtgever bestaat al</p><br /></div>';
		}
	}
	else {
?>
	<div class="list editprofile shadow">
		<div class="title radius"><img src="img/iSkill.png" height="30" /><p>Opdrachtgever toevoegen</p></div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="title2"><h4>Opdrachtgever</h4></div>
				<div class="blocks">
					<div class="label">Bedrijfsnaam:</div> <input type="text" id="opdrachtgever" class="textbox" name="opdrachtgever" value=""><br />
					<div class="label">Telefoon:</div> <input type="text" id="tel" class="textbox" name="tel" value=""><br />
					<div class="label">Plaats:</div> <input type="text" id="plaats" class="textbox" name="plaats" value=""><br />
					<div class="label">Straat:</div> <input type="text" id="straat" class="textbox" name="straat" value=""><br />
					<div class="label">Postcode:</div> <input type="text" id="postcode" class="textbox" name="postcode" value=""><br />
					<div class="label">Website:</div> <input type="text" id="website" class="textbox" name="website" value=""><br />
				</div>	
				<input type="submit" class="button" value="Opdrachtgever toevoegen" />  
			</form>
		<?php
		}
		?>
		</div>
	</div>
</div>
</body>
</html>