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
	}

	if ($_REQUEST["box_id"])
	{
		$box_id = $_REQUEST["box_id"];
	}

	if ($_POST["box_id"])
	{
		$box_id = $_POST["box_id"];
	}

	if ($_REQUEST["content_id"])
	{
		$content_id = $_REQUEST["content_id"];
	}

	if ($_POST["content_id"])
	{
		$content_id = $_POST["content_id"];
		unset($_POST["content_id"]);
	}

	if ($_POST["addcontentinfo"]) 
	{	
		unset($_POST["addcontentinfo"]);
		$_POST["entered_by"] = $_SESSION["userid"];
		$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$content_id = add_record("boxes_digital_content", $_POST);
		$usermsg = "<font color='red'>New Content Added</font>";
	}

	if ($_POST["updatecontentinfo"]) 
	{	
		unset($_POST["updatecontentinfo"]);
		$_POST["updated_by"] = $_SESSION["userid"];
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$where = "id = ".$content_id;
		modify_record("boxes_digital_content", $_POST, $where);
		$usermsg = "<font color='red'>Content Updated</font>";
	}
	
	if ($_REQUEST["deletecontentinfo"])
	{
		delete_record_secondary("boxes_digital_content", $content_id, "id");
	}
} 

$qry = "SELECT * FROM home_page_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);

$qry = "SELECT * FROM boxes_digital_content_type_master";
$box_content_types = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$box_content_type = mysqli_fetch_assoc($box_content_types);

if  (($tab_id) && ($column_id))
{
	$qry = "SELECT * FROM boxes_digital_content where tab_id = ". $tab_id ." AND column_id = " . $column_id ." AND box_id = " . $box_id;
	$boxes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$box = mysqli_fetch_assoc($boxes);

	if ($_REQUEST["editcontentinfo"])
	{
		$qry = "SELECT * FROM boxes_digital_content where id = ". $content_id;
		$e_contents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$e_content = mysqli_fetch_assoc($e_contents);
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
		<td>Digital Type</td>
		<td>Ditital Content Link</td>
		<td>URL</td>
		<td>Action</td>
	</tr>

	<?php 
	do { 
		echo "<tr><td>". $box["digital_type_id"] ." </td>";
		echo "<td>". $box["digital_content_link"] ." </td>";
		echo "<td>". $box["url"] ." </td>";
		?>
		<td>
		<a href="boxes_digital_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
		<a href="boxes_digital_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a>
		</td>
	</tr>

	<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
</table>
</td>

<td width="50%">
<form action="boxes_digital_content.php" enctype="multipart/form-data" method="post" name="addbox">
<?php if ($content_id) { ?>
	<input type="hidden" value="<?php echo $content_id; ?>" name="content_id" />
	<input type="hidden" value="1" name="updatecontentinfo" />
<?php } else { ?>
	<input type="hidden" value="1" name="addcontentinfo" />
<?php } ?>

<input type="hidden" value="<?php echo $column_id; ?>" name="column_id" />
<input type="hidden" value="<?php echo $box_id; ?>" name="box_id" />
<input type="hidden" value="<?php echo $tab_id; ?>" name="tab_id" />

<table width="100%" border="0">
	<tr>
		<td align="right"><strong>Digital Type:</strong></td>
		<td colspan="3">
			<select name="digital_type_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $box_content_type["id"]; ?>"

				<?php
				if ( $box_content_type["id"] == $e_content["digital_type_id"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>

				<?php echo $box_content_type["name"]; ?></option>
				<?php } while ($box_content_type = mysqli_fetch_assoc($box_content_types)); ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Status:</strong></td>
		<td>
			<select name="status">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $status["id"]; ?>"
				<?php
				if ( $status["id"] == $e_content["status"] ) {
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
		<td align="right"><strong>Height:</strong></td>
		<td colspan="3"><input type="text" name="height" size="2" value="<?php echo $e_content["height"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Width:</strong></td>
		<td colspan="3"><input type="text" name="width" size="2" value="<?php echo $e_content["width"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Digital Content Link:</strong></td>
		<td colspan="3"><input type="text" name="digital_content_link" size="200" value="<?php echo $e_content["digital_content_link"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>URL:</strong></td>
		<td colspan="3"><input type="text" name="url" size="200" value="<?php echo $e_content["url"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Start Date:</strong></td>
		<td colspan="3"><input type="text" name="start_date" size="12" value="<?php echo $e_content["start_date"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>End Date:</strong></td>
		<td colspan="3"><input type="text" name="expiry_date" size="12" value="<?php echo $e_content["expiry_date"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
		<?php if ($content_id) { ?>
			<input type="submit" value="Update Content" />
			<input type="button" value="New Content" onClick="javascript:location.href='boxes_digital_content.php?new=1&column_id=<?php echo $column_id; ?>&tab_id=<?php echo $tab_id; ?>&box_id=<?php echo $box_id; ?>'" />
		<?php } else { ?>
			<input type="submit" value="Add Content" />
		<?php } ?></td>
</form>
</td>
</tr>
</table>

</body>
</html>
