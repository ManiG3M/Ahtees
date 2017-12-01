<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

//print_r($_POST);

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

	if ($_POST["state_id"] && $_POST["country_id"])
	{
		add_record("movie_company_master", $data);
	}
}

if (isset($_REQUEST["deleteaward"]))
{
	delete_record_secondary("movie_company_master", $_REQUEST["deleteaward"], "id");
}

$qry = "SELECT movie_company_master.*, state_master.name as sname, country_master.name as cname FROM movie_company_master INNER JOIN state_master ON (state_master.id = movie_company_master.state_id) INNER JOIN country_master ON (country_master.id = movie_company_master.country_id) order by movie_company_master.name";
$moviecs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$moviec = mysqli_fetch_assoc($moviecs);

$qry = "SELECT * FROM state_master order by name";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);

$qry = "SELECT * FROM country_master order by name";
$countrys = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countrys);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Customer Status Master</title>
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

<?php
if (!((isset($_POST["state_id"])) && (isset($_POST["country_id"]))))
{
	echo "<font color='red'>You must enter State and Country</font><p>";
}
?>

<a href="../admin.php">Back to Admin Page</a>
<form name="addaward" enctype="multipart/form-data" method="post">
<table align="center">
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" /></td>
		<td><strong>Address 1:</strong></td>
		<td><input type="text" name="address_1" /></td>
			<td><strong>Address 2:</strong></td>
		<td><input type="text" name="address_2" /></td>
	</tr>

	<tr>
		<td><strong>Address 3:</strong></td>
		<td><input type="text" name="address_3" /></td>
		<td><strong>City:</strong></td>
		<td><input type="text" name="city" /></td>
		<td><strong>State:</strong></td>
		<td>
		<select name="state_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $state["id"]; ?>"><?php echo $state["name"]; ?></option>
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
				<option value="<?php echo $country["id"]; ?>"><?php echo $country["name"]; ?></option>
			<?php } while ($country = mysqli_fetch_assoc($countrys)); ?>
		</select>
		</td>
		<td><strong>Owner:</strong></td>
		<td><input type="text" name="owner_name" /></td>
		<td><strong>Contact Number:</strong></td>
		<td><input type="text" name="contact_number" /></td>
	</tr>
	<tr>
		<td><strong>URL:</strong></td>
		<td><input type="text" name="URL" />
	</tr>
	<tr>
		<td><strong>Email:</strong></td>
		<td><input type="text" name="email_address" />&nbsp;&nbsp;<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<table border=1 width="98%">
	<tr bgcolor="#999999">
		<td align="center" width=""><strong>Name</strong></td>
		<td align="center" width=""><strong>Addr 1</strong></td>
		<td align="center" width=""><strong>Addr 2</strong></td>
		<td align="center" width=""><strong>Addr 3</strong></td>
		<td align="center" width=""><strong>City</strong></td>
		<td align="center" width=""><strong>State</strong></td>
		<td align="center" width=""><strong>Country</strong></td>
		<td align="center" width=""><strong>Owner</strong></td>
		<td align="center" width=""><strong>Phone</strong></td>
		<td align="center" width=""><strong>Email</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td align="center" width=""><?php echo $moviec["name"]; ?></td>
		<td align="center" width=""><?php echo $moviec["address_1"]; ?></td>
		<td align="center" width=""><?php echo $moviec["address_2"]; ?></td>
		<td align="center" width=""><?php echo $moviec["address_3"]; ?></td>
		<td align="center" width=""><?php echo $moviec["city"]; ?></td>
		<td align="center" width=""><?php echo $moviec["sname"]; ?></td>
		<td align="center" width=""><?php echo $moviec["cname"]; ?></td>
		<td align="center" width=""><?php echo $moviec["owner_name"]; ?></td>
		<td align="center" width=""><?php echo $moviec["contact_number"]; ?></td>
		<td align="center" width=""><?php echo $moviec["email_address"]; ?></td>
		<td><a href="movie_company_master_edit.php?id=<?php echo $moviec["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="movie_company_master.php?deleteaward=<?php echo $moviec["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($moviec = mysqli_fetch_assoc($moviecs)); ?>
</table>

</body>
</html>
