<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

//print_r($_POST);
//echo "<BR>";

if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
}
else
{
	$movie_id = $_POST["movie_id"];
}

if (isset($_POST["addlocation"]))
{
	$data["movie_id"] = $movie_id;
	$data["location_id"] = $_POST["location_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_location", $data);
}

if (isset($_POST["modifylocation"]))
{
	$data["location_id"] = $_POST["location_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["locid"];
	modify_record("movie_location", $data, $where);
}


if (isset($_REQUEST["deletelocation"]))
{
	delete_record_secondary("movie_location", $_REQUEST["deletelocation"], "id");
}

$qry = "SELECT * FROM location_master order by name";
$locations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$location = mysqli_fetch_assoc($locations);

	
if ($movie_id) 
{
		
	$qry = "SELECT movie_location.*, location_master.name FROM movie_location INNER JOIN location_master ON (movie_location.location_id = location_master.id) WHERE movie_location.movie_id = ".$movie_id;
	$clocations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$clocation = mysqli_fetch_assoc($clocations);
	
	if (isset($_REQUEST["locid"]))
	{
		$qry = "SELECT movie_location.* FROM movie_location WHERE movie_location.id = ".$_REQUEST["locid"];
		//echo $qry."<BR>";
		$mlocations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mlocation = mysqli_fetch_assoc($mlocations);
	}
}

if ($movie_id)
{
	$qry = "SELECT id, name FROM movie_master where id = ". $movie_id; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
?>
	You're Editing: <b><?php echo $movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<a href="../admin_view_movie.php?movie_id=<?php echo $movie_id; ?>">Go back to Movies</a>

<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["locid"])) { ?>
				<input type="hidden" value="1" name="modifylocation">
			<?php } else { ?>
				<input type="hidden" value="1" name="addlocation">
			<?php } ?>

			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Location:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="location_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $location["id"]; ?>" 
							<?php if (isset($mlocation["location_id"])&&($location["id"] == $mlocation["location_id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $location["name"]; ?></option>
							<?php } while ($location = mysqli_fetch_assoc($locations)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>

					<?php if (isset($_REQUEST["locid"])) { ?>
						<td><input type="submit" value="Modify Location">&nbsp;&nbsp;
						<input type="button" value="New Location" onclick="javascript:location.href='location_new.php?newloc=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Movie Location"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($clocation) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Location</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $clocation["name"]; ?></td>
					<td><a href="location_new.php?locid=<?php echo $clocation["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="location_new.php?deletelocation=<?php echo $clocation["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($clocation = mysqli_fetch_assoc($clocations)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Locations</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
