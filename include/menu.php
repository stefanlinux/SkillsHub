<div class="menu">
	<div class="menucontent">
          <a href="profiel/<?php echo Session::get(Config::get('session/session_name')) ?>"><img class="logo" src="img/skillshub-logo-small.png" width="332" height="54px" /></a>
		<div class="account radius2">
			<div class="pic">
			<?php
				if (file_exists('img/profilepic/'. Session::get(Config::get('session/session_name')) .'.jpg')) {
					echo '<img class="profielpic shadow" src="img/profilepic/'.Session::get(Config::get('session/session_name')).'.jpg" />';
				}
				else {
					echo '<img class="profielpic shadow" src="img/profilepic/noprofile.jpg">';
				 }
//echo $user->data()->accounttype;
			?>
			</div>
			<a class="welkom" href="profile.php">Welkom, <?php echo escape($user->data()->username);?> <br />
Opties</a>
			<div class="menuopties">
				<div class="box"></div>
				<ul>
					<div class="seperator">Account</div>
<a href="profiel/<?php echo Session::get(Config::get('session/session_name')) ?>"><li>Profiel bekijken</li></a>
					<a href="logout.php"><li>Uitloggen</li></a>
					<?php 
          //if( $user->data()->accounttype == 1 OR $user->data()->accounttype == 2) {
       //    if ($user->hasPermission('admin')) {
// 							echo '<div class="seperator">Toevoegen</div>';
// 							echo '<a href="addprojects"><li>Projecten</li></a>';
// 							echo '<a href="addopdrachtgevers"><li>Opdrachtgevers</li></a>';
// 						}
// //if( $user->data()->accounttype == 2) {
// if ($user->hasPermission('admin')) {
// 							echo '<a href="addvakgebied"><li>Vakgebieden</li></a>';
// 							echo '<a href="addskills"><li>Skills</li></a>';
// 							echo '<a href="addaccount"><li>Accounts</li></a>';
// 						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="nav">
	<div class="menucontent">
		<a class="navprojecten" href="projecten">Projecten</a>
		<a class="navopdrachtgevers" href="opdrachtgevers">Opdrachtgevers</a>
		<a class="navleden" href="leden">Leden</a>
		<a class="navsearch" href="search">Zoeken</a>
        <a class="chat" href="chat.php">Chat</a>
		<?php
    //	if( $user->data()->accounttype == 2) { 
if ($user->hasPermission('admin')) {
				echo '<a class="navadmin" href="admin-leden">Admin Menu</a>';
			}
		?>
	</div>
</div>