<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
$u=$_GET["u"];
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
include ("include/file_upload.php");

//$contactpersoon = new Contactpersoon();
?>
<link rel="stylesheet" href="css/opdrachtgever2.css" type="text/css" media="screen" /> 
</head>
<body onLoad="menu()">
<div class="content">
<?php

$sql = "SELECT * FROM `markt` WHERE id='" .$u. "'";
$data = DB::getInstance()->query($sql);
foreach($data->results() as $rij) {
			$id = $rij->id;
			$user = $rij->opdrachtgever;
			$tel = $rij->tel;
			$plaats = $rij->plaats;
			$straat = $rij->straat;
			$postcode = $rij->postcode;
			$website = $rij->website;
			$linkedin = $rij->linkedin;
	}


if (isset($_POST['submit'])) {
 $sql = "UPDATE markt
 SET opdrachtgever='$_POST[naam]',
 tel='$_POST[tel]',
 plaats='$_POST[plaats]',
 straat='$_POST[straat]',
 postcode='$_POST[postcode]',
 website='$_POST[website]',
 tel='$_POST[telefoon]' WHERE id='$u'";
 DB::getInstance()->query($sql);
 }


   
 if (isset($_POST['voornaam'])) {
$volledigenaam = $_POST['voornaam'] . " " . $_POST['tussenvoegsel'] . " " . $_POST['achternaam'];
$volledigenaam = str_replace("  ", " ", $volledigenaam);
$voornaam = $_POST['voornaam'];
$tussenvoegsel = $_POST['tussenvoegsel'];
$achternaam = $_POST['achternaam'];
$tel =  $_POST['tel'];
$mail = $_POST['mail'];

$sql = "INSERT INTO contactpersonen (opdrachtgever, voornaam, tussenvoegsel, achternaam, volledigenaam, tel, email ) VALUES ('$user', '$voornaam', '$tussenvoegsel', '$achternaam',  '$volledigenaam', '$tel', '$mail')";
//$sql = "INSERT INTO contactpersonen (opdrachtgever, voornaam, tussenvoegsel, achternaam, volledigenaam, tel, plaats, mail)
//        VALUES ('$opdrachtgever', '$voornaam', '$tussenvoegsel', '$achternaam', '$volledigenaam', '$tel', '$mail')";
DB::getInstance()->query($sql);
//header('Location: opdrachtgever.php?u=$u');
// Redirect::to("opdrachtgever.php");
echo "<meta http-equiv=\"refresh\" content=\"0;url=opdrachtgever.php?u=$u\"  >";

}



?>
<div class="list editprofile shadow">
    <div class="title radius">
      <img src="img/iSkill.png" height="30" /><p>Opdrachtgever bewerken</p>
      
      
      <a href="opdrachtgever.php?u=<?php echo $u; ?>" class="edit3">Terug naar opdrachtgever</a>
    </div>
  <div class="content">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?u=<?php echo $u; ?>" method="POST" name="profielbewerken" enctype="multipart/form-data"> 
				<div class="title2"><h4>Afbeelding</h4></div>
				<div class="blocks">
					<div class="label">Banner:</div>
					<?php
						if (file_exists("img/bedrijfpic/" . $id . ".jpg")) {
							/*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $id . ".jpg\"> ";*/
							echo "<a class=\"fancybox profielpic\" href=\"img/bedrijfpic/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/bedrijfpic/" . $id . ".jpg\"></a>";
						}
						else {
							echo "<a class=\"fancybox profielpic\" href=\"img/noimage.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/noimage.jpg\"></a>";
						}
					?>
					<input type="file" name="fileup" /><br/>
					<div class="label">Bedrijf:</div>
					<?php
						if (file_exists("img/opdrachtgever/" . $id . ".jpg")) {
							/*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $id . ".jpg\"> ";*/
							echo "<a class=\"fancybox profielpic\" href=\"img/opdrachtgever/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/opdrachtgever/" . $id . ".jpg\"></a>";
						}
						else {
							echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
						}
					?>
					<input type="file" name="fileup2" />
				</div>
				<div class="title2"><h4>Bedrijf</h4></div>
				<div class="blocks">
					<div class="label">Naam:</div> <input type="text" id="naam" name="naam" class="textbox" value="<?php echo $user; ?>" /><br/>
					<div class="label">Straat:</div> <input type="text" id="straat" name="straat" class="textbox" value="<?php echo $straat; ?>" /><br/>
					<div class="label">Postcode:</div> <input type="text" id="postcode" name="postcode" class="textbox" value="<?php echo $postcode; ?>" /><br/>
					<div class="label">Plaats:</div> <input type="text" id="plaats" name="plaats" class="textbox" value="<?php echo $plaats; ?>" /><br/>
					<div class="label">Telefoon:</div> <input type="text" id="telefoon" name="telefoon" class="textbox" value="<?php echo $tel; ?>" /><br/>
					<br />
					<div class="label">Website:</div> <input type="text" id="website" name="website" class="textbox" value="<?php echo $website; ?>" /><br/>
				</div>
				<div class="title2"><h4>Contactpersonen</h4></div>
				<div class="blocks">
<?php 
$sql = "SELECT * FROM contactpersonen WHERE opdrachtgever='$user' ";
$data = DB::getInstance()->query($sql);
if($data != "") { //var_dump($data);
    foreach ($data->results() as $rij) {
        echo '<div class="contactpersoon"><div class="verwijderen"><a href="deletecontactpersoon.php?id='.$rij->id. '&u='.$u. '"><img src="img/trash.png" width="20"/></a></div><div class="label label2">' . $rij->volledigenaam . '</div></div><br />';
    }
}
else {
    echo '<div class="contactpersoon"><div class="label label2">Er zijn nog geen contactpersonen aangemaakt.</div></div>';
}
?>  
				</div>
				<div class="title2"><h4>Contactpersoon toevoegen</h4></div>
				<div class="blocks">
					<div class="label">Naam:</div> <input type="text" id="voornaam" name="voornaam" class="textbox" value="" /><br/>
					<div class="label">Tussenvoegsel:</div> <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="textbox" value="" /><br/>
					<div class="label">Achternaam:</div> <input type="text" id="achternaam" name="achternaam" class="textbox" value="" /><br/>
					<div class="label">Tel:</div> <input type="text" id="tel" name="tel" class="textbox" value="" /><br/>
					<div class="label">Mail:</div> <input type="text" id="mail" name="mail" class="textbox" value="" /><br/>
				</div>   
				<input type="submit" name='submit' id="opslaan" class="button" value="Opslaan"/> 
			</form>
		</div>
	</div>
</div>
          <script type="text/javascript">
	function ConfirmDelete(opdrachtgeverid,opdrachtgevername) {
		if (confirm("Weet je zeker dat je "+opdrachtgevername+" wilt verwijderen?\n\(inclusief bijhorende contactpersonen en projecten\)")) location.href=('deletemarkt.php?u='+opdrachtgeverid);
	}
	
	function deleteproject(naam) {
		var answer = confirm("Weet u zeker deze opdrachtgever wilt verwijderen, dit kan niet ongedaan worden?")
		if (answer) {
			link = "deletemarkt.php?u=" + naam;
			window.location.href = link;
		}
		else {
			//some code
		}
	}
	function menu(){
		$('.navmarkt').addClass('selectedmenu');
	}
</script>
</body>
</html>
