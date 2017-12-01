<?php 

if ($_REQUEST["newspi"])
{
	unset($_SESSION["spiid"]);
}

if ($_REQUEST["spiid"])
{
	$_SESSION["spiid"] = $_REQUEST["spiid"];
}

if ($_POST["addsportsint"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["sports_id"] = $_POST["sports_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_sports_interest", $data);
}

if ($_POST["modifysportsint"])
{

	$data["sports_id"] = $_POST["sports_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["spiid"];
	modify_record("customer_sports_interest", $data, $where);
}

if ($_REQUEST["deletesport"])
{
	delete_record_secondary("customer_sports_interest", $_REQUEST["deletesport"], "id");
}

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM sports_master order by description";
	$sports = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$sport = mysqli_fetch_assoc($sports);
	
	$qry = "SELECT customer_sports_interest.*, sports_master.description FROM customer_sports_interest INNER JOIN sports_master ON (customer_sports_interest.sports_id = sports_master.id) WHERE customer_id = ".$_SESSION["custid"];
	$csports = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$csport = mysqli_fetch_assoc($csports);
	
	if ($_SESSION["spiid"])
	{
		$qry = "SELECT customer_sports_interest.* FROM customer_sports_interest WHERE customer_sports_interest.id = ".$_SESSION["spiid"];
		//echo $qry."<BR>";
		$mspinterests = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mspinterest = mysqli_fetch_assoc($mspinterests);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addsports" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["spiid"]) { ?>
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
							<option value ="<?php echo $sport["id"]; ?>" <?php if ($mspinterest["sports_id"] == $sport["id"]) {?>selected<?php } ?>><?php echo $sport["description"]; ?></option>
							<?php } while ($sport = mysqli_fetch_assoc($sports)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["spiid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Sports Interest"><br /><input type="button" value="New Language" onclick="javascript:location.href='admin_add_customer.php?newspi=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Sport Interest"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($csport) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
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
					<td><a href="admin_add_customer.php?spiid=<?php echo $csport["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deletesport=<?php echo $csport["id"]; ?>">delete</a></td>
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
		</div>
		<?php } else { ?>
			<center> <h3> No Sports Interest </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
