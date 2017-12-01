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

if (isset($_POST["addstudio"]))
{
	$data["movie_id"] = $movie_id;
	$data["studio_id"] = $_POST["studio_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_studio", $data);
}

if (isset($_POST["modifystudio"]))
{
	$data["studio_id"] = $_POST["studio_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["studioid"];
	modify_record("movie_studio", $data, $where);
}

if (isset($_REQUEST["deletestudiol"]))
{
	delete_record_secondary("movie_studio", $_REQUEST["deletestudiol"], "id");
}

$qry = "SELECT * FROM studio_master order by name";
$studios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$studio = mysqli_fetch_assoc($studios);

	
if ($movie_id) 
{
		
	$qry = "SELECT movie_studio.*, studio_master.name, studio_master.city, studio_master.state, studio_master.country FROM movie_studio INNER JOIN studio_master ON (movie_studio.studio_id = studio_master.id) WHERE movie_studio.movie_id = ".$movie_id;
	$cmoviess = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cmovies = mysqli_fetch_assoc($cmoviess);
	
	if (isset($_REQUEST["studioid"]))
	{
		$qry = "SELECT movie_studio.* FROM movie_studio WHERE movie_studio.id = ".$_REQUEST["studioid"];
		//echo $qry."<BR>";
		$mstudios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mstudio = mysqli_fetch_assoc($mstudios);
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
			<form name="addstudio" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["studioid"])) { ?>
				<input type="hidden" value="1" name="modifystudio">
			<?php } else { ?>
				<input type="hidden" value="1" name="addstudio">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Studio:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="studio_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $studio["id"]; ?>" 
							<?php if (isset($mstudio["studio_id"])&&($studio["id"] == $mstudio["studio_id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $studio["name"]; ?></option>
							<?php } while ($studio = mysqli_fetch_assoc($studios)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["studioid"])) { ?>
						<td><input type="submit" value="Modify Studio">&nbsp;&nbsp;<input type="button" value="New Studio" onclick="javascript:location.href='studio_new.php?newstudio=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Studio"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cmovies) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Studio</strong></td>
					<td><strong>City</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cmovies["name"]; ?></td>
					<td><?php echo $cmovies["city"]; ?></td>
					<td><a href="studio_new.php?studioid=<?php echo $cmovies["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="studio_new.php?deletestudiol=<?php echo $cmovies["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cmovies = mysqli_fetch_assoc($cmoviess)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Studios</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
