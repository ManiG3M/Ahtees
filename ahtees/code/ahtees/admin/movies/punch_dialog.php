<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newpunchdialog"])
{
	unset($_SESSION["pdid"]);
}

if ($_REQUEST["pdid"])
{
	$_SESSION["pdid"] = $_REQUEST["pdid"];
}


if ($_POST["addpunchdialog"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["dialog"] = $_POST["dialog"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_punch_dialog", $data);
}

if ($_POST["modifypunchdialog"])
{
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["dialog"] = $_POST["dialog"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["pdid"];
	modify_record("movie_punch_dialog", $data, $where);
}

if ($_REQUEST["deletedialog"])
{
	delete_record_secondary("movie_punch_dialog", $_REQUEST["deletedialog"], "id");
}

if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_punch_dialog.*, system_lang_code_master.name as langname FROM movie_punch_dialog LEFT JOIN system_lang_code_master ON (movie_punch_dialog.system_lang_code_id = system_lang_code_master.id) WHERE movie_id = ".$_SESSION["movieid"];
	$moviepds = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$moviepd = mysqli_fetch_assoc($moviepds);
	
	if ($_SESSION["pdid"])
	{
		$qry = "SELECT movie_punch_dialog.* FROM movie_punch_dialog WHERE movie_punch_dialog.id = ".$_SESSION["pdid"];
		//echo $qry."<BR>";
		$mpdialogs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mpdialog = mysqli_fetch_assoc($mpdialogs);
	}
}
$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addpunchdialog" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["pdid"]) { ?>
				<input type="hidden" value="1" name="modifypunchdialog">
			<?php } else { ?>
				<input type="hidden" value="1" name="addpunchdialog">
			<?php } ?>
			
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $mpdialog["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Dialog:</strong>&nbsp;</td>
					<td colspan="3">
						<textarea name="dialog" rows="5" cols="40"><?php echo $mpdialog["dialog"]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["pdid"]) { ?>
						<td><input type="submit" value="Modify Punch Dialog">&nbsp;&nbsp;<input type="button" value="New Punch Dialog" onclick="javascript:location.href='admin_add_movie.php?newpunchdialog=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Punch Dialog"></td>
					<?php } ?>
					
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($moviepd) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Language</strong></td>
					<td><strong>Dialog</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $moviepd["langname"]; ?></td>
					<td><?php echo $moviepd["dialog"]; ?></td>
					<td><a href="admin_add_movie.php?pdid=<?php echo $moviepd["id"]; ?>">edit</a><br /><a href="admin_add_movie.php?deletedialog=<?php echo $moviepd["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($moviepd = mysqli_fetch_assoc($moviepds)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Punch Dialogs</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
