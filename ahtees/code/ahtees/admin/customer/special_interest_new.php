<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

//print_r($_POST);

if (isset($_POST["addspecint"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["lang_id"] = $_POST["lang_id"];
	$data["interest"] = $_POST["interest"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_special_interest", $data);
}

if (isset($_POST["modifyspecint"]))
{

	$data["lang_id"] = $_POST["lang_id"];
	$data["interest"] = $_POST["interest"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["spintid"];
	modify_record("customer_special_interest", $data, $where);
}


if (isset($_REQUEST["deletespint"]))
{
	delete_record_secondary("customer_special_interest", $_REQUEST["deletespint"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT customer_special_interest.*, system_lang_code_master.name FROM customer_special_interest INNER JOIN system_lang_code_master ON (system_lang_code_master.id = customer_special_interest.lang_id) WHERE customer_id = ".$_REQUEST["custid"];
	$cspecints = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cspecint = mysqli_fetch_assoc($cspecints);
	
	if (isset($_REQUEST["spintid"]))
	{
		$qry = "SELECT customer_special_interest.* FROM customer_special_interest WHERE customer_special_interest.id = ".$_REQUEST["spintid"];
		//echo $qry."<BR>";
		$mspinterests = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mspinterest = mysqli_fetch_assoc($mspinterests);
	}
	
}

$qry = "SELECT * FROM system_lang_code_master";
$langs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$lang = mysqli_fetch_assoc($langs);
	
?>
<h1>Editing Special Interests of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addlanguage" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["spintid"])) { ?>
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
							<option value ="<?php echo $lang["id"]; ?>" 
							<?php if (isset($mspinterest["lang_id"])&&($mspinterest["lang_id"] == $lang["id"])) {?>
							selected
							<?php } ?>>
							<?php echo $lang["name"]; ?></option>
							<?php } while ($lang = mysqli_fetch_assoc($langs)); ?>
						</select>
					</td>
				<tr>
					<td align="right"><strong>Special Interest:</strong>&nbsp;</td>
					<td>
					<?php if(isset($mspinterest["interest"])) { ?>
						<input type="text" name="interest" size="50" value="<?php echo $mspinterest["interest"]; ?>"/>
					<?php } else { ?>
						<input type="text" name="interest" size="50" value=""/>
					<?php } ?>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["spintid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Special Interest"><br />
						<input type="button" value="New Special Interest" onclick="javascript:location.href='special_interest_new.php?newspint=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Special Interest"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($cspecint)) {?>
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
					<td><?php echo $cspecint["name"]; ?></td>
					<td><?php echo $cspecint["interest"]; ?></td>
					<td><a href="special_interest_new.php?spintid=<?php echo $cspecint["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="special_interest_new.php?deletespint=<?php echo $cspecint["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
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
		<?php } else { ?>
			<center> <h3> No Special Interests </h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
