<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_REQUEST["id"])
{
	$id = $_REQUEST["id"];
} else if ($_POST["id"]) {
	$id = $_POST["id"];
}

if ($_POST)
{
	
	$where = "id = ".$_POST["id"];
	modify_record("location_master", $_POST, $where);
	$modmsg = "<font color='red'>Locations Updated, Close Window and refresh Customer Status Master</font>";
	header("location: location_master.php");
	}

$qry = "SELECT * FROM location_master WHERE id=".$id;
$locations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$loc = mysqli_fetch_assoc($locations);

$qry = "SELECT * FROM country_master";
$countries = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countries);

$qry = "SELECT * FROM state_master";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);

$qry = "SELECT * FROM location_type_master";
$locationtypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$locationtype = mysqli_fetch_assoc($locationtypes);

$qry = "SELECT * FROM theme_master";
$themes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$theme = mysqli_fetch_assoc($themes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Locations Master Edit</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<a href="admin.php">Go Back to Home Page</a>
<body bgcolor="#CCCCCC">
<?php if (isset($modmsg)) { echo $modmsg; } ?>
<form name="editloc" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table>
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td><input type="text" name="name" size="30" value="<?php echo $loc["name"]; ?>"/></td>
		<td align="right"><strong>Description:</strong></td>
		<td><input type="text" name="description" size="50" value="<?php echo $loc["description"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Type:</strong></td>
		<td colspan="3">
			<select name="type_id">
			<option value="0">Select Type...</option>
			<?php do { ?>
				<option value="<?php echo $locationtype["id"]; ?>" <?php if ($loc["type_id"] == $locationtype["id"]) { ?>selected<?php } ?>><?php echo $locationtype["name"]; ?></option>
			<?php } while ($locationtype = mysqli_fetch_assoc($locationtypes)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;
		<strong>Country:</strong>&nbsp;
			<select name="country_id">
			<option value="0">Select Country...</option>
			<?php do { ?>
				<option value="<?php echo $country["id"]; ?>" <?php if ($loc["country_id"] == $country["id"]) { ?>selected<?php } ?>><?php echo $country["name"]; ?></option>
			<?php } while ($country = mysqli_fetch_assoc($countries)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;<strong>State:</strong>&nbsp;
			<select name="state_id">
			<option value="0">Select State...</option>
			<?php do { ?>
				<option value="<?php echo $state["id"]; ?>" <?php if ($loc["state_id"] == $state["id"]) { ?>selected<?php } ?>><?php echo $state["name"]; ?></option>
			<?php } while ($state = mysqli_fetch_assoc($states)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Theme:</strong></td>
		<td colspan="3">
			<select name="theme_id">
			<option value="0">Select Theme...</option>
			<?php do { ?>
				<option value="<?php echo $theme["id"]; ?>" <?php if ($loc["theme_id"] == $theme["id"]) { ?>selected<?php } ?>><?php echo $theme["name"]; ?></option>
			<?php } while ($theme = mysqli_fetch_assoc($themes)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;<strong>Contact Number:</strong>&nbsp;<input type="text" name="contact_number" value="<?php echo $loc["contact_number"]; ?>"/>
		&nbsp;&nbsp;&nbsp;<strong>Email Address:</strong>&nbsp;<input type="text" name="email_address" value="<?php echo $loc["email_address"]; ?>"/>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>URL:</strong></td>
		<td colspan="3"><input type="text" size="80" name="url" value="<?php echo $loc["url"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right" valign="top"><strong>Text:</strong></td>
		<td colspan="3"><textarea name="text" rows="3" cols="60"><?php echo $loc["text"]; ?></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3"><input type="submit" value="Update" />&nbsp;<input type="button" value="Cancel" onclick="javascript:location.href='location_master.php';"/></td>
	</tr>
</table>
</form>

</body>
</html>
