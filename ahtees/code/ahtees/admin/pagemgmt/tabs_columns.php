<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST || $_REQUEST)
{
	if ($_REQUEST["tab_id"])
	{
		$tab_id = $_REQUEST["tab_id"];
	}

	if ($_POST["tab_id"])
	{
		$tab_id = $_POST["tab_id"];
	}

	if ($_REQUEST["column_id"])
	{
		$column_id = $_REQUEST["column_id"];
	}

	if ($_POST["column_id"])
	{
		$column_id = $_POST["column_id"];
		unset($_POST["column_id"]);
	}
	if ($_POST["addcolumninfo"]) 
	{	
		unset($_POST["addcolumninfo"]);
		$_POST["entered_by"] = $_SESSION["userid"];
		$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$column_id = add_record("tab_columns", $_POST);
		$usermsg = "<font color='red'>New Column Added</font>";
	}

	if ($_POST["updatecolumninfo"]) 
	{	
		unset($_POST["updatecolumninfo"]);
		$_POST["updated_by"] = $_SESSION["userid"];
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$where = "id = ".$column_id;
		modify_record("tab_columns", $_POST, $where);
		$usermsg = "<font color='red'>Customer Updated</font>";
	}
	
	if ($_REQUEST["deletecolumninfo"])
	{
		delete_record_secondary("tab_columns", $column_id, "id");
	}
} 

if  ($tab_id)
{
	$qry = "SELECT * FROM tab_columns where tab_id = ". $tab_id;
	$columns = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$column = mysqli_fetch_assoc($columns);

	if ($_REQUEST["editcolumninfo"])
	{
		$qry = "SELECT * FROM tab_columns where id = ". $column_id;
		$e_columns = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$e_column = mysqli_fetch_assoc($e_columns);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>

<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<?php 
	$qry = "SELECT name FROM tabs_master where id = ". $tab_id;
	$tabs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$tab = mysqli_fetch_assoc($tabs);
?>
<body bgcolor="#CACACA">
<h1>Manage Columns For <?php echo $tab["name"]; ?></h1>
<table width="100%">
	<tr>
		<td><a href="tabs_master.php"> <span style="font-size:14px;"> Go Back to <B><?php echo $tab["name"]; ?></b> Tab</a></span></td>
	</tr>
</table>

<table border=1>
<tr valign="top">
<td width="70%">
<table width="100%" border=1>
	<tr>
		<td>Name</td>
		<td>Height</td>
		<td>Width</td>
		<td>BG Color</td>
		<td>Font & Size</td>
		<td>Border</td>
		<td>Action</td>
		<td>Manage Boxes</td>
	</tr>

	<?php 
	do { 
		echo "<tr><td>". $column["name"] ." </td>";
		echo "<td>". $column["height"] ." </td>";
		echo "<td>". $column["weight"] ." </td>";
		echo "<td>". $column["bgcolor"] ." </td>";
		echo "<td>". $column["font"] ." (". $column["font_size"] . ") </td>";
		echo "<td>". $column["border_flag"] ." </td>";
		?>
		<td>
		<a href="tabs_columns.php?editcolumninfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column["id"]; ?>">edit</a>
		<a href="tabs_columns.php?deletecolumninfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column["id"]; ?>">delete</a>
		</td>
		<td>
		<a href="boxes_master.php?tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column["id"]; ?>">Boxes</a>
		</td>
	</tr>

	<?php } while ($column = mysqli_fetch_assoc($columns)); ?>
</table>
</td>

<td width="30%">
<form action="tabs_columns.php" enctype="multipart/form-data" method="post" name="addcolum">
<?php if ($column_id) { ?>
	<input type="hidden" value="1" name="updatecolumninfo" />
	<input type="hidden" value="<?php echo $column_id; ?>" name="column_id" />
<?php } else { ?>
	<input type="hidden" value="1" name="addcolumninfo" />
<?php } ?>
	<input type="hidden" value="<?php echo $tab_id; ?>" name="tab_id" />
<table width="100%" border="0">
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td colspan="3"><input type="text" name="name" size="65" value="<?php echo $e_column["name"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Height:</strong></td>
		<td colspan="3"><input type="text" name="height" size="65" value="<?php echo $e_column["height"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Width:</strong></td>
		<td colspan="3"><input type="text" name="width" size="65" value="<?php echo $e_column["width"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Back Ground Color:</strong></td>
		<td colspan="3"><input type="text" name="bgcolor" size="65" value="<?php echo $e_column["bgcolor"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Font:</strong></td>
		<td colspan="3"><input type="text" name="font" size="65" value="<?php echo $e_column["font"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Font Size:</strong></td>
		<td colspan="3"><input type="text" name="font_size" size="65" value="<?php echo $e_column["font_size"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Border Needed:</strong></td>
		<td colspan="3"><input type="text" name="border_flag" size="65" value="<?php echo $e_column["border_flag"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
		<?php if ($column_id) { ?>
			<input type="submit" value="Update Column" />
			<input type="button" value="New Column" onClick="javascript:location.href='tabs_columns.php?new=1&tab_id=<?php echo $tab_id; ?>'" />
		<?php } else { ?>
			<input type="submit" value="Add Column" />
		<?php } ?></td>
</form>
</td>
</tr>
</table>

</body>
</html>
