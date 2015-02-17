<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
session_start();
$curSessID = session_id();

if(isset($_POST['submit'])) {

	class MyDB extends SQLite3
	{
		function __construct()
		{
			$this->open('./rooms/store.db');
		}
	}
	
	$db = new MyDB();
	
	$exists = $db->querySingle("SELECT SESSIONID FROM ROOMS WHERE SESSIONID=$curSessID");
	if($exists != NULL) {
		print "You already exist";
		
	} else {
		$first = $_POST['first'];
		$last = $_POST['last'];
		$email = $_POST['email'];
	
		$sql = "INSERT INTO rooms (SESSIONID,FIRSTNAME,LASTNAME,EMAIL) VALUES (:curSessID,:first,:last,:email)"; 
		$q = $db->prepare($sql); 
	
		$q->bindParam(':curSessID',$curSessID);
		$q->bindParam(':first',$first); 
		$q->bindParam(':last',$last); 
		$q->bindParam(':email',$email); 
	
		$q->execute(); 
	}
	
	header("Location: ?page=home");
	die();
}

?>

<body>

<form action="<?php $_PHP_SELF ?>" method="post">
First Name: <input type="text" name="first"><br>
Last Name: <input type="text" name="last"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit" name="submit" id="submit">
</form>

</body>
</html>

