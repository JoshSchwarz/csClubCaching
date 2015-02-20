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
	<title>Home</title>
	<link href="css/edsWIP.css" type="text/css" rel="stylesheet"></link>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="./img/favicon1.png" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
</head>

<?php
session_start();
$curSessID = session_id();

if(isset($_POST['submit'])) {

	class MyDB extends SQLite3
	{
		function __construct()
		{
			$this->open('./db/store.db');
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
}

?>

<body>
	<div class="container">
		<!-- Header -->
		<div class="header">
			<div class="cont">
				<div class="logo_cont">
					<img class="logo" src="./img/logo.svg">
				</div>
				<div class="title_cont">
					<div class="title lrg">
						Computer Science Club
					</div>
					<div class="title sml">
						CS Club
					</div>
					<div class="subtitle lrg">
						// O'Week 2015 Adelaide Uni
					</div>
					<div class="subtitle sml">
						// O'Week 2015
					</div>
				</div>
			</div>
		</div>

		<!-- Content -->
		<div class="content">
			<div class="cont cont_wid">
				<h1>HOME PAGE INFO.</h1>                
				<br>
				<h2>Signup for competition</h2>
                <h3>Win some fully sik prizez</h3>
				<form action="<?php $_PHP_SELF ?>" method="post">
					First Name: <input type="text" name="first"><br>
					Last Name:  <input type="text" name="last"><br>
					E-mail:     <input type="text" name="email"><br>
					<input type="submit" name="submit" id="submit">
				</form>
                <br>
                <a href="rooms/EM110.php">CSLC</a><br><br>
                <a href="rooms/FLENT.php">Flentje</a><br><br>
                <a href="rooms/CAT2.php">CAT Suite lvl 2</a><br><br>
                <a href="rooms/LVLB.php">Basement</a><br><br>
                <a href="rooms/CHAPM.php">Chapman</a><br><br>
                <a href="rooms/LVL4.php">Level 4</a><br><br>
                <a href="rooms/HORLA.php">Horace Lamb</a><br><br>
                
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