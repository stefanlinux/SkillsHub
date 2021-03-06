<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
     Redirect::to('login.php');
}
//$u=$_GET["u"];
include("include/global_header.php");
include ("include/menu.php");
?>
<script type="text/javascript">
	function menu(){
		$('.navmarkt').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu()">

<div class="content">
<?php
if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'opdrrachtgever' => array(
    
      ),
      'tel' => array(
    
      ),
      'plaats' => array(

      ),
      'straat' => array(
      ),
      'postcode' => array(
      ),
      'website' => array(
      ),
    ));

    if($validation->passed()) {

        $opdrachtgever = new Opdrachtgever();
        
        // oude code insert in de markt insert (id , opdrachtgever, tel, plaats, straat, postcode, website)
        try {
            $opdrachtgever->create(array(
                'opdrachtgever' => Input::get('opdrachtgever'),
                'tel' => Input::get('tel'),
                'email' => Input::get('email'),
                'plaats' => Input::get('plaats'),
                'straat' => Input::get('straat'),
                'postcode' => Input::get('postcode'),
                'website' => Input::get('website')

            ));


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
	<div class="list editprofile shadow">
		<div class="title radius"><img src="img/iSkill.png" height="30" /><p>Opdrachtgever toevoegen</p></div>
		<div class="content">
			<form id="frm" name="frm" method="post" action="">
				<div class="title2"><h4>Opdrachtgever</h4></div>
				<div class="blocks">
					<div class="label">Opdrachtgever:</div> <input type="text" id="opdrachtgever" class="textbox" name="opdrachtgever" value=""><br />
					<div class="label">Telefoon:</div> <input type="text" id="tel" class="textbox" name="tel" value=""><br />
    <div class="label">Mail:</div> <input type="text" id="mail" class="textbox" name="email" value=""><br />
    <div class="label">Plaats:</div> <input type="text" id="plaats" class="textbox" name="plaats" value=""><br />
					<div class="label">Straat:</div> <input type="text" id="straat" class="textbox" name="straat" value=""><br />
					<div class="label">Postcode:</div> <input type="text" id="postcode" class="textbox" name="postcode" value=""><br />
    	<div class="label">Website:</div> <input type="text" id="website" class="textbox" name="website" value=""><br />
					
				</div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" class="button" value="Opdrachtgever toevoegen" />  
	</form>

		</div>
	</div>
</div>
</body>
</html>
