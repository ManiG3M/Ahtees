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

$_SESSION["LOAD_ATTR_DATA"] = 0;

if (isset($_REQUEST["newattribute"]) || isset($_REQUEST["deleteattribute"]) || isset($_POST["modifyattribute"]) || isset($_POST["addattribute"]) || isset($_POST["loadattributes"]) || isset($_REQUEST["attributeid"] ))
{
	$_SESSION["LOAD_ATTR_DATA"] = 1;
}

if ($_POST || $_REQUEST)
{
	if (isset($_REQUEST["custid"]))
	{
		$_SESSION["custid"] = $_REQUEST["custid"];
		unset($_SESSION["cawardid"]);
		unset($_SESSION["clangid"]);
		unset($_SESSION["spintid"]);
		unset($_SESSION["spiid"]);
		unset($_SESSION["talentid"]);
	}

	if (isset($_REQUEST["new"]))
	{	
		unset($_SESSION["custid"]);
		unset($_SESSION["cawardid"]);
		unset($_SESSION["clangid"]);
		unset($_SESSION["spintid"]);
		unset($_SESSION["spiid"]);
		unset($_SESSION["talentid"]);
	}

	if (isset($_POST["addcustomerinfo"])) 
	{
		unset($_POST["addcustomerinfo"]);
		$_POST["date_of_birth"] = date('Y-m-d H:i:s', strtotime($_POST["date_of_birth"]));
		$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
                $_POST["entered_by"] = $_SESSION["userid"];
		$_SESSION["custid"] = add_record("customer_master", $_POST);
		$usermsg = "<font color='red'>New Customer Added</font>";
	}	

	if (isset($_POST["editcustomerinfo"])) 
	{
		unset($_POST["editcustomerinfo"]);

		$_POST["date_of_birth"] = date('Y-m-d H:i:s', strtotime($_POST["date_of_birth"]));
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
                $_POST["updated_by"] = $_SESSION["userid"];
		$where = "customer_id = ".$_SESSION["custid"];
		modify_record("customer_master", $_POST, $where);
		$usermsg = "<font color='red'>Customer Updated</font>";
	}

	if (isset($_SESSION["custid"])) 
	{	
		$qry = "SELECT * FROM customer_master WHERE customer_id =".$_SESSION["custid"];
		$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$customer = mysqli_fetch_assoc($customers);
	}
} else {
	unset($_SESSION["custid"]);
	unset($_SESSION["cawardid"]);
	unset($_SESSION["clangid"]);
	unset($_SESSION["spintid"]);
	unset($_SESSION["spiid"]);
	unset($_SESSION["talentid"]);

}

$qry = "SELECT * FROM customer_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);

$qry = "SELECT * FROM language_master order by description";
$languages = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$language = mysqli_fetch_assoc($languages);

$qry = "SELECT * FROM country_master order by name";
$countries = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$country = mysqli_fetch_assoc($countries);
$countrycount = 0;

if ($country)
{
	do {
		$countrycount++;
		$countryname[$countrycount] = $country["name"];
		$countryid[$countrycount] = $country["id"];
	} while($country = mysqli_fetch_assoc($countries));
}

$qry = "SELECT * FROM state_master order by name";
$states = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$state = mysqli_fetch_assoc($states);
$statecount = 0;

if ($state)
{
	do {
		$statecount++;
		$statename[$statecount] = $state["name"];
		$stateid[$statecount] = $state["id"];
	} while($state = mysqli_fetch_assoc($states));
}

$qry = "SELECT * FROM total_worth_master order by description";
$tworths = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$tworth = mysqli_fetch_assoc($tworths);

$qry = "SELECT * FROM gender_master order by description";
$tgenders= mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$tgender = mysqli_fetch_assoc($tgenders);

$qry = "SELECT * FROM talent_master order by description";
$ttalents= mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$ttalent = mysqli_fetch_assoc($ttalents);

$qry = "SELECT * FROM movie_industry_master order by description";
$tindustries= mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$tindustry = mysqli_fetch_assoc($tindustries);
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

<a href="admin.php">Go Back to Home Page</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
<br>
<body bgcolor="#AACFF9">
<?php if(isset($usermsg)) { 
	echo $usermsg;
} ?>

