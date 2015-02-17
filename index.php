<!--
-index.php -

Landing page for the site. 
If no paramaters are passed, will load -home.php- 
Otherwise will serve whatever was passed as the 'page' variable. (i.e. $url/?page=home).

Code by Josh Schwarz
-->

<!doctype html>

<?php
//Extend session life to 35 days.
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 35);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 35);
//Initiate session.
session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Computer Science Club O-Week</title>

	<link href="./css/styles.css" type="text/css" rel="stylesheet"></link>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="./img/favicon1.png" type="image/x-icon" />
</head>

<body>
	<?php 
	if(!empty($_GET['page'])) {
		require("./rooms/" . $_GET['page'] . ".php"); 
	} else {
		require("./rooms/home.php");
	}
	?> 
</body>
</html>
