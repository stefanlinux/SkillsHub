<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");
?>
<script type="text/javascript" src="js/opdrachten.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	function menu() {
		$('.navmarkt').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu()">
<?php
	//include het menu
	include ("include/menu.php");
	include ("fancybox.js");
?>
<div class="content">
	<div class="opdrachten shadow">
		<div class="title radius"><img src="img/iSkill.png" height="30" /><p>Markt</p></div>
		<div class="content " id="opdrachtenresults">
		<?php
			include ("include/clsDatabase.php");
			$letter = "2";
			$letter2 = "#";
			$data = $rs->dataOpvragen("SELECT * FROM markt ORDER BY opdrachtgever ");
			if($data != "")	{
				foreach($data as $rij) {
					$string = $rij["opdrachtgever"];
					$letter = strtolower($string[0]);
					if($letter != $letter2) {
						echo '<br /><div id="' . $letter . '" class="title2 title3"><h4>' . $letter . '</h4></div><br />';
						$letter2 = $letter;
					}
					echo '<div class="searchresult2">' . '<a  href="opdrachtgever.php?u=' .  $rij["opdrachtgever"] . '">';
					echo '<p class="lid">' .$rij["opdrachtgever"] . '</p>';
					echo  "<div class=\"opdrachtgever\"><h2>Opdrachtgever: &nbsp" . $rij["voornaam"] . $rij["achternaam"] . "</h2></div>";
					echo  "<div class=\"projectleider\"><h2>Bedrijf: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $rij["opdrachtgever"] . "</h2></div>";
					if (file_exists("img/opdrachtgever/" . $rij["opdrachtgever"] . ".jpg")) {
						echo "<img class=\"radius2\"src=\"img/opdrachtgever/" . $rij["opdrachtgever"] . ".jpg\">";
					}
					else {
						echo "<img class=\"radius2\" src=\"img/profilepic/noprofile.jpg\">";
					}
					echo "</a></div>";
				}
			}	
		?>
		</div>
	</div>
</div>
</body>
</html>