<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	add_record("theme_master", $data);
}

if (isset($_REQUEST["deletestatusm"]))
{
	delete_record_secondary("theme_master", $_REQUEST["deletestatusm"], "id");
}

$qry = "SELECT theme_master.*, system_lang_code_master.name as cname, system_lang_code_master.id as cid FROM theme_master INNER JOIN system_lang_code_master ON (theme_master.system_lang_code_id = system_lang_code_master.id)";
$statusms = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$statusm = mysqli_fetch_assoc($statusms);

$qry = "SELECT * FROM system_lang_code_master";
$codems = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codem = mysqli_fetch_assoc($codems);

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
		<td><strong>Language Code:</strong></td>
		<td><select name="system_lang_code_id">
		<option value="0">Select...</option>
		<?php do { ?>
			<option value="<?php echo $codem["id"]; ?>"><?php echo $codem["name"]; ?></option>
		<?php } while ($codem = mysqli_fetch_assoc($codems)) ;?></select>&nbsp;&nbsp;<input type="submit" value="Add" />
		</td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:170px; width:308px; border:1px solid gray;"> 
<table width="93%">
	<tr bgcolor="#999999">
		<td align="center" width="75%"><strong>Theme Name</strong></td>
		<td align="center" width="75%"><strong>Lang Code</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $statusm["name"]; ?></td>
		<td><?php echo $statusm["cname"]; ?></td>
		<td><a href="theme_master_edit.php?id=<?php echo $statusm["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="theme_master.php?deletestatusm=<?php echo $statusm["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($statusm = mysqli_fetch_assoc($statusms)); ?>
</table>
</div>

</body>
</html>
