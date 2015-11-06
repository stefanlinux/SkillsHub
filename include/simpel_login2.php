<?php
//session werkt als volgt
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
session_start();
if (isset($_SESSION["login"])) {}
else {
	header("location:login");
	exit;
}
?>