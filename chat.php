<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
     Redirect::to('login.php');
}
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
?>
<script type="text/javascript" src="js/chat.js"></script>
<link rel="stylesheet" href="css/chat.css" type="text/css" media="screen" />
</head>
<!-- <body onLoad="menu(), selecttab('img1', 'tab1')"> -->
<body>
<div class="content">
	<div class="opdrachten shadow">
		<div class="title radius">
			<img src="img/iSkill.png" height="30" /><p>Chat</p>
			<div class="select">
<!-- 				<center>
					<div class="options" id="tab1" onclick="selecttab('img1', 'tab1', '0')">1<br /><img id="img1" src="img/iSelect.png"></div>
					<div class="options" id="tab2" onclick="selecttab('img2', 'tab2', '1')">2<br /><img id="img2" src="img/iSelect.png"></div>
					<div class="options" id="tab3" onclick="selecttab('img3', 'tab3', '2')">3<br /><img id="img3" src="img/iSelect.png"></div>
				</center>
 -->
			</div>
		</div>
		
			<table id="content-chat">
				<tr>
					<td>
						<div id="scroll">
						</div>
					</td>
					<td id="colorpicker">
						<img src="palette.png" id="palette" alt="Color Palette" border="1"/>
						<br />
						<input id="color" type="hidden" readonly="true" value="#000000" />
						<span id="sampleText">
							(tekst kleur)
						</span>
					</td>
				</tr>
			</table>
			<div> 
				<input type="text" id="userName" maxlength="10" size="10" value="<?php echo $user->data()->username; ?>"/>
				<input type="text" id="messageBox" maxlength="2000" size="50" />
				<input type="button" value="verzend" id="send" />
				
			</div>
		
	</div>
</div>
<?php 
	include("include/global_footer.php");

?>
