  <?php
require_once 'core/init.php';

	$letter = "2";
	$letter2 = "#";
	$s = $_GET["s"];
$puser;



  function getProjectLeider($p) {
        $sql = "SELECT username FROM users WHERE id='$p'";
        $data = DB::getInstance()->query($sql);
        foreach($data->results() as $rij) {
            return $rij->username;
        }
    }




	// $data = $rs->dataOpvragen("SELECT projects.id as id, projects.naam as naam, projects.omschrijving as omschrijving, markt.opdrachtgever as bedrijf, users.name as leidernaam, users.tussenvoegsel as leidertussenvoegsel, users.achternaam as leiderachternaam FROM `projects`,`users`,`markt` WHERE projects.status='$s' AND `projects`.`projectleider` = `users`.`id` AND projects.bedrijf = `markt`.`id` ORDER BY projects.naam ");

// $sql = "SELECT projects.id as id,
// projects.naam as naam,
// projects.omschrijving as omschrijving,
// markt.opdrachtgever as bedrijf,
// users.name as leidernaam,
// users.tussenvoegsel as leidertussenvoegsel,
// users.achternaam as leiderachternaam
// FROM `projects`,`users`,`markt`
// WHERE projects.status='$s'
// AND `projects`.`projectleider` = `users`.`id`
// AND projects.bedrijf = `markt`.`id`
// ORDER BY projects.naam ";


// $sql = "SELECT
// projects.id as id,
// projects.naam as naam,
// projects.omschrijving as omschrijving,
// projects.opdrachtgever as opdrachtgever,
// users.name as leidernaam,
// users.tussenvoegsel as leidertussenvoegsel,
// users.achternaam as leiderachternaam
// FROM `projects`,`users`
// WHERE projects.status='$s'
// AND `projects`.`projectleider` = `users`.`id`
// ORDER BY projects.naam ";

$sql = "SELECT * FROM projects WHERE projects.status='$s'";
$data = DB::getInstance()->query($sql);
//var_dump($data);
// $project = new Project();
// $data = $project->get_all_projects();
if($data != "")	{ 
		foreach($data->results() as $rij) {
            //$projectleider = $rij->projectleider;
                        // $sql2 = "SELECT username FROM users WHERE id='$projectleider'";
                        // $data2 = DB::getInstance()->query($sql2);
                        // foreach($data2->results() as $rij2) {
                        //     $puser =  $rij2->username;
                        // }var_dump($puser);
// $puser = DB::getInstance()->get('users', array('id', '=', '$projectleider'));
                        // var_dump($data2) ;
            
			$string = $rij->naam;
			$letter = strtolower($string);
			if($letter != $letter2)	{
				echo '<br /><div id="' . $letter . '" class="title2 title3"><h4>' . $letter . '</h4></div><br />';
				$letter2 = $letter;
			}
			echo '<div title="' . $rij->omschrijving . '"class="searchresult2">' . '<a  href="project/' .  $rij->id . '">';
			echo '<p class="lid">' .$rij->naam . '</p>';

			echo  "<div class=\"opdrachtgever\"><h2>Opdrachtgever: " . $rij->opdrachtgever . "</h2></div>";
			echo  "<div class=\"projectleider\"><h2>Projectleider: " . getProjectLeider($rij->projectleider) . "</h2></div>";
			echo  "<div class=\"omschrijving\">" . $rij->omschrijving . "</div>";

			if (file_exists("img/projectpic/" . $rij->id . ".jpg")) {
							echo "<img class=\"radius2";
							echo "\"src=\"img/projectpic/" . $rij->id . ".jpg\">";
			}
			else {
				echo "<img class=\"radius2";
				echo "\" src=\"img/profilepic/noprofile.jpg\">";
			}
			echo "</a></div>";
		}
	}
?>