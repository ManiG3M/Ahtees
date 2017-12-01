<?php 

if ($_REQUEST["newtalent"])
{
	unset($_SESSION["talentid"]);
}

if ($_REQUEST["talentid"])
{
	$_SESSION["talentid"] = $_REQUEST["talentid"];
}


if ($_POST["addtalents"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["talent_id"] = $_POST["talent_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_talent", $data);
}

if ($_POST["modifytalents"])
{
	$data["talent_id"] = $_POST["talent_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["talentid"];
	modify_record("customer_talent", $data, $where);
}

if ($_REQUEST["deletetalent"])
{
	delete_record_secondary("customer_talent", $_REQUEST["deletetalent"], "id");
}

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM talent_master order by description";
	$talents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$talent = mysqli_fetch_assoc($talents);
	
	$qry = "SELECT customer_talent.*, talent_master.description FROM customer_talent INNER JOIN talent_master ON (customer_talent.talent_id = talent_master.id) WHERE customer_id = ".$_SESSION["custid"];
	$ctalents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ctalent = mysqli_fetch_assoc($ctalents);
	
	if ($_SESSION["talentid"])
	{
		$qry = "SELECT customer_talent.* FROM customer_talent WHERE customer_talent.id = ".$_SESSION["talentid"];
		//echo $qry."<BR>";
		$mtalents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mtalent = mysqli_fetch_assoc($mtalents);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addtalent" enctype="multipart/form-data" method="post">
				<?php if ($_SESSION["talentid"]) { ?>
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
							<option value ="<?php echo $talent["id"]; ?>" <?php if ($mtalent["talent_id"] == $talent["id"]) { ?>selected<?php } ?>><?php echo $talent["description"]; ?></option>
							<?php } while ($talent = mysqli_fetch_assoc($talents)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
						<?php if ($_SESSION["talentid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Talent"><br /><input type="button" value="New Talent" onclick="javascript:location.href='admin_add_customer.php?newtalent=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add talent"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ctalent) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
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
					<td><a href="admin_add_customer.php?talentid=<?php echo $ctalent["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deletetalent=<?php echo $ctalent["id"]; ?>">delete</a></td>
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
		</div>
		<?php } else { ?>
			<center> <h3> No Talents </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
