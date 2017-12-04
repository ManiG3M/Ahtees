<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_DB = "localhost";
$database_DB = "ahtees";
$username_DB = "root";
$password_DB = "123!@#Krishna";

//$hostname_DB = "custsql.sonic.net";
//$database_DB = "language_3";
//$username_DB = "language_3-all";
//$password_DB = "5956e124";

//$connDB = mysql_connect($hostname_DB, $username_DB, $password_DB) or trigger_error(mysqli_error($connDB),E_USER_ERROR); 

$connDB = mysqli_connect($hostname_DB, $username_DB, $password_DB, $database_DB) or trigger_error(mysqli_error($connDB),E_USER_ERROR); 
$GLOBALS['connDB'] = $connDB;

?>