<form action="admin_add_customer.php" enctype="multipart/form-data" method="post" name="addcustomer">
<?php if (isset($_SESSION["custid"] )) { ?>
	<input type="hidden" name="editcustomerinfo" value="1">
<?php } else { ?>
	<input type="hidden" name="addcustomerinfo" value="1">
<?php } ?>
<table width="775" frame="box" border="0">
	<tr>
		<td align="right"><strong>First Name:</strong></td>
		<?php if(isset($customer["first_name"])) { ?>
			<td><input type="text" name="first_name" value="<?php echo $customer["first_name"]; ?>"/></td>
		<?php } else { ?>
			<td><input type="text" name="first_name" value=""/></td>
		<?php } ?>
		<td align="right"><strong>Middle Name:</strong></td>
		<?php if(isset($customer["middle_name"])) { ?>
	  	<td><input type="text" name="middle_name" value="<?php echo $customer["middle_name"]; ?>" /></td>
	  	<?php } else { ?>
	  	<td><input type="text" name="middle_name" value="" /></td>
		<?php } ?>
		<td align="right"><strong>Last Name:</strong></td>
		<?php if(isset($customer["last_name"])) { ?>
	  	<td><input type="text" name="last_name" value="<?php echo $customer["last_name"]; ?>" /></td>
		<?php } else { ?>
			<td><input type="text" name="last_name" value="" /></td>
		<?php } ?>
	</tr>
	<tr>
		<td align="right"><strong>Star Name:</strong></td>
		<?php if(isset($customer["star_name"])) { ?>
		<td><input type="text" name="star_name" value="<?php echo $customer["star_name"]; ?>" /></td>
		<?php } else { ?>
		<td><input type="text" name="star_name" value="" /></td>
		<?php } ?>
		<td align="right"><strong>Star Title:</strong></td>
		<?php if(isset($customer["star_title"])) { ?>
		<td colspan="3"><input type="text" name="star_title" value="<?php echo $customer["star_title"]; ?>" /></td>
		<?php } else { ?>
		<td colspan="3"><input type="text" name="star_title" value="" /></td>
		<?php } ?>
		<td align="right"><strong>Alternate Name:</strong></td>
		<?php if(isset($customer["alternate_name"])) { ?>
		<td colspan="3"><input type="text" name="alternate_name" value="<?php echo $customer["alternate_name"]; ?>" /></td>
		<?php } else { ?>
		<td colspan="3"><input type="text" name="alternate_name" value="" /></td>
		<?php } ?>
	</tr>
	<tr>
		<td align="right"><strong>Date of Birth:</strong></td>
		<?php if(isset($customer["date_of_birth"])) { ?>
		<td><input id="date_of_birth" name="date_of_birth" class="text" type="text" size="10" value="<?php echo $customer["date_of_birth"]; ?>"/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
		onMouseOut="this.style.background=''"; /><br /></td>
		<?php } else { ?>
		<td><input id="date_of_birth" name="date_of_birth" class="text" type="text" size="10" value=""/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
		onMouseOut="this.style.background=''"; /><br /></td>
		<?php } ?>
		<td align="right"><strong>Mother Tongue:</strong></td>	
		<td colspan="3">
			<select name="mother_tongue">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $language["id"]; ?>"

				<?php if (isset($customer["mother_tongue"])&& ($language["id"] == $customer["mother_tongue"])) { ?>
					 selected
					 <?php } ?> >
				<?php echo $language["description"]; ?></option>
				<?php } while ($language = mysqli_fetch_assoc($languages)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Birth City:</strong></td>
		<?php if(isset($customer["birth_city"])) { ?>
		<td><input type="text" name="birth_city" value="<?php echo $customer["birth_city"]; ?>" /></td>
		<?php } else { ?>
		<td><input type="text" name="birth_city" value="" /></td>
		<?php } ?>
		<td align="right"><strong>Birth State:</strong></td>
		<td>
			<select name="birth_state">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$statecount; $n++) { ?>
				<option value="<?php echo $stateid[$n]; ?>"
				<?php if (isset($customer["birth_state"] )&&($stateid[$n] == $customer["birth_state"] )) { ?>
					selected
				<?php } ?> >
				<?php echo $statename[$n]; ?></option>
				<?php } ?>
			</select>
		</td>
		<td align="right"><strong>Birth Country:</strong></td>
		<td>
			<select name="birth_country">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$countrycount; $n++) { ?>
				<option value="<?php echo $countryid[$n]; ?>"
				<?php
				if (isset($customer["birth_country"])&&($countryid[$n] == $customer["birth_country"])) { ?>
					selected
				<?php } ?> >
				<?php echo $countryname[$n]; ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Address 1:</strong></td>
		<?php if(isset($customer["address_1"])) { ?>
		<td><input type="text" name="address_1" size="25" value="<?php echo $customer["address_1"]; ?>"/></td>
		<?php } else { ?>
		<td><input type="text" name="address_1" size="25" value=""/></td>
		<?php } ?>
		<td align="right"><strong>City:</strong></td>
		<?php if(isset($customer["city"])) { ?>
		<td><input type="text" name="city" value="<?php echo $customer["city"]; ?>"/></td>
		<?php } else { ?>
		<td><input type="text" name="city" value=""/></td>
		<?php } ?>
		<td align="right"><strong>State</strong></td>
		<td>
		<select name="state">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$statecount; $n++) { ?>
				<option value="<?php echo $stateid[$n]; ?>"
				<?php
				if (isset($customer["state"])&&($stateid[$n] == $customer["state"])) { ?>
					selected
				<?php } ?> >
				<?php echo $statename[$n]; ?></option>
				<?php } ?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Address 2:</strong></td>
		<?php if(isset($customer["address_2"])) { ?>
		<td><input type="text" name="address_2" size="25" value="<?php echo $customer["address_2"]; ?>"/></td>
		<?php } else { ?>
		<td><input type="text" name="address_2" size="25" value=""/></td>
		<?php } ?>
		<td align="right"><strong>Country:</strong></td>
		<td>
			<select name="country">
				<option value="0">Select One...</option>
				<?php for ($n=1; $n<=$countrycount; $n++) { ?>
				<option value="<?php echo $countryid[$n]; ?>"
				<?php
				if (isset($customer["country"])&&($countryid[$n] == $customer["country"])) { ?>
					selected
				<?php	} ?> >
				<?php echo $countryname[$n]; ?></option>
				<?php } ?>
			</select>
		</td>
		<td align="right"><strong>Zip</strong></td>
		<?php if(isset($customer["zip"])) { ?>
		<td><input type="text" name="zip" size="6" value="<?php echo $customer["zip"]; ?>"/></td>
		<?php } else { ?>
		<td><input type="text" name="zip" size="6" value=""/></td>
		<?php } ?>
	</tr>
	<tr>
		<td align="right"><strong>Status:</strong></td>
		<td>
			<select name="status_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $status["id"]; ?>"
				<?php
				if (isset($customer["status_id"] )&&($status["id"] == $customer["status_id"] )) { ?>
					selected
				<?php } ?> >
				<?php echo $status["description"]; ?></option>
				<?php } while ($status = mysqli_fetch_assoc($statuses)); ?>
			</select>
		</td>

		<td align="right"><strong>Total Worth:</strong></td>
		<td>
			<select name="total_worth">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $tworth["id"]; ?>"
				<?php
				if (isset($customer["total_worth"])&&($tworth["id"] == $customer["total_worth"])) { ?>
					selected
					<?php } ?> >
				<?php echo $tworth["description"]; ?></option>
				<?php } while ($tworth = mysqli_fetch_assoc($tworths)); ?>
			</select>
		</td>

		<td align="right"><strong>Gender:</strong></td>
		<td>
			<select name="gender_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $tgender["id"]; ?>"
				<?php
				if (isset($customer["gender_id"])&&($tgender["id"] == $customer["gender_id"]) ) { ?>
					selected
				<?php } ?> >
				<?php echo $tgender["description"]; ?></option>
				<?php } while ($tgender = mysqli_fetch_assoc($tgenders)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Primary Talent:</strong></td>
		<td>
			<select name="primary_skill_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $ttalent["id"]; ?>"
				<?php
				if (isset($customer["primary_skill_id"])&&($ttalent["id"] == $customer["primary_skill_id"]) ) { ?>
					selected
				<?php }	?> >
				<?php echo $ttalent["description"]; ?></option>
				<?php } while ($ttalent = mysqli_fetch_assoc($ttalents)); ?>
			</select>
		</td>

		<td align="right"><strong>Primary Industry:</strong></td>
		<td>
			<select name="primary_industry_id">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $tindustry["id"]; ?>"
				<?php
				if (isset($customer["primary_industry_id"])&&($tindustry["id"] == $customer["primary_industry_id"]) ) { ?>
					selected
				<?php }	?> >
				<?php echo $tindustry["description"]; ?></option>
				<?php } while ($tindustry = mysqli_fetch_assoc($tindustries)); ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>School Info:</strong></td>
		<?php if(isset($customer["school_info"])) { ?>
		<td colspan="5"><textarea cols="70" rows="2" name="school_info"><?php echo $customer["school_info"]; ?></textarea></td>
		<?php } else { ?>
		<td colspan="5"><textarea cols="70" rows="2" name="school_info"></textarea></td>
		<?php } ?>
	</tr>
	<tr>
		<td align="right"><strong>College Info:</strong></td>
		<?php if(isset($customer["college_info"])) { ?>
		<td colspan="5"><textarea cols="70" rows="2" name="college_info"><?php echo $customer["college_info"]; ?></textarea></td>
		<?php } else { ?>
		<td colspan="5"><textarea cols="70" rows="2" name="college_info"></textarea></td>
		<?php } ?>
	</tr>
	<!-- main calendar program 
	<tr>
		<td align="right"><strong>Self Promo:</strong></td>
		<td colspan="5"><textarea cols="70" rows="2" name="self_promo_text"><?php echo $customer["self_promo_text"]; ?></textarea></td>
	</tr>
	-->
	<tr>
		<td align="right">&nbsp;</td>
		<td colspan="5">
		<?php if (isset($_SESSION["custid"]) ) { ?>
			<input type="submit" value="Update Cast Info">&nbsp;&nbsp;
			<input type="button" value="Start New Customer" onClick="javascript:location.href='admin_add_customer.php?new=1';"/>
		<?php } else { ?>
			<input type="submit" value="Add Cast Info" />
		<?php } ?>
		</td>
	</tr>
