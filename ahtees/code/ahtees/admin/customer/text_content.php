<?php 
if ($_REQUEST["newdetail"])
{
	unset($_SESSION["drid"]);
}

if ($_REQUEST["drid"])
{
	$_SESSION["drid"] = $_REQUEST["drid"];
}

if ($_POST["adddetail"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["text_content"] = $_POST["text_content"];
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_text_content", $data);
}

if ($_POST["modifydetail"])
{
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["text_content"] = $_POST["text_content"];
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["drid"];
	modify_record("customer_text_content", $data, $where);
}

if ($_REQUEST["deleted"])
{
	delete_record_secondary("customer_text_content", $_REQUEST["deleted"], "id");
}

if ($_SESSION["custid"]) 
{
	//old query..
	//$qry = "SELECT customer_text_content.*, system_lang_code_master.name as langname FROM customer_text_content LEFT JOIN system_lang_code_master ON (customer_text_content.system_lang_code_id = system_lang_code_master.id) WHERE customer_id = ".$_SESSION["custid"];

	$qry = "SELECT a.*, b.name as langname , c.description as description FROM customer_text_content a, system_lang_code_master b, text_type_master c WHERE a.customer_id = " . $_SESSION["custid"] . " AND b.id = a.system_lang_code_id AND c.id = a.content_type_id order by description";

	$cdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdreview = mysqli_fetch_assoc($cdreviews);
	
	if ($_SESSION["drid"])
	{
		$qry = "SELECT customer_text_content.* FROM customer_text_content WHERE customer_text_content.id = ".$_SESSION["drid"];
		//echo $qry."<BR>";
		$mdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdreview = mysqli_fetch_assoc($mdreviews);
	}
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

$ttqry = "SELECT * FROM text_type_master order by description";
$ttmasters = mysqli_query($connDB,$ttqry) or die('Query failed: ' . mysqli_error($connDB)); 
$ttmaster = mysqli_fetch_assoc($ttmasters);
?>

<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="40%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["drid"]) { ?>
				<input type="hidden" value="1" name="modifydetail">
			<?php } else { ?>
				<input type="hidden" value="1" name="adddetail">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $mdreview["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>

				<tr>
					<td align="right"><strong>Type: </strong></td>
					<td colspan="3">
					<select name="content_type_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $ttmaster["id"]; ?>" <?php if ($ttmaster["id"] == $mdreview["content_type_id"]) { ?>selected<?php } ?>><?php echo $ttmaster["description"]; ?></option>
					<?php } while ($ttmaster = mysqli_fetch_assoc($ttmasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Text Content:</strong>&nbsp;</td>
					<td colspan="3">
						<textarea name="text_content" rows="20" cols="60"><?php echo $mdreview["text_content"]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>

					<?php if ($_SESSION["drid"]) { ?>
						<td><input type="submit" value="Modify Text Content">&nbsp;&nbsp;<input type="button" value="New Text Content" onclick="javascript:location.href='admin_add_customer.php?newdetail=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Text Content"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="60%" align="left" valign="top">
		<?php if ($cdreview) {?>
		<div style="overflow:auto; height:420px; width:590px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Language</strong></td>
					<td><strong>Type</strong></td>
					<td><strong>Text Content</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdreview["langname"]; ?></td>
					<td><?php echo $cdreview["description"]; ?>
					<br />
					<a href="admin_add_customer.php?drid=<?php echo $cdreview["id"]; ?>">edit</a><br /><a href="admin_add_customer.php?deleted=<?php echo $cdreview["id"]; ?>">delete</a></td>
					<?php 
					if (($cdreview["content_type_id"] == 3) || ($cdreview["content_type_id"] == 8))
					{ ?>
						<td><a href="<?php echo $cdreview["text_content"]; ?>" target="_blank"><?php echo $cdreview["text_content"]; ?></a></td>
					<?php } else { ?>
						<td><?php echo $cdreview["text_content"]; ?></td>
					<?php } ?>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cdreview = mysqli_fetch_assoc($cdreviews)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Text Content</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
