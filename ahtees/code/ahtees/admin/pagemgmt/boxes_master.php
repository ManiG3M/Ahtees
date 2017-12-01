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
		unset($_POST["box_id"]);
	}

	if ($_POST["addboxinfo"]) 
	{	
		unset($_POST["addboxinfo"]);
		$_POST["entered_by"] = $_SESSION["userid"];
		$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$box_id = add_record("boxes_master", $_POST);
		$usermsg = "<font color='red'>New Box Added</font>";
	}

	if ($_POST["updateboxinfo"]) 
	{	
		unset($_POST["updateboxinfo"]);
		$_POST["updated_by"] = $_SESSION["userid"];
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$where = "id = ".$box_id;
		modify_record("boxes_master", $_POST, $where);
		$usermsg = "<font color='red'>Box Updated</font>";
	}
	
	if ($_REQUEST["deleteboxinfo"])
	{
		delete_record_secondary("boxes_master", $box_id, "id");
	}
} 

$qry = "SELECT * FROM home_page_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);

$qry = "SELECT * FROM box_type_master";
$box_types = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$box_type = mysqli_fetch_assoc($box_types);

if  (($tab_id) && ($column_id))
{
	$qry = "SELECT boxes_master.*, box_type_master.name as box_type_name  FROM boxes_master, box_type_master where boxes_master.tab_id = ". $tab_id ." AND boxes_master.column_id = " . $column_id ." AND boxes_master.box_type_id = box_type_master.id";
	$boxes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$box = mysqli_fetch_assoc($boxes);

	if ($_REQUEST["editboxinfo"])
	{
		$qry = "SELECT * FROM boxes_master where id = ". $box_id;
		$e_boxes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$e_box = mysqli_fetch_assoc($e_boxes);
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
<?php 
	$qry = "SELECT name FROM tab_columns where id = ". $column_id;
	$columns = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$column = mysqli_fetch_assoc($columns);
?>

<body bgcolor="#CACACA">
<h1>Manage Boxes For -> <?php echo $tab["name"]; ?>/<?php echo $column["name"]; ?></h1>
<table valign="top" width="100%">
	<tr>
		<td><a href="tabs_master.php"> <span style="font-size:14px;"> Go Back to <B><?php echo $tab["name"]; ?></b> Tab</a></span>
		&nbsp;/&nbsp;
		<a href="tabs_columns.php?tab_id=<?php echo $tab_id; ?>"> <span style="font-size:14px;"> Go Back to <b><?php echo $column["name"]; ?></b> column</a></span></td>
	</tr>
</table>

<table border=1>
<tr valign="top">
<td width="50%">
<table valign="top" width="100%" border=1>
	<tr>
		<td>Name</td>
		<td>Type</td>
		<td>Height</td>
		<td>Width</td>
		<td># options</td>
		<td>order</td>
		<td>Title</td>
		<td>Action</td>
		<td>Box Content</td>
	</tr>

	<?php 
	do { 
		echo "<tr><td>". $box["name"] ." </td>";
		echo "<td>". $box["box_type_name"] ." </td>";
		echo "<td>". $box["height"] ." </td>";
		echo "<td>". $box["weight"] ." </td>";
		echo "<td>". $box["no_of_options"] ." </td>";
		echo "<td>". $box["box_order"] ." </td>";
		echo "<td>". $box["title_text"] ." </td>";
		?>
		<td>
		<a href="boxes_master.php?editboxinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box["id"]; ?>">edit</a>
		<a href="boxes_master.php?deleteboxinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box["id"]; ?>">delete</a>
		</td>
		<td>
		<a href="boxes_options_content.php?tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box["id"]; ?>">Box Contents</a>
		</td>
	</tr>

	<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
</table>
</td>

<td width="50%">
<form action="boxes_master.php" enctype="multipart/form-data" method="post" name="addbox">
<?php if ($box_id) { ?>
	<input type="hidden" value="<?php echo $box_id; ?>" name="box_id" />
	<input type="hidden" value="1" name="updateboxinfo" />
<?php } else { ?>
	<input type="hidden" value="1" name="addboxinfo" />
<?php } ?>

<input type="hidden" value="<?php echo $column_id; ?>" name="column_id" />
<input type="hidden" value="<?php echo $tab_id; ?>" name="tab_id" />

<table width="100%" border="0">
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<td colspan="3"><input type="text" name="name" size="65" value="<?php echo $e_box["name"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Box Type:</strong></td>
		<td colspan="3">
			<select name="box_type_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $box_type["id"]; ?>"

				<?php
				if ( $box_type["id"] == $e_box["box_type_id"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>

				<?php echo $box_type["name"]; ?></option>
				<?php } while ($box_type = mysqli_fetch_assoc($box_types)); ?>
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
				if ( $status["id"] == $e_box["status"] ) {
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
		<td align="right"><strong>Title Needed:</strong></td>
		<td>
			<select name="no_title">
				<option value="0">Select One...</option>
				<option value="1"
					<?php if ($e_box["no_title"] == 1 ) { echo " selected>"; } else { echo ">"; } ?>
					<?php echo "Yes"; ?>
				</option>
				<option value="2"
					<?php if ($e_box["no_title"] == 2 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "No"; ?>
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Rolling Title:</strong></td>
		<td>
			<select name="rolling_title">
				<option value="0">Select One...</option>
				<option value="1"
					<?php if ($e_box["rolling_title"] == 1 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "Yes"; ?>
				</option>
				<option value="2"
					<?php if ($e_box["rolling_title"] == 2 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "No"; ?>
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Blinking Title:</strong></td>
		<td>
			<select name="blinking_title">
				<option value="0">Select One...</option>
				<option value="1"
					<?php if ($e_box["blinking_title"] == 1 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "Yes"; ?>
				</option>
				<option value="2"
					<?php if ($e_box["blinking_title"] == 2 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "No"; ?>
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Title:</strong></td>
		<td colspan="3"><input type="text" name="title_text" size="65" value="<?php echo $e_box["title_text"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Title Font:</strong></td>
		<td colspan="3"><input type="text" name="title_font" size="65" value="<?php echo $e_box["title_font"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Title Font Size:</strong></td>
		<td colspan="3"><input type="text" name="title_font_size" size="5" value="<?php echo $e_box["title_font_size"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Title Image:</strong></td>
		<td colspan="3"><input type="text" name="title_image" size="65" value="<?php echo $e_box["title_image"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Border Required:</strong></td>
		<td>
			<select name="border_flag">
				<option value="0">Select One...</option>
				<option value="1"
					<?php if ($e_box["border_flag"] == 1 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "Yes"; ?>
				</option>
				<option value="2"
					<?php if ($e_box["border_flag"] == 2 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "No"; ?>
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Border color:</strong></td>
		<td colspan="3"><input type="text" name="box_border_color" size="65" value="<?php echo $e_box["box_border_color"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Rounded Corners:</strong></td>
		<td>
			<select name="rounded_corners">
				<option value="0">Select One...</option>
				<option value="1"
					<?php if ($e_box["rounded_corners"] == 1 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "Yes"; ?>
				</option>
				<option value="2"
					<?php if ($e_box["rounded_corners"] == 2 ) { echo " selected>"; }  else { echo ">"; }?>
					<?php echo "No"; ?>
				</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong># of Options:</strong></td>
		<td colspan="3"><input type="text" name="no_of_options" size="2" value="<?php echo $e_box["no_of_options"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Box Order:</strong></td>
		<td colspan="3"><input type="text" name="box_order" size="2" value="<?php echo $e_box["box_order"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Box Start Date:</strong><img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
		<td colspan="3"><input type="text" name="box_start_date" size="12" value="<?php echo $e_box["box_start_date"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Box End Date:</strong></td>
		<td colspan="3"><input type="text" name="box_end_date" size="12" value="<?php echo $e_box["box_end_date"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Height:</strong></td>
		<td colspan="3"><input type="text" name="box_height" size="5" value="<?php echo $e_box["box_height"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right"><strong>Width:</strong></td>
		<td colspan="3"><input type="text" name="box_width" size="5" value="<?php echo $e_box["box_width"]; ?>" /></td>
	</tr>

	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
		<?php if ($box_id) { ?>
			<input type="submit" value="Update Box" />
			<input type="button" value="New Box" onClick="javascript:location.href='boxes_master.php?new=1&column_id=<?php echo $column_id; ?>&tab_id=<?php echo $tab_id; ?>'" />
		<?php } else { ?>
			<input type="submit" value="Add Box" />
		<?php } ?></td>
</form>
</td>
</tr>
</table>

</body>
</html>

<script type="text/javascript">
	Calendar.setup({
	inputField     :    "box_start_date",     // id of the input field
	ifFormat       :    "%m/%d/%Y",      // format of the input field
	button         :    "f_trigger_date",  // trigger for the calendar (button ID)
	align          :    "Bl",           // alignment (defaults to "Bl")
	singleClick    :    true
	});
</script>
