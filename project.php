<?php
error_reporting(0);
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
include("include/global-header-project.php");
include ("include/menu.php");
include ("fancybox.js");

$n=$_GET["n"];
$userid = Session::get(Config::get('session/session_name'));
$project = New Project($n);
$data = Project::get_project($n, $userid); //$sql = "SELECT * FROM `projects` WHERE id='$n'";

if ($data != "") {
    foreach ($data->results() as $rij) {
        $projectname = $rij->naam;
        $omschrijving = $rij->omschrijving;
        $evaluatie = $rij->evaluatie;
        $skills = $rij->skills;
        $startdatum = $rij->startdatum;
        $einddatum = $rij->einddatum;
        $opdrachtgever = $rij->opdrachtgever;
        $leider = $rij->projectleider;
        $status = $rij->status;
        $projectid = $rij->id;
        $prijs = $rij->prijs;
        $kosten = $rij->kosten;
        $storting = $rij->storting;
	
        if ($rij->projectleider == $userid) {
            $projectleider = "yes";
        } else {
            $projectleider = "no";
        }
	
        if ($status == 0) {
            $status = "lopend";
        } else if ($status == 1) {
            $status = "afgerond";
        } else {
            $status = "aankomend";	
        }
    }
}
?>
</head>
<body>
<div class="content">

<?php 

echo $project->get_project_info($n);
if($projectleider == "no") {
    echo $project->get_project_user_status($userid, $projectname, $status);
    }

