<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');
if (!$_SESSION["userid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if (isset($_REQUEST["deleteid"]))
{
	delete_record_secondary("studio_master", $_REQUEST["deleteid"], "id");
}	

$qry = "SELECT studio_master.*, country_master.name as country_name, state_master.name as state_name FROM studio_master, country_master, state_master where country_master.id = studio_master.country and state_master.id = state order by name";
$studios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$studio = mysqli_fetch_assoc($studios);
	

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

<script language="javascript">
function reloadIt()
{
	window.location = "admin_view_user.php";
}
</script>
</head>

<body bgcolor="#CACACA">
<a href="admin.php">Go Back to Home Page</a>
<p>&nbsp;</p>
<h3>View Studios</h3>
<hr />

<table width="100%" frame="box" border="0">
	<tr bgcolor="#999999">
		<td><strong>Name</strong></td>
		<td><strong>Description</strong></td>
		<td><strong>Address 1</strong></td>
		<td><strong>Address 2</strong></td>
		<td><strong>City</strong></td>
		<td><strong>State</strong></td>
		<td><strong>Country</strong></td>
		<td><strong>Email</strong></td>
		<td><strong>Phone 1</strong></td>
		<td><strong>Phone 2</strong></td>									
		<td><strong>Phone 3</strong></td>
		<td><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $studio["name"]; ?></td>
		<td><?php echo $studio["description"]; ?></td>
		<td><?php echo $studio["address_line_1"]; ?></td>
		<td><?php echo $studio["address_line_2"]; ?></td>
		<td><?php echo $studio["city"]; ?></td>
		<td><?php echo $studio["state_name"]; ?></td>
		<td><?php echo $studio["country_name"]; ?></td>
		<td><?php echo $studio["email_address"]; ?></td>
		<td><?php echo $studio["contact_number_1"]; ?></td>
		<td><?php echo $studio["contact_number_2"]; ?></td>
		<td><?php echo $studio["contact_number_3"]; ?></td>
		<td><a href="admin_edit_studio.php?studioid=<?php echo $studio["id"]; ?>" title="Edit Studio" rel="gb_page_center[500, 550]">edit</a>&nbsp;&nbsp;<a href="admin_view_studio.php?deleteid=<?php echo $studio["id"]; ?>">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($studio = mysqli_fetch_assoc($studios)); ?>
</table>

<hr />
</body>
</html>
