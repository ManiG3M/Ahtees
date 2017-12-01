<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_REQUEST["deletersong"]))
{
	delete_record_secondary("song_review", $_REQUEST["deletersong"], "id");
}

if (isset($_POST["addsongrinfo"])) 
{
	unset($_POST["addsongrinfo"]);
	$_POST["song_id"] = $_REQUEST["song_id"];
	add_record("song_review", $_POST);
	$usersongmsg = "<font color='green'>New Song Review Added</font>";
}

if (isset($_POST["editsongrinfo"])) 
{
	unset($_POST["editsongrinfo"]);
	$where = "id = ".$_REQUEST["editrsong"];
	modify_record("song_review", $_POST, $where);
	$usersongmsg = "<font color='green'>Review Updated</font>";
}

//This is the old stupid query
//$qry = "SELECT song_review.*, system_lang_code_master.name as lname, user_master.username FROM song_review INNER JOIN system_lang_code_master// ON (system_lang_code_master.id = song_review.system_lang_code_id) INNER JOIN user_master ON (user_master.id = song_review.user_id) WHERE son//g_id = ".$_REQUEST["song_id"];
//God, I am pissed.....

$qry = "SELECT song_review.*, system_lang_code_master.name as lname FROM song_review,system_lang_code_master WHERE song_review.song_id = ".$_REQUEST["song_id"] . " AND system_lang_code_master.id = song_review.system_lang_code_id";
$songrs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$songr = mysqli_fetch_assoc($songrs);

$qry = "SELECT * FROM system_lang_code_master";
$codemasterrs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemasterr = mysqli_fetch_assoc($codemasterrs);

if (isset($_REQUEST["editrsong"]))
{
	$qry = "SELECT song_review.* FROM song_review WHERE song_review.id = ".$_REQUEST["editrsong"];
	//echo $qry."<BR>";
	$songers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songer = mysqli_fetch_assoc($songers);
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
			<input type="hidden" value="<?php echo $_REQUEST["song_id"]; ?>" name="song_id">
			<?php if (isset($_REQUEST["editrsong"])) {?>
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
						<?php if ($_REQUEST["editrsong"]) {?>
							<option value="<?php echo $codemasterr["id"]; ?>"
							 <?php if ($codemasterr["id"] == $songer["system_lang_code_id"]) { ?>
							 selected
							 <?php } ?>>
							 <?php echo $codemasterr["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemasterr["id"]; ?>"><?php echo $codemasterr["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemasterr = mysqli_fetch_assoc($codemasterrs)); ?>
					</select><?php if (isset($usersongmsg)) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Review Text:</strong></td>
					<?php if(isset($songer["review_text"])) {?> 
						<td><textarea cols="35" rows="8" name="review_text"><?php echo $songer["review_text"]; ?></textarea></td>
					<?php } else {?>
						<td><textarea cols="35" rows="8" name="review_text"></textarea></td>
					<?php }?>
					
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if (isset($_REQUEST["editrsong"])) {?>
						<input type="submit" value="Update Song Review Info">
						<input type="button" value="New Review" onclick="javascript:location.href='songex2_new.php?newsongr=1&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>';" />
					<?php } else { ?>
						<input type="submit" value="Add Review" />
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
					<td align="center"><strong><font style="color:#FFFFFF">Language</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Review Text</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $songr["lname"]; ?></td>
					<td><?php echo $songr["review_text"]; ?></td>
					<td align="center"><a href="songex2_new.php?editrsong=<?php echo $songr["id"]; ?>&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>">edit/view</a>&nbsp;&nbsp;<a href="songex2_new.php?deletersong=<?php echo $songr["id"]; ?>&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>">delete</a></td>
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
