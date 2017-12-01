<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	add_record("location_master", $_POST);
}

if (isset($_REQUEST["deleteloc"]))
{
	delete_record_secondary("location_master", $_REQUEST["deleteloc"], "id");
}


$qry = "SELECT location_master.*, location_type_master.name as tname, country_master.name as cname, state_master.name as sname, theme_master.name as thname FROM location_master , country_master , theme_master, state_master, location_type_master WHERE location_type_master.id = location_master.type_id AND country_master.id = location_master.country_id AND state_master.id = location_master.state_id AND theme_master.id = location_master.theme_id order by location_master.name"; 
$locations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$loc = mysqli_fetch_assoc($locations);

$qry = "SELECT * FROM country_master order by name";
$countries = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countries);

$qry = "SELECT * FROM state_master order by name";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);

$qry = "SELECT * FROM location_type_master order by name";
$locationtypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$locationtype = mysqli_fetch_assoc($locationtypes);

$qry = "SELECT * FROM theme_master order by name";
$themes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$theme = mysqli_fetch_assoc($themes);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sports Master</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<a href="../admin.php">Go Back to Home Page</a>
<body bgcolor="#CCCCCC">
<form name="addrate" enctype="multipart/form-data" method="post">
<table>
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td><input type="text" name="name" size="30" /></td>
		<td align="right"><strong>Description:</strong></td>
		<td><input type="text" name="description" size="50"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Type:</strong></td>
		<td colspan="3">
			<select name="type_id">
			<option value="0">Select Type...</option>
			<?php do { ?>
				<option value="<?php echo $locationtype["id"]; ?>"><?php echo $locationtype["name"]; ?></option>
			<?php } while ($locationtype = mysqli_fetch_assoc($locationtypes)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;
		<strong>Country:</strong>&nbsp;
			<select name="country_id">
			<option value="0">Select Country...</option>
			<?php do { ?>
				<option value="<?php echo $country["id"]; ?>"><?php echo $country["name"]; ?></option>
			<?php } while ($country = mysqli_fetch_assoc($countries)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;<strong>State:</strong>&nbsp;
			<select name="state_id">
			<option value="0">Select State...</option>
			<?php do { ?>
				<option value="<?php echo $state["id"]; ?>"><?php echo $state["name"]; ?></option>
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
				<option value="<?php echo $theme["id"]; ?>"><?php echo $theme["name"]; ?></option>
			<?php } while ($theme = mysqli_fetch_assoc($themes)); ?>
			</select>
		&nbsp;&nbsp;&nbsp;<strong>Contact Number:</strong>&nbsp;<input type="text" name="contact_number" />
		&nbsp;&nbsp;&nbsp;<strong>Email Address:</strong>&nbsp;<input type="text" name="email_address" />
		</td>
	</tr>
	<tr>
		<td align="right"><strong>URL:</strong></td>
		<td colspan="3"><input type="text" size="80" name="url"/></td>
	</tr>
	<tr>
		<td align="right" valign="top"><strong>Text:</strong></td>
		<td colspan="3"><textarea name="text" rows="3" cols="60"></textarea>&nbsp;&nbsp;<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<table width="97%">
	<tr bgcolor="#999999">
		<td align="center" width="40%"><strong>Name</strong></td>
		<td align="center" width="40%"><strong>Description</strong></td>
		<td align="center" width="40%"><strong>Type</strong></td>
		<td align="center" width="40%"><strong>Country</strong></td>
		<td align="center" width="40%"><strong>State</strong></td>
		<td align="center" width="40%"><strong>URL</strong></td>
		<td align="center" width="40%"><strong>Text</strong></td>
		<td align="center" width="40%"><strong>Contact Number</strong></td>
		<td align="center" width="40%"><strong>Email Address</strong></td>
		<td align="center" width="40%"><strong>Theme</strong></td>
		<td align="center" width="20%"><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<?php if(isset($loc["name"])) { ?>
		<td><?php echo $loc["name"]; ?></td>
		<?php } ?>
		<?php if(isset($loc["description"])) { ?>
		<td><?php echo $loc["description"]; ?></td>
		<?php } ?>

			
	<?php if(isset($loc["tname"])) { ?>
		<td><?php echo $loc["tname"]; ?></td>
	<?php } ?>	
	<?php if(isset($loc["cname"])) { ?>
		<td><?php echo $loc["cname"]; ?></td>
	<?php } ?>	
		
		<?php if(isset($loc["sname"])) { ?>
		<td><?php echo $loc["sname"]; ?></td>
	<?php } ?>
		
		<?php if(isset($loc["url"])) { ?>
		<td><?php echo $loc["url"]; ?></td>
	<?php } ?>
		
		<?php if(isset($loc["text"])) { ?>
		<td><?php echo $loc["text"]; ?></td>
	<?php } ?>
		
		<?php if(isset($loc["contact_number"])) { ?>
		<td><?php echo $loc["contact_number"]; ?></td>
	<?php } ?>
		
		<?php if(isset($loc["email_address"])) { ?>
		<td><?php echo $loc["email_address"]; ?></td>
	<?php } ?>
		
		<?php if(isset($loc["thname"])) { ?>
		<td><?php echo $loc["thname"]; ?></td>
	<?php } ?>
		
		<td><a href="location_master_edit.php?id=<?php echo $loc["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="location_master.php?deleteloc=<?php echo $loc["id"]; ?>">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "")
	{
		$bgcolor = "#E2E2E2";
	} else {
		$bgcolor = "";
	}
	} while ($loc = mysqli_fetch_assoc($locations)); ?>
</table>

</body>
</html>
