<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Table Dump</title>
</head>

<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
	 		 $this->open('../db/store.db');

      }
   }
   $db = new MyDB();

   $sql =<<<EOF
      SELECT * from ROOMS ORDER BY sum DESC;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray() ){
      $str1 = "ID = ". $row['SESSIONID'];
      $str2 = "NAME = ". $row['FIRSTNAME'] . " " . $row['LASTNAME'];
      $str3 = "EMAIL = ". $row['EMAIL'];
      $str4 = "SUM =  ". $row['SUM'];
	  
	  echo htmlspecialchars($str1) . "<br>";
	  echo htmlspecialchars($str2) . "<br>";
	  echo htmlspecialchars($str3) . "<br>";
	  echo htmlspecialchars($str4) . "<br><br>";
	  
   }
   $db->close();
?>

<body>
</body>
</html>