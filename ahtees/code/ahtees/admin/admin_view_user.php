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
	delete_record_secondary("user_master", $_REQUEST["deleteid"], "id");
}

$qry = "SELECT * FROM user_master";
$users = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$user = mysqli_fetch_assoc($users);
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
<p>&nbsp;</p>
<h3>View Users</h3>
<hr />
<form action="admin_add_user.php" enctype="multipart/form-data" method="post" name="adduser">
<table width="100%" border="0">
<input type="hidden" name="adduserinfo" value="1">
<table width="100%" frame="box" border="0">
	<tr bgcolor="#999999">
		<td><strong>User Name</strong></td>
		<td><strong>Password</strong></td>
		<td><strong>Email</strong></td>
		<td><strong>Level</strong></td>
		<td><strong>Action</strong></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $user["username"]; ?></td>
		<td><?php echo $user["password"]; ?></td>
		<td><?php echo $user["email"]; ?></td>
		<td><?php echo $user["level"]; ?></td>
		<td><a href="admin_edit_user.php?userid=<?php echo $user["id"]; ?>" title="View Users" rel="gb_page_center[500, 400]">edit</a>&nbsp;&nbsp;<a href="admin_view_user.php?deleteid=<?php echo $user["id"]; ?>">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#D8D8D8";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($user = mysqli_fetch_assoc($users)); ?>
</table>
</form>
<hr />
</body>
</html>
