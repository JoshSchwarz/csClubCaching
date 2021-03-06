<!doctype html>

<?php
//Extend session life to 35 days.
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 35);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 35);
//Initiate session.
session_start();
$curSessID = session_id();
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
                
                         <p>We've hidden a few QR codes in a some of the rooms around the uni, they'll link you to a page with information about the room and surrounding area.</p>
                         <p>A prize will be awarded to the 1st year who scans the most codes by the end of O-week.</p>
                         <p>In order to award you a prize you need to signup with the form below, visit the links in each QR code, and come to the Computer Science Club Meet and Greet (5pm on the 12th of March @ the Margaret Murry Room).</p>
                         <p>We hope to see you there!</p>
				
                <div id="signup"><br>
                    <h2>Signup for competition</h2>
                    <form action="<?php $_PHP_SELF ?>" method="post">
                        First Name: <br><input type="text" name="first"><br>
                        Last Name:  <br><input type="text" name="last"><br>
                        E-mail:     <br><input type="text" name="email"><br>
                        <input type="submit" name="submit" id="submit">
                    </form>
                </div>                
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			<div class="cont">
				<p>2015 Computer Science Club of The University of Adelaide</p>
			</div>
		</div>
	</div>

<?php
class MyDB extends SQLite3
	{
		function __construct()
		{
			$this->open('./db/store.db');
		}
	}
	
	$db = new MyDB();

if(isset($_POST['submit'])) {
	
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

//Checks if user exists in database (if they do, they are signed up).
$sql = $db->prepare('SELECT * FROM rooms WHERE sessionid = :id;');
$sql->bindValue(':id', $curSessID);
$exists = $sql->execute();

//Checks if there exists a row in the response, if there is a row, user exists.
$row = $exists->fetchArray();
if ($row == false) {
	?>
    <script type="text/javascript">
    	document.getElementById("signup").style.visibility = 'visible';
		document.getElementById("signup").style.position = 'relative';
    </script>
    <?php
}?>

</body>
</html>