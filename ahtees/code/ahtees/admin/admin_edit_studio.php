<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

date_default_timezone_set('Asia/Kolkata');
if (isset($_POST["editstudioinfo"])) 
{
	unset($_POST["editstudioinfo"]);
	$where = "id = ".$_POST["studioid"];
	unset($_POST["studioid"]);
	modify_record("studio_master", $_POST, $where);
	$usermsg = "<font color='red'>Studio Updated</font>";
}

$qry = "SELECT * FROM studio_master WHERE id =".$_REQUEST["studioid"];
$studios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$studio = mysqli_fetch_assoc($studios);

$qry = "SELECT * FROM country_master order by name";
$countries = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countries);
$countrycount = 0;

if ($country)
{
	do {
		$countrycount++;
		$countryname[$countrycount] = $country["name"];
		$countryid[$countrycount] = $country["id"];
	} while($country = mysqli_fetch_assoc($countries));
}

$qry = "SELECT * FROM state_master order by name";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);
$statecount = 0;

if ($state)
{
	do {
		$statecount++;
		$statename[$statecount] = $state["name"];
		$stateid[$statecount] = $state["id"];
	} while($state = mysqli_fetch_assoc($states));
}

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

<script language="javascript">
function closewindow()
{
	parent.parent.location.href='admin_view_studio.php';	
	window.close();
}
</script>
</head>

<body bgcolor="#CACACA" onunload="javascript:closewindow();">
<p>&nbsp;</p>
<h3>Edit Studio</h3>
<hr />
<form action="admin_edit_studio.php" enctype="multipart/form-data" method="post" name="adduser">
<input type="hidden" name="editstudioinfo" value="1">
<input type="hidden" name="studioid" value="<?php echo $studio["id"]; ?>">
<table width="100%" frame="box" border="0">
	<?php if (isset($usermsg)) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $usermsg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td><input type="text" name="name" size="40" value="<?php echo $studio["name"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Description:</strong></td>
		<td><textarea rows="3" cols="45" name="description"><?php echo $studio["description"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right"><strong>Address 1:</strong></td>
		<td><input type="text" name="address_line_1" size="40" value="<?php echo $studio["address_line_1"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Address 1:</strong></td>
		<td><input type="text" name="address_line_2" size="40" value="<?php echo $studio["address_line_2"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>City</strong></td>
		<td><input type="text" name="city" size="30" value="<?php echo $studio["city"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>State:</strong></td>
		<td>
			<select name="state">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$statecount; $n++) { ?>
				<option value="<?php echo $stateid[$n]; ?>"
				<?php
				if ( $stateid[$n] == $studio["state"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>
				<?php echo $statename[$n]; ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Country:</strong></td>
		<td>
			<select name="country">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$countrycount; $n++) { ?>
				<option value="<?php echo $countryid[$n]; ?>"
				<?php
				if ( $countryid[$n] == $studio["country"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>
				<?php echo $countryname[$n]; ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type="text" name="email_address" size="40" value="<?php echo $studio["email_address"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 1:</strong></td>
		<td><input type="text" name="contact_number_1"  size="40" value="<?php echo $studio["contact_number_1"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 2:</strong></td>
		<td><input type="text" name="contact_number_2" size="40" value="<?php echo $studio["contact_number_2"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Phone 3:</strong></td>
		<td><input type="text" name="contact_number_3" size="40" value="<?php echo $studio["contact_number_3"]; ?>"/></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Update Studio" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
