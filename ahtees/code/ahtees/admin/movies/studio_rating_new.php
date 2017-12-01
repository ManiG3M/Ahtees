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


if (isset($_POST["addstudiorating"]))
{
	$data["movie_id"] = $movie_id;
	$data["studio_id"] = $_POST["studio_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_studio_rating", $data);
}

if (isset($_POST["modifystudiorating"]))
{

	$data["studio_id"] = $_POST["studio_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["mstudiorid"];
	modify_record("movie_studio_rating", $data, $where);
}

if (isset($_REQUEST["deletestudiorating"]))
{
	delete_record_secondary("movie_studio_rating", $_REQUEST["deletestudiorating"], "id");
}

$qry = "SELECT movie_studio.*, studio_master.name FROM movie_studio INNER JOIN studio_master ON (studio_master.id = movie_studio.studio_id) WHERE movie_studio.movie_id = ".$movie_id;
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($movie_id) 
{
		
	$qry = "SELECT movie_studio_rating.*, studio_master.name, studio_ratings.rating FROM movie_studio_rating INNER JOIN studio_master ON (movie_studio_rating.studio_id = studio_master.id) INNER JOIN studio_ratings ON (studio_ratings.id = movie_studio_rating.rating_id) WHERE movie_studio_rating.movie_id = ".$movie_id;
	$ccastrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccastrate = mysqli_fetch_assoc($ccastrates);
	
	if (isset($_REQUEST["mstudiorid"]))
	{
		$qry = "SELECT movie_studio_rating.* FROM movie_studio_rating WHERE movie_studio_rating.id = ".$_REQUEST["mstudiorid"];
		//echo $qry."<BR>";
		$mcrcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mcrcast = mysqli_fetch_assoc($mcrcasts);
	}
}

$qry = "SELECT * FROM studio_ratings";
$ratings = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rating = mysqli_fetch_assoc($ratings);

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
			<form name="addstudio" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["mstudiorid"])) { ?>
				<input type="hidden" value="1" name="modifystudiorating">
			<?php } else { ?>
				<input type="hidden" value="1" name="addstudiorating">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Studio:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="studio_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["studio_id"]; ?>"
							 <?php if (isset($mcrcast["studio_id"])&&($mcrcast["studio_id"] == $customer["studio_id"])) { ?>
							 selected
							 <?php } ?>>
							 <?php echo $customer["name"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Rating:</strong></td>
		<td>
		<select name="rating_id">
			<option value="0">Select One...</option>
			<?php do {  ?>
				<option value="<?php echo $rating["id"]; ?>" 
				<?php if (isset($mcrcast["rating_id"])&&($mcrcast["rating_id"] == $rating["id"])) {?>
				selected
				<?php } ?>>
				<?php echo $rating["rating"]; ?></option>
			<?php } while ($rating = mysqli_fetch_assoc($ratings));?>
		</select>
		</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["mstudiorid"])) { ?>
						<td><input type="submit" value="Modify Studio Rating">&nbsp;&nbsp;
						<input type="button" value="New Studio Rating" onclick="javascript:location.href='studio_rating_new.php?newstudior=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Studio Rating"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccastrate) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Studio</strong></td>
					<td><strong>Rating</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccastrate["name"]; ?></td>
					<td><?php echo $ccastrate["rating"]; ?></td>
					<td><a href="studio_rating_new.php?mstudiorid=<?php echo $ccastrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="studio_rating_new.php?deletestudiorating=<?php echo $ccastrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccastrate = mysqli_fetch_assoc($ccastrates)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Studio Rating</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
