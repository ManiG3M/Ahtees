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
	$where = "id = ".$_POST["id"];
	modify_record("system_lang_code_master", $data, $where);
	header("location: system_lang_code_master.php");
	}

$qry = "SELECT * FROM system_lang_code_master WHERE id=".$id;
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
		<td><strong>Edit:</strong></td>
		<td><input type="text" name="name" value="<?php echo $statusm["name"]; ?>"/></td>
		<td><input type="submit" value="Update" /></td>
	</tr>
</table>
</form>

</body>
</html>
