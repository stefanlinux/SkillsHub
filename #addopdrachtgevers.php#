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
date_default_timezone_set('Europe/Amsterdam');
?>
</head>
<body>

<div class="content">

<?php
if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
        $opdrachtgever = new Opdrachtgever();
        try {
            $opdrachtgever->create_markt(array(
                'opdrachtgever' => Input::get('opdrachtgever'),
                
                'tel' => Input::get('tel'),
                'email' => Input::get('email'),
                'plaats' => Input::get('plaats'),
                'straat' => Input::get('straat'),
                'postcode' => Input::get('postcode'),
                'website' => Input::get('website')

            ));

            $opdrachtgever->create_opdrachtgever(array(
                'bedrijf' => Input::get('opdrachtgever'),
                'voornaam' => Input::get('voornaam') ,
                'achternaam' => Input::get('achternaam'),
                'tel' => Input::get('tel'),
                'email' => Input::get('email')
            ));


            $volledigenaam =  Input::get('voornaam')." ".Input::get('tussenvoegsel') . " " .Input::get('achternaam') ;
            $opdrachtgever->create_contactpersoon(array(
                'opdrachtgever' => Input::get('opdrachtgever'),
                'voornaam' => Input::get('voornaam'),
                'tussenvoegsel' => Input::get('tussenvoegsel'),
                'achternaam' => Input::get('achternaam'),
                'volledigenaam' => $volledigenaam,
                 'tel' => Input::get('tel2'),
                'email' => Input::get('mail'),
                
            ));
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
     }
}

 
?>
<div class="list editprofile shadow">
    <div class="title radius"><img src="img/iSkill.png" height="30" /><p>Opdrachtgever toevoegen</p></div>
    <div class="content">
	<form id="frm" name="frm" method="post" action="">
	    <div class="title2"><h4>Opdrachtgever</h4></div>
	    <div class="blocks">
		<div class="label">Bedrijf:</div> <input type="text" id="opdrachtgever" class="textbox" name="opdrachtgever" value=""><br />
    	        <!-- <div class="label">Voornaam:</div> <input type="text" id="voornaam" class="textbox" name="voornaam" value=""><br />
    	        <div class="label">Achternaam:</div> <input type="text" id="achternaam" class="textbox" name="achternaam" value=""><br /> -->
		<div class="label">Telefoon:</div> <input type="text" id="tel" class="textbox" name="tel" value=""><br />
        
        <div class="label">Plaats:</div> <input type="text" id="plaats" class="textbox" name="plaats" value=""><br />
		<div class="label">Straat:</div> <input type="text" id="straat" class="textbox" name="straat" value=""><br />
		<div class="label">Postcode:</div> <input type="text" id="postcode" class="textbox" name="postcode" value=""><br />
                <!-- <div class="label">Mail:</div> <input type="text" id="mail" class="textbox" name="email" value=""><br /> -->
    	<div class="label">Website:</div> <input type="text" id="website" class="textbox" name="website" value=""><br />

	    </div>
           
	   

    	<div class="title2"><h4>Contactpersoon toevoegen</h4></div>
				<div class="blocks">
					<div class="label">Naam:</div> <input type="text" id="voornaam" name="voornaam" class="textbox" value="" /><br/>
					<div class="label">Tussenvoegsel:</div> <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="textbox" value="" /><br/>
					<div class="label">Achternaam:</div> <input type="text" id="achternaam" name="achternaam" class="textbox" value="" /><br/>
                                        
					<div class="label">Tel:</div> <input type="text" id="tel2" name="tel2" class="textbox" value="" /><br/>
					<div class="label">Mail:</div> <input type="text" id="mail" name="mail" class="textbox" value="" /><br/>
				</div>
                                 <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<input type="submit" name='submit' id="opslaan" class="button" value="Toevoegen"/> 
    </form>

    

    </div>
</div>
</div>
</body>
</html>
