<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["status"] = $_POST["status"];
	$data["lang_id"] = $_POST["lang_id"];
	add_record("tabs_master", $data);
}

if ($_REQUEST["deletetab"])
{
	delete_record_secondary("tabs_master", $_REQUEST["deletetab"], "id");
}

$qry = "SELECT * FROM language_master ORDER BY description";
$languages = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$language = mysqli_fetch_assoc($languages);

$qry = "SELECT tabs_master.*, language_master.description FROM tabs_master, language_master where language_master.id = tabs_master.lang_id";
$tabss = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$tab = mysqli_fetch_assoc($tabss);

$qry = "SELECT * FROM home_page_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);
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
<h1>Manage Tabs</h1>
<form name="addtab" enctype="multipart/form-data" method="post">
<table>
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Status:</strong></td>
		<td>
			<select name="status">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $status["id"]; ?>"
				<?php
				if ( $status["id"] == $tabss["status"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>
				<?php echo $status["description"]; ?></option>
				<?php } while ($status = mysqli_fetch_assoc($statuses)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Language:</strong></td>
		<td>
			<select name="lang_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $language["id"]; ?>"
				<?php echo ">"; ?>
				<?php echo $language["description"]; ?></option>
				<?php } while ($language = mysqli_fetch_assoc($languages)); ?>
			</select>
		</td>
	</tr>

	<tr>
		<td>&nbsp;&nbsp;<input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:399px; width:548px; border:1px solid gray;"> 
<table width="100%">
	<tr bgcolor="#999999">
		<td><strong>Name</strong></td>
		<td><strong>Language</strong></td>
		<td><strong>Status</strong></td>
		<td><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $tab["name"]; ?></td>
		<td><?php echo $tab["description"]; ?></td>
		<td>
		<?php 
			$qry = "SELECT * FROM home_page_status_master WHERE id = ". $tab["status"];
			$xstats = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
			$xstat = mysqli_fetch_assoc($xstats);
			echo $xstat["description"];
 		?>
		</td>
		<td><a href="tabs_master_edit.php?id=<?php echo $tab["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="tabs_master.php?deletetab=<?php echo $tab["id"]; ?>">delete</a>&nbsp;&nbsp;<a href="tabs_columns.php?tab_id=<?php echo $tab["id"]; ?>">Manage Columns</a></td>
	</tr>
	<?php } while ($tab = mysqli_fetch_assoc($tabss)); ?>
</table>
</div>

</body>
</html>
