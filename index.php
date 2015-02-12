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
<title>Index</title>
</head>

<body>
	<?php 
		if(!empty($_GET['page'])) {
			require($_GET['page'] . ".php"); 
		} else {
			require("home" . ".php");
		}
	?> 
</body>
</html>
