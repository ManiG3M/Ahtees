<?php include("../scripts/collapse.js"); ?>

<?php if ($_SESSION["songid"]) { 

if ($_REQUEST["newsongl"])
{
	unset($_SESSION["editlsong"]);
}

if ($_REQUEST["editlsong"])
{
	$_SESSION["editlsong"] = $_REQUEST["editlsong"];
}

if ($_REQUEST["deletelsong"])
{
	delete_record_secondary("song_master_extension", $_REQUEST["deletelsong"], "id");
}

if ($_POST["addsonglinfo"]) 
{
	unset($_POST["addsonglinfo"]);
	$_POST["song_id"] = $_SESSION["songid"];
	add_record("song_master_extension", $_POST);
	$usersongmsg = "<font color='green'>New Song Info Added</font>";
}

if ($_POST["editsonglinfo"]) 
{
	unset($_POST["editsonglinfo"]);
	$where = "id = ".$_SESSION["editlsong"];
	modify_record("song_master_extension", $_POST, $where);
	$usersongmsg = "<font color='green'>Song Updated</font>";
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

$qry = "SELECT song_master_extension.*, system_lang_code_master.name as lname FROM song_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE song_id = ".$_SESSION["songid"];
$songs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$song = mysqli_fetch_assoc($songs);

if ($_SESSION["editlsong"])
{
	$qry = "SELECT song_master_extension.*, system_lang_code_master.name as lname FROM song_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE song_master_extension.id = ".$_SESSION["editlsong"];
	//echo $qry."<BR>";
	$songls = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songl = mysqli_fetch_assoc($songls);
}


?>
<table width="98%">
	<tr>
		<td>
			<form name="add_song_ext" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["editlsong"]) {?>
				<input type="hidden" name="editsonglinfo" value="1">
			<?php } else { ?>
				<input type="hidden" name="addsonglinfo" value="1">
			<?php } ?>
			<table>
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td>
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<?php if ($_SESSION["editlsong"]) {?>
							<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $songl["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemaster["id"]; ?>"><?php echo $codemaster["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
					<?php if ($usersongmsg) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
		  			<td align="right"><strong>Song Name: </strong></td>
				    <td><input type="text" name="name" size="40" value="<?php echo $songl["name"]; ?>"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Description: </strong></td>
					<td><textarea cols="32" rows="2" name="description"><?php echo $songl["description"]; ?></textarea></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Lyrics: </strong><br /><a href="songs/song_lyrics.php" title="Type Lyrics" rel="gb_page_center[780, 550]">open lyrics</a></td>
					<td align="left"><textarea cols="40" rows="2" name="lyrics"><?php echo $songl["lyrics"]; ?></textarea>	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Highlight: </strong></td>
					<td><textarea cols="32" rows="2" name="highlight"><?php echo $songl["highlight"]; ?></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if ($_SESSION["editlsong"]) {?>
						<input type="submit" value="Update Song Language Info"><input type="button" value="New Language" onclick="javascript:location.href='admin_add_movie.php?newsongl=1';" />
					<?php } else { ?>
						<input type="submit" value="Add Song Language Info">
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>
		</td>
		<td valign="top">
			<h5><font color="green">Song <?php echo $_SESSION["songnumber"]; ?><?php if ($_SESSION["songname"]){ echo " - ".$_SESSION["songname"]; } ?></font></h5>
			<table width="98%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#000099">
					<td align="center"><strong><font style="color:#FFFFFF">Language</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Song Name</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Description</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $song["lname"]; ?></td>
					<td><?php echo $song["name"]; ?></td>
					<td><?php echo $song["description"]; ?></td>
					<td align="center"><a href="admin_add_movie.php?editlsong=<?php echo $song["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="admin_add_movie.php?deletelsong=<?php echo $song["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "#33FFFF")
				{
					$bgcolor = "WHITE";
				} else {
					$bgcolor = "#33FFFF";
				}
				} while ($song = mysqli_fetch_assoc($songs)) ;?>
			</table>
		</td>
	</tr>
</table>
<?php } else { ?>
<table>
	<tr>
		<td><h3>Add or Choose Song First</h3></td>
	</tr>
</table>
<?php } ?>