<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLoggedIn()) {
   	include("include/global_header.php");
?>
<script type="text/javascript" src="js/search.js"></script>
<link rel="stylesheet" href="css/search.css" type="text/css" media="screen" /> 
<script type="text/javascript">
	function menu(){
		$('.navsearch').addClass('selectedmenu');
	}
</script>
<script type="text/javascript">
	function selecttab(image, tab, content) {
		document.getElementById('searchskills').style.display = 'none';
		document.getElementById('searchmembers').style.display = 'none';
		document.getElementById('searchprojects').style.display = 'none';
	
		document.getElementById('members').style.color = 'gray';
		document.getElementById('projects').style.color = 'gray';
		document.getElementById('skills').style.color = 'gray';
		
		document.getElementById('img1').style.visibility = 'hidden';
		document.getElementById('img2').style.visibility = 'hidden';
		document.getElementById('img3').style.visibility = 'hidden';
		//document.getElementById('img3').style.visibility = 'hidden';
		//document.getElementById('img4').style.visibility = 'hidden';
	
		document.getElementById(image).style.visibility = 'visible';
		document.getElementById(tab).style.color = 'rgb(36, 137, 187)';
		document.getElementById(content).style.display = 'block';
	}
	function skillssearch(search) {
		var val = search, sel = document.getElementById('skilloption');
		for(var i, j = 0; i = sel.options[j]; j++) {
			if(i.value == val) {
				sel.selectedIndex = j;
				break;
			}
		}
		searchskills();
		selecttab('img2', 'skills', 'searchskills');
	}
	function projectsearch(search) {
		var val = search, sel = document.getElementById('skilloption2');
		for(var i, j = 0; i = sel.options[j]; j++) {
			if(i.value == val) {
				sel.selectedIndex = j;
				break;
			}
		}
		searchprojects();
		selecttab('img3', 'projects', 'searchprojects');
	}
</script>
</head>
<body onLoad="menu(), selecttab('img1', 'members', 'searchmembers')<?php
	if(isset($_GET["s"])){
		echo " , skillssearch('" . $_GET["s"]  .  "')";
	}
	if(isset($_GET["p"])){
		echo " , projectsearch('" . $_GET["p"]  .  "')";
	}
?>
">
<?php
	//include het menu
	include ("include/menu.php");
	include ("fancybox.js");
?>
<div class="content">
	<div class="search shadow">
		<div class="title radius">
			<img src="img/icon_zoeken.png" height="30" /><p>Zoeken</p>
			<div class="select">
				<center>
					<div class="options" id="members" onclick="selecttab('img1', 'members', 'searchmembers')">Leden<br /><img id="img1" src="img/iSelect.png"></div>
					<div class="options" id="skills" onclick="selecttab('img2', 'skills', 'searchskills')">Skills<br /><img id="img2" src="img/iSelect.png"></div>
					<div class="options" id="projects" onclick="selecttab('img3', 'projects', 'searchprojects')">Projecten<br /><img id="img3" src="img/iSelect.png"></div>
				</center>
			</div>
		</div>
		<div class="content searching">
			<div class="skills" id="searchskills">
				<form>
					<span>Selecteer uw skill: </span>
					<select class="textbox" onchange="searchskills()" id="skilloption">
					<?php 
						include ("include/clsDatabase.php");
						$data = $rs->dataOpvragen("SELECT * FROM `skills`");

						foreach ($data as $rij)	{
							echo "<option value=\"" . $rij["id"] . "\">" . $rij["skill"] . "</option>";
						}
					?>
					</select>
					<span>Selecteer het niveau:</span>
					<select class="textbox" onchange="searchskills()" id="lvloption">
						<option>-</option>
						<option>Ontwikkel</option>
						<option>Basis</option>
						<option>Professioneel</option>
					</select>
					<div class="btnSearch" onClick="searchskills()" >Zoeken</div>
				</form>
			</div>
			<div class="members" id="searchmembers">
				<input type="text" id="searchtext" placeholder="Type uw zoekopdracht in.." onkeyup="searchmembers()" value="">
				<div class="searchbtn  radius2"  onclick="search()">Zoeken</div>
			</div>
			<div class="projects" id="searchprojects">
				<form>
					<span>Selecteer een skill: </span>
					<select class="textbox textboxsearch" name="skilloption2" id="skilloption2" onchange="searchprojects()">
					<option value="-">-</option>
					<?php 
						$data = $rs->dataOpvragen("SELECT * FROM `skills`");
						foreach ($data as $rij)	{
							echo "<option value=\"" . $rij["id"] . "\">" . $rij["skill"] . "</option>";
						}
					?>
					</select>	
					<span>Selecteer projectstatus: </span>
					<select class="textbox" onchange="searchprojects()" name="status" id="status">
						<option value="-">-</option>
						<option value="0">Lopend</option>
						<option value="1">Afgerond</option>
						<option value="2">Aankomend</option>
					</select>		
					<div class="btnSearch" onClick="searchprojects()" >Zoeken</div>
				</form>
			</div>
		</div>
		<div class="searchresult shadow">
			<div class="title radius"><p>Resultaten</p></div>
			<div class="content" id="searchresults"></div>
		</div>
<?php
	include("include/global_footer.php");
} else {
    Redirect::to('login.php');
}
?>