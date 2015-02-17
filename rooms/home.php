<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Computer Science Club O-Week</title>

	<link href="./css/styles.css" type="text/css" rel="stylesheet"></link>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="./images/favicon1.png" type="image/x-icon" />
</head>

<?php
session_start();
$curSessID = session_id();

if(isset($_POST['signup'])) {

	header("Location: ?page=signup");
	die();
}

?>

<body>
	HOME PAGE!

	<form action="<?php $_PHP_SELF ?>" method="post">
		<input type="submit" name="signup">
	</form>

</body>
</html>
