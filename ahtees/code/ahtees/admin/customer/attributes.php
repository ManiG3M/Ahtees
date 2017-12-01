<?php 

if ($_REQUEST["newattribute"])
{
	unset($_SESSION["attributeid"]);
}

if ($_REQUEST["attributeid"])
{
	$_SESSION["attributeid"] = $_REQUEST["attributeid"];
}

if ($_POST["addattribute"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["attribute_id"] = $_POST["attribute_id"];
	$data["attribute_value"] = $_POST["attribute_value"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_attributes", $data);
}

if ($_POST["modifyattribute"])
{
	$data["attribute_id"] = $_POST["attribute_id"];
	$data["attribute_value"] = $_POST["attribute_value"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["attributeid"];
	modify_record("customer_attributes", $data, $where);
}

if ($_REQUEST["deleteattribute"])
{
	delete_record_secondary("customer_attributes", $_REQUEST["deleteattribute"], "id");
}

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM attributes_master order by description";
	$attributes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$attribute = mysqli_fetch_assoc($attributes);
	
	//$qry = "SELECT customer_attributes.*, attributes_master.description FROM customer_attributes INNER JOIN attributes_master ON (customer_attributes.attribute_id = attributes_master.id) WHERE customer_id = ".$_SESSION["custid"];

	$qry = "SELECT customer_attributes.*, attributes_master.description FROM customer_attributes,attributes_master WHERE customer_attributes.customer_id = ". $_SESSION["custid"] ." AND customer_attributes.attribute_id = attributes_master.id";
	$cattributes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cattribute = mysqli_fetch_assoc($cattributes);
	
	if ($_SESSION["attributeid"])
	{
		$qry = "SELECT customer_attributes.* FROM customer_attributes WHERE customer_attributes.id = ".$_SESSION["attributeid"];
		//echo $qry."<BR>";
		$mattributes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mattribute = mysqli_fetch_assoc($mattributes);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addattributes" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["attributeid"]) { ?>
				<input type="hidden" value="1" name="modifyattribute">
			<?php } else { ?>
				<input type="hidden" value="1" name="addattribute">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Attributes</strong>&nbsp;</td>
					<td>
						<select name="attribute_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $attribute["id"]; ?>" <?php if ($mattribute["attribute_id"] == $attribute["id"]) {?>selected<?php } ?>><?php echo $attribute["description"]; ?></option>
							<?php } while ($attribute = mysqli_fetch_assoc($attributes)); ?>
						</select>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>Value</strong>&nbsp;</td>
					<td>
						<input type="text" name="attribute_value" size="50" value="<?php echo $mattribute["attribute_value"]; ?>"/>
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["attributeid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Attributes"><br /><input type="button" value="New attribute" onclick="javascript:location.href='admin_add_customer.php?newattribute=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Attributes"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cattribute) {?>
		<div style="overflow:auto; height:340px; width:560px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Attributes</strong></td>
					<td><strong>Description</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cattribute["description"]; ?></td>
					<td><?php echo $cattribute["attribute_value"]; ?></td>
					<td><a href="admin_add_customer.php?attributeid=<?php echo $cattribute["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deleteattribute=<?php echo $cattribute["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cattribute = mysqli_fetch_assoc($cattributes)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Attributes</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
