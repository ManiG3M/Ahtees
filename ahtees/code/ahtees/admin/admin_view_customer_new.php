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

if (isset($_REQUEST["clearsearch"]))
{
	$_POST["castsearch"] = "";
}

if (isset($_REQUEST["disableid"]))
{
	$data["status"] = 0;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "customer_id = ".$_REQUEST["disableid"];
	modify_record("customer_master", $data, $where);
}

if (isset($_REQUEST["enableid"]))
{
	$data["status"] = 1;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "customer_id = ".$_REQUEST["enableid"];
	modify_record("customer_master", $data, $where);
}

if (isset($_REQUEST["displaydisabled"]))
{
	$qry = "SELECT customer_master.*, movie_industry_master.description as industry_name from customer_master, movie_industry_master  WHERE customer_master.status = 0 and movie_industry_master.id = customer_master.primary_industry_id";  
}
else
{
	if (isset($_POST["castsearch"]))
	{
		$qry = "SELECT customer_master.*, movie_industry_master.description as industry_name FROM customer_master LEFT JOIN movie_industry_master ON (customer_master.primary_industry_id = movie_industry_master.id) WHERE (customer_master.first_name LIKE '%".$_POST["castsearch"]."%' OR customer_master.last_name LIKE '%".$_POST["castsearch"]."%' OR customer_master.star_name LIKE '%".$_POST["castsearch"]."%')";

	} 
	else 
	{
		if (isset($_REQUEST["custid"]))
		{
			$qry = "SELECT customer_master.*, movie_industry_master.description as industry_name FROM customer_master LEFT JOIN movie_industry_master ON (customer_master.primary_industry_id = movie_industry_master.id) WHERE customer_master.customer_id = " . $_REQUEST["custid"];
		}	
		else
		{	
			$qry = "SELECT customer_master.*, movie_industry_master.description as industry_name FROM customer_master, movie_industry_master WHERE movie_industry_master.id = customer_master.primary_industry_id ORDER BY customer_master.star_name LIMIT 10";
		}
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
<a href="admin.php"><span style="font-size:14px;">Go Back to Home Page</a></span>
<p>&nbsp;</p>
<form action="admin_view_customer_new.php" method="post" enctype="multipart/form-data" name="searchcast">
<?php if(isset($_POST["castsearch"])) {?>
	<input type="text" name="castsearch" size="30" value="<?php echo $_POST["castsearch"]; ?>"/>&nbsp;&nbsp;
<?php } else {?>
	<input type="text" name="castsearch" size="30" value=""/>&nbsp;&nbsp;
<?php }?>

<input type="submit" value="Find Cast" />&nbsp;&nbsp;
<input type="button" value="Display Disabled Cast" onClick="javascript:location.href='admin_view_customer_new.php?displaydisabled=1';" />
</form>
<hr />
<table width="100%">
	<tr bgcolor="#999999">
		<td>First Name</td>
		<td>Last Name</td>
		<td>Star Name</td>
		<td>Industry</td>
		<td>Star Title</td>
		<td>Action</td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $customer["first_name"]; ?></td>
		<td><?php echo $customer["last_name"]; ?></td>
		<td><?php echo $customer["star_name"]; ?></td>
		<td><?php echo $customer["industry_name"]; ?></td>
		<td><?php echo $customer["star_title"]; ?></td>
		<td <?php if (!$customer["status"]) { ?>bgcolor="orange"<?php } ?>><a href="admin_add_customer.php?custid=<?php echo $customer["customer_id"]; ?>">view/edit</a>&nbsp;&nbsp;</td>
		<?php $display_name="Actor Name:" . $customer["star_name"] ."(". $customer["first_name"] ." ". $customer["last_name"] .")"; ?>
		<td><a href="customer/attributes_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Attributes</a></td>
		<td><a href="customer/awards_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Awards</a></td>
		<td><a href="digital_content_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Digital Content</a></td>
		<td><a href="customer/text_content_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Text Content</a></td>
		<td><a href="customer/degree_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Degree</a></td>
		<td><a href="customer/favorite_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Favorites</a></td>
		<td><a href="customer/language_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Language</a></td>
		<td><a href="customer/relation_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Relations</a></td>
		<td><a href="customer/talents_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Talents</a></td>
		<td><a href="customer/special_interest_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Spc. Interest</a></td>
		<td><a href="customer/sports_interest_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Sports</a></td>
		<td> <?php if ($customer["status"]) { ?>
				<a href="admin_view_customer_new.php?disableid=<?php echo $customer["customer_id"]; ?>">disable</a></td>
			<?php } else { ?>
				<a href="admin_view_customer_new.php?enableid=<?php echo $customer["customer_id"]; ?>">enable</a></td>
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
