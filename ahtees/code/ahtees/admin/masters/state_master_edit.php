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
	$data["country_id"] = $_POST["country_id"];
	$where = "id = ".$_POST["id"];
	modify_record("state_master", $data, $where);
	header("location: state_master.php");
	}

$qry = "SELECT * FROM state_master WHERE id=".$id;
$statusms = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$statusm = mysqli_fetch_assoc($statusms);

$qry = "SELECT * FROM country_master";
$countrys = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countrys);
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
		<td><strong>Country:</strong></td>
		<td><select name="country_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $country["id"]; ?>" <?php if ($statusm["country_id"] == $country["id"]) {?>selected<?php } ?>><?php echo $country["name"]; ?></option>	
			<?php } while ($country = mysqli_fetch_assoc($countrys)); ?>
		</select>&nbsp;&nbsp;<input type="submit" value="Update" /></td>
	</tr>
</table>
</form>

</body>
</html>
