<?php
require_once 'core/init.php';
$user = new User();
if (!$user->isLoggedIn()) {
     Redirect::to('login.php');
}   
include("include/global_header.php");
include ("include/menu.php");
include ("fancybox.js");
if (isset($GET['id'])) {
    $id = $GET_['id'];
}
?>
<link rel="stylesheet" href="css/registreren.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="css/css.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="js/leden.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(window).bind('scroll', function() {
		if ($(window).scrollTop() > 160) {
            $('.title').addClass('fixed');
            $('.opdrachten').addClass('paddingtop');
        }
        else {
            $('.title').removeClass('fixed');
            $('.opdrachten').removeClass('paddingtop');
        }
    });
</script>
<script type="text/javascript">
    function menu(){
        $('.navleden').addClass('selectedmenu');
    }
</script>
</head>
<body onLoad="ledensearch(), menu()">

<div class="content">
	<div class="opdrachten shadow">
		<div class="title radius">
			<img src="img/icon_person.png" height="30" /><p>Leden</p>
			<a class="edit3" href="leden.php?id=z">z</a>
			<a class="edit3" href="leden.php?id=y">y</a>
			<a class="edit3" href="leden.php?id=x">x</a>
			<a class="edit3" href="leden.php?id=w">w</a>
			<a class="edit3" href="leden.php?id=v">v</a>
			<a class="edit3" href="leden.php?id=u">u</a>
			<a class="edit3" href="leden.php?id=t">t</a>
			<a class="edit3" href="leden.php?id=s">s</a>
			<a class="edit3" href="leden.php?id=r">r</a>
			<a class="edit3" href="leden.php?id=q">q</a>
			<a class="edit3" href="leden.php?id=p">p</a>
			<a class="edit3" href="leden.php?id=o">o</a>
			<a class="edit3" href="leden.php?id=n">n</a>
			<a class="edit3" href="leden.php?id=m">m</a>
			<a class="edit3" href="leden.php?id=l">l</a>
			<a class="edit3" href="leden.php?id=k">k</a>
			<a class="edit3" href="leden.php?id=j">j</a>
			<a class="edit3" href="leden.php?id=i">i</a>
			<a class="edit3" href="leden.php?id=h">h</a>
			<a class="edit3" href="leden.php?id=g">g</a>
			<a class="edit3" href="leden.php?id=f">f</a>
			<a class="edit3" href="leden.php?id=e">e</a>
			<a class="edit3" href="leden.php?id=d">d</a>
			<a class="edit3" href="leden.php?id=c">c</a>
			<a class="edit3" href="leden.php?id=b">b</a>
			<a class="edit3" href="leden.php?id=a">a</a>
			<div class="select"><center></center></div>
		</div>
		<div class="content " id="opdrachtenresults"></div>
	</div>
<?php 
	include("include/global_footer.php");
  
?>