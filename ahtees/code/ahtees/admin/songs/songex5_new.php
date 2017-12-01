<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

//print_r($_POST);

if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
	$song_id = $_REQUEST["song_id"];
} else {
	$movie_id = $_POST["movie_id"];
	$song_id = $_POST["song_id"];
}

if (isset($_POST["addcastsinger"]))
{
	$data["song_id"] = $song_id;
	$data["customer_id"] = $_POST["customer_id"];
	add_record("song_lyricist", $data);
}

if (isset($_POST["modifycastsinger"]))
{
	$data["song_id"] = $song_id;
	$data["customer_id"] = $_POST["customer_id"];
	$where = "id= ".$_SESSION["mcastsingerid"];
	modify_record("song_lyricist", $data, $where);
}

if (isset($_REQUEST["deletesinger"]))
{
	delete_record_secondary("song_lyricist", $_REQUEST["deletesinger"], "id");
}

if (isset($_POST["castsearchsinger"])) 
{
	$qry = "SELECT customer_master.*, talent_master.description FROM customer_master, talent_master WHERE customer_master.status = 1 AND (customer_master.first_name LIKE '%".$_POST["castsearchsinger"]."%' OR customer_master.last_name LIKE '%".$_POST["castsearchsinger"]."%' OR customer_master.star_name LIKE '%".$_POST["castsearchsinger"]."%') AND customer_master.primary_skill_id = talent_master.id order by customer_master.star_name";
	$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$customer = mysqli_fetch_assoc($customers);
}

if ($movie_id) 
{
	$qry = "SELECT song_lyricist.*, customer_master.first_name, customer_master.last_name, customer_master.star_name FROM song_lyricist,customer_master WHERE song_lyricist.song_id = ".$song_id ." AND song_lyricist.customer_id = customer_master.customer_id";
	$ccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccast = mysqli_fetch_assoc($ccasts);
	
	if (isset($_SESSION["mcastsingerid"]))
	{
		$qry = "SELECT song_lyricist.* FROM song_lyricist WHERE song_lyricist.id = ".$_SESSION["mcastsingerid"];
		$mccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mccast = mysqli_fetch_assoc($mccasts);
	}
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

<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<table cellpadding="0" cellspacing="1" border="0" width="100%">
				<form name="searchcastformsinger" enctype="multipart/form-data" method="post" action="songex5_new.php">
				<input type="hidden" name="movie_id" value=<?php echo $movie_id; ?>>	
				<input type="hidden" name="song_id" value=<?php echo $song_id; ?>>	
				<tr>
					<td align="right"><strong>Search Cast:</strong>&nbsp;</td>
					<td >
						<?php if(isset($_POST["castsearchsinger"])) {?>
							<input type="text" name="castsearchsinger" value="<?php echo $_POST["castsearchsinger"]; ?>"/>&nbsp;&nbsp;
						<?php } else {?>
							<input type="text" name="castsearchsinger" value=""/>&nbsp;&nbsp;
						<?php }?>
					
						<input type="submit" value="Search" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
				</form>

				<form name="addaward" enctype="multipart/form-data" method="post">
				<input type="hidden" name="movie_id" value=<?php echo $movie_id; ?>>	
				<input type="hidden" name="song_id" value=<?php echo $song_id; ?>>	
			<?php if (isset($_SESSION["mcastsingerid"])) { ?>
				<input type="hidden" value="1" name="modifycastsinger">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastsinger">
			<?php } ?>
				<tr>
					<td align="right"><strong>Cast Name:</strong>&nbsp;</td>
					<td >
						<?php if (isset($customer)) { ?>
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php 
							if ($customer)
							{
							do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>"
							 <?php if (isset($mccast["customer_id"])&&($mccast["customer_id"] == $customer["customer_id"])) {?>
							 selected
							 <?php } ?>>
							 <?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["star_name"] ." (" . $customer["description"] .")"; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers));
							} ?>
						</select>
						<?php } else { ?>
						<font color="red"><strong>No Lyricist Found, Try A New Search</strong></font>
						<?php } ?>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_SESSION["mcastsingerid"])) { ?>
						<td><input type="submit" value="Modify Cast">&nbsp;&nbsp;<input type="button" value="New Lyricist" onclick="javascript:location.href='songex5_new.php?newsinger=1&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $song_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Lyricist"></td>
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
					<td><a href="songex5_new.php?deletesinger=<?php echo $ccast["id"]; ?>&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $song_id; ?>">delete</a></td>
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
			<center> <h3> No Lyricist </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
