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
	<title>Room1</title>
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
	$sql = $db->prepare('SELECT * FROM rooms WHERE room1 = 1 AND sessionid = :id;');
	$sql->bindValue(':id', $curSessID);
	$visited = $sql->execute();
	
	//If user hasnt visited, database is updated, setting -roomID- to 1.
	$row = $visited->fetchArray();
	if($row == false) {
		//NOTE: after 'SET' should be a roomID matching a column in the database. Check -setup.php- for a list of room ID's.
		$q = $db->prepare('UPDATE rooms SET room1 = 1 WHERE SESSIONID = :id;'); 
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
						Room1
					</div>
					<div class="title sml">
						Rm1
					</div>
					<div class="subtitle lrg">
						// Computer Science Club
					</div>
					<div class="subtitle sml">
						// CS Club
					</div>
				</div>
			</div>
		</div>

		<!-- Content -->
		<div class="content">
			<div class="cont cont_wid">
				<h1>-Info-</h1>  

				Cupcake ipsum dolor sit amet apple pie. Biscuit cake cupcake gummies candy lemon drops apple pie. Cake gingerbread pie sesame snaps oat cake. Topping tiramisu powder lemon drops. Sweet donut pastry soufflé. Marshmallow gummies icing chupa chups cookie macaroon sugar plum. Sweet cake dragée marzipan dragée bonbon lemon drops. Chocolate cake tart tootsie roll croissant. Sweet marshmallow toffee cake dessert pudding. Sweet roll candy lollipop muffin gummies. <br> <br>
				Fruitcake sesame snaps powder chocolate. Topping gingerbread macaroon powder chupa chups biscuit tootsie roll cupcake wafer. Cookie chocolate bar bonbon ice cream tart. Marzipan sesame snaps gummi bears bear claw biscuit. Donut wafer dragée macaroon. Gummi bears fruitcake oat cake liquorice powder. Powder cookie chocolate ice cream chocolate bar pudding lemon drops candy macaroon. Gummi bears halvah brownie jujubes gingerbread. Pastry brownie pudding gingerbread macaroon. Liquorice chupa chups chocolate cake.

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