<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newloc"])
{
	unset($_SESSION["locid"]);
}

if ($_REQUEST["locid"])
{
	$_SESSION["locid"] = $_REQUEST["locid"];
}

if ($_POST["addlocation"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["location_id"] = $_POST["location_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_location", $data);
}

if ($_POST["modifylocation"])
{
	$data["location_id"] = $_POST["location_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["locid"];
	modify_record("movie_location", $data, $where);
}


if ($_REQUEST["deletelocation"])
{
	delete_record_secondary("movie_location", $_REQUEST["deletelocation"], "id");
}

$qry = "SELECT * FROM location_master";
$locations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$location = mysqli_fetch_assoc($locations);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_location.*, location_master.name FROM movie_location INNER JOIN location_master ON (movie_location.location_id = location_master.id) WHERE movie_location.movie_id = ".$_SESSION["movieid"];
	$clocations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$clocation = mysqli_fetch_assoc($clocations);
	
	if ($_SESSION["locid"])
	{
		$qry = "SELECT movie_location.* FROM movie_location WHERE movie_location.id = ".$_SESSION["locid"];
		//echo $qry."<BR>";
		$mlocations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mlocation = mysqli_fetch_assoc($mlocations);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["locid"]) { ?>
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
							<option value ="<?php echo $location["id"]; ?>" <?php if ($location["id"] == $mlocation["location_id"]) { ?>selected<?php } ?>><?php echo $location["name"]; ?></option>
							<?php } while ($location = mysqli_fetch_assoc($locations)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>

					<?php if ($_SESSION["locid"]) { ?>
						<td><input type="submit" value="Modify Location">&nbsp;&nbsp;<input type="button" value="New Location" onclick="javascript:location.href='admin_add_movie.php?newloc=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Movie Location"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($clocation) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
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
					<td><a href="admin_add_movie.php?locid=<?php echo $clocation["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletelocation=<?php echo $clocation["id"]; ?>">delete</a></td>
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
		</div>
		<?php } else { ?>
			<center> <h3> No Locations</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
