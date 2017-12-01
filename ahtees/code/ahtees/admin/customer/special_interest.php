<?php 
if ($_REQUEST["newspint"])
{
	unset($_SESSION["spintid"]);
}

if ($_REQUEST["spintid"])
{
	$_SESSION["spintid"] = $_REQUEST["spintid"];
}


if ($_POST["addspecint"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["lang_id"] = $_POST["lang_id"];
	$data["interest"] = $_POST["interest"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_special_interest", $data);
}

if ($_POST["modifyspecint"])
{

	$data["lang_id"] = $_POST["lang_id"];
	$data["interest"] = $_POST["interest"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["spintid"];
	modify_record("customer_special_interest", $data, $where);
}


if ($_REQUEST["deletespint"])
{
	delete_record_secondary("customer_special_interest", $_REQUEST["deletespint"], "id");
}

if ($_SESSION["custid"]) 
{
	
	$qry = "SELECT customer_special_interest.*, language_master.description FROM customer_special_interest INNER JOIN language_master ON (language_master.id = customer_special_interest.lang_id) WHERE customer_id = ".$_SESSION["custid"];
	$cspecints = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cspecint = mysqli_fetch_assoc($cspecints);
	
	if ($_SESSION["spintid"])
	{
		$qry = "SELECT customer_special_interest.* FROM customer_special_interest WHERE customer_special_interest.id = ".$_SESSION["spintid"];
		//echo $qry."<BR>";
		$mspinterests = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mspinterest = mysqli_fetch_assoc($mspinterests);
	}
	
}

$qry = "SELECT * FROM system_lang_code_master";
$langs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$lang = mysqli_fetch_assoc($langs);
	
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addlanguage" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["spintid"]) { ?>
				<input type="hidden" value="1" name="modifyspecint">
			<?php } else { ?>
				<input type="hidden" value="1" name="addspecint">
			<?php } ?>
			
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Language:</strong></td>
					<td>
						<select name="lang_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $lang["id"]; ?>" <?php if ($mspinterest["lang_id"] == $lang["id"]) {?>selected<?php } ?>><?php echo $lang["name"]; ?></option>
							<?php } while ($lang = mysqli_fetch_assoc($langs)); ?>
						</select>
					</td>
				<tr>
					<td align="right"><strong>Special Interest:</strong>&nbsp;</td>
					<td>
						<input type="text" name="interest" size="50" value="<?php echo $mspinterest["interest"]; ?>"/>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["spintid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Special Interest"><br /><input type="button" value="New Special Interest" onclick="javascript:location.href='admin_add_customer.php?newspint=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Special Interest"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cspecint) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Language</strong></td>
					<td><strong>Special Interest</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cspecint["description"]; ?></td>
					<td><?php echo $cspecint["interest"]; ?></td>
					<td><a href="admin_add_customer.php?spintid=<?php echo $cspecint["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deletespint=<?php echo $cspecint["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cspecint = mysqli_fetch_assoc($cspecints)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Special Interests </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
