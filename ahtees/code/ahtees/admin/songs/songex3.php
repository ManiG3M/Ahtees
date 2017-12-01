<?php if ($_SESSION["songid"]) { 

if ($_REQUEST["newsongrate"])
{
	unset($_SESSION["editratesong"]);
}

if ($_REQUEST["editratesong"])
{
	$_SESSION["editratesong"] = $_REQUEST["editratesong"];
}

if ($_REQUEST["deleteratesong"])
{
	delete_record_secondary("song_rating", $_REQUEST["deleteratesong"], "id");
}

if ($_POST["addsongrateinfo"]) 
{
	unset($_POST["addsongrateinfo"]);
	$_POST["song_id"] = $_SESSION["songid"];
	$_POST["user_id"] = $_SESSION["userid"];
	add_record("song_rating", $_POST);
	$usersongmsg = "<font color='green'>New Song Rating Added</font>";
}

if ($_POST["editsongrateinfo"]) 
{
	unset($_POST["editsongrateinfo"]);
	$where = "id = ".$_SESSION["editratesong"];
	modify_record("song_rating", $_POST, $where);
	$usersongmsg = "<font color='green'>Rating Updated</font>";
}

$qry = "SELECT song_rating.*, user_master.username FROM song_rating INNER JOIN user_master ON (user_master.id = song_rating.user_id) WHERE song_rating.song_id = ".$_SESSION["songid"];
$songrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$songrate = mysqli_fetch_assoc($songrates);

$qry = "SELECT * FROM user_master";
$usersrs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$usersr = mysqli_fetch_assoc($usersrs);


if ($_SESSION["editratesong"])
{
	$qry = "SELECT song_rating.* FROM song_rating WHERE song_rating.id = ".$_SESSION["editratesong"];
	$songeratefs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songeratef = mysqli_fetch_assoc($songeratefs);
}

?>

<table width="98%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<form name="add_song_review" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["editratesong"]) {?>
				<input type="hidden" name="editsongrateinfo" value="1">
			<?php } else { ?>
				<input type="hidden" name="addsongrateinfo" value="1">
			<?php } ?>
			<table>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td align="right"><strong>Rating: </strong></td>
					<td>
					<select name="rating">
						<option value="0">Select...</option>
						<option value="1" <?php if ($songeratef["rating"] == "1") { ?>selected<?php } ?>>One</option>
						<option value="2" <?php if ($songeratef["rating"] == "2") { ?>selected<?php } ?>>Two</option>
						<option value="3" <?php if ($songeratef["rating"] == "3") { ?>selected<?php } ?>>Three</option>
						<option value="4" <?php if ($songeratef["rating"] == "4") { ?>selected<?php } ?>>Four</option>
						<option value="5" <?php if ($songeratef["rating"] == "5") { ?>selected<?php } ?>>Five</option>
					</select><?php if ($usersongmsg) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if ($_SESSION["editratesong"]) {?>
						<input type="submit" value="Update Rating"><input type="button" value="New Rating" onclick="javascript:location.href='admin_add_movie.php?newsongrate=1';" />
					<?php } else { ?>
						<input type="submit" value="Add Rating" />
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
					<td align="center"><strong><font style="color:#FFFFFF">Rating</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $songrate["username"]; ?></td>
					<td><?php echo $songrate["rating"]; ?></td>
					<td align="center"><a href="admin_add_movie.php?editratesong=<?php echo $songrate["id"]; ?>">edit/view</a>&nbsp;&nbsp;<a href="admin_add_movie.php?deleteratesong=<?php echo $songrate["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "#33FFFF")
				{
					$bgcolor = "WHITE";
				} else {
					$bgcolor = "#33FFFF";
				}
				} while ($songrate = mysqli_fetch_assoc($songrates)) ;?>
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