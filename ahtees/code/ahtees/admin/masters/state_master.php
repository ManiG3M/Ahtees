<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["country_id"] = $_POST["country_id"];
	add_record("state_master", $data);
}

if (isset($_REQUEST["deletestatusm"]))
{
	delete_record_secondary("state_master", $_REQUEST["deletestatusm"], "id");
}

$qry = "SELECT state_master.*, country_master.name as sname FROM state_master INNER JOIN country_master ON (country_master.id = state_master.country_id) order by country_master.name, state_master.name";
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
	</tr>
	<tr>
		<td><strong>Country:</strong></td>
		<td>
		<select name="country_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $country["id"]; ?>"><?php echo $country["name"]; ?></option>	
			<?php } while ($country = mysqli_fetch_assoc($countrys)); ?>
		</select>&nbsp;&nbsp;
		<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:270px; width:408px; border:1px solid gray;"> 
<table width="98%">
	<tr bgcolor="#999999">
		<td align="center" width="75%"><strong>Name</strong></td>
		<td align="center" width="75%"><strong>Country</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $statusm["name"]; ?></td>
		<td><?php echo $statusm["sname"]; ?></td>
		<td><a href="state_master_edit.php?id=<?php echo $statusm["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="state_master.php?deletestatusm=<?php echo $statusm["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($statusm = mysqli_fetch_assoc($statusms)); ?>
</table>
</div>

</body>
</html>
