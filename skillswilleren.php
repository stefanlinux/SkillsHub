<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLoggedIn()) {
    include("include/global_header.php");
    include ("include/menu.php");
} else {
    Redirect::to('login');
  }
$u=$_GET["u"];
//echo $u;
?>
<script type="text/javascript" src="js/skills.js"></script>
<link rel="stylesheet" href="css/skills.css" type="text/css" media="screen" />
</head>
<!-- <body onLoad="getSkills('-', \"<?php  $u ?>\")"> -->
<body onLoad="getSkills('-', <?php echo $u; ?>)">

<div class="content">
	<div class="projectlist skillslist2 shadow">
		<div class="title radius"><img src="img/iSkill.png" height="30" /><p>Skills wil leren LET OP WERKT NOG NIET</p> 
			<div class="divisie">Selecteer vakgebied: &nbsp;
				<select class="textbox" onchange="getSkills(this.value,<?php echo $_GET['u']; ?>)">
					<option>-</option>
						<?php
    $sql = "SELECT * FROM vakgebieden ORDER BY id";
    $data = DB::getInstance()->query($sql);
foreach ($data->results() as $rij) {
        echo '<option value="'.$rij->id .'">' . $rij->vakgebied . '</option>';
    }
						?>
				</select>
			</div>
			<a href="profiel/<?php echo $_GET['u']; ?>" class="edit3">Profiel bekijken</a>
		</div>
		<div id="skillsresults" class="content"></div>
	</div>
    </div>
    <script>
	function getSkills(divisie,user) {
       // alert ('hi');
		skillswillerenSearch(divisie,user);
	}
</script>
</body>
</html>
