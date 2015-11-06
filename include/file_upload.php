<?php
// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/

	$uploadpath = 'upload/';													// directory to store the uploaded files
	$max_size = 2000;															// maximum file size, in KiloBytes
	$alwidth = 4000;															// maximum allowed width, in pixels
	$alheight = 4000;															// maximum allowed height, in pixels
	$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');						// allowed extensions

	if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
		$uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);		// gets the file name
		$sepext = explode('.', strtolower($_FILES['fileup']['name']));
		$type = end($sepext);													// gets extension
		list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);	// gets image width and height
		$err = '';																// to store the errors   

		// Checks if the file has allowed type, size, width and height (for images)
		if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
		if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
		if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
		
		// If no errors, upload the image, else, output the errors
		if($err == '') {
			if(move_uploaded_file($_FILES['fileup']['tmp_name'], "img/bedrijfpic/" . $u . ".jpg"  )) { }
			else echo '<b>Unable to upload the file.</b>';
		}
		else echo $err;
	}

	if(isset($_FILES['fileup2']) && strlen($_FILES['fileup2']['name']) > 1) {
		$uploadpath = $uploadpath . basename( $_FILES['fileup2']['name']);		// gets the file name
		$sepext = explode('.', strtolower($_FILES['fileup2']['name']));
		$type = end($sepext);													// gets extension
		list($width, $height) = getimagesize($_FILES['fileup2']['tmp_name']);	// gets image width and height
		$err = '';																// to store the errors   

		// Checks if the file has allowed type, size, width and height (for images)
		if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup2']['name']. '</b> not has the allowed extension type.';
		if($_FILES['fileup2']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
		if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
		
		// If no errors, upload the image, else, output the errors
		if($err == '') {
			if(move_uploaded_file($_FILES['fileup2']['tmp_name'], "img/opdrachtgever/" . $u . ".jpg"  )) { }
			else echo '<b>Unable to upload the file.</b>';
		}
		else echo $err;
	}