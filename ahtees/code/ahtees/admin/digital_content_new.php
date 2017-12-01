<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST["adddigitalcontentcus"]))
{
	$target_path = "customer/content/".$_REQUEST["custid"]."_".$_POST["content_type_id"]."_".$_FILES['content_path']['name'];
	if(move_uploaded_file($_FILES['content_path']['tmp_name'], $target_path)) 
	{
		$data["customer_id"] = $_REQUEST["custid"];
		$data["content_type_id"] = $_POST["content_type_id"];
		$data["content_path"] = "customer/content/".$_REQUEST["custid"]."_".$_POST["content_type_id"]."_".$_FILES['content_path']['name'];
		$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        	$data["entered_by"] = $_REQUEST["userid"];
		add_record("customer_digital_content", $data);
		chmod($target_path, 0777);
	} else {
		$digcontentmsg = "<font color='red'>There has been an error uploading the file.";
	}
}

if (isset($_REQUEST["deletedcontent"]))
{
	delete_record_secondary("customer_digital_content", $_REQUEST["deletedcontent"], "id");
	unlink($_REQUEST["filename"]);
}

$qry = "SELECT * FROM content_type_master order by description";
$ctypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$ctype = mysqli_fetch_assoc($ctypes);

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT customer_digital_content.*, content_type_master.description FROM customer_digital_content INNER JOIN content_type_master ON (customer_digital_content.content_type_id = content_type_master.id) WHERE customer_digital_content.customer_id = ".$_REQUEST["custid"];
	$cdigitalcontents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdigitalcontent = mysqli_fetch_assoc($cdigitalcontents);
}
?>
<h1>Editing Digital Content of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post" action="digital_content_new.php">
			<input type="hidden" value="1" name="adddigitalcontentcus">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Type:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="content_type_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $ctype["id"]; ?>"><?php echo $ctype["description"]; ?></option>
							<?php } while ($ctype = mysqli_fetch_assoc($ctypes)); ?>
						</select>
					</td>

				</tr>	

				<tr>
					<td align="right"><strong>Select File:</strong>&nbsp;</td>
					<td colspan="3"><input type="file" name="content_path"/></td>
				</tr>

				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Add Digital Content"></td>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($cdigitalcontent)) {?>
		<div style="overflow:auto; height:540px; width:560px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Content Type</strong></td>
					<td><strong>Digital Content</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdigitalcontent["description"]; ?></td>
					<td><a href="<?php echo $cdigitalcontent["content_path"]; ?>" target="_blank"> <?php echo $cdigitalcontent["content_path"]; ?> </a></td>
					<td><a href="digital_content_new.php?deletedcontent=<?php echo $cdigitalcontent["id"]; ?>&filename=<?php echo $cdigitalcontent["content_path"]; ?>&custid=<?php echo $_REQUEST["custid"] ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cdigitalcontent = mysqli_fetch_assoc($cdigitalcontents)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Digital Content</h3> </center>
		<?php } ?>
		</td>
	</tr>
	<a href="admin_view_customer_new.php?custid=<? echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
