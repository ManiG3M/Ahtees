<?php 

if ($_REQUEST["newsinger"])
{
	unset($_SESSION["mcastsingerid"]);
}


if ($_REQUEST["mcastsingerid"])
{
	$_SESSION["mcastsingerid"] = $_REQUEST["mcastsingerid"];
}

if ($_POST["addcastsinger"])
{
	$data["song_id"] = $_SESSION["songid"];
	$data["customer_id"] = $_POST["customer_id"];
	add_record("song_singer", $data);
}

if ($_POST["modifycastsinger"])
{
	$data["song_id"] = $_SESSION["song_id"];
	$data["customer_id"] = $_POST["customer_id"];
	$where = "id= ".$_SESSION["mcastsingerid"];
	modify_record("song_singer", $data, $where);
}

if ($_REQUEST["deletesinger"])
{
	delete_record_secondary("song_singer", $_REQUEST["deletesinger"], "id");
}

if ($_POST["castsearchsinger"]) 
{
	$qry = "SELECT * FROM customer_master WHERE status = 1 AND first_name LIKE '%".$_POST["castsearchsinger"]."%' OR last_name LIKE '%".$_POST["castsearchsinger"]."%' OR star_name LIKE '%".$_POST["castsearchsinger"]."%'";
	$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$customer = mysqli_fetch_assoc($customers);

}
//echo $qry;

if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT song_singer.*, customer_master.first_name, customer_master.last_name, customer_master.star_name FROM song_singer INNER JOIN customer_master ON (song_singer.customer_id = customer_master.customer_id) WHERE song_id = ".$_SESSION["songid"];
	$ccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccast = mysqli_fetch_assoc($ccasts);
	
	if ($_SESSION["mcastsingerid"])
	{
		$qry = "SELECT song_singer.* FROM song_singer WHERE song_singer.id = ".$_SESSION["mcastsingerid"];
		$mccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mccast = mysqli_fetch_assoc($mccasts);
	}
	
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<table cellpadding="0" cellspacing="1" border="0" width="100%">
				<form name="searchcastformsinger" enctype="multipart/form-data" method="post" action="admin_add_movie.php">
				<tr>
					<td align="right"><strong>Search Cast:</strong>&nbsp;</td>
					<td ><input type="text" name="castsearchsinger" value="<?php echo $_POST["castsearchsinger"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Search" /></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
				</form>
				<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mcastsingerid"]) { ?>
				<input type="hidden" value="1" name="modifycastsinger">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastsinger">
			<?php } ?>
				<tr>
					<td align="right"><strong>Cast Name:</strong>&nbsp;</td>
					<td >
						<?php if ($customer) { ?>
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php 
							if ($customer)
							{
							do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" <?php if ($mccast["customer_id"] == $customer["customer_id"]) {?>selected<?php } ?>><?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["star_name"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers));
							} ?>
						</select>
						<?php } else { ?>
						<font color="red"><strong>No Singers Found, Try A New Search</strong></font>
						<?php } ?>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["mcastsingerid"]) { ?>
						<td><input type="submit" value="Modify Cast">&nbsp;&nbsp;<input type="button" value="New Singer" onclick="javascript:location.href='admin_add_movie.php?newsinger=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Singer"></td>
					<?php } ?>
				</tr>		
			</form>
			</table>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccast) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Cast</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccast["first_name"]." ".$ccast["last_name"]; ?></td>
					<td><a href="admin_add_movie.php?deletesinger=<?php echo $ccast["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccast = mysqli_fetch_assoc($ccasts)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Singers </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
