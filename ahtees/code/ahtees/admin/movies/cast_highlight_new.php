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

if (isset($_POST["addcasthighlight"]))
{
	$data["movie_id"] = $movie_id;
	$data["customer_id"] = $_POST["customer_id"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["highlight"] = $_POST["highlight"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast_highlights", $data);
}

if (isset($_POST["modifycasthighlight"]))
{
	$data["customer_id"] = $_POST["customer_id"];
	$data["highlight"] = $_POST["highlight"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["mcasthid"];
	modify_record("movie_cast_highlights", $data, $where);
}


if (isset($_REQUEST["deletecasth"]))
{
	delete_record_secondary("movie_cast_highlights", $_REQUEST["deletecasth"], "id");
}

$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, movie_role_type_master.description FROM movie_cast INNER JOIN customer_master ON (customer_master.customer_id = movie_cast.customer_id) INNER JOIN movie_role_type_master ON (movie_role_type_master.id = movie_cast.role_type_id) WHERE movie_cast.movie_id = ".$movie_id;
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

if ($movie_id) 
{
	$qry = "SELECT movie_cast_highlights.*, customer_master.first_name, customer_master.last_name, customer_master.star_name, system_lang_code_master.name as langname , movie_role_type_master.description as role_name FROM movie_cast_highlights , customer_master, system_lang_code_master , movie_cast, movie_role_type_master WHERE movie_cast_highlights.movie_id = ". $movie_id ." AND customer_master.customer_id = movie_cast_highlights.customer_id AND system_lang_code_master.id = movie_cast_highlights.system_lang_code_id AND movie_cast.movie_id = movie_cast_highlights.movie_id AND movie_cast.customer_id = movie_cast_highlights.customer_id AND movie_role_type_master.id = movie_cast.role_type_id ORDER BY customer_master.star_name";
	$ccasths = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccasth = mysqli_fetch_assoc($ccasths);
	
	if (isset($_REQUEST["mcasthid"]))
	{
		$qry = "SELECT movie_cast_highlights.* FROM movie_cast_highlights WHERE movie_cast_highlights.id = ".$_REQUEST["mcasthid"];
		$mchcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mchcast = mysqli_fetch_assoc($mchcasts);
	}
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

if (isset($movie_id))
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
			<?php if (isset($_REQUEST["mcasthid"])) { ?>
				<input type="hidden" value="1" name="modifycasthighlight">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcasthighlight">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Cast:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" 
							<?php if (isset($mchcast["customer_id"])&&($mchcast["customer_id"] == $customer["customer_id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["description"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" 
						<?php if (isset($mchcast["system_lang_code_id"])&&($codemaster["id"] == $mchcast["system_lang_code_id"])) { ?>
						selected
						<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Highlight:</strong>&nbsp;</td>
					<td colspan="3">
					<?php if(isset($mchcast["highlight"])) { ?>
						<textarea name="highlight" cols="40" rows="4"><?php echo $mchcast["highlight"]; ?></textarea>
					<?php } else { ?>
						<textarea name="highlight" cols="40" rows="4"></textarea>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					
					<?php if (isset($_REQUEST["mcasthid"])) { ?>
						<td><input type="submit" value="Modify Cast Highlight">&nbsp;&nbsp;
						<input type="button" value="New Cast Highlight" onclick="javascript:location.href='cast_highlight_new.php?newcasthigh=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast Highlight"></td>
					<?php } ?></td>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($ccasth)) {?>
			<table>
				<tr bgcolor="#999999">
					<td><strong>Cast</strong></td>
					<td><strong>Role</strong></td>
					<td><strong>Language</strong></td>
					<td><strong>Highlight</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccasth["star_name"]; ?></td>
					<td><?php echo $ccasth["role_name"]; ?></td>
					<td><?php echo $ccasth["langname"]; ?></td>
					<td><?php echo $ccasth["highlight"]; ?></td>
					<td><a href="cast_highlight_new.php?mcasthid=<?php echo $ccasth["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="cast_highlight_new.php?deletecasth=<?php echo $ccasth["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccasth = mysqli_fetch_assoc($ccasths)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Cast Highlights</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
