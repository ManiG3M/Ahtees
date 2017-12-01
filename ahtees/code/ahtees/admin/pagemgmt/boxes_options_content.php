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
		$content_id = add_record("boxes_options_content", $_POST);
		$usermsg = "<font color='red'>New Content Added</font>";
	}

	if ($_POST["updatecontentinfo"]) 
	{	
		unset($_POST["updatecontentinfo"]);
		$_POST["updated_by"] = $_SESSION["userid"];
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$where = "id = ".$content_id;
		modify_record("boxes_options_content", $_POST, $where);
		$usermsg = "<font color='red'>Content Updated</font>";
	}
	
	if ($_REQUEST["deletecontentinfo"])
	{
		delete_record_secondary("boxes_options_content", $content_id, "id");
	}
} 

$qry = "SELECT * FROM home_page_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);

if  (($tab_id) && ($column_id) && ($box_id))
{
	$qry = "SELECT box_type_id FROM boxes_master WHERE id  = ". $box_id;
	$box_types = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$box_type = mysqli_fetch_assoc($box_types);
	$box_type_id = $box_type["box_type_id"];

	$qry = "SELECT * FROM boxes_options_content where tab_id = ". $tab_id ." AND column_id = " . $column_id ." AND box_id = " . $box_id;
	$boxes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$box = mysqli_fetch_assoc($boxes);

	if ($_REQUEST["editcontentinfo"])
	{
		$qry = "SELECT * FROM boxes_options_content where id = ". $content_id;
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
<?php 
	$qry = "SELECT name FROM boxes_master where id = ". $box_id;
	$xboxes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$xbox = mysqli_fetch_assoc($xboxes);
?>

<body bgcolor="#CACACA">
<h1>Manage Box Content For <?php echo $tab["name"]; ?>/<?php echo $column["name"]; ?>/<?php echo $xbox["name"]; ?> </h1>
<table width="100%">
	<tr>
		<td><a href="tabs_master.php"> <span style="font-size:14px;"> Go Back to <B><?php echo $tab["name"]; ?></b> Tab</a></span>
		&nbsp;/&nbsp;
		<a href="tabs_columns.php?tab_id=<?php echo $tab_id; ?>"> <span style="font-size:14px;"> Go Back to <b><?php echo $column["name"]; ?></b> column</a></span>
		&nbsp;/&nbsp;
		<a href="boxes_master.php?column_id=<?php echo $column_id; ?>&tab_id=<?php echo $tab_id; ?>"> <span style="font-size:14px;"> Go Back to <b><?php echo $xbox["name"]; ?></b> Box</a></span></td>
	</tr>
</table>

<table border=1>
<tr valign="top">
<td width="50%">
<table width="100%" border=1>
	<?php if ($box_type_id == 1 ) 
	{ ?>
		<tr>
			<td><strong>Digital Storage URL:</strong></td>
			<td><strong>Digital Link:</strong></td>
			<td ><strong>Digital Height:</strong></td>
			<td ><strong>Digital Width:</strong></td>
			<td ><strong>Digital Layover Text:</strong></td>
			<td ><strong>Digital Display Time:</strong></td>
			<td ><strong>Side Text:</strong></td>
			<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
			<td ><?php echo $box["digital_storage_url"]; ?></td>
			<td ><?php echo $box["digital_link"]; ?></td>
			<td ><?php echo $box["digital_height"]; ?></td>
			<td ><?php echo $box["digital_width"]; ?></td>
			<td ><?php echo $box["digital_layover_text"]; ?></td>
			<td ><?php echo $box["digital_display_time"]; ?></td>
			<td ><?php echo $box["side_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>

	<?php } ?>

	<?php if ($box_type_id == 2 )
	{ ?>
		<tr>
		<td ><strong>Short Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
			<td><?php echo $box["short_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if ($box_type_id == 3 )
	{ ?>
		<tr>
		<td ><strong>Detailed Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
			<td ><?php echo $box["detailed_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if ($box_type_id == 5 )
	{ ?>
		<tr>
		<td ><strong>HTML Code:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
		<td ><?php echo $box["detailed_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if ($box_type_id == 6 )
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><strong>Digital Link:</strong></td>
		<td ><strong>Digital Height:</strong></td>
		<td ><strong>Digital Width:</strong></td>
		<td ><strong>Detailed Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
		<td ><?php echo $box["digital_storage_url"]; ?></td>
		<td ><?php echo $box["digital_link"]; ?></td>
		<td ><?php echo $box["digital_height"]; ?> </td>
		<td ><?php echo $box["digital_width"]; ?> </td>
		<td ><?php echo $box["detailed_text"]; ?></td>
		<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
		<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if ($box_type_id == 7 ) 
	{ ?>
		<tr>
		<td ><strong>News Heading :</strong></td>
		<td ><strong>News Subtitle:</strong></td>
		<td ><strong>Detailed Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
			<tr>
			<td ><?php echo $box["news_heading"]; ?></td>
			<td ><?php echo $box["news_subtitle_text"]; ?></td>
			<td ><?php echo $box["detailed_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a> <a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td> 
			</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if (($box_type_id == 8 ) || ($box_type_id == 14 )  || ($box_type_id == 15 ))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><strong>Digital Link:</strong></td>
		<td ><strong>Digital Height:</strong></td>
		<td ><strong>Digital Width:</strong></td>
		<td ><strong>Top Text:</strong></td>
		<td ><strong>Bottom Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
		<td ><?php echo $box["digital_storage_url"]; ?></td>
		<td ><?php echo $box["digital_link"]; ?></td>
		<td ><?php echo $box["digital_height"]; ?></td>
		<td ><?php echo $box["digital_width"]; ?></td>
		<td ><?php echo $box["top_text"]; ?></td>
		<td ><?php echo $box["top_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>

	<?php } ?>

	<?php if ($box_type_id == 9 ) 
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><strong>Digital Link:</strong></td>
		<td ><strong>Digital Height:</strong></td>
		<td ><strong>Digital Width:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
		<td ><?php echo $box["digital_storage_url"]; ?></td>
		<td ><?php echo $box["digital_link"]; ?></td>
		<td ><?php echo $box["digital_height"]; ?></td>
		<td ><?php echo $box["digital_width"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>
	<?php } ?>

	<?php if (($box_type_id == 10 )  || ($box_type_id == 11 ))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td>Action</td>
		</tr>

		<tr>
		<td ><?php echo $box["digital_storage_url"]; ?></td>
		</tr>
	<?php } ?>

	<?php if (($box_type_id == 12 )  || ($box_type_id == 13))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><strong>Digital Link:</strong></td>
		<td ><strong>Digital Height:</strong></td>
		<td ><strong>Digital Width:</strong></td>
		<td ><strong>Bottom Text:</strong></td>
		<td>Action</td>
		</tr>

		<?php do {  ?>
		<tr>
		<td ><?php echo $box["digital_storage_url"]; ?></td>
		<td ><?php echo $box["digital_link"]; ?></td>
		<td ><?php echo $box["digital_height"]; ?></td>
		<td ><?php echo $box["digital_width"]; ?></td>
		<td ><?php echo $box["top_text"]; ?></td>
			<td><a href="boxes_options_content.php?editcontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">edit</a>
			<a href="boxes_options_content.php?deletecontentinfo=1&tab_id=<?php echo $tab_id; ?>&column_id=<?php echo $column_id; ?>&box_id=<?php echo $box_id; ?>&content_id=<?php echo $box["id"]; ?>">delete</a></td>
		</tr>
		<?php } while ($box = mysqli_fetch_assoc($boxes)); ?>

	<?php } ?>

</table>
</td>

<td width="50%">
<form action="boxes_options_content.php" enctype="multipart/form-data" method="post" name="addbox">
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

	<?php if ($box_type_id == 1 ) 
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Link:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_link"><?php echo $e_content["digital_link"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Height:</strong></td>
		<td ><input type="text" name="digital_height" size="12" value="<?php echo $e_content["digital_height"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Width:</strong></td>
		<td ><input type="text" name="digital_width" size="12" value="<?php echo $e_content["digital_width"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Layover Text:</strong></td>
		<td ><textarea cols="70" rows="4" name="digital_layover_text"><?php echo $e_content["digital_layover_text"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Display Time:</strong></td>
		<td ><input type="text" name="digital_display_time" size="12" value="<?php echo $e_content["digital_display_time"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Side Text:</strong></td>
		<td ><textarea cols="70" rows="3" name="side_text"><?php echo $e_content["side_text"]; ?></textarea></td>
		</tr>

	<?php } ?>

	<?php if ($box_type_id == 2 )
	{ ?>
		<tr>
		<td ><strong>Short Text:</strong></td>
		<td ><textarea cols="70" rows="2" name="short_text"><?php echo $e_content["short_text"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if ($box_type_id == 3 )
	{ ?>
		<tr>
		<td ><strong>Detailed Text:</strong></td>
		<td ><textarea cols="70" rows="6" name="detailed_text"><?php echo $e_content["detailed_text"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if ($box_type_id == 5 )
	{ ?>
		<tr>
		<td ><strong>HTML Code:</strong></td>
		<td ><textarea cols="70" rows="6" name="detailed_text"><?php echo $e_content["detailed_text"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if ($box_type_id == 6 )
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="3" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Link:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_link"><?php echo $e_content["digital_link"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Height:</strong></td>
		<td ><input type="text" name="digital_height" size="12" value="<?php echo $e_content["digital_height"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Width:</strong></td>
		<td ><input type="text" name="digital_width" size="12" value="<?php echo $e_content["digital_width"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Detailed Text:</strong></td>
		<td ><textarea cols="70" rows="6" name="detailed_text"><?php echo $e_content["detailed_text"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if ($box_type_id == 7 ) 
	{ ?>
		<tr>
		<td ><strong>News Heading :</strong></td>
		<td ><input type="text" name="news_heading" size="70" value="<?php echo $e_content["news_heading"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>News Subtitle:</strong></td>
		<td ><input type="text" name="news_subtitle_text" size="70" value="<?php echo $e_content["news_subtitle_text"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Detailed Text:</strong></td>
		<td ><textarea cols="70" rows="6" name="detailed_text"><?php echo $e_content["detailed_text"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if (($box_type_id == 8 ) || ($box_type_id == 14 )  || ($box_type_id == 15 ))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Link:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_link"><?php echo $e_content["digital_link"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Height:</strong></td>
		<td ><input type="text" name="digital_height" size="12" value="<?php echo $e_content["digital_height"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Width:</strong></td>
		<td ><input type="text" name="digital_width" size="12" value="<?php echo $e_content["digital_width"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Top Text:</strong></td>
		<td ><textarea cols="70" rows="5" name="top_text"><?php echo $e_content["top_text"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Bottom Text:</strong></td>
		<td ><textarea cols="70" rows="5" name="bottom_text"><?php echo $e_content["top_text"]; ?></textarea></td>
		</tr>

	<?php } ?>

	<?php if ($box_type_id == 9 ) 
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Link:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_link"><?php echo $e_content["digital_link"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Height:</strong></td>
		<td ><input type="text" name="digital_height" size="12" value="<?php echo $e_content["digital_height"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Width:</strong></td>
		<td ><input type="text" name="digital_width" size="12" value="<?php echo $e_content["digital_width"]; ?>" /></td>
		</tr>
	<?php } ?>

	<?php if (($box_type_id == 10 )  || ($box_type_id == 11 ))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>
	<?php } ?>

	<?php if (($box_type_id == 12 )  || ($box_type_id == 13))
	{ ?>
		<tr>
		<td ><strong>Digital Storage URL:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_storage_url"><?php echo $e_content["digital_storage_url"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Link:</strong></td>
		<td ><textarea cols="70" rows="2" name="digital_link"><?php echo $e_content["digital_link"]; ?></textarea></td>
		</tr>

		<tr>
		<td ><strong>Digital Height:</strong></td>
		<td ><input type="text" name="digital_height" size="12" value="<?php echo $e_content["digital_height"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Digital Width:</strong></td>
		<td ><input type="text" name="digital_width" size="12" value="<?php echo $e_content["digital_width"]; ?>" /></td>
		</tr>

		<tr>
		<td ><strong>Bottom Text:</strong></td>
		<td ><textarea cols="70" rows="5" name="bottom_text"><?php echo $e_content["top_text"]; ?></textarea></td>
		</tr>

	<?php } ?>

	<tr>
		<td ><strong>Keywords:</strong></td>
		<td ><textarea cols="70" rows="4" name="keywords"><?php echo $e_content["keywords"]; ?></textarea></td>
	</tr>

	<tr>
		<td ><strong>Outside Text:</strong></td>
		<td ><input type="text" name="outside_text" size="50" value="<?php echo $e_content["outside_text"]; ?>" /></td>
	</tr>

	<tr>
		<td ><strong>Start Date:</strong></td>
		<td ><input type="text" name="start_date" size="12" value="<?php echo $e_content["start_date"]; ?>" /></td>
	</tr>

	<tr>
		<td ><strong>End Date:</strong></td>
		<td ><input type="text" name="expiry_date" size="12" value="<?php echo $e_content["expiry_date"]; ?>" /></td>
	</tr>

	<tr>
		<td ><strong>Status:</strong></td>
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
		<td  valign="top">&nbsp;</td>
		<td >
		<?php if ($content_id) { ?>
			<input type="submit" value="Update Content" />
			<input type="button" value="New Content" onClick="javascript:location.href='boxes_options_content.php?new=1&column_id=<?php echo $column_id; ?>&tab_id=<?php echo $tab_id; ?>&box_id=<?php echo $box_id; ?>'" />
		<?php } else { ?>
			<input type="submit" value="Add Content" />
		<?php } ?></td>
</form>
</td>
</tr>
</table>

</body>
</html>
