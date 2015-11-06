<?php
require_once 'core/init.php';
$user = new User();
$u = $_GET['u'];
if ($user->isLoggedIn()) {	
include("include/global_header.php");
include ("include/clsDatabase.php");
	include ("include/menu.php");
} else {

    // echo '<p>Je kan <a href="login.php">inloggen</a> of <a href="register.php">registreren</a></p>';
    Redirect::to('login');
}
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/skills.js"></script>
<link rel="stylesheet" href="css/skills.css" type="text/css" media="screen" />
</head>
<body onLoad="getSkills('-',<?php echo $u; ?>)">
	<script>
	function getSkills (divisie, user) {
		/* alert ("hi"); */
		skillsSearch(divisie,user);
	}
        function getWensen ( skill ) {
        wensenSearch(skill);
       
	}
	</script>

<div class="content">
	<div class="projectlist skillslist2 shadow">
		<div class="title radius"><img src="img/iSkill.png" height="30" /><p>Project Wensen</p> 
			<div class="divisie">Selecteer skill: &nbsp;
				<select class="textbox" onchange="getWensen(this.value)">
					<option>-</option>
						<?php
    //$data = $rs->dataOpvragen("SELECT * FROM `skills`");
    $sql = "SELECT * FROM skills";
    $data = DB::getInstance()->query($sql);
    foreach ($data->results() as $rij) {	
							echo '<option value="' . $rij->id .'">' . $rij->skill . '</option>';
						}
						?>
				</select>
			</div>
			<a href="profiel/<?php echo $_GET['u']; ?>" class="edit3">Profiel bekijken</a>
		</div>
		<div id="skillsresults" class="content"></div>
	</div>
</div>
</body>
</html>
<?php 
?>