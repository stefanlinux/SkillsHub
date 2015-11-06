<?php
error_reporting(1);

require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    exit;
}
include("include/global_header.php");
include ("include/menu.php");
include ('fancybox.js');
$p=$_GET["p"];
$project = new Project($p);

?>
</head>
<body onLoad="menu()">
<div class="content">
<?php

if (isset($_POST['addskill'])) {
    $project->update_project_skill($p);
}

if(isset($_POST['submit'])) {
    $project->update_project($p);
    // echo "<meta http-equiv=\"refresh\" content=\"0;url=project/$p\"  >";
}


$project->get_projects($p);

//$sql = "SELECT `projects`.`id`, `projects`.`naam`, `projects`.`omschrijving`, `projects`.`startdatum`, `projects`.`einddatum`, `users`.`naam` as leidernaam, `users`.`tussenvoegsel` as leidertussenv, `users`.`achternaam` as leiderachtern, `projects`.`opdrachtgever`, `projects`.`status`, `projects`.`evaluatie`, `projects`.`skills` FROM `projects`,`users` WHERE `projects`.`id`='$p' AND `projects`.`projectleider` = `users`.`id`";
?>
        <div class="list editprofile shadow">
            <div class="title radius">
                <img src="img/iSkill.png" height="30" /><p>Project bewerken</p>
                <a class="edit3"></a> 
                <a href="project.php?n=<?php echo $id; ?>" class="edit3">Project pagina bekijken</a>
            </div>

            <div class="content">
                <form action="<?php echo $_SERVER['PHP_SELF'] . "?p=" . $p; ?>" method="POST" name="profielbewerken" enctype="multipart/form-data"> 
                    
                    <div class="title2"><h4>Afbeeldingen</h4></div>
                    <div class="blocks">
                        <div class="label">Projectfoto:</div>

