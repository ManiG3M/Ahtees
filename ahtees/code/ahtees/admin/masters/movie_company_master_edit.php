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
	$data["name"] = $_POST["name"];
	$data["URL"] = $_POST["URL"];
	$data["address_1"] = $_POST["address_1"];
	$data["address_2"] = $_POST["address_2"];
	$data["address_3"] = $_POST["address_3"];
	$data["city"] = $_POST["city"];
	$data["state_id"] = $_POST["state_id"];
	$data["country_id"] = $_POST["country_id"];
	$data["owner_name"] = $_POST["owner_name"];
	$data["contact_number"] = $_POST["contact_number"];
	$data["email_address"] = $_POST["email_address"];
	$where = "id = ".$_POST["id"];
	modify_record("movie_company_master", $data, $where);
	header("location: movie_company_master.php");
	}

$qry = "SELECT movie_company_master.*, state_master.name as sname, country_master.name as cname FROM movie_company_master INNER JOIN state_master ON (state_master.id = movie_company_master.state_id) INNER JOIN country_master ON (country_master.id = movie_company_master.country_id) WHERE movie_company_master.id=".$id;
$moviecs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$moviec = mysqli_fetch_assoc($moviecs);

$qry = "SELECT * FROM state_master";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);

$qry = "SELECT * FROM country_master";
$countrys = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countrys);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Award Status Master</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" media="all" href="../../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../../calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CCCCCC">
<a href="movie_company_master.php">Back to Company Master</a>
<?php if (isset($modmsg)) { echo $modmsg; } ?>
<form name="editcusstat" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table align="center">
	<tr>
		<td width="77"><strong>Name:</strong></td>
	  <td width="159"><input type="text" name="name" value="<?php echo $moviec["name"]; ?>"/></td>
		<td width="68"><strong>Address 1:</strong></td>
	  <td width="152"><input type="text" name="address_1" value="<?php echo $moviec["address_1"]; ?>" /></td>
			<td width="114"><strong>Address 2:</strong></td>
	  <td width="179"><input type="text" name="address_2" value="<?php echo $moviec["address_2"]; ?>" /></td>
	</tr>
	<tr>
		<td><strong>Address 3:</strong></td>
		<td><input type="text" name="address_3" value="<?php echo $moviec["address_3"]; ?>" /></td>
		<td><strong>City:</strong></td>
		<td><input type="text" name="city" value="<?php echo $moviec["city"]; ?>" /></td>
		<td><strong>State:</strong></td>
		<td>
		<select name="state_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $state["id"]; ?>" <?php if ($state["id"] == $moviec["state_id"]) {?>selected<?php } ?>><?php echo $state["name"]; ?></option>
			<?php } while ($state = mysqli_fetch_assoc($states)); ?>
		</select>
		</td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td><strong>Country:</strong></td>
		<td>
		<select name="country_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $country["id"]; ?>" <?php if ($country["id"] == $moviec["country_id"]) {?>selected<?php } ?>><?php echo $country["name"]; ?></option>
			<?php } while ($country = mysqli_fetch_assoc($countrys)); ?>
		</select>
		</td>
		<td><strong>Owner:</strong></td>
		<td><input type="text" name="owner_name" value="<?php echo $moviec["owner_name"]; ?>" /></td>
		<td><strong>Contact Number:</strong></td>
		<td><input type="text" name="contact_number" value="<?php echo $moviec["contact_number"]; ?>" /></td>
	</tr>
	<tr>
		<td><strong>URL:</strong></td>
		<td colspan="5"><input type="text" name="URL" value="<?php echo $moviec["URL"]; ?>" />
	</tr>
	<tr>
		<td><strong>Email:</strong></td>
		<td colspan="5"><input type="text" name="email_address" value="<?php echo $moviec["email_address"]; ?>" />&nbsp;&nbsp;<input type="submit" value="Update" /></td>
	</tr>
</table>

</form>

</body>
</html>
