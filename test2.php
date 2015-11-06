<?php
require_once 'core/init.php';


    
$user = new User();

 
 $u = Session::get(Config::get('session/session_name'));
 
$sql = "SELECT * FROM `projectsusers` WHERE `usersid`='$u' AND projectid='$n'";
		$data = DB::getInstance()->query($sql);