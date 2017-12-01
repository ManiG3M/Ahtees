<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');




if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
}
else
{
	$movie_id = $_POST["movie_id"];
}

if (isset($_POST["adddetailreview"]))
{
	$data["movie_id"] = $movie_id;
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["review_text"] = $_POST["review_text"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_detail_review", $data);
}

if (isset($_POST["modifydetailreview"]))
{
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["review_text"] = $_POST["review_text"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["drid"];
	modify_record("movie_detail_review", $data, $where);
}

if (isset($_REQUEST["deletedreview"]))
{
	delete_record_secondary("movie_detail_review", $_REQUEST["deletedreview"], "id");
}

if ($movie_id) 
{
		
	$qry = "SELECT movie_detail_review.*, system_lang_code_master.name as langname FROM movie_detail_review LEFT JOIN system_lang_code_master ON (movie_detail_review.system_lang_code_id = system_lang_code_master.id) WHERE movie_id = ".$movie_id;
	$cdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdreview = mysqli_fetch_assoc($cdreviews);
	
	if (isset($_REQUEST["drid"]))
	{
		$qry = "SELECT movie_detail_review.* FROM movie_detail_review WHERE movie_detail_review.id = ".$_REQUEST["drid"];
		//echo $qry."<BR>";
		$mdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdreview = mysqli_fetch_assoc($mdreviews);
	}
}
$qry = "SELECT * FROM system_lang_code_master order by name";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);
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
			<?php if (isset($_REQUEST["drid"])) { ?>
				<input type="hidden" value="1" name="modifydetailreview">
			<?php } else { ?>
				<input type="hidden" value="1" name="adddetailreview">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" 
						<?php if (isset($mdreview["system_lang_code_id"])&&($codemaster["id"] == $mdreview["system_lang_code_id"])) { ?>
						selected
						<?php } ?>>
						<?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Review Text:</strong>&nbsp;</td>
					<td colspan="3">
					<?php if(isset($mdreview["review_text"])) { ?>
						<textarea name="review_text" rows="5" cols="40"><?php echo $mdreview["review_text"]; ?></textarea>
					<?php } else { ?>
							<textarea name="review_text" rows="5" cols="40"></textarea>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>

					<?php if (isset($_REQUEST["drid"])) { ?>
						<td><input type="submit" value="Modify Detail Review">&nbsp;&nbsp;
						<input type="button" value="New Detail Review" onclick="javascript:location.href='detail_review_new.php?newdetailreview=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Detailed Review"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cdreview) {?>
			<table>
				<tr bgcolor="#999999">
					<td><strong>Language</strong></td>
					<td><strong>Review Text</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdreview["langname"]; ?></td>
					<td><?php echo $cdreview["review_text"]; ?></td>
					<td><a href="detail_review_new.php?drid=<?php echo $cdreview["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a><br /><a href="detail_review_new.php?deletedreview=<?php echo $cdreview["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cdreview = mysqli_fetch_assoc($cdreviews)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Review Text</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
