<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["description"] = $_POST["description"];
	add_record("raaga_master", $data);
}

if (isset($_REQUEST["deleterag"]))
{
	delete_record_secondary("raaga_master", $_REQUEST["deleterag"], "id");
}

$qry = "SELECT * FROM raaga_master";
$raagas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rag = mysqli_fetch_assoc($raagas);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Raaga Master</title>
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
<form name="addrag" enctype="multipart/form-data" method="post">
<table>
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<td><strong>Description:</strong></td>
		<td><input type="text" name="description" />&nbsp;&nbsp;<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:399px; width:548px; border:1px solid gray;"> 
<table width="100%">
	<tr bgcolor="#999999">
		<td align="center" width="40%"><strong>Name</strong></td>
		<td align="center" width="40%"><strong>Description</strong></td>
		<td align="center" width="20%"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $rag["name"]; ?></td>
		<td><?php echo $rag["description"]; ?></td>
		<td><a href="raaga_master_edit.php?id=<?php echo $rag["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="raaga_master.php?deleterag=<?php echo $rag["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($rag = mysqli_fetch_assoc($raagas)); ?>
</table>
</div>

</body>
</html>
