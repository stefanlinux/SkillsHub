<?php
require_once 'core/init.php';
include("include/global_header.php");
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {

      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)
      ));

      if ($validation->passed()) {
        // Log gebruiker in
        $user = new User();

        $remember = true;
          $login = $user->login(Input::get('username'), Input::get('password'), $remember);

          if ($login) {
  
              // if ($user->hasPermission('admin')) {
              //     Redirect::to("admin_leden.php?u=" . Session::get(Config::get('session/session_name')));
              // } 

              // Redirect::to("profiel.php" . Session::get(Config::get('session/session_name')));
              
              
               Redirect::to('index.php');
          } else {
              
              echo '<p>Sorry, login mislukt</p>';
          Redirect::to('login.php');
          }
          
      } else {
        foreach ($validation->errors() as $error) {
            echo $error, '<br>';
        }
      }
    }
}
?>

<link rel="stylesheet" href="css/registreren.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" /> 
<link href="slideshow/css/webwidget_slideshow_dot.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="css/login.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="slideshow/js/webwidget_slideshow_dot.js"></script>
</head>
<body onLoad="loading()">

	<div class="menu">
		<div class="menucontent">
			<img class="logo" src="img/logo.png" height="60px" />
			<div class="form">
				<form action="" method="post">
					<div class="field">
						<label style="margin: 16px 0 0 52px; position: relative; float: left;"  for="username">Gebruikersnaam</label>
						<input type="text" name="username" id="username" autocomplete="off" class="textbox" >
					</div>

					<div class="field">
						<label style="margin: 16px 0 0 -142px;padding-left:33px; position: relative; float: left;" for="password">Wachtwoord</label>
						<input type="password" name="password" id="password" autocomplete="off" class="textbox">
					</div>

					

					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input style="border:none; height:33px; width:108px; cursor:pointer; left:-122px;" type="submit" value="inloggen" class="button">
				</form>
			</div>
		</div>
	</div>
<div class="nav schaduw"></div>

    <div class="content">
    <img src="img/home.jpg" class="home-img schaduw" /><br />
    <?php
	include("include/global_footer.php");
?>
