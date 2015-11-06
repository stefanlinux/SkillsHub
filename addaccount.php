<?php
// LET OP accoutnype is group geworden

//	$volledigenaam = $_POST["naam"] . " " . $_POST["tussenvoegsel"] . " " . $_POST["achternaam"];
		//	$sql = "INSERT INTO users (id , user, pass, naam, tussenvoegsel, achternaam, accounttype, volledigenaam) VALUES (NULL, '$_POST[user]', '$password', '$_POST[naam]', '$_POST[tussenvoegsel]', '$_POST[achternaam]', '$_POST[accounttype]', '$volledigenaam')";
    //     
?>
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

if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array(
        'required' => true,
        'min' => 2,
        'max' => 20,
        'unique' => 'users'
      ),
      'password' => array(
        'required' => true,
        'min' => 6
      ),
      'password_again' => array(
        'required' => true,
        'matches' => 'password'
      ),
      'name' => array(
        'required' => true,
        'min' => 2,
        'max' => 50
      )
     
    ));

    if($validation->passed()) {
      // registreer gebruiker
         Session::flash('succes', 'Je bent geregistreerd!');
        // header('Location: index.php');
        // deze functie kan ander door naar een pagina te redirecten

        $user = new User();
        $salt = Hash::salt(32);

        $volledigenaam = $_POST["username"] . " " . $_POST["tussenvoegsel"] . " " . $_POST["achternaam"];
        

        
        try {
            $user->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'), $salt),
                
                'name' => Input::get('name'),
                'tussenvoegsel' => Input::get('tussenvoegsel'),
                'achternaam' => Input::get('achternaam'),
                'volledigenaam' => $volledigenaam,
                'age' => Input::get('age'),
                'adres' => Input::get('adres'),
                'woonplaats' => Input::get('woonplaats'),
                'functie' => Input::get('functie'),
                'beschikbaarheid' => Input::get('beschikbaarheid'),
                'motivatie' => Input::get('motivatie'),
                'leerdoel' => Input::get('leerdoel'),
                'tel' => Input::get('tel'),
                'email' => Input::get('email'),
                'linkedin' => Input::get('linkedin'),
                'site' => Input::get('website'),
                 //'accounttype' => Input::get('accounttype'),
                'salt' => $salt,
                'group' => 1
            ));

            //Session::flash('home', 'Je bent geregistreerd en kunt inloggen');
            //header('Location: index.php');
            //Redirect::to('login.php');

        } catch(Exception $e) {
            die($e->getMessage());
        }
    } else {
      // ouput errors
      //print_r($validation->errors());
      foreach($validation->errors() as $error) {
        echo $error, '<br>';
      }
    }
  }
}
?>
</head>
<body onLoad="loading()">

    <div class="content">

	<div class="list editprofile shadow">
	    <div class="title radius"><img src="img/icon_person.png" height="30" /><p>Account aanmaken</p></div>
	    <div class="content">

            <form id="frm" name="frm" method="post" action="">
		    <div class="title2"><h4>Account gegevens</h4></div>
		    <div class="blocks">
			<div class="label">User:</div><input type="text" class="textbox" name="username" id="username" value="" autocomplete="off"><br />
			<div class="label">Wachtwoord:</div><input type="password" name="password" id="password" class="textbox" ><br />
            <div class="label">Wachtwoord opnieuw:</div><input type="password" name="password_again" id="password_again" class="textbox"><br />
			<div class="label">Naam:</div>    <input type="text" name="name" value="" id="name" class="textbox"><br />
			<div class="label">Tussenvoegsel:</div><input type="text" class="textbox" name="tussenvoegsel" id="tussennvoegsel" class="textbox"><br />
            <div class="label">Achternaam:</div><input type="text" class="textbox" name="achternaam" id="achternaam" class="textbox"><br>
            <div class="label">Leeftijd:</div><input type="text" class="textbox" name="age" id="age" class="textbox"><br>
    <div class="label">Adres:</div><input type="text" class="textbox" name="adres" id="adres" class="textbox"><br>
    <div class="label">Woonplaats:</div><input type="text" class="textbox" name="woonplaats" id="woonplaats" class="textbox"><br>
    <div class="label">Functie:</div><input type="text" class="textbox" name="functie" id="functie" class="textbox"><br>
    <div class="label">Beschikbaarheid:</div><input type="text" class="textbox" name="beschikbaarheid" id="beschikbaarheid" class="textbox"><br>
    <div class="label">Motivatie:</div><input type="text" class="textbox" name="motivatie" id="motivatie" class="textbox"><br>
    <div class="label">Leerdoel:</div><input type="text" class="textbox" name="leerdoel" id="leerdoel" class="textbox"><br>
    <div class="label">Tel:</div><input type="text" class="textbox" name="tel" id="tel" class="textbox"><br>
    <div class="label">Email:</div><input type="text" class="textbox" name="email" id="email" class="textbox"><br>
    <div class="label">Linkedin:</div><input type="text" class="textbox" name="linkedin" id="linkedin" class="textbox"><br>
     <div class="label">Website:</div><input type="text" class="textbox" name="website" id="website" class="textbox"><br>
    

 

            <div class="label">Accounttype</div> <input type="radio" name="accounttype" value="0"> lid
			<input type="radio" name="accounttype" value="1" /> projectleider
			<input type="radio" name="accounttype" value="2" /> admin<br><br>
		    </div> -->
		    <input type="submit" class="button" value="account aanmaken" />
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
		</form>
	    </div>
	</div>
    </div>
</body>
</html>
