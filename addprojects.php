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
include("include/datumselect.php");
?>
<script type="text/javascript">
	function menu() {
		$('.navprojecten').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu()">
    <div class="content">
<?php
	if(isset($_POST['projectnaam'])) {
        
		$projectleider = $_POST["projectleider"];
		$opdrachtgever = $_POST["opdrachtgever"];
        $projectnaam = $_POST[projectnaam];
			
		if (isset($_POST["omschrijving"])) {
			$omschrijving = str_replace("'","&#39;",$_POST["omschrijving"]);
		}
		
		$start = $_POST["date_year_start"]."-".$_POST["date_month_start"]."-".$_POST["date_day_start"];
		$eind = $_POST["date_year_end"]."-".$_POST["date_month_end"]."-".$_POST["date_day_end"];
		
		//$sql = "INSERT INTO projects (id , naam, omschrijving, skills, startdatum, einddatum, projectleider, opdrachtgever, bedrijf) VALUES (NULL, '$_POST[projectnaam]', '$omschrijving', '$_POST[skills]', '$_POST[startdatum]', '$_POST[einddatum]', '$projectleider', '$opdrachtgever', '$bedrijf' )";

        $sql = "INSERT INTO projects (id , naam, omschrijving, startdatum, einddatum, projectleider, status, opdrachtgever, bedrijf) VALUES (NULL, '$_POST[projectnaam]', '$omschrijving', '$start', '$eind', '$projectleider', 0, '$opdrachtgever', '$bedrijf' )";
        $data = DB::getInstance()->query($sql);
		// echo $sql."<br>";

        $sql = "INSERT INTO projectsusers (id , project, usersid, accept) VALUES (NULL, '$projectnaam', '$projectleider', '3' )";
		//echo $sql."<br>";
        $data = DB::getInstance()->query($sql);

        $sql = "SELECT * FROM `projects` WHERE naam = '$_POST[projectnaam]'";
        $data = DB::getInstance()->query($sql);

        foreach ($data->results() as $rij) {
			$target = $rij->id;
		}
		echo "<meta http-equiv=\"refresh\" content=\"0;url=project/" . $target .  "\"  >";
	}
	else {
        ?>
        <div class="list editprofile shadow">
		<div class="title radius">
        <img src="img/iSkill.png" height="30" /><p>Project aanmaken</p>
		</div>
		<div class="content">

        <form id="frm" name="frm" method="post" action="">
        <div class="title2"><h4>Bewerk het project na het aanmaken voor meer gegevens!!</h4><br><h4>Algemene informatie</h4></div>
        <div class="blocks">
        <div class="label">Projectnaam:</div> <input type="text" id="projectnaam" class="textbox" name="projectnaam" value=""><br>
        <div class="label">Opdrachtgever:</div> <select class="textbox" name="opdrachtgever" style="width: 226px">
<?php
        $sql = "SELECT * FROM `opdrachtgevers`";
        $data = DB::getInstance()->query($sql);

        foreach ($data->results() as $rij) {
            echo '<option value=' . $rij->id . '>';
            echo $rij->project_rel;
            if (!empty($rij->voornaam)) echo ' - ' . $rij->voornaam;
            if (!empty($rij->tussenvoegsel)) echo " " . $rij->tussenvoegsel;
            if (!empty($rij->achternaam)) echo " " . $rij->achternaam;
            echo '</option>';
        }
        ?>
        </select><br /><br />
              <div class="label">Projectleider:</div> <select class="textbox" name="projectleider" style="width: 226px">
<?php
        //        $sql = "SELECT * FROM `users` WHERE group != 2 AND user != 'Admin'";
                $sql = "SELECT * FROM `users` ";
        $data = DB::getInstance()->query($sql);
        foreach ($data->results() as $rij) {
            echo '<option value='.$rij->id . '>' . $rij->name;
            if(!empty($rij->tussenvoegsel)) echo " " . $rij->tussenvoegsel;
            if(!empty($rij->achternaam)) echo " " . $rij->achternaam;
            echo '</option>';
        }
        ?>
        </select><br /><br />
        <div class="label">Startdatum:</div> <?php echo date_dropdown('start',date("j"),date("n"),date("Y")); ?><br>
        

        <div class="label">Einddatum:</div> <?php echo date_dropdown('end',date("j"),date("n"),date("Y")); ?>
        
                        </div>
        <div class="title2"><h4>Omschrijving</h4></div>
        <div class="blocks">	
        <div class="label">Omschrijving:</div> <textarea name="omschrijving" class="textbox" style="overflow:auto" id="omschrijving" cols="67" rows="5"></textarea><br />
        <!-- <div class="label">:</div> <textarea name="skills" style="overflow:auto" class="textbox"  id="skills" cols=67 rows=5 ></textarea><br />
        </div> -->
        <input type="submit" class="button gradient schaduw" value="Project toevoegen" />  
        </form>
<?php
    }
?>
</div>
</div>
</div>
</body>
</html>
