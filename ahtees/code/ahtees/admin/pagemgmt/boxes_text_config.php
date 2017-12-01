<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST["addconfig"]) 
{	
	unset($_POST["addconfig"]);
	$id = add_record("box_text_content_config", $_POST);
	$usermsg = "<font color='red'>New Config Added</font>";
}

if ($_REQUEST["deleteconfig"])
{
	delete_record_secondary("box_text_content_config", $_REQUEST["id"], "id");
}

$qry = "SELECT * FROM box_type_master";
$box_types = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$box_type = mysqli_fetch_assoc($box_types);

$qry = "SELECT * FROM boxes_text_content_type_master";
$text_content_types = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$text_content_type = mysqli_fetch_assoc($text_content_types);

$qry = "SELECT box_text_content_config.id, box_text_content_config.box_type_id, box_text_content_config.text_content_type_id, box_type_master.name as box_type_name,  boxes_text_content_type_master.name as content_type_name FROM box_text_content_config, box_type_master, boxes_text_content_type_master WHERE box_text_content_config.box_type_id = box_type_master.id AND box_text_content_config.text_content_type_id = boxes_text_content_type_master.id ";
$text_configs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$text_config = mysqli_fetch_assoc($text_configs);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Boxes Text Configuration</title>
</head>

<body bgcolor="#CACACA">

<table width="100%">
	<tr>
		<td><a href="tabs_master.php"> <span style="font-size:14px;"> Go Back to Tabs Page</a></span></td>
	</tr>
</table>

<table>
<tr>
<td width="50%">
<table width="100%" border=1>
	<tr>
		<td>Box Type</td>
		<td>Text Type</td>
		<td>Action</td>
	</tr>

	<?php 
	do { 
		echo "<tr><td>". $text_config["box_type_name"] ." </td>";
		echo "<td>". $text_config["content_type_name"] ." </td>";
		?>
		<td>
		<a href="boxes_text_config.php?deleteconfig=1&id=<?php echo $text_config["id"]; ?>">delete</a>
		</td>
		</tr>

	<?php } while ($text_config = mysqli_fetch_assoc($text_configs)); ?>
</table>
</td>

<td width="50%">
<form action="boxes_text_config.php" enctype="multipart/form-data" method="post" name="addbox">
<input type="hidden" value="1" name="addconfig" />

<table width="100%" border="0">
	<tr>
		<td align="right"><strong>Box Type:</strong></td>
		<td colspan="3">
			<select name="box_type_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $box_type["id"]; ?>">
				<?php echo $box_type["name"]; ?></option>
				<?php } while ($box_type = mysqli_fetch_assoc($box_types)); ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Text Type:</strong></td>
		<td colspan="3">
			<select name="text_content_type_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $text_content_type["id"]; ?>">
				<?php echo $text_content_type["name"]; ?></option>
				<?php } while ($text_content_type = mysqli_fetch_assoc($text_content_types)); ?>
			</select>
	</tr>
	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
			<input type="submit" value="Add Config" />
		</td>
	</tr>

</form>
</td>
</tr>
</table>

</body>
</html>
