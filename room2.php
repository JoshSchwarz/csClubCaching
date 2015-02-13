<!--
-1.php -

A sample room including user tracking ONLY if they have signed up.
On page load, checks to see if user is known, if so updates the database to show that they have visted room and serves content.
If user is unknown, content is still served.

Code by Josh Schwarz
-->

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sample Room</title>
</head>

<?php
session_start();
$curSessID = session_id();

//Open database.
class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('store.db');
	}
}
$db = new MyDB();

//Checks if user exists in database (if they do, they are signed up).
$sql = $db->prepare('SELECT * FROM rooms WHERE sessionid = :id;');
$sql->bindValue(':id', $curSessID);
$exists = $sql->execute();

//Checks if there exists a row in the response, if there is a row, user exists.
$row = $exists->fetchArray();
if ($row != false) {
	
	//Checks if user has already visited.
	$sql = $db->prepare('SELECT * FROM rooms WHERE :currentRoom = 1');
	$sql->bindValue(':currentRoom', $currRoom);
	$visited = $sql->execute();
	
	//If user hasnt visited, database is updated, setting -roomID- to 1.
	$row = $visited->fetchArray();
	if($row == false) {
		//NOTE: after 'SET' should be a roomID matching a column in the database. Check -setup.php- for a list of room ID's.
		$q = $db->prepare('UPDATE rooms SET room2 = 1 WHERE SESSIONID = :id;'); 
		$q->bindValue(':id', $curSessID);
		$q->execute();
		
		$r = $db->prepare('UPDATE rooms SET sum = sum + 1 WHERE SESSIONID = :id;'); 
		$r->bindValue(':id', $curSessID);
		$r->execute();
	}	
}?>

<body>

Room 2 information.

</body>
</html>