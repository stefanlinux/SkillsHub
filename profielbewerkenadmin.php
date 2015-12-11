<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    exit;
}
include("include/global_header.php");
include ("include/menu.php");
include ('fancybox.js');
error_reporting(0);
?>

</head>
<body onLoad="menu()">
<div class="content">
<?php
	if(isset($_POST['submit'])) {
		$user = $_GET['u'];
		
		$volledigenaam = $_POST["naam"] . " " . $_POST["tussenvoegsel"] . " " . $_POST["achternaam"];
		if($_POST["status"] == "Actief") {
			$status = 0;
		}
		else {
			$status = 1;
		}
		if($_POST["ww"] == "") {
			$sql = "UPDATE users SET name='$_POST[naam]', tussenvoegsel='$_POST[tussenvoegsel]', achternaam='$_POST[achternaam]', volledigenaam='$volledigenaam', age='$_POST[leeftijd]', adres='$_POST[adres]', woonplaats='$_POST[woonplaats]', functie='$_POST[functie]', beschikbaarheid='$_POST[beschikbaarheid]',  motivatie='$_POST[motivatie]', leerdoel='$_POST[leerdoel]', tel='$_POST[tel]', email='$_POST[email]', linkedin='$_POST[linkedin]', site='$_POST[site]', accounttype='$_POST[accounttype]', status='$status' WHERE id ='$user'";
		}
		else {
			$sql = "UPDATE users SET name='$_POST[naam]', tussenvoegsel='$_POST[tussenvoegsel]', achternaam='$_POST[achternaam]', volledigenaam='$volledigenaam', age='$_POST[leeftijd]', adres='$_POST[adres]', woonplaats='$_POST[woonplaats]', functie='$_POST[functie]', beschikbaarheid='$_POST[beschikbaarheid]',  motivatie='$_POST[motivatie]', leerdoel='$_POST[leerdoel]', tel='$_POST[tel]', email='$_POST[email]', linkedin='$_POST[linkedin]', site='$_POST[site]', accounttype='$_POST[accounttype]', status='$status', pass='$pass' WHERE id ='$user'";
		}
		DB::getInstance()->query($sql);
	}


if (isset($_POST['password']) && isset($_POST['password_again'])) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        
        'password' => array(
            'required' => true,
            'min' => 6
        ),
        'password_again' => array(
            'required' => true,
            'matches' => 'password'
        )
            
    ));

    if($validation->passed()) {
            
            
       // $user = new User();
$salt = Hash::salt(32);

try {
    //    $id = $_GET['u'];
    $user->update(array(
        
        'password' => Hash::make(Input::get('password'), $salt),
        'salt' => $salt
    ));

} catch(Exception $e) {
    die($e->getMessage());
}
} else {
    // ouput errors
    //print_r($validation->errors());
    /* foreach($validation->errors() as $error) {
       echo $error, '<br>';
       } */
}
}



?> 
<?php
$u = $_GET['u'];
$sql = "SELECT * FROM users WHERE id = $u";
$data = DB::getInstance()->query($sql);
global $id;
foreach($data->results() as $rij) {
	$id = $rij->id;
    $username = utf8_encode($rij->username);
    $password = $rij->password;
    $name = utf8_encode($rij->name);
    $tussenvoegsel = $rij->tussenvoegsel;
    $achternaam = utf8_encode($rij->achternaam);
    $age = $rij->age;
    $adres = $rij->adres;
    $woonplaats = $rij->woonplaats;
    $woonplaats = $rij->woonplaats;
    $functie = $rij->functie;
    $beschikbaarheid = $rij->beschikbaarheid;
    $motivatie = $rij->motivatie;
    $leerdoel = $rij->leerdoel;
    $tel = $rij->tel;
    $email = $rij->email;
    $linkedin = $rij->linkedin;
    $site = $rij->site;
    $accounttype = $rij->accounttype;
    $status = $rij->status;
			}
	
