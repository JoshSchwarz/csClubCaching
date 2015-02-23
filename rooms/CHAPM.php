<!doctype html>
<html>
<head>
	<title>Chapman Lecture Theatre</title>
	<link href="../css/edsWIP.css" type="text/css" rel="stylesheet"></link>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="../img/favicon1.png" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
</head>

<?php
session_start();
$curSessID = session_id();

//Open database.
class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('../db/store.db');

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
	$sql = $db->prepare('SELECT * FROM rooms WHERE CHAPM = 1 AND sessionid = :id;');
	$sql->bindValue(':id', $curSessID);
	$visited = $sql->execute();
	
	//If user hasnt visited, database is updated, setting -roomID- to 1.
	$row = $visited->fetchArray();
	if($row == false) {
		//NOTE: after 'SET' should be a roomID matching a column in the database. Check -setup.php- for a list of room ID's.
		$q = $db->prepare('UPDATE rooms SET CHAPM = 1 WHERE SESSIONID = :id;');
		$q->bindValue(':id', $curSessID);
		$q->execute();
		
		$r = $db->prepare('UPDATE rooms SET sum = sum + 1 WHERE SESSIONID = :id;'); 
		$r->bindValue(':id', $curSessID);
		$r->execute();
	}
}?>

<body>
	<div class="container">

		<!-- Header -->
		<div class="header">
			<div class="cont">
				<div class="logo_cont">
					<img class="logo" src="../img/logo.svg">
				</div>
				<div class="title_cont">
					<div class="title lrg">
						Chapman Lecture Theatre <!-- Full Room Name (DESKTOP VIEW) -->
					</div>
					<div class="title sml">
						Chapman <!-- Small Room Name (MOBILE VIEW) -->
					</div>
					<div class="subtitle lrg">
						// Computer Science Club <!-- Full Subtitle (DESKTOP VIEW) -->
					</div>
					<div class="subtitle sml">
						// CS Club <!-- Small Room Name (MOBILE VIEW) -->
					</div>
				</div>
			</div>
		</div>

		<!-- Content -->
		<div class="content">
			<div class="cont cont_wid">
            	<!-- CONTENT -->
				<p>Many 1st year Computer Science Courses have a few lectures here. There is easy access to the Ingkarni Wardli building if you walk west, and easy access to the engineering maths building just to the east.</p>
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			<div class="cont">
				<p>2015 Computer Science Club of The University of Adelaide</p>
			</div>
		</div>
	</div>

</body>
</html>