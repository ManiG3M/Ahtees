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

if (isset($_POST["adddetail"]))
{
	$data["movie_id"] = $movie_id;
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["text_content"] = $_POST["text_content"];
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_text_content", $data);
}

if (isset($_POST["modifydetail"]))
{
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["text_content"] = $_POST["text_content"];
	$data["content_type_id"] = $_POST["content_type_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["drid"];
	modify_record("movie_text_content", $data, $where);
}

if (isset($_REQUEST["deleted"]))
{
	delete_record_secondary("movie_text_content", $_REQUEST["deleted"], "id");
}

if ($movie_id) 
{
	$qry = "SELECT a.*, b.name as langname , c.description as description FROM movie_text_content a, system_lang_code_master b, text_type_master c WHERE a.movie_id = " . $movie_id . " AND b.id = a.system_lang_code_id AND c.id = a.content_type_id order by description";
	$cdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdreview = mysqli_fetch_assoc($cdreviews);
	
	if (isset($_REQUEST["drid"]))
	{
		$qry = "SELECT movie_text_content.* FROM movie_text_content WHERE movie_text_content.id = ".$_REQUEST["drid"];
		//echo $qry."<BR>";
		$mdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdreview = mysqli_fetch_assoc($mdreviews);
	}
}

$qry = "SELECT * FROM system_lang_code_master order by name";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

$ttqry = "SELECT * FROM text_type_master order by description";
$ttmasters = mysqli_query($connDB,$ttqry) or die('Query failed: ' . mysqli_error($connDB)); 
$ttmaster = mysqli_fetch_assoc($ttmasters);
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
				<input type="hidden" value="1" name="modifydetail">
			<?php } else { ?>
				<input type="hidden" value="1" name="adddetail">
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
					<td align="right"><strong>Type: </strong></td>
					<td colspan="3">
					<select name="content_type_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $ttmaster["id"]; ?>"
						 <?php if (isset($mdreview["content_type_id"])&&($ttmaster["id"] == $mdreview["content_type_id"])) { ?>
						 selected
						 <?php } ?>>
						 <?php echo $ttmaster["description"]; ?></option>
					<?php } while ($ttmaster = mysqli_fetch_assoc($ttmasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Text Content:</strong>&nbsp;</td>
					<td colspan="3">
					<?php if(isset($mdreview["text_content"])) { ?>
						<textarea name="text_content" rows="5" cols="40"><?php echo $mdreview["text_content"]; ?></textarea>
					<?php } else { ?>
					<textarea name="text_content" rows="5" cols="40"></textarea>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>

					<?php if (isset($_REQUEST["drid"])) { ?>
						<td><input type="submit" value="Modify Text Content">&nbsp;&nbsp;
						<input type="button" value="New Text Content" onclick="javascript:location.href='text_content_new.php?newdetail=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Text Conten"></td>
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
					<td><strong>Type</strong></td>
					<td><strong>Text</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdreview["langname"]; ?></td>
					<td><?php echo $cdreview["description"]; ?></td>

					<?php 
					if (($cdreview["content_type_id"] == 3) || ($cdreview["content_type_id"] == 8))
					{ ?>
						<td><a href="<?php echo $cdreview["text_content"]; ?>" target="_blank"><?php echo $cdreview["text_content"]; ?></a></td>
					<?php } else { ?>
						<td><?php echo $cdreview["text_content"]; ?></td>
					<?php } ?>
					<td><a href="text_content_new.php?drid=<?php echo $cdreview["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a><br /><a href="text_content_new.php?deleted=<?php echo $cdreview["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
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
			<center> <h3> No Text Content</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
