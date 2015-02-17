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
	<title>Computer Science Club O-Week</title>
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
}

?>

<body>
	<div class="container">
		<!-- Header -->
		<div class="header">
			<div class="cont">
				<div class="logo_cont">
					<img class="logo" src="./img/compsci_logo.svg">
				</div>
				<div class="title_cont">
					<div id="title">
						Computer Science Club
					</div>
					<div id="subtitle">
						// O'Week 2015 Adelaide Uni
					</div>
				</div>
			</div>
		</div>

		<!-- Navbar -->
		<div class="navbar">
				<img class="menu" src="./img/menu.svg">
				<div id="page_name" class="cont"></div>
				<div class="cont nav_wid">
					<div class="nav_opt current">Home</div>
					<div class="nav_opt">News</div>
					<div class="nav_opt">Tutorials</div>
					<div class="nav_opt">Calendar</div>
					<div class="nav_opt">Contact</div>
					<!-- <form class="searchbar">
						<input type="text" name="search" placeholder="Search">
						<input type="submit" name="submit" value="Go">
					</form> -->
				</div>
		</div>

		<!-- Content -->
		<div class="content">
			<div class="cont content_wid">
				<h1>HOME PAGE INFO.</h1>                
                <br><br>
                <h2>Signup for comp</h2>
                <form action="<?php $_PHP_SELF ?>" method="post">
                First Name: <input type="text" name="first"><br>
                Last Name: <input type="text" name="last"><br>
                E-mail: <input type="text" name="email"><br>
                <input type="submit" name="submit" id="submit">
                </form>
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			<div class="cont">
				<p>2015 Computer Science Club of The University of Adelaide</p>
			</div>
		</div>
	</div>
    
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script>
		document.getElementById("page_name").innerHTML = "Home";
		if ($(window).width() <= 768) {
		    document.getElementById("title").innerHTML = "CS Club";
		}
	</script>

</body>
</html>