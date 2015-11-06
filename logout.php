<?php
require_once 'core/init.php';
$user = New  User();
$user->logout();
Redirect::to('login.php');
