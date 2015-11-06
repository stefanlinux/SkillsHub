<?php
require_once 'core/init.php';
//var_dump(Token::check(Input::get('token')));
//include 'functions/sanitize.php';

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
        // Session::flash('succes', 'Je bent geregistreerd!');
        // header('Location: index.php');
        // deze functie kan ander door naar een pagina te redirecten

        $user = new User();
        $salt = Hash::salt(32);

        try {
            $user->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'name' => Input::get('name'),
                'group' => 1
            ));

            Session::flash('home', 'Je bent geregistreerd en kunt inloggen');
            //header('Location: index.php');
            Redirect::to('login.php');

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


  error_reporting(E_ALL);
//error_reporting(E_ALL & ~E_NOTICE | E_STRICT); // Warns on good coding standards
  ini_set("display_errors", "1");


?>

<form action="" method="post" >
  <div class="field">
    <label for="username">Gebruikersnaam</label>
    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
  </div>

  <div class="field">
    <label for="password">Kies een wachtwoord</label>
    <input type="password" name="password" id="password">
  </div>

  <div class="field">
    <label for="password_again">Kies opnieuw een wachtwoord</label>
    <input type="password" name="password_again" id="password_again">
  </div>

  <div class="field">
    <label for="name">Je Naam</label>
    <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
  </div>
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" value="Registreer">
</form>
