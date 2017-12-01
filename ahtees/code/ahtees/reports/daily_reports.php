<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

$cd_qry = "SELECT current_date()-1 as curr_date from dual"; 
$cd_set = mysqli_query($connDB,$cd_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$cd = mysqli_fetch_assoc($cd_set);

$m_t_d_qry = "SELECT count(*) as total_movies FROM movie_master";
$m_t_d_set = mysqli_query($connDB,$m_t_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$m_t_d = mysqli_fetch_assoc($m_t_d_set);

$m_a_d_qry = "SELECT count(*) as total_movie_added FROM movie_master where date(entered_date) = date(current_date()-1)";
$m_a_d_set = mysqli_query($connDB,$m_a_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$m_a_d = mysqli_fetch_assoc($m_a_d_set);

$m_u_d_qry = "SELECT count(*) as total_movie_updated FROM movie_master where date(updated_date) = date(current_date())";
$m_u_d_set = mysqli_query($connDB,$m_u_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$m_u_d = mysqli_fetch_assoc($m_u_d_set);

$c_t_d_qry = "SELECT count(*) as total_cast FROM customer_master";
$c_t_d_set = mysqli_query($connDB,$c_t_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$c_t_d = mysqli_fetch_assoc($c_t_d_set);

$c_a_d_qry = "SELECT count(*) as total_cast_added FROM customer_master where date(entered_date) = date(current_date()-1)";
$c_a_d_set = mysqli_query($connDB,$c_a_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$c_a_d = mysqli_fetch_assoc($c_a_d_set);

$c_u_d_qry = "SELECT count(*) as total_cast_updated FROM customer_master where date(updated_date) = date(current_date())";
$c_u_d_set = mysqli_query($connDB,$c_u_d_qry) or die('Query failed: ' . mysqli_error($connDB)); 
$c_u_d = mysqli_fetch_assoc($c_u_d_set);

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

<h1>Executive Information System (EIS) (<?php echo $cd["curr_date"]; ?>)</h1>

<body>
<font size=4 face='verdana'>

<table border=1>
<tr>
<td>Total Movies </td><td> <?php echo $m_t_d["total_movies"]; ?> <br></td>
</tr>
<tr>
<td>Movies Added today </td><td> <?php echo $m_a_d["total_movie_added"]; ?> <br></td>
</tr>
<tr>
<td>Movies Update today </td><td> <?php echo $m_u_d["total_movie_updated"]; ?><br></td>
</tr>
<tr>
<td>Total Cast </td><td> <?php echo $c_t_d["total_cast"]; ?> <br></td>
</tr>
<tr>
<td>Cast Added today </td><td> <?php echo $c_a_d["total_cast_added"]; ?> <br></td>
</tr>
<tr>
<td>Cast Update today </td><td> <?php echo $c_u_d["total_cast_updated"]; ?><br></td>
</tr>
</table>
</font>
</body>
</html>