?>
	<div class="list editprofile shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Profiel bewerken</p>
			<a href="profiel/<?php echo $u; ?>" class="edit3">Terug naar het profiel</a>
		</div>
		<div class="content">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?u=<?php echo $u; ?>" method="POST" name="profielbewerken" enctype="multipart/form-data">
				<div class="title2"><h4>Profielfoto</h4></div>
				<div class="blocks">
					<?php
						if (file_exists("img/profilepic/" . $u . ".jpg")) {
							/*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
							echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/" . $u . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/" . $u . ".jpg\"></a>";
						}
						else {
							echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
						}
					?>
					<input type="file" name="fileup" /><br/>
				</div>
				<div class="title2"><h4>Algemene gegevens</h4></div>
				<div class="blocks">
                                     <div class="label">Gebruiker:</div> <input type="text" id="username" name="username" class="textbox" value="<?php echo $username; ?>" /><br/>
					<div class="label">Naam:</div> <input type="text" id="naam" name="naam" class="textbox" value="<?php echo $name; ?>" /><br/>
					<div class="label">Tussenvoegsel:</div> <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="textbox" value="<?php echo $tussenvoegsel; ?>" /><br/>
					<div class="label">Achternaam:</div> <input type="text" id="achternaam" name="achternaam" class="textbox" value="<?php echo $achternaam; ?>" /><br/>
					<div class="label">Leeftijd:</div> <input type="text" id="leeftijd" name="leeftijd" class="textbox" value="<?php echo $age; ?>" /><br/>
					<div class="label">Adres:</div> <input type="text" id="adres" name="adres" class="textbox" value="<?php echo $adres; ?>" /><br/>
					<div class="label">Woonplaats:</div> <input type="text" id="woonplaats" name="woonplaats" class="textbox" value="<?php echo $woonplaats; ?>" /><br/>
					<br />
					<div class="label">Functie:</div> <input type="text" id="functie" name="functie" class="textbox" value="<?php echo $functie; ?>" /><br/>
					<div class="label">Rol:</div>
					<select class="textbox" name="accounttype" style="width: 226px">
					<?php
						echo '<option value="0"';
						if($accounttype == 0) echo " selected";
						echo '>Projectlid</option>';
						echo '<option value="1"';
						if($accounttype == 1) echo " selected";
						echo '>Projectleider</option>';
						echo '<option value="2"';
						if($accounttype == 2) echo " selected";
						echo '>Beheerder</option>';
					?>
					</select><br /><br />
					<div class="label">Status:</div>
					<select class="textbox" name="status" style="width: 226px">
					<?php
						if(0 == $status) {
							echo '<option selected>Actief</option>';
							echo '<option>Non Actief</option>';
						}
						else {
							echo '<option>Actief</option>';
							echo '<option selected>Non Actief</option>'; 
						}
					?>
					</select><br /><br />
				</div>
				<div class="title2"><h4>Persoonlijke beschrijving</h4></div>
				<div class="blocks">
					<div class="label">Beschikbaarheid:</div> <textarea id="beschikbaarheid" name="beschikbaarheid" class="textbox" ><?php echo $beschikbaarheid; ?></textarea><br />
					<div class="label">Motivatie:</div> <textarea id="motivatie" name="motivatie" class="textbox" ><?php echo $motivatie; ?></textarea><br />
					<div class="label">Leerdoel(en):</div> <textarea id="leerdoel" name="leerdoel" class="textbox" ><?php echo $leerdoel; ?></textarea><br />
					<div class="label">Skills:</div> <div class="one" style="display: inline-block; width: 500px; clear: both; border: 1px solid #BBB;">
<?php 
$sql = "SELECT skillsusers.id as id, skills.skill as skill, skillsusers.lvl as lvl FROM skillsusers, skills WHERE skillsusers.usersid=$u AND skillsusers.skill = skills.id";
$data = DB::getInstance()->query($sql);
//	if($data != "") {
		foreach ($data->results() as $rij) {
			echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem lvl" . $rij->lvl;
            //			if($_SESSION["accounttype"] != 2) {
            if ($user->hasPermission('admin')) {
				echo " noadmin";
			}
			echo "\">" . $rij->skill; 
            //	if($_SESSION["accounttype"] == 2) {
            if ($user->hasPermission('admin')) {
				echo "<a class=\"deleteitem\" href=\"deleteuserskills.php?t=" .  $rij->id. "&u=" . $u . "\">x</a>"; 
			}
			echo "</div>";
		}
        //	}
?>
				</div>
					  	<?php
//	if($_SESSION["accounttype"] == 2) {
//if ($user->hasPermission('admin')) {
				echo "<a href=\"skills.php?u=" . $u  . "\"><img src=\"img/icon_edit.png\"></a>";
                //	}
		?>
				<div class="title2"><h4>Contact</h4></div>
				<div class="blocks">
					<div class="label">Tel.:</div> <input type="text" id="tel" name="tel" class="textbox" value="<?php echo $tel; ?>" /><br/>
					<div class="label">Email:</div> <input type="text" id="email" name="email" class="textbox" value="<?php echo $email; ?>" /><br/>
					<div class="label">linkedin:</div> <input type="text" id="linkedin" name="linkedin" class="textbox" value="<?php echo $linkedin; ?>" /><br/>
					<div class="label">Site:</div> <input type="text" id="site" name="site" class="textbox" value="<?php echo $site; ?>" /><br/>
				</div>
				<div class="title2"><h4>Wachtwoord</h4></div>
				<div class="blocks">
				 <div class="label">Wachtwoord:</div> <input type="password" id="ww" name="password" class="textbox" value="" /><br/>
            <div class="label">Wachtwoord opnieuw:</div> <input type="password" id="ww" name="password_again" class="textbox" value="" /><br/>
				</div> 
				<input type="submit" name='submit'id="opslaan" class="button" value="Opslaan"> 
			</form>
		</div>
	</div>
            </div>
            <script type="text/javascript">
	function menu(){
		$('.navleden').addClass('selectedmenu');
	}
</script>
</body>
</html>
<?php
	// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/
  //	$uploadpath = 'upload/';								// directory to store the uploaded files
  $uploadpath = '/var/www/htdocs/upload/';
	$max_size = 2000;										// maximum file size, in KiloBytes
	$alwidth = 4000;										// maximum allowed width, in pixels
	$alheight = 4000;										// maximum allowed height, in pixels
	$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');	// allowed extensions


	if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
		$uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       // gets the file name
		$sepext = explode('.', strtolower($_FILES['fileup']['name']));
		$type = end($sepext);       // gets extension
		list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
		$err = '';         // to store the errors   

		// Checks if the file has allowed type, size, width and height (for images)
		if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
		if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
		if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;

		// If no errors, upload the image, else, output the errors

		if($err == '') {
			if(move_uploaded_file($_FILES['fileup']['tmp_name'], "img/profilepic/" . $u . ".jpg"  )) { }
			else echo '<b>Unable to upload the file.</b>';
		}
		else echo $err;
	}
?>
