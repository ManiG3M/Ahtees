<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');
if (!$_SESSION["userid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if (isset($_POST["addstudioinfo"])) 
{
	unset($_POST["addstudioinfo"]);
	add_record("studio_master", $_POST);
	$usermsg = "<font color='red'>New Studio Added</font>";
}

$qry = "SELECT * FROM state_master";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);

$qry = "SELECT * FROM country_master";
$countries = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countries);

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
<a href="admin.php">Go Back to Home Page</a>
<h3>Add Studio</h3>
<hr />
<form action="admin_add_studio.php" enctype="multipart/form-data" method="post" name="adduser">
<input type="hidden" name="addstudioinfo" value="1">
<table width="100%" frame="box" border="0">
	<?php if (isset($usermsg)) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $usermsg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td><input type="text" name="name" size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Description:</strong></td>
		<td><textarea rows="3" cols="45" name="description"></textarea></td>
	</tr>
	<tr>
		<td align="right"><strong>Address 1:</strong></td>
		<td><input type="text" name="address_line_1" size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Address 1:</strong></td>
		<td><input type="text" name="address_line_2" size="40" size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>City</strong></td>
		<td><input type="text" name="city" size="30"/></td>
	</tr>
	<tr>
		<td align="right"><strong>State</strong></td>
		<td>
			<select name="state">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $state["id"]; ?>"><?php echo $state["name"]; ?></option>
				<?php } while ($state = mysqli_fetch_assoc($states)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Country:</strong></td>
		<td>
			<select name="country">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $country["id"]; ?>"><?php echo $country["name"]; ?></option>
				<?php } while ($country = mysqli_fetch_assoc($countries)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type="text" name="email_address" size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 1:</strong></td>
		<td><input type="text" name="contact_number_1"  size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 2:</strong></td>
		<td><input type="text" name="contact_number_2" size="40"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 3:</strong></td>
		<td><input type="text" name="contact_number_3" size="40"/></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Add Studio" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
