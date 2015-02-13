<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('store.db');
      }
   }
   $db = new MyDB();

   $sql =<<<EOF
      SELECT * from ROOMS;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray() ){
      echo "ID = ". $row['SESSIONID'] . "<br>";
      echo "NAME = ". $row['FIRSTNAME'] . $row['LASTNAME'] ."<br>";
      echo "EMAIL = ". $row['EMAIL'] ."<br>";
      echo "SUM =  ". $row['SUM'] ."<br>";
	  echo "ROOM1 =  ". $row['ROOM1'] ."<br>";
	  echo "ROOM2 =  ". $row['ROOM2'] ."<br><br>";
   }
   $db->close();
?>

<body>
</body>
</html>