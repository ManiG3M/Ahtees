<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["description"] = $_POST["description"];
	add_record("content_type_master", $data);
}

if (isset($_REQUEST["deletect"]))
{
	delete_record_secondary("content_type_master", $_REQUEST["deletect"], "id");
}

$qry = "SELECT * FROM content_type_master";
$contents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$content = mysqli_fetch_assoc($contents);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Content Type Master</title>
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
<form name="addcat" enctype="multipart/form-data" method="post">
<table align="center">
	<tr>
		<td><strong>Add New:</strong></td>
		<td><input type="text" name="description" /></td>
		<td><input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:199px; width:308px; border:1px solid gray;"> 
<table width="93%">
	<tr bgcolor="#999999">
		<td align="center" width="75%"><strong>Description</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $content["description"]; ?></td>
		<td><a href="content_type_master_edit.php?id=<?php echo $content["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="content_type_master.php?deletect=<?php echo $content["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($content = mysqli_fetch_assoc($contents)); ?>
</table>
</div>

</body>
</html>
