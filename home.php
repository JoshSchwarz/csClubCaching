<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
