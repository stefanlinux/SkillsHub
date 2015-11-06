<?php
require_once 'core/init.php';

// if(Session::exists('home')) {
//     echo '<p>' . Session::flash('home') . '</p>';
// }
//echo Session::get(Config::get('session/session_name')); // Laat de id van de user zien

$user = new User();
if ($user->isLoggedIn()) {
    if ($user->hasPermission('admin')) {
	   
	    $id = Session::get(Config::get('session/session_name'));
	    Redirect::to("admin-leden.php?$id");
    }
    $id = Session::get(Config::get('session/session_name'));
	//echo "<meta http-equiv=\"refresh\" content=\"0;url=profiel/" . Session::get(Config::get('session/session_name')) . "\" >";
	Redirect::to("profiel/$id");

} else {
    Redirect::to('login');
}



// <?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username); ?> geef username
// if ($user->hasPermission('admin')) {
// 	echo '<p>Je bent administrator!</p>';
// }


//echo $user->data()->username;
//var_dump(Config::get('mysql/host')); // 127.etc

// $users = DB::getInstance()->query("SELECT username FROM users");
// if( $users -> count($users)) {
//     foreach( $users as $user) {
//         echo $user->username;
//     }
// }

//$db = new DB();

// $user2 = DB::getInstance()->query("SELECT * FROM users");
// //$user = DB::getInstance()->get('users', array('username', '=', 'Alex'));
// $user = DB::getInstance()->get('users', array('username', '=', 'Alex'));

// if(!$user->count()) {
//     echo "No user";
// } else {
//     echo $user->first()->username;
// }

// foreach ( $user2->results() as $user1) {
//     echo $user1->username, '<br>';
// }

// $user = DB::getInstance()->insert('users', array(
//     'username' => 'Dale',
//     'password' => 'password',
//     'salt'     => 'salt'
// ));

// $user = DB::getInstance()->update('users', 5,  array(

//     'password' => 'newpassword',
//     'name' => 'Bil Clinton'

// ));
