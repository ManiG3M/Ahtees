<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newcastpd"])
{
	unset($_SESSION["mcastpdid"]);
}

if ($_REQUEST["mcastpdid"])
{
	$_SESSION["mcastpdid"] = $_REQUEST["mcastpdid"];
}


if ($_POST["addcastpunch"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["customer_id"] = $_POST["customer_id"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["dialog"] = $_POST["dialog"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast_punch_dialogs", $data);
}

if ($_POST["modifycastpunch"])
{
	$data["customer_id"] = $_POST["customer_id"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["dialog"] = $_POST["dialog"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["mcastpdid"];
	modify_record("movie_cast_punch_dialogs", $data, $where);
}

if ($_REQUEST["deletecastpd"])
{
	delete_record_secondary("movie_cast_punch_dialogs", $_REQUEST["deletecastpd"], "id");
}

//$qry = "SELECT distinct customer_master.* FROM customer_master RIGHT JOIN movie_cast ON (customer_master.customer_id = movie_cast.customer_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, movie_role_type_master.description FROM movie_cast INNER JOIN customer_master ON (customer_master.customer_id = movie_cast.customer_id) INNER JOIN movie_role_type_master ON (movie_role_type_master.id = movie_cast.role_type_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_cast_punch_dialogs.*, customer_master.first_name, customer_master.last_name, system_lang_code_master.name as langname FROM movie_cast_punch_dialogs INNER JOIN customer_master ON (movie_cast_punch_dialogs.customer_id = customer_master.customer_id) LEFT JOIN system_lang_code_master ON (movie_cast_punch_dialogs.system_lang_code_id = system_lang_code_master.id) WHERE movie_cast_punch_dialogs.movie_id = ".$_SESSION["movieid"];
	$ccastpds = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccastpd = mysqli_fetch_assoc($ccastpds);
	
	if ($_SESSION["mcastpdid"])
	{
		$qry = "SELECT movie_cast_punch_dialogs.* FROM movie_cast_punch_dialogs WHERE movie_cast_punch_dialogs.id = ".$_SESSION["mcastpdid"];
		$mpdcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mpdcast = mysqli_fetch_assoc($mpdcasts);
	}
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mcastpdid"]) { ?>
				<input type="hidden" value="1" name="modifycastpunch">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastpunch">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Cast:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" <?php if ($mpdcast["customer_id"] == $customer["customer_id"]) { ?>selected<?php } ?>><?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["description"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $mpdcast["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Dialog:</strong>&nbsp;</td>
					<td colspan="3"><textarea name="dialog" cols="40" rows="4"><?php echo $mpdcast["dialog"]; ?></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["mcasthid"]) { ?>
						<td><input type="submit" value="Modify Cast Dialog">&nbsp;&nbsp;<input type="button" value="New Cast Dialog" onclick="javascript:location.href='admin_add_movie.php?newcastpd=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast Dialog"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccastpd) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Cast</strong></td>
					<td><strong>Language</strong></td>
					<td><strong>Dialog</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccastpd["first_name"]." ".$ccastpd["last_name"]; ?></td>
					<td><?php echo $ccastpd["langname"]; ?></td>
					<td><?php echo $ccastpd["dialog"]; ?></td>
					<td><a href="admin_add_movie.php?mcastpdid=<?php echo $ccastpd["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletecastpd=<?php echo $ccastpd["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccastpd = mysqli_fetch_assoc($ccastpds)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Cast Punch Dialogs</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