</table>
</form>

<?php 
if (isset($_SESSION["custid"]))
{
?>
<?php $display_name="Actor Name:" . $customer["star_name"] ."(". $customer["first_name"] ." ". $customer["last_name"] .")"; ?> 
<font size=9> 
<a href="customer/attributes_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Attributes</a>&nbsp;&nbsp;&nbsp;
<a href="customer/awards_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Awards</a>&nbsp;&nbsp;&nbsp;
<a href="digital_content_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Digital Content</a>&nbsp;&nbsp;&nbsp;
<a href="customer/text_content_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Text Content</a>&nbsp;&nbsp;&nbsp;
<a href="customer/degree_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Degree</a>&nbsp;&nbsp;&nbsp;
<a href="customer/favorite_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Favorites</a>&nbsp;&nbsp;&nbsp;
<a href="customer/language_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Language</a>&nbsp;&nbsp;&nbsp;
<a href="customer/relation_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Relations</a>&nbsp;&nbsp;&nbsp;
<a href="customer/talents_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Talents</a>&nbsp;&nbsp;&nbsp;
<a href="customer/special_interest_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Spc. Interest</a>&nbsp;&nbsp;&nbsp;
<a href="customer/sports_interest_new.php?custid=<?php echo $customer["customer_id"]?>&userid=<?php echo $_SESSION["userid"]?>&display_name=<?php echo $display_name; ?>">Sports</a>&nbsp;&nbsp;&nbsp;
</font>
<?php } ?>

</body>
</html>
<script type="text/javascript">

var customers=new ddtabcontent("customer1tabs")
customers.setpersist(true)
customers.setselectedClassTarget("link") //"link" or "linkparent"
customers.init()

</script>

<script type="text/javascript">
	Calendar.setup({
	inputField     :    "date_of_birth",     // id of the input field
	ifFormat       :    "%m/%d/%Y",      // format of the input field
	button         :    "f_trigger_date",  // trigger for the calendar (button ID)
	align          :    "Bl",           // alignment (defaults to "Bl")
	singleClick    :    true
	});
</script>

