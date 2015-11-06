<html>
<head>
<title>File Upload To Database</title>
</head>
<body>
<h3>Please Choose a File and click Submit</h3>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<input name="userfile[]" type="file" />
	<input type="submit" value="Submit" />
</form>
</body>
</html>