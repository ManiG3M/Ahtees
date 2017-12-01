<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_POST["addtalents"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["talent_id"] = $_POST["talent_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_talent", $data);
}

if (isset($_POST["modifytalents"]))
{
	$data["talent_id"] = $_POST["talent_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["talentid"];
	modify_record("customer_talent", $data, $where);
}

if (isset($_REQUEST["deletetalent"]))
{
	delete_record_secondary("customer_talent", $_REQUEST["deletetalent"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM talent_master order by description";
	$talents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$talent = mysqli_fetch_assoc($talents);
	
	$qry = "SELECT customer_talent.*, talent_master.description FROM customer_talent INNER JOIN talent_master ON (customer_talent.talent_id = talent_master.id) WHERE customer_id = ".$_REQUEST["custid"];
	$ctalents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ctalent = mysqli_fetch_assoc($ctalents);
	
	if (isset($_REQUEST["talentid"]))
	{
		$qry = "SELECT customer_talent.* FROM customer_talent WHERE customer_talent.id = ".$_REQUEST["talentid"];
		//echo $qry."<BR>";
		$mtalents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mtalent = mysqli_fetch_assoc($mtalents);
	}
}
?>
<h1>Editing Talents of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addtalent" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
				<?php if (isset($_REQUEST["talentid"])) { ?>
				<input type="hidden" value="1" name="modifytalents">
			<?php } else { ?>
				<input type="hidden" value="1" name="addtalents">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Talent:</strong>&nbsp;</td>
					<td>
						<select name="talent_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $talent["id"]; ?>" 
							<?php if (isset($mtalent["talent_id"])&&($mtalent["talent_id"] == $talent["id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $talent["description"]; ?></option>
							<?php } while ($talent = mysqli_fetch_assoc($talents)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
						<?php if (isset($_REQUEST["talentid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Talent"><br />
						<input type="button" value="New Talent" onclick="javascript:location.href='talents_new.php?newtalent=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add talent"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($ctalent)) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Talent</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ctalent["description"]; ?></td>
					<td><a href="talents_new.php?talentid=<?php echo $ctalent["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="talents_new.php?deletetalent=<?php echo $ctalent["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ctalent = mysqli_fetch_assoc($ctalents)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Talents </h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
