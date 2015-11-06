<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
$u=$_GET["u"];
?>
<link rel="stylesheet" href="css/opdrachtgever.css" type="text/css" media="screen" /> 
<script type="text/javascript">
	function menu() {
		$('.navopdrachtgevers').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu(), selecttab('img2', 'lopend', 'tablopend')">
<?php

?>
<div class="content">
<?php
$whitesmoke = 1;
$sql = "SELECT * FROM `markt` WHERE id='$u' ";
$data = DB::getInstance()->query($sql);
	if($data != "") {
		foreach ($data->results() as $rij) {
			$opdrachtgever = $rij->opdrachtgever;
			$projectid = $rij->id;
			$plaats = $rij->plaats;
			$straat = $rij->straat;
			$postcode = $rij->postcode;
			$website = $rij->website;
			$telefoon = $rij->tel;
		}
	}
	echo "<div class=\"projectnaam\">" . $opdrachtgever . "</div>";
	echo "<div class=\"projectopdrachtgever\">" . $plaats . "</div>";
	
	if (file_exists("img/bedrijfpic/" . $u . ".jpg")) {
		// echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";
		echo "<a class=\"fancybox profielpic projectpic\" href=\"img/bedrijfpic/" . $u . ".jpg\" data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/bedrijfpic/" . $u . ".jpg\"></a>";
	}
	else {
		echo "<a class=\"fancybox profielpic projectpic\" href=\"img/profilepic/noprofile.jpg\"data-fancybox-group=\"gallery\" ><img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\"></a>";
	}
	if($user->hasPermission('admin')) {
		echo '<div class="connectstatus">';
		echo "<a class=\"button projectbtn\" href=\"opdrachtgeverbewerken.php?u=" . $u . "\">Opdrachtgever bewerken</a> ";
		echo '</div>';
	}
	echo '<div class="projectbanner">';
	if (file_exists("img/opdrachtgever/" . $u . ".jpg")) {
		/*echo "<img class=\"profielpic\" src=\"img/profilepic/" . $u . ".jpg\"> ";*/
		echo "<a class=\"fancybox\" href=\"img/opdrachtgever/" . $u . ".jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/opdrachtgever/" . $u . ".jpg\" \></a>";
	}
	else {
		echo "<a class=\"fancybox\" href=\"img/noimage.jpg\"data-fancybox-group=\"gallery\" ><img class=\"projectbanner\" width=\"940\" height=\"250\" src=\"img/noimage.jpg\" \></a>";
	}
	echo '</div>';
	echo '<div class="projectcontent">';
	echo '<div class="block"><h3>Plaats</h3>' . $plaats . '</div>';
	echo '<div class="block"><h3>Postcode</h3>' . $postcode . '</div>';
	echo '<div class="block"><h3>Straat</h3>' . $straat . '</div>';
	echo '<div class="block"><h3>Website</h3>' . $website . '</div>';
	echo '<div class="block"><h3>Telefoon</h3>' . $telefoon . '</div>';
	echo '</div>';
?>
<div class="content-left">
	<div class="projectlist shadow">
		<div class="title radius">
			<img src="img/icon_project.png" height="30" /><p>Projecten</p>
			<script type="text/javascript">
				function selecttab(img, status, tab) {			 
					document.getElementById('img1').style.visibility = 'hidden';
					document.getElementById('img2').style.visibility = 'hidden';
					document.getElementById('img3').style.visibility = 'hidden';
					document.getElementById('afgerond').style.color = 'gray';
					document.getElementById('lopend').style.color = 'gray';
					document.getElementById('aankomend').style.color = 'gray';
					document.getElementById(img).style.visibility = 'visible';
					document.getElementById(status).style.color = 'rgb(36, 137, 187)';
					document.getElementById("tabafgerond").style.display = 'none';
					document.getElementById("tablopend").style.display = 'none';
					document.getElementById("tabaankomend").style.display = 'none';
					document.getElementById(tab).style.display = 'block';
				}
			</script>
			<div class="select">
				<center>	
					<div class="options" id="lopend" onclick="selecttab('img2', 'lopend', 'tablopend')">Lopend<br /><img id="img2" src="img/iSelect.png"></div>
					<div class="options" id="afgerond" onclick="selecttab('img1', 'afgerond', 'tabafgerond')">Afgerond<br /><img id="img1" src="img/iSelect.png"></div>
					<div class="options" id="aankomend" onclick="selecttab('img3', 'aankomend', 'tabaankomend')">Aankomend<br /><img id="img3" src="img/iSelect.png"></div>
				</center>
			</div>
		</div>
		<div class="content">
		<?php
        $sql = "SELECT * FROM projects WHERE opdrachtgever='$opdrachtgever'";
$data = DB::getInstance()->query($sql);
		?>
			<div id="tabafgerond">
			<?php
				if($data != "")	{
					foreach ($data->results() as $rij) {
						if($rij->status == 1)	{
							echo "<div class=\"listitem2 "; 
							if($whitesmoke == 0) {
								echo "whitesmoke";
								$whitesmoke = 1;
							}
							else {
								$whitesmoke = 0;
							}
							echo "\">" . "<a href=\"project/" . $rij->id . "\">";
							if (file_exists("img/projectpic/" . $rij->id . ".jpg")) {
								echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $rij->id . ".jpg\">";
							}
							else {
								echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
							}
							echo "<p>" . $rij->naam . "</p></a></div>";
						}
					}
				}
			?>
			</div>

			<div id="tablopend">
			<?php
				if($data != "")	{
					foreach ($data->results() as $rij) {
						if($rij->status == 0)	{
							echo "<div class=\"listitem2 "; 
							if($whitesmoke == 0) {
								echo "whitesmoke";
								$whitesmoke = 1;
							}
							else {
								$whitesmoke = 0;
							}
							echo "\">" . "<a href=\"project/" . $rij->id . "\">";
							if (file_exists("img/projectpic/" . $rij->id . ".jpg")) {
								echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $rij->id . ".jpg\">";
							}
							else {
								echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
							}
							echo "<p>" . $rij->naam . "</p></a></div>";
						}
					}
				}
			?>
			</div>
			<div id="tabaankomend">
			<?php
				if($data != "")	{
					foreach ($data->results() as $rij) {
						if($rij->status == 2)	{
							echo "<div class=\"listitem2 "; 
							if($whitesmoke == 0) {
								echo "whitesmoke";
								$whitesmoke = 1;
							}
							else {
								$whitesmoke = 0;
							}
							echo "\">" . "<a href=\"project/" . $rij->naam . "\">";
							if (file_exists("img/projectpic/" . $rij->id . ".jpg")) {
								echo "<img class=\"radius2\" height=\"50px\" src=\"img/projectpic/" . $rij->id . ".jpg\">";
							}
							else {
								echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
							}
							echo "<p>" . $rij->naam . "</p></a></div>";
						}
					}
				}
			?>
			</div>
		</div>
	<!-- end content left-->
	</div>
</div>

<div class="content-right">
	<div class="requests shadow">
		<div class="title radius"><img src="img/icon_person.png" height="30" /><p>Contactpersonen</p></div>
		<div class="content">
		<?php
      $sql = "SELECT * FROM contactpersonen WHERE opdrachtgever='$opdrachtgever'";
$data = DB::getInstance()->query($sql);

if($data->count()) {
			foreach ($data->results() as $rij) 
			{ //echo 'ok';
			echo "<div class=\"listitem2 ";
			if($whitesmoke == 0)
			{
				echo "whitesmoke";
				$whitesmoke = 1;
			}
			else
			{
				$whitesmoke = 0;
			}
			echo "\">";
			echo "<img class=\"radius2\" height=\"50px\"  src=\"img/profilepic/noprofile.jpg\">";
            //	echo "<p class=\"naam\">" . $rij->volledigenaam . "</p>";
            //	echo "<p class=\"tel\">" . $rij->tel . "</p>";
			echo "</div>";
            	    $voornaam = $rij->voornaam;
				    $tussenvoegsel = $rij->tussenvoegsel;
				    $achternaam = $rij->achternaam;
				    $naam = $voornaam . " " . $tussenvoegsel . " " . $achternaam;
				    $mail = $rij->email;
				    if($mail == "") {
				    	$mail = "-";
				    }
				    $tel = $rij->tel;
				    if($tel == 0) {
			    		$tel = "-";
			    	}
			    	$opdrachtgever = $rij->opdrachtgever;
			    	echo '<div class="title2 title4"><h4>' . $naam . '</h4></div><div class="projectleider"><br /><br /><br />';
				 	echo '<div class="contactinfo"><div class="content-left">Mail: </div>' . $mail . '</div>';
				 	echo '<div class="contactinfo"><div class="content-left">Tel: </div>' . $tel . '</div>';
				 	echo '<div class="contactinfo"><div class="content-left">Bedrijf: </div>' . $opdrachtgever . '</div></div>';
			}
		}
		?>
<?php //var_dump($opdrachtgever);
//     $sql = "SELECT `opdrachtgevers`.`voornaam`, `opdrachtgevers`.`tussenvoegsel`, `opdrachtgevers`.`achternaam`, `opdrachtgevers`.`mail`, `opdrachtgevers`.`tel`, `markt`.`opdrachtgever` FROM `opdrachtgevers`, `markt` WHERE `opdrachtgevers`.`opdrachtgever`='$oprachtgever' AND `opdrachtgever`.`opdrachtgever` = `markt`.`id`";
//     $sql = "SELECT * FROM contactpersonen WHERE opdrachtgever = '$opdrachtgever'";
//$data2 = DB::getInstance()->query($sql);

			// if($data2 != "") {
			// 	foreach($data2->results() as $rij2) {	
			
			//     }
			// }
		?>
		</div>
	</div>
</div>
</body>
</html>