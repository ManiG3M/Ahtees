<?php if ($_SESSION["songid"]) { 

if ($_REQUEST["newsongr"])
{
	unset($_SESSION["editrsong"]);
}

if ($_REQUEST["editrsong"])
{
	$_SESSION["editrsong"] = $_REQUEST["editrsong"];
}

if ($_REQUEST["deletersong"])
{
	delete_record_secondary("song_review", $_REQUEST["deletersong"], "id");
}

if ($_POST["addsongrinfo"]) 
{
	unset($_POST["addsongrinfo"]);
	$_POST["song_id"] = $_SESSION["songid"];
	$_POST["user_id"] = $_SESSION["userid"];
	add_record("song_review", $_POST);
	$usersongmsg = "<font color='green'>New Song Review Added</font>";
}

if ($_POST["editsongrinfo"]) 
{
	unset($_POST["editsongrinfo"]);
	$where = "id = ".$_SESSION["editrsong"];
	modify_record("song_review", $_POST, $where);
	$usersongmsg = "<font color='green'>Review Updated</font>";
}

$qry = "SELECT song_review.*, system_lang_code_master.name as lname, user_master.username FROM song_review INNER JOIN system_lang_code_master ON (system_lang_code_master.id = song_review.system_lang_code_id) INNER JOIN user_master ON (user_master.id = song_review.user_id) WHERE song_id = ".$_SESSION["songid"];
$songrs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$songr = mysqli_fetch_assoc($songrs);

$qry = "SELECT * FROM user_master";
$usersrws = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$usersrw = mysqli_fetch_assoc($usersrws);

$qry = "SELECT * FROM system_lang_code_master";
$codemasterrs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemasterr = mysqli_fetch_assoc($codemasterrs);

if ($_SESSION["editrsong"])
{
	$qry = "SELECT song_review.* FROM song_review WHERE song_review.id = ".$_SESSION["editrsong"];
	//echo $qry."<BR>";
	$songers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songer = mysqli_fetch_assoc($songers);
}

?>

<table width="98%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<form name="add_song_review" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["editrsong"]) {?>
				<input type="hidden" name="editsongrinfo" value="1">
			<?php } else { ?>
				<input type="hidden" name="addsongrinfo" value="1">
			<?php } ?>
			<table>
				
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td>
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<?php if ($_SESSION["editrsong"]) {?>
							<option value="<?php echo $codemasterr["id"]; ?>" <?php if ($codemasterr["id"] == $songer["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemasterr["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemasterr["id"]; ?>"><?php echo $codemasterr["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemasterr = mysqli_fetch_assoc($codemasterrs)); ?>
					</select><?php if ($usersongmsg) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Review Text:</strong></td>
					<td><textarea cols="35" rows="8" name="review_text"><?php echo $songer["review_text"]; ?></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if ($_SESSION["editrsong"]) {?>
						<input type="submit" value="Update Song Review Info"><input type="button" value="New Review" onclick="javascript:location.href='admin_add_movie.php?newsongr=1';" />
					<?php } else { ?>
						<input type="submit" value="Add Review" />
					<?php } ?>
					</td>
				</tr>
			</table>
		</td>
		</form>
		<td valign="top">
		<h5><font color="green">Song <?php echo $_SESSION["songnumber"]; ?><?php if ($_SESSION["songname"]){ echo " - ".$_SESSION["songname"]; } ?></font></h5>
			<table width="100%">	
				<tr bgcolor="#000099">
					<td align="center"><strong><font style="color:#FFFFFF">User</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Language</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Review Text</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $songr["username"]; ?></td>
					<td><?php echo $songr["lname"]; ?></td>
					<td><?php echo $songr["review_text"]; ?></td>
					<td align="center"><a href="admin_add_movie.php?editrsong=<?php echo $songr["id"]; ?>">edit/view</a>&nbsp;&nbsp;<a href="admin_add_movie.php?deletersong=<?php echo $songr["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "#33FFFF")
				{
					$bgcolor = "WHITE";
				} else {
					$bgcolor = "#33FFFF";
				}
				} while ($songr = mysqli_fetch_assoc($songrs)) ;?>
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