<?php
	include("include/simpel_login2.php");
	include("include/global_header.php");
?>
<!-- imports -->
<link rel="stylesheet" href="css/opdrachten.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="js/opdrachten.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	function selecttab(image, tab, search) {
		opdrachtensearch(search);
		document.getElementById('tab1').style.color = 'gray';
		document.getElementById('tab3').style.color = 'gray';
		document.getElementById('tab2').style.color = 'gray';
		document.getElementById('img1').style.visibility = 'hidden';
		document.getElementById('img2').style.visibility = 'hidden';
		document.getElementById('img3').style.visibility = 'hidden';
		//document.getElementById('img4').style.visibility = 'hidden';
		document.getElementById(image).style.visibility = 'visible';
		document.getElementById(tab).style.color = 'rgb(36, 137, 187)';
		//document.getElementById(content).style.display = 'block';
	}
</script>
<script type="text/javascript">
	function menu(){
		$('.navopdracht').addClass('selectedmenu');
	}
</script>
</head>
<body onLoad="menu(), selecttab('img1', 'tab1')">
<?php
	//include het menu
	include ("include/menu.php");
	include ("fancybox.js");
?>
<div class="content">
	<div class="opdrachten shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Opdrachten</p>
			<div class="select">
				<center>
					<div class="options" id="tab1" onclick="selecttab('img1', 'tab1', '0')">Lopend<br /><img id="img1" src="img/iSelect.png"></div>
					<div class="options" id="tab2" onclick="selecttab('img2', 'tab2', '1')">Afgerond<br /><img id="img2" src="img/iSelect.png"></div>
					<div class="options" id="tab3" onclick="selecttab('img3', 'tab3', '2')">Aankomend<br /><img id="img3" src="img/iSelect.png"></div>
				</center>
			</div>
		</div>
		<div class="content " id="opdrachtenresults"></div>
	</div>
</div>
</body>
</html>