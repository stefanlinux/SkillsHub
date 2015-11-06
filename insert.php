<?php 

// Create MySQL login values and
// set them to your login information.
$username = "wp";
$password = "wp01";
$host = "192.168.1.6";
$database = "shub";


// Make the connect to MySQL or die
// and display an error.
$link = mysql_connect($host, $username, $password);
if (!$link) {
die('Could not connect: ' . mysql_error());
}

// Select your database
mysql_select_db ($database);

// Make sure the user actually
// selected and uploaded a file
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

// Temporary file name stored on the server
$tmpName = $_FILES['image']['tmp_name'];

// Read the file
$fp = fopen($tmpName, 'r');
$data = fread($fp, filesize($tmpName));
$data = addslashes($data);
fclose($fp);


// Create the query and insert
// into our database.

$n=$_GET["n"];
$query = "INSERT INTO media ";
$query .= "(project, image) VALUES ('$n', '$data')";
$results = mysql_query($query, $link);

// Print results
echo "<meta http-equiv=\"refresh\" content=\"0;url=project.php?n=" . $n . "\"    >";

}
else {
print "No image selected/uploaded";
$n=$_GET["n"];
echo "<meta http-equiv=\"refresh\" content=\"0;url=project.php?n=" . $n . "\"    >";
}

// Close our MySQL Link
mysql_close($link);
?>