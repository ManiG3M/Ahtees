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

if ($_REQUEST["clearsearch"])
{
	$_POST["castsearch"] = "";
}

if ($_REQUEST["disableid"])
{
	$data["status"] = 0;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "customer_id = ".$_REQUEST["disableid"];
	modify_record("customer_master", $data, $where);
	
}

if ($_REQUEST["enableid"])
{
	$data["status"] = 1;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "customer_id = ".$_REQUEST["enableid"];
	modify_record("customer_master", $data, $where);
	
}
if ($_REQUEST["displaydisabled"])
{
	$qry = "SELECT * from customer_master WHERE status = 0";  
}
else
{
	$qry = "SELECT * FROM customer_master";
	if ($_POST["castsearch"])
	{
		$qry.= " WHERE first_name LIKE '%".$_POST["castsearch"]."%' OR last_name LIKE '%".$_POST["castsearch"]."%' OR star_name LIKE '%".$_POST["castsearch"]."%'";
	} else {
		$qry.= " ORDER BY star_name LIMIT 10";
	}
}

$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

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
<link rel="stylesheet" type="text/css" href="../tabs/tabcontent.css" />

<script type="text/javascript" src="../tabs/tabcontent.js"></script>


</head>

<body bgcolor="#CACACA">
<p>&nbsp;</p>
<form action="admin_view_customer.php" method="post" enctype="multipart/form-data" name="searchcast">
<input type="text" name="castsearch" size="30" value="<?php echo $_POST["castsearch"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Find Cast" />&nbsp;&nbsp;
<input type="button" value="Display Disabled Cast" onClick="javascript:location.href='admin_view_customer.php?displaydisabled=1';" />
</form>
<hr />
<table width="100%">
	<tr bgcolor="#999999">
		<td>First Name</td>
		<td>Middle Name</td>
		<td>Last Name</td>
		<td>Star Name</td>
		<td>Star Title</td>
		<td>Action</td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $customer["first_name"]; ?></td>
		<td><?php echo $customer["middle_name"]; ?></td>
		<td><?php echo $customer["last_name"]; ?></td>
		<td><?php echo $customer["star_name"]; ?></td>
		<td><?php echo $customer["star_title"]; ?></td>
		<td <?php if (!$customer["status"]) { ?>bgcolor="orange"<?php } ?>><a href="admin_add_customer.php?custid=<?php echo $customer["customer_id"]; ?>">view/edit</a>&nbsp;&nbsp;<?php if ($customer["status"]) { ?>
				<a href="admin_view_customer.php?disableid=<?php echo $customer["customer_id"]; ?>">disable</a></td>
			<?php } else { ?>
				<a href="admin_view_customer.php?enableid=<?php echo $customer["customer_id"]; ?>">enable</a></td>
			<?php } ?>
	</tr>
	<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
	
	<?php
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#CCCCCC";
	} else {
		$bgcolor = "WHITE";
	}
	?>
</table>

</body>
</html>
