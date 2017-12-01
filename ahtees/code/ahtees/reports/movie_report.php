<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

$qry = "SELECT * FROM state_master";
$states = mysqli_query($connDB,$qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysql_fetch_assoc($states);

$qry = "SELECT * FROM country_master";
$countries = mysqli_query($connDB,$qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysql_fetch_assoc($countries);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>
</head>

<body bgcolor="#CACACA">
<?php 
	do 
	{ 
		echo $state["id"]; 
		echo $state["name"]; 
		echo "<br>";
	} while ($state = mysql_fetch_assoc($states)); 
?>

</body>
</html>
