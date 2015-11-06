<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLoggedIn()) {
    include("include/global_header.php");
} else {
    Redirect::to('login.php');
}
$userid=Session::get(Config::get('session/session_name'));
include ("include/menu.php");
include ("fancybox.js");
$u = Session::get(Config::get('session/session_name'));
?>
</head>
<body onLoad="menu()">
<div class="content">
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username'])) {$username = $_POST['username'];}
    if (isset($_POST['name'])) {$name = $_POST['name'];}
    if (isset($_POST['tussenvoegsel'])) {$tussenvoegsel = $_POST['tussenvoegsel'];}
    if (isset($_POST['achternaam'])) {$achternaam = $_POST['achternaam'];}
    if (isset($_POST['leeftijd'])) {$leeftijd = $_POST['leeftijd'];}
    if (isset($_POST['adres'])) {$adres = $_POST['adres'];}
    if (isset($_POST['woonplaats'])) {$woonplaats = $_POST['woonplaats'];}
    if (isset($_POST['functie'])) {$functie = $_POST['functie'];}
    if (isset($_POST['organisatie'])) {$organisatie = $_POST['organisatie'];}
    if (isset($_POST['beschikbaar'])) {$beschikbaarheid = $_POST['beschikbaar'];}
    if (isset($_POST['motivatie'])) {$motivatie = $_POST['motivatie'];}
    if (isset($_POST['leerdoel'])) {$leerdoel = $_POST['leerdoel'];}
    if (isset($_POST['tel'])) {$tel = $_POST['tel'];}
    if (isset($_POST['email'])) {$email = $_POST['email'];}
    if (isset($_POST['linkedin'])) {$linkedin = $_POST['linkedin'];}
    if (isset($_POST['site'])) {$website = $_POST['site'];}
//        if (isset($_POST['postcode'])) {$postcode = $_POST['postcode']};
 //       if (isset($_POST['website'])) {$website = $_POST['website']};
 //   if (isset($_POST['opdrachtgever'])) {$opdrachtgever = $_POST['opdrachtgever']};        
        $volledigenaam = $name . " " . $tussenvoegsel . " " . $achternaam;
              
        $sql = "UPDATE  users SET
                    
                    username = '$username',
                    name = '$name', 
                    tussenvoegsel = '$tussenvoegsel',
                    achternaam = '$achternaam',
                    volledigenaam = '$volledigenaam',
                    age = '$leeftijd',
                    adres = '$adres',
                    woonplaats = '$woonplaats',
                    organisatie = '$organisatie',
                    functie = '$functie',
                    beschikbaarheid = '$beschikbaarheid',
                    motivatie = '$motivatie',
                    leerdoel = '$leerdoel',
                    tel = '$tel',
                    email = '$email',
                    linkedin = '$linkedin',
                    site = '$website'
                WHERE id = '$userid'
                    ";
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


$sql = "SELECT * FROM users WHERE id = '$userid' ";
$data = DB::getInstance()->query($sql); 
foreach($data->results() as $rij) {
    $id = $rij->id;
    $username = $rij->username;
    $password = $rij->password;
    $name = $rij->name;
    $tussenvoegsel = $rij->tussenvoegsel;
    $achternaam = $rij->achternaam;
    $volledigenaam = $rij->volledigenaam;
    $age = $rij->age;
    $adres = $rij->adres;
    $woonplaats = $rij->woonplaats;
    $organisatie = $rij->organisatie;
    $functie = $rij->functie;
    $beschikbaarheid = $rij->beschikbaarheid;
    $motivatie = $rij->motivatie;
    $leerdoel = $rij->leerdoel;
    $tel = $rij->tel;
    $email = $rij->email;
    $linkedin = $rij->linkedin;
    $site = $rij->site;
    $accounttype = $rij->accounttype;
}
?>
  <div class="list editprofile shadow">
    <div class="title radius">
      <img src="img/iSkill.png" height="30" /><p>Profiel bewerken</p>
      <a href="profiel/<?php echo $id; ?>" class="edit3">Terug naar je profiel</a>
    </div>
    <div class="content">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="profielbewerken" enctype="multipart/form-data"> 

      
      <div class="title2"><h4>Profielfoto</h4></div>
      <div class="blocks">
      <?php
      if (file_exists("img/profilepic/" . $id . ".jpg")) {
      /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
      echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/" . $id . ".jpg\"></a>";
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
        <div class="label">Naam:</div> <input type="text" id="name" name="name" class="textbox" value="<?php echo $name; ?>" /><br/>
        <div class="label">Tussenvoegsel:</div> <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="textbox" value="<?php echo $tussenvoegsel; ?>" /><br/>
        <div class="label">Achternaam:</div> <input type="text" id="achternaam" name="achternaam" class="textbox" value="<?php echo $achternaam; ?>" /><br/>
        <div class="label">Leeftijd:</div> <input type="text" id="leeftijd" name="leeftijd" class="textbox" value="<?php echo $age; ?>" /><br/>
        <div class="label">Adres:</div> <input type="text" id="adres" name="adres" class="textbox" value="<?php echo $adres; ?>" /><br/>
        <div class="label">Woonplaats:</div> <input type="text" id="woonplaats" name="woonplaats" class="textbox" value="<?php echo $woonplaats; ?>" /><br/>
<div class="label">Organistie:</div> <input type="text" id="organisatie" name="organisatie" class="textbox" value="<?php echo $organisatie; ?>" /><br/>
        <div class="label">Functie:</div> <input type="text" id="functie" name="functie" class="textbox" value="<?php echo $functie; ?>" /><br/>
	<!-- 
        <div class="label">Motivatie:</div> <input type="text" id="motivatie" name="motivatie" class="textbox" value="<?php echo $motivatie; ?>" /><br/> -->
        <!-- 
        <div class="label">Leerdoel:</div><input type="text" class="textbox" name="leerdoel" id="leerdoel" class="textbox" value="<?php echo $leerdoel; ?>"><br> -->
<!--     <div class="label">Tel:</div><input type="text" class="textbox" name="tel" id="tel" class="textbox" value="<?php echo $tel; ?>"><br> -->
    
    
    
     
      </div>
      <div class="title2"><h4>Persoonlijke beschrijving</h4></div>
      <div class="blocks">
        <div class="label">Beschikbaarheid:</div> <textarea id="beschikbaar" name="beschikbaar" class="textbox" ><?php echo $beschikbaarheid; ?></textarea><br />
        <div class="label">Motivatie:</div> <textarea id="motivatie" name="motivatie" class="textbox"><?php echo $motivatie; ?></textarea><br />
        <div class="label">Leerdoel(en):</div> <textarea id="leerdoel" name="leerdoel" class="textbox" ><?php echo $leerdoel; ?></textarea><br />
      </div>
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
      <input type="submit" name='submit' id="opslaan" class="button" value="Opslaan" onClick=""/> 
    </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/checkform.js"></script>
<script type="text/javascript">
	function menu(){
		 $('.navleden').addClass('selectedmenu');
	}
</script>

          </body>
</html>
<?php
	// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/

	$uploadpath = 'upload/';      // directory to store the uploaded files
	$max_size = 2000;          // maximum file size, in KiloBytes
	$alwidth = 4000;            // maximum allowed width, in pixels
	$alheight = 4000;           // maximum allowed height, in pixels
	$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');        // allowed extensions


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
		if(move_uploaded_file($_FILES['fileup']['tmp_name'], "img/profilepic/" . $u . ".jpg"  )) { 

		}
		else echo '<b>Unable to upload the file.</b>';
	  }
	  else echo $err;
	}
?>
