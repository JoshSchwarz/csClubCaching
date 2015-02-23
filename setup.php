<?php
//Open database (If database doesnt exist will be created.
class MyDB extends SQLite3
{
  function __construct()
  {
	 $this->open('./db/store.db');
  }
}
$db = new MyDB();
if(!$db){
  echo $db->lastErrorMsg();
} else {
  echo "Opened database successfully\n";
}

//Creates table.
$sql =<<<EOF
  CREATE TABLE ROOMS
  (SESSIONID INT PRIMARY KEY     NOT NULL,
  FIRSTNAME      TEXT     NOT NULL,
  LASTNAME 		 TEXT 	  NOT NULL,
  EMAIL          TEXT     NOT NULL,
  SUM 			 INT	  NOT NULL 		DEFAULT 0,
  EM110 		 INT,
  FLENT 		 INT,
  CAT2 			 INT,
  LVLB			 INT,
  CHAPM 		 INT,
  LVL4 			 INT,
  HORLA			 INT,
  GRND 			 INT);
EOF;

$ret = $db->exec($sql);
if(!$ret){
  echo $db->lastErrorMsg();
} else {
  echo "Table created successfully\n";
}
$db->close();
?>