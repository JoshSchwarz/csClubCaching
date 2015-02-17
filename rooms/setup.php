<?php
//Open database (If database doesnt exist /should/ be created.
class MyDB extends SQLite3
{
  function __construct()
  {
	 $this->open('./rooms/store.db');
  }
}
$db = new MyDB();
if(!$db){
  echo $db->lastErrorMsg();
} else {
  echo "Opened database successfully\n";
}

//Creates table.
//SESSIONID through EMAIL are required by code.
//ROOM1 is an example roomID that can be changed to any ID.
//NOTE: Must be one roomID column per room.
$sql =<<<EOF
  CREATE TABLE ROOMS
  (SESSIONID INT PRIMARY KEY     NOT NULL,
  FIRSTNAME      TEXT     NOT NULL,
  LASTNAME 		 TEXT 	  NOT NULL,
  EMAIL          TEXT     NOT NULL,
  SUM 			 INT	  NOT NULL 		DEFAULT 0,
  ROOM1 		 INT,
  ROOM2 		 INT);
EOF;

$ret = $db->exec($sql);
if(!$ret){
  echo $db->lastErrorMsg();
} else {
  echo "Table created successfully\n";
}
$db->close();
?>
