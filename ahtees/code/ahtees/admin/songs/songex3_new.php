<?php
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
	$song_id = $_REQUEST["song_id"];
} else {
	$movie_id = $_POST["movie_id"];
	$song_id = $_POST["song_id"];
}

if (isset($_REQUEST["deleteratesong"]))
{
	delete_record_secondary("song_rating", $_REQUEST["deleteratesong"], "id");
}

if (isset($_POST["addsongrateinfo"])) 
{
	unset($_POST["addsongrateinfo"]);
	unset($_POST["movie_id"]);
	$_POST["song_id"] = $song_id;
	add_record("song_rating", $_POST);
	$usersongmsg = "<font color='green'>New Song Rating Added</font>";
}

if (isset($_POST["editsongrateinfo"])) 
{
	unset($_POST["editsongrateinfo"]);
	unset($_POST["movie_id"]);
	$where = "id = ".$_REQUEST["editratesong"];
	modify_record("song_rating", $_POST, $where);
	$usersongmsg = "<font color='green'>Rating Updated</font>";
}

$qry = "SELECT song_rating.* FROM song_rating WHERE song_rating.song_id = ".$song_id;
$songrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$songrate = mysqli_fetch_assoc($songrates);

if (isset($_REQUEST["editratesong"]))
{
	$qry = "SELECT song_rating.* FROM song_rating WHERE song_rating.id = ".$_REQUEST["editratesong"];
	$songeratefs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songeratef = mysqli_fetch_assoc($songeratefs);
}
if ($_REQUEST["movie_id"])
{
	$qry = "SELECT id, name FROM movie_master where id = ". $_REQUEST["movie_id"]; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
	echo "You're Editing: <b>". $movie["name"] ."</b>"; 
}
if(isset($_REQUEST["song_id"]))
{
	$qry="SELECT name FROM song_master_extension where song_id = ". $_REQUEST['song_id'];
	$songnames=mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB));
	$songname=mysqli_fetch_assoc($songnames);
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin_view_movie.php?movie_id=<?php echo $_REQUEST["movie_id"]; ?>">Go back to Movies</a>

<?php
if (isset($_REQUEST["song_id"]))
{
	echo "Song Name: ". $songname["name"];
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../admin_add_song_new.php?movie_id=<?php echo $_REQUEST["movie_id"]; ?>"> Go Back to Songs</a>

<table width="98%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<form name="add_song_review" enctype="multipart/form-data" method="post">
			<input type="hidden" name="movie_id" value=<?php echo $movie_id; ?>>	
			<input type="hidden" name="song_id" value=<?php echo $song_id; ?>>	
			<?php if (isset($_REQUEST["editratesong"])) {?>
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
						<option value="1" <?php if (isset($songeratef["rating"]) &&($songeratef["rating"]== "1")) { ?>
						selected<?php } ?>>One</option>
						<option value="2" <?php if (isset($songeratef["rating"])&&($songeratef["rating"] == "2")) { ?>
						selected<?php } ?>>Two</option>
						<option value="3" <?php if (isset($songeratef["rating"])&&($songeratef["rating"] == "3")) { ?>
						selected<?php } ?>>Three</option>
						<option value="4" <?php if (isset($songeratef["rating"])&&($songeratef["rating"] == "4")) { ?>
						selected<?php } ?>>Four</option>
						<option value="5" <?php if (isset($songeratef["rating"])&&($songeratef["rating"] == "5")) { ?>
						selected<?php } ?>>Five</option>
					</select><?php if (isset($usersongmsg)) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if (isset($_REQUEST["editratesong"])) {?>
						<input type="submit" value="Update Rating"><input type="button" value="New Rating" onclick="javascript:location.href='songex3_new.php?newsongrate=1&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $song_id; ?>';" />
					<?php } else { ?>
						<input type="submit" value="Add Rating" />
					<?php } ?>
					</td>
				</tr>
			</table>
		</td>
		</form>
		<td valign="top">
		<h5><font color="green">Song <?php echo isset($_REQUEST["songnumber"]); ?><?php if (isset($_REQUEST["songname"])){ echo " - ".$_REQUEST["songname"]; } ?></font></h5>
			<table width="100%">	
				<tr bgcolor="#000099">
					<td align="center"><strong><font style="color:#FFFFFF">Rating</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $songrate["rating"]; ?></td>
					<td align="center"><a href="songex3_new.php?editratesong=<?php echo $songrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $song_id; ?>">edit/view</a>&nbsp;&nbsp;<a href="songex3_new.php?deleteratesong=<?php echo $songrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $song_id; ?>">delete</a></td>
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
