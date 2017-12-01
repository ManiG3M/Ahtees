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
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["file_extension"] = $_POST["file_extension"];
	$where = "id = ".$_POST["id"];
	modify_record("content_type_file_extensions", $data, $where);
	$modmsg = "<font color='red'>Content Type Updated, Close Window and refresh Customer Status Master</font>";
	header("location: content_type_file_extensions.php");
	}

$qry = "SELECT * FROM content_type_file_extensions WHERE id=".$id;
$contents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$content = mysqli_fetch_assoc($contents);

$qry = "SELECT * FROM content_type_master";
$contenttypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$contenttype = mysqli_fetch_assoc($contenttypes);

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
<form name="editcat" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table align="left">
	<tr>
		<td><strong>Content Type:</strong></td>
		<td>
		<select name="content_type_id">
			<option value="0">Select...</option>
			<?php do { ?>
				<option value="<?php echo $contenttype["id"]; ?>" <?php if ($contenttype["id"] == $content["content_type_id"]) {?>selected<?php } ?>><?php echo $contenttype["description"]; ?></option>
			<?php } while ($contenttype = mysqli_fetch_assoc($contenttypes)); ?>
		</select>
		</td>
	</tr>
	<tr>
		<td><strong>File Extension:</strong></td>
		<td><input type="text" name="file_extension" value="<?php echo $content["file_extension"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Update" /></td>
	</tr>
</table>
</form>

</body>
</html>
