<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');
//if (!$_SESSION["userid"])
//{
	//header("location: login.php");
//}

if (isset($_POST["adduserinfo"])) 
{
	unset($_POST["adduserinfo"]);
	$where = "id = ".$_POST["userid"];
	unset($_POST["userid"]);
	modify_record("user_master", $_POST, $where);
	$usermsg = "<font color='red'>User Updated</font>";
}

$qry = "SELECT * FROM user_master WHERE id =".$_REQUEST["userid"];
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

<script language="javascript">
	window.parent.reloadIt();
</script>
</head>

<body bgcolor="#CACACA">
<p>&nbsp;</p>
<h3>Edit User</h3>
<hr />
<form action="admin_edit_user.php" enctype="multipart/form-data" method="post" name="adduser">
<input type="hidden" name="adduserinfo" value="1">
<input type="hidden" name="userid" value="<?php echo $user["id"]; ?>">
<table width="100%" frame="box" border="0">
	<?php if (isset($usermsg)) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $usermsg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>User Name:</strong></td>
		<td><input type="text" name="username" value="<?php echo $user["username"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Password:</strong></td>
		<td><input type="text" name="password" value="<?php echo $user["password"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type="text" name="email" value="<?php echo $user["email"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Level:</strong></td>
		<td>
		<select name="level">
			<option value="0">Select One...</option>
			<option value="1" <?php if ($user["level"] == 1) {?>selected<?php } ?>>Level 1 - Basic Admin</option>
			<option value="2" <?php if ($user["level"] == 2) {?>selected<?php } ?>>Level 2 - Super Admin</option>
		</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Update User" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
