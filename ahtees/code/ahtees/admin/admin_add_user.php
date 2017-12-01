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

if (isset($_POST["adduserinfo"])) 
{
	unset($_POST["adduserinfo"]);
	add_record("user_master", $_POST);
	$usermsg = "<font color='red'>New User Added</font>";
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
</head>

<body bgcolor="#CACACA">
<p>&nbsp;</p>
<h3>Add User</h3>
<hr />
<form action="admin_add_user.php" enctype="multipart/form-data" method="post" name="adduser">
<input type="hidden" name="adduserinfo" value="1">
<table width="100%" frame="box" border="0">
	<?php if (isset($usermsg)) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $usermsg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>User Name:</strong></td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Password:</strong></td>
		<td><input type="text" name="password" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type="text" name="email" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Level:</strong></td>
		<td>
		<select name="level">
			<option value="0">Select One...</option>
			<option value="1">Level 1 - Basic Admin</option>
			<option value="2">Level 2 - Super Admin</option>
		</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Add New User" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
