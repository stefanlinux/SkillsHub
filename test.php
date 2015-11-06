<?php
require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}
//echo Session::get(Config::get('session/session_name')); // Laat de id van de user zien

$user = new User();
if ($user->isLoggedIn()) {



    //$projectleider = $rij->projectleider;
    //$projectleider = 42;
                        $sql2 = "SELECT projectleider FROM projects WHERE id = 18";
                        $data2 = DB::getInstance()->query($sql2);
                        //echo $data2->projectleider;
                                               foreach($data2->results() as $rij2) {
                         $puser =  $rij2->projectleider;
                                               }echo 'de naam is' . $puser;



    // $usersid = 42;
	// $sql = "SELECT * FROM `users` WHERE id=$usersid";
	// 						$data2 = DB::getInstance()->query($sql);

	// 							foreach($data2->results() as $rij2) {
	// 							echo "naam is: " .  $rij2->volledigenaam ."<br>";
	// 							}
  



    // $u = Session::get(Config::get('session/session_name'));
	// $sql = "SELECT `skills`.`id` as `id`, `skills`.`skill` as `skill`, `skillsusers`.`lvl` as `lvl` FROM `skillsusers`, `skills` WHERE `skillsusers`.`usersid`='$u' AND `skillsusers`.`skill` = `skills`.`id` ORDER BY lvl ASC";
    // $data = DB::getInstance()->query($sql);
			

    //         foreach ($data->results() as $item) {
    //             echo  "id is:" . $item->id . " = skill is: " . $item->skill;
    //         }

            echo "<br>";
              echo "----";  
              $n = 18;



	$sql = "SELECT * FROM `projectsusers` WHERE projectid=$n AND accept='3' ";
					$data = DB::getInstance()->query($sql);
					if($data != "") {
						foreach ($data->results() as $rij) {
							echo $usersid = $rij->usersid;
							$id = (int) $rij->usersid;
                            
							$sql = "SELECT * FROM users WHERE id=42";
							$data2 = DB::getInstance()->query($sql);
                            
						foreach ($data2->results() as $rijb) {
                            echo $rijb->volledigenaam ;
                            
								}

							// echo "<div class=\"listitem2\">";
							
							// if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) 
							// {
							// 	echo "<a href=\"profiel/" . $rij->usersid . "\">";
							// 	echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>";
	 						// }
	 						// else {
	 						// 	echo "<a href=\"profiel/" . $rij->id . "\">";
							// 	echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
	 						// }
							// //if($projectleider == "yes"  OR $_SESSION["accounttype"] == 2) {
							// if ($projectleider == "yes" ) { //note no accouttype
							// 	if ($rij->usersid != $leider) {
							// 		echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij->id ."  \"> Verwijderen</a>";
							// 	}
							// }
							// echo  "<p class=\"omschrijving\">Functie: " . $rij->functie ."<br />Omschrijving: " . $rij->omschrijving  . "</p>";
							// echo  "</div>";
						}}

   







    ?>
    <p>Hallo <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username); ?></a>!</p>

    <ul>
      <li><a href="logout.php">uitloggen</a></li>
      <li><a href="update.php">Verander  gegevens</a></li>
      <li><a href="changepassword.php">Verander wachtwoord</a></li>
    </ul>
    
<?php

    echo "username is: " . $user->data()->username . "<br>";
    echo "session/session_name is: " . Session::get(Config::get('session/session_name')) . "<br>";
    echo "<br>" . Session::get(Config::get('session/session_name')) . "<br>";



    echo $user->data()->username;
var_dump(Config::get('mysql/host')); // 127.etc

$users = DB::getInstance()->query("SELECT username FROM users");
if( $users -> count($users)) {
    foreach( $users as $user) {
        echo $user->username;
    }
}

// $db = new DB();
//echo $user->first()->username;
 $user2 = DB::getInstance()->query("SELECT * FROM projects ");
// //$user = DB::getInstance()->get('users', array('username', '=', 'das'));
// $user = DB::getInstance()->get('users', array('username', '=', 'das'));
 // echo "de naam is:" . $user->first()->username;

// if(!$user->count()) {
//     echo "No user";
// } else {
//     echo $user->first()->username;
// }

foreach ( $user2->results() as $user1) {
    echo "<br>" . "naam:" . $user1->naam, '<br>';
}


// $data2 = DB::getInstance()->query("SELECT * FROM `skillsusers`");
	
	
// foreach ($data2->results() as $rij) {
//     //        		if ($rij["usersid"] == $user) {
//                     //array_push($skillslist, $rij["skill"]);
//           echo "dee skills zij als volgt...:   " . $rij->skill;
// 		}



echo "<br>heleo<br>";
$data4 =  DB::getInstance()->query("SELECT * FROM vakgebieden ORDER BY id");
foreach ($data4->results() as $rij) {	
    //echo $rij->id;echo
    //                $rij->vakgebied ;


    echo    'value' .$rij->id.'">' . $rij->vakgebied;
							}	





// $user = DB::getInstance()->insert('users', array(
//     'username' => 'Dale',
//     'password' => 'password',
//     'salt'     => 'salt'
// ));

// $user = DB::getInstance()->update('users', 5,  array(

//     'password' => 'newpassword',
//     'name' => 'Bil Clinton'

// ));
    
// if ($user->hasPermission('admin')) {
// 	echo '<p>Je bent administrator!</p>';
// }
} else {
    // echo '<p>Je kan <a href="login.php">inloggen</a> of <a href="register.php">registreren</a></p>';
    Redirect::to('login');
}