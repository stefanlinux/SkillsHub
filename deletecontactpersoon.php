<?php
require_once 'core/init.php';
$user = new User();
if (!$user->hasPermission('admin')) {
    exit;
}
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

$id=$_GET['id'];
$u=$_GET['u'];
//$opdrachtgever=$_GET["u"];


$sql = "DELETE FROM contactpersonen WHERE id='$id'";
DB::getInstance()->query($sql);

?>
<meta http-equiv="refresh" content="0;url=opdrachtgeverbewerken.php?u=<?php echo $u; ?>">