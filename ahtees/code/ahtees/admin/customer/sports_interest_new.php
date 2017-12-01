<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_POST["addsportsint"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["sports_id"] = $_POST["sports_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_sports_interest", $data);
}

if (isset($_POST["modifysportsint"]))
{

	$data["sports_id"] = $_POST["sports_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["spiid"];
	modify_record("customer_sports_interest", $data, $where);
}

if (isset($_REQUEST["deletesport"]))
{
	delete_record_secondary("customer_sports_interest", $_REQUEST["deletesport"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM sports_master order by description";
	$sports = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$sport = mysqli_fetch_assoc($sports);
	
	$qry = "SELECT customer_sports_interest.*, sports_master.description FROM customer_sports_interest INNER JOIN sports_master ON (customer_sports_interest.sports_id = sports_master.id) WHERE customer_id = ".$_REQUEST["custid"];
	$csports = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$csport = mysqli_fetch_assoc($csports);
	
	if (isset($_REQUEST["spiid"]))
	{
		$qry = "SELECT customer_sports_interest.* FROM customer_sports_interest WHERE customer_sports_interest.id = ".$_REQUEST["spiid"];
		//echo $qry."<BR>";
		$mspinterests = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mspinterest = mysqli_fetch_assoc($mspinterests);
	}
}
?>
<h1>Editing Sports Interests of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addsports" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["spiid"])) { ?>
				<input type="hidden" value="1" name="modifysportsint">
			<?php } else { ?>
				<input type="hidden" value="1" name="addsportsint">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Sport Interest:</strong>&nbsp;</td>
					<td>
						<select name="sports_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $sport["id"]; ?>" 
							<?php if (isset($mspinterest["sports_id"])&&($mspinterest["sports_id"] == $sport["id"])) {?>
							selected
							<?php } ?>>
							<?php echo $sport["description"]; ?></option>
							<?php } while ($sport = mysqli_fetch_assoc($sports)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["spiid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Sports Interest"><br />
						<input type="button" value="New Language" onclick="javascript:location.href='sports_interest_new.php?newspi=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Sport Interest"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($csport)) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Sport</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $csport["description"]; ?></td>
					<td><a href="sports_interest_new.php?spiid=<?php echo $csport["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="sports_interest_new.php?deletesport=<?php echo $csport["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($csport = mysqli_fetch_assoc($csports)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Sports Interest </h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