<?php
if (file_exists("img/projectpic/" . $p . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox profielpic\" href=\"img/projectpic/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/projectpic/" . $id . ".jpg\"></a>";
}
else
{
    echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
}
?>
                        <input type="file" name="fileup" /><br/><br/>
                        <div class="label">Projectbanner:</div>
<?php
if (file_exists("img/projectbanner/" . $p . ".jpg")) {
    /*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
    echo "<a class=\"fancybox profielpic\" href=\"img/projectbanner/" . $id . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/projectbanner/" . $id . ".jpg\"></a>";
}
else
{
    echo "<a class=\"fancybox profielpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
}
?>
                        <input type="file" name="fileup2" /><br/>
                    </div>
                    <div class="title2"><h4>Algemene informatie</h4></div>
                    <div class="blocks">


                        <div class="label">Naam:</div>
                        <input type="text" id="naam" name="naam" class="textbox" value="<?php echo $naam; ?>" /><br/>    
                        <div class="label">Omschrijving:</div>
                        <textarea id="omschrijving" name="omschrijving" class="textbox" ><?php echo $omschrijving; ?></textarea><br />
                        <div class="label">Opdrachtgever:</div>
                        <select class="textbox" name="opdrachtgever" style="width: 226px" value=""><option value=""></option>
<?php
$sql = "SELECT * FROM markt ";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
    echo '<option   ';

    if ($opdrachtgever == $rij->opdrachtgever) {
        echo 'selected ';
    }
    echo '" >' . $rij->opdrachtgever . '</option>';
}
?>
                        </select><br /><br />
                        <div class="label">Projectleider:</div>
                        <select class="textbox" name="projectleider" style="width: 226px"><option value=""></option>
<?php
$results = $project->get_form_users();
echo $results;
?>
                        </select><br><br>
                     
                        <div class="label">Skills toevoegen:</div>
                        <select name="addskill" class="textbox" style="width: 226px"><option value=""></option>
<?php
$sql = "SELECT skill FROM skills";
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
    echo '<option>' .$rij->skill. '</option>';
    
}
?>
        </select><br/><br>
<div class="label">level:</div>
                <select class="textbox" name="level" style="width: 226px">
                    <option value=""></option>
                    <option value="0">Ontwikkel</option>
                    <option value="1">Basis</option>
                    <option value="2">Professioneel</option>
                </select><br><br>

                        
<div class="label">Skills:</div> <div class="one" style="display: inline-block; width: 500px; clear: both; border: 1px solid #BBB;">
<?php

$sql = "SELECT projectskills.id as id,
skills.skill as skill,
projectskills.lvl as lvl FROM projectskills,skills
WHERE projectskills.projectid='$p'
AND projectskills.skillid = skills.id";

$data = DB::getInstance()->query($sql);

if($data != "") {
    foreach ($data->results() as $rij) {
        // echo "<div onclick=\"location.href='search.php?s=" . $rij->id . "';\" class=\"listitem lvl" . $rij->lvl;
        echo "<div  class=\"listitem lvl" . $rij->lvl;
        if (!$user->hasPermission('admin')) {
            echo " noadmin";
        }
        echo "\">" . $rij->skill; 
        if ($user->hasPermission('admin')) {
            echo "<a class=\"deleteitem\" href=\"deleteprojectskill.php?t=" .$rij->id. "\">x</a>"; 
        }
        echo "</div>";
    }
}
?>

                            
</div><br><br>

                        <div class="label">Prijs:</div> <input type="text" id="prijs" class="textbox" name="prijs" value="<?php echo $prijs;  ?>"><br>
<div class="label">kosten:</div> <input type="text" id="kosten" class="textbox" name="kosten" value="<?php echo $kosten;  ?>"><br>
<div class="label">Storting Stimuleringsfonds:</div> <input type="text" id="storting" class="textbox" name="storting" value="<?php echo $storting;  ?>"><br>

<?php
// if($projectleider == "yes" OR $user->hasPermission('admin')) {
//     echo "<a href=\"projectskills.php?p=" . $p  . "\"><img src=\"img/icon_edit.png\"></a>";
// }




?>
                    </div>
                    <div class="title2"><h4>Status</h4></div>
                    <div class="blocks">
                        <div class="label">Status</div> <input type="radio" name="status" value="0" <?php if ($status == 0) echo 'checked'; ?> /> lopend
                        <input type="radio" name="status" value="1" <?php if ($status == 1) echo 'checked'; ?> /> afgerond
                        <input type="radio" name="status" value="2" <?php if ($status == 2) echo 'checked'; ?> /> aankomend<br /><br />
                        <div class="label">Startdatum:</div> <input type="date" id="startdatum" name="startdatum" class="textbox" value="<?php echo $startdatum; ?>" /><br/>
                        <div class="label">Einddatum:</div> <input type="date" id="einddatum" name="einddatum" class="textbox" value="<?php echo $einddatum; ?>" /><br/>
                        
                    </div>
<?php if($status == 1)
{
?>
    <div class="title2"><h4>Evaluatie</h4></div>
    <div class="blocks">
        <div class="label">Evaluatie</div> <textarea id="evaluatie" name="evaluatie" class="textbox" ><?php echo $evaluatie; ?></textarea><br />
    </div>
<?php
}
else {
?>
    <textarea id="evaluatie" style="display:none" name="evaluatie" class="textbox" ><?php echo $evaluatie; ?></textarea><br />
<?php
}
?>
<input type="submit" name='submit' id="opslaan" class="button" value="Opslaan"> 
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php

// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/
$uploadpath = 'upload/';      // directory to store the uploaded files
$max_size = 2000;          // maximum file size, in KiloBytes
$alwidth = 2000;            // maximum allowed width, in pixels
$alheight = 2000;           // maximum allowed height, in pixels
$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');        // allowed extensions

if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
    $uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       // gets the file name
    $sepext = explode('.', strtolower($_FILES['fileup']['name']));
    $type = end($sepext);       // gets extension
    list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
    $err = '';         // to store the errors   


    // Checks if the file has allowed type, size, width and height (for images)
    if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
    if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
    if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;


    // If no errors, upload the image, else, output the errors
    if($err == '') {
	if(move_uploaded_file($_FILES['fileup']['tmp_name'], "img/projectpic/" . $p . ".jpg"  )) { 

	}
	else echo '<b>Unable to upload the file.</b>';
    }
    else echo $err;
}
if(isset($_FILES['fileup2']) && strlen($_FILES['fileup2']['name']) > 1) {
    $uploadpath = $uploadpath . basename( $_FILES['fileup2']['name']);       // gets the file name
    $sepext = explode('.', strtolower($_FILES['fileup2']['name']));
    $type = end($sepext);       // gets extension
    list($width, $height) = getimagesize($_FILES['fileup2']['tmp_name']);     // gets image width and height
    $err = '';         // to store the errors
    
    // Checks if the file has allowed type, size, width and height (for images)
    if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup2']['name']. '</b> not has the allowed extension type.';
    if($_FILES['fileup2']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
    if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
    // If no errors, upload the image, else, output the errors
    if($err == '') {
	if(move_uploaded_file($_FILES['fileup2']['tmp_name'], "img/projectbanner/" . $p . ".jpg"  )) { 

	}
	else echo '<b>Unable to upload the file.</b>';
    }
    else echo $err;
}
?>
