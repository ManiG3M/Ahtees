<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_REQUEST["deletelsong"]))
{
	delete_record_secondary("song_master_extension", $_REQUEST["deletelsong"], "id");
}

if (isset($_POST["addsonglinfo"])) 
{
	unset($_POST["addsonglinfo"]);
	$_POST["song_id"] = $_REQUEST["song_id"];
	add_record("song_master_extension", $_POST);
	$usersongmsg = "<font color='green'>New Song Info Added</font>";
}

if (isset($_POST["editsonglinfo"])) 
{
	unset($_POST["editsonglinfo"]);
	$where = "id = ".$_REQUEST["editlsong"];
	modify_record("song_master_extension", $_POST, $where);
	$usersongmsg = "<font color='green'>Song Updated</font>";
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

$qry = "SELECT song_master_extension.*, system_lang_code_master.name as lname FROM song_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE song_id = ".$_REQUEST["song_id"];
$songs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$song = mysqli_fetch_assoc($songs);

if (isset($_REQUEST["editlsong"]))
{
	$qry = "SELECT song_master_extension.*, system_lang_code_master.name as lname FROM song_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE song_master_extension.id = ".$_REQUEST["editlsong"];
	//echo $qry."<BR>";
	$songls = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songl = mysqli_fetch_assoc($songls);
}

if (isset($_REQUEST["movie_id"]))
{
	$qry = "SELECT id, name FROM movie_master where id = ". $_REQUEST["movie_id"]; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
	echo "You're Editing: <b>". $movie["name"] ."</b>"; 
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin_view_movie.php?movie_id=<?php echo $_REQUEST["movie_id"]; ?>">Go back to Movies</a>

<?php
if (isset($_REQUEST["song_id"]))
{
	echo "Song Name: ". $song["name"];
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../admin_add_song_new.php?movie_id=<?php echo $_REQUEST["movie_id"]; ?>"> Go Back to Songs</a>

<table width="98%">
	<tr>
		<td>
			<form name="add_song_ext" enctype="multipart/form-data" method="post">
			<?php if (isset($_REQUEST["editlsong"])) {?>
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
						<?php if ($_REQUEST["editlsong"]) {?>
							<option value="<?php echo $codemaster["id"]; ?>"
							 <?php if ($codemaster["id"] == $songl["system_lang_code_id"]) { ?>
							 selected
							 <?php } ?>>
							 <?php echo $codemaster["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemaster["id"]; ?>"><?php echo $codemaster["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
					<?php if (isset($usersongmsg)) { ?><?php echo "&nbsp;&nbsp;".$usersongmsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
		  			<td align="right"><strong>Song Name: </strong></td>
				    <td>
				    <?php if(isset($songl["name"])) {?> 
				    	 <input type="text" name="name" size="40" value="<?php echo $songl["name"]; ?>"/>
				    <?php } else {?>
				    	 <input type="text" name="name" size="40" value=""/>
				    <?php } ?>
				   </td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Description: </strong></td>
					<td>
					<?php if(isset($songl["description"])) {?>
						<textarea cols="32" rows="2" name="description"><?php echo $songl["description"]; ?></textarea>
					<?php } else {?>
					<textarea cols="32" rows="2" name="description"></textarea>
					<?php }?>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Lyrics: </strong></td>
					<td align="left">
					<?php if(isset($songl["lyrics"])) {?>
						<textarea cols="90" rows="30" name="lyrics"><?php echo $songl["lyrics"]; ?></textarea>
					<?php } else {?>
						<textarea cols="90" rows="30" name="lyrics"></textarea>
					<?php } ?>
						</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Highlight: </strong></td>
					<td>
					<?php if(isset($songl["highlight"])) {?>
						<textarea cols="32" rows="2" name="highlight"><?php echo $songl["highlight"]; ?></textarea>
					<?php } else {?>
						<textarea cols="32" rows="2" name="highlight"></textarea>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if (isset($_REQUEST["editlsong"])) {?>
						<input type="submit" value="Update Song Language Info"><input type="button" value="New Language" onclick="javascript:location.href='songex1_new.php?newsongl=1&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>';" />
					<?php } else { ?>
						<input type="submit" value="Add Song Language Info">
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>
		</td>
		<td valign="top">
			<h5><font color="green">Song <?php echo isset($_REQUEST["songnumber"]); ?><?php if (isset($_REQUEST["songname"])){ echo " - ".$_REQUEST["songname"]; } ?></font></h5>
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
					<td align="center"><a href="songex1_new.php?editlsong=<?php echo $song["id"]; ?>&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>">edit</a>&nbsp;&nbsp;<a href="songex1_new.php?deletelsong=<?php echo $song["id"]; ?>&song_id=<?php echo $_REQUEST["song_id"]; ?>&movie_id=<?php echo $_REQUEST["movie_id"]; ?>">delete</a></td>
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
