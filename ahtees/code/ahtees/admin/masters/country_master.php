<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["altitude"] = $_POST["altitude"];
	$data["latitude"] = $_POST["latitude"];
	$data["timezone_id"] = $_POST["timezone_id"];
	add_record("country_master", $data);
}

if (isset($_REQUEST["deletestatusm"]))
{
	delete_record_secondary("country_master", $_REQUEST["deletestatusm"], "id");
}

$qry = "SELECT * FROM country_master order by name";
$statusms = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$statusm = mysqli_fetch_assoc($statusms);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Theme Master</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CCCCCC">
<form name="addformat" enctype="multipart/form-data" method="post">
<table align="center">
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" /></td>
		<td><strong>Altitude:</strong></td>
		<td><input type="text" name="altitude" /></td>
	</tr>
	<tr>
		<td><strong>Latitude:</strong></td>
		<td><input type="text" name="latitude" /></td>
		<td><strong>Time Zone:</strong></td>
		<td><input type="text" name="timezone_id" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3"><input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:242px; width:448px; border:1px solid gray;"> 
<table width="98%">
	<tr bgcolor="#999999">
		<td align="center" width="75%"><strong>Name</strong></td>
		<td align="center" width="75%"><strong>Altitude</strong></td>
		<td align="center" width="75%"><strong>Latitude</strong></td>
		<td align="center" width="75%"><strong>Time Zone</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $statusm["name"]; ?></td>
		<td><?php echo $statusm["altitude"]; ?></td>
		<td><?php echo $statusm["latitude"]; ?></td>
		<td><?php echo $statusm["timezone_id"]; ?></td>
		<td><a href="country_master_edit.php?id=<?php echo $statusm["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="country_master.php?deletestatusm=<?php echo $statusm["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($statusm = mysqli_fetch_assoc($statusms)); ?>
</table>
</div>

</body>
</html>
