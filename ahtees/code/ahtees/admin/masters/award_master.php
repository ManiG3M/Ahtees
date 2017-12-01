<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_POST)
{
	$data["description"] = $_POST["description"];
	$data["initiated_by"] = $_POST["initiated_by"];
	$data["initiated_date"] = date('Y-m-d H:i:s', strtotime($_POST["initiated_date"]));
	$data["purpose"] = $_POST["purpose"];
	
	add_record("award_master", $data);
}

if (isset($_REQUEST["deleteaward"]))
{
	delete_record_secondary("award_master", $_REQUEST["deleteaward"], "id");
}

$qry = "SELECT * FROM award_master order by description";
$awards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$award = mysqli_fetch_assoc($awards);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Customer Status Master</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../../calendar/calendar-setup.js"></script>


<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CCCCCC">
<form name="addaward" enctype="multipart/form-data" method="post">
<table align="center">
	<tr>
		<td><strong>Description:</strong></td>
		<td><input type="text" name="description" /></td>
		<td><strong>Initiated By:</strong></td>
		<td><input type="text" name="initiated_by" /></td>
	</tr>
	<tr>
		<td><strong>Initiated Date:</strong></td>
		<td><input id="initiated_date" name="initiated_date" class="text" type="text" size="10"/>&nbsp;<img src="../../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" onMouseOut="this.style.background=''"; /><br /></td>
		<td><strong>Purpose:</strong></td>
		<td><input type="text" name="purpose" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3"><input type="submit" value="Add" /></td>
	</tr>
</table>
</form>
<div style="overflow:auto; height:292px; width:498px; border:1px solid gray;"> 
<table width="93%">
	<tr bgcolor="#999999">
		<td align="center" width=""><strong>Description</strong></td>
		<td align="center" width=""><strong>Initiated By</strong></td>
		<td align="center" width=""><strong>Date</strong></td>
		<td align="center" width=""><strong>Purpose</strong></td>
		<td align="center"><strong>Action</strong></td>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $award["description"]; ?></td>
		<td><?php echo $award["initiated_by"]; ?></td>
		<td><?php echo $award["initiated_date"]; ?></td>
		<td><?php echo $award["purpose"]; ?></td>
		<td><a href="award_master_edit.php?id=<?php echo $award["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="award_master.php?deleteaward=<?php echo $award["id"]; ?>">delete</a></td>
	</tr>
	<?php } while ($award = mysqli_fetch_assoc($awards)); ?>
</table>
</div>

</body>
</html>
<script type="text/javascript">
	Calendar.setup({
	inputField     :    "initiated_date",     // id of the input field
	ifFormat       :    "%m/%d/%Y",      // format of the input field
	button         :    "f_trigger_date",  // trigger for the calendar (button ID)
	align          :    "Bl",           // alignment (defaults to "Bl")
	singleClick    :    true
	});
</script>
