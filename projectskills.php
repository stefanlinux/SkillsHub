<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
$u = Session::get(Config::get('session/session_name'));
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
?>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/projectskills.js"></script>
    <link rel="stylesheet" href="css/skills.css" type="text/css" media="screen" />
    </head>
    <body onLoad="getProjectSkills('-',<?php echo $_GET['p']; ?>)">

    <script>
	function getProjectSkills(divisie,project) {
		projectskillssearch(divisie,project);
	}
</script>
<div class="content">
	<div class="projectlist skillslist2 shadow">
    <div class="title radius"><img src="img/iSkill.png" height="30" /><p>Skills</p> 
    <div class="divisie">Selecteer vakgebied: &nbsp;
<select class="textbox" onchange="getProjectSkills(this.value,<?php echo $_GET['p']; ?>)">
    <option>-</option>
<?php
    $sql = "SELECT * FROM vakgebieden";
//$data = $rs->dataOpvragen();
$data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
    //  echo $rij->id;
    // echo $rij->vakgebied;
      echo '<option value="'.$rij->id.'">' . $rij->vakgebied . '</option>';
}
?>
</select>
</div>
<a href="projectbewerken.php?p=<?php echo $_GET['p']; ?>" class="edit3">Terug naar Project bewerken</a>
    </div>
    <div id="projectskillsresults" class="content"></div>
	</div>
    </div>
    </body>
    </html>