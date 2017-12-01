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

if (isset($_POST["addcastrating"]))
{
	$data["movie_id"] = $movie_id;
	$data["customer_id"] = $_POST["customer_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast_rating", $data);
}

if (isset($_POST["modifycastrating"]))
{

	$data["customer_id"] = $_POST["customer_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["mcastcrid"];
	modify_record("movie_cast_rating", $data, $where);
}

if (isset($_REQUEST["deletecastrating"]))
{
	delete_record_secondary("movie_cast_rating", $_REQUEST["deletecastrating"], "id");
}

$qry = "SELECT movie_cast.*, customer_master.star_name, customer_master.first_name, customer_master.last_name, movie_role_type_master.description FROM movie_cast, customer_master , movie_role_type_master WHERE movie_cast.movie_id = ".$movie_id . " AND customer_master.customer_id = movie_cast.customer_id AND movie_role_type_master.id = movie_cast.role_type_id ORDER BY customer_master.star_name";
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($movie_id) 
{
	$qry = "SELECT movie_cast_rating.*, customer_master.star_name, customer_master.first_name, customer_master.last_name, customer_rating_master.description , movie_role_type_master.description as role_name FROM movie_cast_rating,customer_master,customer_rating_master ,movie_cast, movie_role_type_master WHERE movie_cast_rating.movie_id = ". $movie_id ." AND customer_master.customer_id = movie_cast_rating.customer_id AND customer_rating_master.id = movie_cast_rating.rating_id AND movie_cast.movie_id = movie_cast_rating.movie_id AND movie_cast.customer_id = movie_cast_rating.customer_id AND movie_role_type_master.id = movie_cast.role_type_id ORDER BY customer_master.star_name";
	$ccastrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccastrate = mysqli_fetch_assoc($ccastrates);
	
	if (isset($_REQUEST["mcastcrid"]))
	{
		$qry = "SELECT movie_cast_rating.* FROM movie_cast_rating WHERE movie_cast_rating.id = ".$_REQUEST["mcastcrid"];
		//echo $qry."<BR>";
		$mcrcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mcrcast = mysqli_fetch_assoc($mcrcasts);
	}
}

$qry = "SELECT * FROM customer_rating_master";
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
			<form name="addaward" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["mcastcrid"])) { ?>
				<input type="hidden" value="1" name="modifycastrating">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastrating">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Cast:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" 
							<?php if (isset($mcrcast["customer_id"])&&($mcrcast["customer_id"] == $customer["customer_id"]) ){ ?>
							selected
							<?php } ?>>
							<?php echo $customer["star_name"] .", ".$customer["description"]; ?></option>
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
				<?php echo $rating["description"]; ?></option>
			<?php } while ($rating = mysqli_fetch_assoc($ratings));?>
		</select>
		</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["mcastcrid"])) { ?>
						<td><input type="submit" value="Modify Cast Rating">&nbsp;&nbsp;
						<input type="button" value="New Cast Rating" onclick="javascript:location.href='cast_rating_new.php?newcastcr=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast Rating"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccastrate) {?>
			<table>
				<tr bgcolor="#999999">
					<td><strong>Cast</strong></td>
					<td><strong>Role</strong></td>
					<td><strong>Rating</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccastrate["star_name"]; ?></td>
					<td><?php echo $ccastrate["role_name"]; ?></td>
					<td><?php echo $ccastrate["description"]; ?></td>
					<td><a href="cast_rating_new.php?mcastcrid=<?php echo $ccastrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="cast_rating_new.php?deletecastrating=<?php echo $ccastrate["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
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
			<center> <h3> No Cast Rating</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
