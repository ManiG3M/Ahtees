<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["file_extension"] = $_POST["file_extension"];
	add_record("content_type_file_extensions", $data);
}

if (isset($_REQUEST["deletect"]))
{
	delete_record_secondary("content_type_file_extensions", $_REQUEST["deletect"], "id");
}

$qry = "SELECT * FROM content_type_master";
$contents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$content = mysqli_fetch_assoc($contents);

$qry = "SELECT content_type_file_extensions.*, content_type_master.description FROM content_type_file_extensions INNER JOIN content_type_master ON (content_type_master.id = content_type_file_extensions.content_type_id)";
$contenttypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$contenttype = mysqli_fetch_assoc($contenttypes);

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
		<td><strong>Content Type:</strong></td>
		<td>
		<select name="content_type_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $content["id"]; ?>"><?php echo $content["description"]; ?></option>
			<?php } while ($content = mysqli_fetch_assoc($contents)); ?>
		</select>
		</td>
	</tr>
	<tr>
		<td><strong>File Extension:</strong></td>
		<td><input type="text" name="file_extension" />&nbsp;&nbsp;<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:272px; width:408px; border:1px solid gray;"> 
<table width="93%">
	<tr bgcolor="#999999">
		<td align="center" width="75%"><strong>Content Type</strong></td>
		<td align="center" width="75%"><strong>File Exension</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $contenttype["description"]; ?></td>
		<td><?php echo $contenttype["file_extension"]; ?></td>
		<td><a href="content_type_file_extensions_edit.php?id=<?php echo $contenttype["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="content_type_file_extensions.php?deletect=<?php echo $contenttype["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($contenttype = mysqli_fetch_assoc($contenttypes)); ?>
</table>
</div>

</body>
</html>
