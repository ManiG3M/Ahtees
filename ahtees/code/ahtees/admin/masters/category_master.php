<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["description"] = $_POST["description"];
	add_record("category_master", $data);
}

if (isset($_REQUEST["deletecat"]))
{
	delete_record_secondary("category_master", $_REQUEST["deletecat"], "id");
}

$qry = "SELECT * FROM category_master order by description";
$categories = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$category = mysqli_fetch_assoc($categories);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sports Master</title>
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
		<td><?php echo $category["description"]; ?></td>
		<td><a href="category_master_edit.php?id=<?php echo $category["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="category_master.php?deletecat=<?php echo $category["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($category = mysqli_fetch_assoc($categories)); ?>
</table>
</div>

</body>
</html>
