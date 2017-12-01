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
	$data["altitude"] = $_POST["altitude"];
	$data["latitude"] = $_POST["latitude"];
	$data["timezone_id"] = $_POST["timezone_id"];
	$where = "id = ".$_POST["id"];
	modify_record("country_master", $data, $where);
	header("location: country_master.php");
	}

$qry = "SELECT * FROM country_master WHERE id=".$id;
$statusms = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$statusm = mysqli_fetch_assoc($statusms);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sports Master Edit</title>
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
<?php if (isset($modmsg)) { echo $modmsg; } ?>
<form name="editformat" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table align="left">
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $statusm["name"]; ?>"/></td>
	</tr>
	<tr>
		<td><strong>Altitude:</strong></td>
		<td><input type="text" name="altitude" value="<?php echo $statusm["altitude"]; ?>" /></td>
	</tr>
	<tr>
		<td><strong>Latitude:</strong></td>
		<td><input type="text" name="latitude" value="<?php echo $statusm["latitude"]; ?>" /></td>
	</tr>
	<tr>
		<td><strong>Time Zone:</strong></td>
		<td><input type="text" name="timezone_id" value="<?php echo $statusm["timezone_id"]; ?>" />&nbsp;&nbsp;<input type="submit" value="Update" /></td>
	</tr>
</table>
</form>

</body>
</html>
