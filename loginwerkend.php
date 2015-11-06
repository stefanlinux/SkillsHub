<?php
require_once 'core/init.php';
include("include/global_header.php");


if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        echo Input::get('token');
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)
      ));

      if ($validation->passed()) {
        // Log gebruiker in
        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

          if ($login) {
              Redirect::to('profile.php');
          } else {
              echo '<p>Sorry, login mislukt</p>';
          }
          
      } else {

          Redirect::to('profile.php');
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
<script type="text/javascript" src="slideshow/js/webwidget_slideshow_dot.js"></script>
</head>
<body>
<div class="content">
<?php
	
	include ("include/loginmenu.php");


?>
<img src="img/home.jpg" class="home-img schaduw" /><br />
<?php
	include("include/global_footer.php");
  error_reporting(E_ALL);
//error_reporting(E_ALL & ~E_NOTICE | E_STRICT); // Warns on good coding standards
  ini_set("display_errors", "1");
?>