if (file_exists("img/projectpic/" . $projectid . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox profielpic projectpic\" href=\"img/projectpic/" . $projectid . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/projectpic/" . $projectid . ".jpg\"></a>";
}
else {
    echo "<a class=\"fancybox profielpic projectpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
}


if ($projectleider == "yes") {
    echo '<div class="connectstatus">';
    echo "<a class=\"button projectbtn\" href=\"projectbewerken.php?p=" . $projectid . "\">Project bewerken</a> ";
    echo '</div>';
} 

echo '<div class="projectbanner">';

if (file_exists("img/projectbanner/" . $projectid . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox\" href=\"img/projectbanner/" . $projectid . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/projectbanner/" . $projectid . ".jpg\" \></a>";
} else {
    echo "<a class=\"fancybox\" href=\"img/noimage.jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/noimage.jpg\" \></a>";
}
echo '</div>';
echo '<div class="projectcontent">';
if($omschrijving != "") {
    echo '<div class="omschrijving"><h3>Omschrijving</h3>' . $omschrijving . '</div>';
}
if($status == "afgerond") {
    if($evaluatie != "") {
        echo '<div class="omschrijving"><h3>Evaluatie</h3>' . $evaluatie . '</div><br />';
    }
}

echo '<div class="media">';

$sql = "SELECT * FROM `projects` WHERE `projectleider` = '" .$userid. "' ";
$data = DB::getInstance()->query($sql);

$arrayprojectsusers = array();
if ($data != "")
{
    foreach($data->results() as $rij)
    {
        //echo $rij->omschrijving;
        array_push($arrayprojectsusers,$rij->naam);
    }
}

//$sql = "SELECT * FROM `media` WHERE project='$n' ";
//$data = DB::getInstance()->query($sql);

echo '</div>';
echo '</div>';
?>



<div class="content-left">
    <div class="list peoplelist shadow">
	<div class="title radius">
            <img src="img/icon_person.png" height="30" /><p>Projectleden</p>
<?php
//				
if($projectleider == "yes" || $user->hasPermission('admin') ) 
{
    echo "<a class=\"edit\" href=\"projectleden.php?p=" . $projectname  . "\"><img src=\"img/icon_edit.png\"></a>";
}
?>
        </div>
        <div class="content">
<?php 
$sql = "SELECT * FROM `projectsusers` WHERE project='$projectname' AND accept='3' ";
$data = DB::getInstance()->query($sql);
if($data != "") {
    foreach ($data->results() as $rij) {
        $usersid = $rij->usersid;
	
        $sql = "SELECT * FROM `users` WHERE id='$usersid' ";
        $data2 = DB::getInstance()->query($sql);

        foreach($data2->results() as $rij2) {
            $naam = $rij2->volledigenaam;
        }
        echo "<div class=\"listitem2\">";
	
        if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) 
        {
            echo "<a href=\"profiel/" . $rij->usersid . "\">";
            echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>";
        }
        else
        {
            echo "<a href=\"profiel/" . $rij->id . "\">";
            echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
        }
	
        if ($projectleider == "yes" || $user->hasPermission('admin')) { 
            if ($rij->usersid != $leider) {
                echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij->id . "&p=" .$projectname. "\"> Verwijderen</a>";
            }
        }
        echo  "<p class=\"omschrijving\">Functie: " . $rij->functie ."<br />Omschrijving: " . $rij->omschrijving  . "</p>";
        echo  "</div>";
    }
}
?>
        </div>
    </div>



    <div class="list skillslist shadow">
        <div class="title radius">
            <img src="img/icon_skill.png" height="30" /><p>Skills</p>
            
<?php
if ($projectleider == "yes" || $user->hasPermission('admin')) {
    //    echo "<a class=\"edit\" href=\"projectskills.php?p=" . $projectid  . "\"><img src=\"img/icon_edit.png\"></a>";
}
?>
            <div class="legenda">
		<!-- <div class="color ont"></div><h4>Ontwikkel</h4>
		     <div class="color basis"></div><h4>Basis</h4>
		     <div class="color prof"></div><h4>Professioneel</h4> -->
			</div>
        </div>
        <div class="one">
<?php 
$sql = "SELECT projectskills.id as id, skills.skill as skill, projectskills.lvl as lvl FROM projectskills, skills WHERE projectskills.projectid='$projectid' AND projectskills.skillid = skills.id";
$data = DB::getInstance()->query($sql);
if($data != "") {
    foreach ($data->results() as $rij) {
        echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem lvl" . $rij->lvl;
	
	
        echo "\">" . $rij->skill; 
        //if($_SESSION["user"] == "Admin") {
        // if ($user->hasPermission('admin')) {
        //    echo "<a class=\"deleteitem\" href=\"deleteprojectskill.php?t=" .  $rij->id. "&p=" . $projectid . "\">x</a>"; 
        // } else {
        //     echo " noadmin";
        // }
        
        echo "</div>";
    }
}
?>
        </div>
    </div>
<?php
$projectleider = Session::get(Config::get('session/session_name'));
$sql = "SELECT * FROM `projects` WHERE projectleider=$projectleider";
$data = DB::getInstance()->query($sql);
$arrayprojectsusers = array();
if ($data != "") {
    foreach($data->results() as $rij) {
        array_push($arrayprojectsusers,$rij->naam);
    }
}

//if (in_array($n, $arrayprojectsusers) OR $_SESSION["accounttype"] == 2) {
//			if (in_array($n, $arrayprojectsusers)) { // note off accouttype
if(true ) { 
?>
    <div class="list request shadow">
        <div class="title radius"><img src="img/icon_project-aanvragen.png" height="30" /><p>Projectaanvragen</p>
        </div>
        <div class="content">
<?php 
//$sql = "SELECT * FROM `projectsusers` WHERE `projectid`='$n' AND `accept`='1' ";
$sql = "SELECT * FROM `projectsusers` WHERE `project`='$projectname' AND `accept`='1' ";
$data = DB::getInstance()->query($sql);
if ($data != "")	{
    foreach ($data->results() as $rij) {
        $usersid = $rij->usersid;

        $sql = "SELECT * FROM `users` WHERE `id`='$usersid' ";
        $data2 = DB::getInstance()->query($sql);

        foreach ($data2->results() as $rij2) {
            $naam = $rij2->volledigenaam;
        }

        echo "<div class=\"listitem2\">";
        if (file_exists("img/profilepic/" . $rij->usersid . ".jpg")) {
            echo "<a href=\"profiel/" . $rij->usersid . "\">";
            echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij->usersid . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
        }
        else {
            echo "<a href=\"profiel/" . $rij->usersid . "\">";
            echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
        }

        if($projectleider == "yes" || $user->hasPermission('admin') ) {
            echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij->usersid . "&p=" .$projectname. "\">Weigeren</a>";
            echo " <a class=\"edit\" href=\"acceptuserinproject.php?id=" . $rij->usersid ."  \">Accepteren</a>";
        }
        echo "</div>";
    }
}
?>
        </div>
    </div>

<?php 
}
//if (in_array($n, $arrayprojectsusers)  OR $_SESSION["accounttype"] == 2) note UITGEZET
if (in_array($n, $arrayprojectsusers))
{
		
    ?>
    <div class="list request shadow">
    <div class="title radius"><img src="img/icon_project-genodigden.png" height="30" /><p>Genodigden</p>
<?php
	if($projectleider == "yes" OR $_SESSION["accounttype"] == 2) echo "<a class=\"edit\" href=\"uitnodigen/".$n."\"><img src=\"img/icon_add.png\"></img></a>";
    ?>
    </div>
    <div class="content">
<?php 
    $data = $rs->dataOpvragen("SELECT * FROM `projectsusers` WHERE projectid='$n' AND accept='2' ");
    if($data != "")
    {
        foreach ($data as $rij) 
        {
            $usersid = $rij['usersid'];
            $data2 = $rs->dataOpvragen("SELECT * FROM `users` WHERE id='$usersid' ");
            foreach($data2 as $rij2)
            {
                $naam = $rij2["volledigenaam"];
            }
            echo "<div class=\"listitem2\">";
            if (file_exists("img/profilepic/" . $rij['usersid'] . ".jpg")) {
                echo "<a href=\"profiel/" . $rij["usersid"] . "\">";
                echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij['usersid'] . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
            }
            else
            {
                echo "<a href=\"profiel/" . $rij["usersid"] . "\">";
                echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
            }
			echo "<a class=\"edit\" href=\"removeuserfromproject.php?id=" . $rij['id'] ."  \">Uitnodiging intrekken</a>";
		
            echo "</div>";
        }
    }
    ?>
    </div>
    </div>
<?php
}
?>
</div>

<div class="content-right">

<div class="projectdetails shadow">
    <div class="title radius">
        <img src="img/icon_aanspreekpunten.png" height="30" /><p>Project Details</p>
        
        <br><br>
            <div class="title2 title3"><h4>Financiering</h4></div>
            
              
            <div class="content-left">Prijs: <span class="rechts-uitlijnen"> <?php echo $prijs; ?> </span></div>
	    <div class="content-left">Kosten: <span class="rechts-uitlijnen"><?php echo $kosten; ?></span></div>
                <div class="title2 title3"></div>
		<div class="content-left">totaal: <span class="rechts-uitlijnen"><?php echo $prijs - $kosten; ?></span></div>
            <div class="content-left">Storting fonds: <span class="rechts-uitlijnen"><?php echo $storting; ?></span></div>
        
    </div>
</div>
    
    <div class="people shadow">
    <div class="title radius">
    <img src="img/icon_aanspreekpunten.png" height="30" /><p>Contactpersonen</p>
    </div>
	<div class="content">
    <div class="title2 title4"><h4>Projectleider</h4></div>
    <div class="projectleider">
<?php
    $sql = "SELECT projectleider FROM projects WHERE id=$n";
$data = DB::getInstance()->query($sql);

if ($data != "") {
    foreach ($data->results() as $rij) {
				
        $usrid = intval( $rij->projectleider);
                
        $sql = "SELECT * FROM `users` WHERE `id` =  '".$usrid."'";
        $data2 = DB::getInstance()->query($sql);

        foreach ($data2->results() as $rij2) {
                    
            $leiderid = $rij2->id;
            $naam = $rij2->volledigenaam;
            $email = $rij2->email;
					
            if ($email == "") {
                $email = "-";
            }
					
            $tel = $rij2->tel;
					
            if ($tel == 0) {
                $tel = "-";
            }
					
            $functie = $rij2->functie;

            if (file_exists("img/profilepic/" . $rij2->id . ".jpg")) {
                echo "<a href=\"profiel/" . $rij2->id . "\">";
                echo "<img class=\"profielpicc\" src=\"img/profilepic/" . $rij2->id . ".jpg\" height=\"40px\" width=\"40px\" ><p>" . $naam . "</p></a>" ;
            }
            else {
                echo "<a href=\"profiel/" . $rij2->id . "\">";
                echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  ><p>" . $naam . "</p></a>" ;
            }

            echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $email . '</div>';
            echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
            echo '<div class="contactinfo"><div class="content-left">Functie: </div>' . $functie . '</div>';
				 	
        }
    }

}
?>
</div>
<br />
<?php if ($projectleider == "yes") { ?>
<div class="title2 title4"><h4>Contactpersoon</h4></div>
           <div class="projectleider">
<?php
           $sql = "SELECT * FROM `projects` WHERE id='$n'";
$data = DB::getInstance()->query($sql);
		
if ($data != "")	{
    foreach ($data->results() as $rij) {
        $opdrachtgever = $rij->opdrachtgever;
        //				$sql = "SELECT opdrachtgevers.voornaam, opdrachtgevers.tussenvoegsel, `opdrachtgevers`.`achternaam`, `opdrachtgevers`.`mail`, `opdrachtgevers`.`tel`, `markt`.`opdrachtgever` FROM `opdrachtgevers`, `markt` WHERE `opdrachtgevers`.`id`='$rij->opdrachtgever' AND `opdrachtgevers`.`opdrachtgever` = `markt`.`oprachtgever`";
        //$opdrachtgever = $rij->opdrachtgever;
        /* $sql = "SELECT * FROM opdrachtgevers WHERE project_rel ='$n'";

           $data2 = DB::getInstance()->query($sql);

           if($data2 != "") {
           foreach ($data2->results() as $rij2) {	
           $voornaam = $rij2->voornaam;
           $tussenvoegsel = $rij2->tussenvoegsel;
           $achternaam = $rij2->achternaam;
           $naam = $voornaam . " " . $tussenvoegsel . " " . $achternaam;
           $mail = $rij2->email;
	   
           if ($mail == "") {
           $mail = "-";
           }
	   
           $tel = $rij2->tel;
	   
           if ($tel == 0) {
           $tel = "-";
           }
	   
           $opdrachtgever = $rij2->opdrachtgever;
           echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  /><p>" . $naam . "</p></a>" ;
           echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $mail . '</div>';
           echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
           echo '<div class="contactinfo"><div class="content-left">Berijf: </div>' . $opdrachtgever . '</div>';
           }
           } */

        
        $sql = "SELECT * FROM contactpersonen WHERE opdrachtgever ='$opdrachtgever'";

        $data2 = DB::getInstance()->query($sql);

        if($data2 != "") {
            foreach ($data2->results() as $rij2) {	
                $voornaam = $rij2->voornaam;
                $tussenvoegsel = $rij2->tussenvoegsel;
                $achternaam = $rij2->achternaam;
                $naam = $voornaam . " " . $tussenvoegsel . " " . $achternaam;
                $mail = $rij2->email;
						
                if ($mail == "") {
                    $mail = "-";
                }
						
                $tel = $rij2->tel;
						
                if ($tel == 0) {
                    $tel = "-";
                }
						
                $opdrachtgever = $rij2->opdrachtgever;
                echo "<img class=\"profielpicc\" src=\"img/profilepic/noprofile.jpg\" height=\"40px\" width=\"40px\"  /><p>" . $naam . "</p></a>" ;
                echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $mail . '</div>';
                echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
                echo '<div class="contactinfo"><div class="content-left">Berijf: </div>' . $opdrachtgever . '</div>';
            }
        }
        }         
    }
}
?>
</div>
</div>
</div>
</div>


</div>

<script type="text/javascript">
           function menu(){
               $('.navprojecten').addClass('selectedmenu');
           }
</script>
</body>
</html>


