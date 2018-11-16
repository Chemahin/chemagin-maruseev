<?php

$db_host = 'localhost';
$db_name = 'causeffe_db';
$db_user = 'causeffe_db_user';
$db_pass = 'g00H6Pzx8ZDQ';//'YIm1qz9Xq4_G';

sql::$con = new mysqli($db_host, $db_user, $db_pass, $db_name);

class sql {

    public static $con;

}

if (!sql::$con->set_charset("utf8")) {

  printf("Error loading character set utf8: %s\n", sql::$con->error);
  exit();

}

?>
