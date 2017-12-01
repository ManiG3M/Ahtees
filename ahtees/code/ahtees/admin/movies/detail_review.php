<?php 
date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newdetailreview"])
{
	unset($_SESSION["drid"]);
}

if ($_REQUEST["drid"])
{
	$_SESSION["drid"] = $_REQUEST["drid"];
}

if ($_POST["adddetailreview"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["review_text"] = $_POST["review_text"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_detail_review", $data);
}

if ($_POST["modifydetailreview"])
{
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["review_text"] = $_POST["review_text"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["drid"];
	modify_record("movie_detail_review", $data, $where);
}

if ($_REQUEST["deletedreview"])
{
	delete_record_secondary("movie_detail_review", $_REQUEST["deletedreview"], "id");
}

if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_detail_review.*, system_lang_code_master.name as langname FROM movie_detail_review LEFT JOIN system_lang_code_master ON (movie_detail_review.system_lang_code_id = system_lang_code_master.id) WHERE movie_id = ".$_SESSION["movieid"];
	$cdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdreview = mysqli_fetch_assoc($cdreviews);
	
	if ($_SESSION["drid"])
	{
		$qry = "SELECT movie_detail_review.* FROM movie_detail_review WHERE movie_detail_review.id = ".$_SESSION["drid"];
		//echo $qry."<BR>";
		$mdreviews = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdreview = mysqli_fetch_assoc($mdreviews);
	}
}
$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["drid"]) { ?>
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
						<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $mdreview["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Review Text:</strong>&nbsp;</td>
					<td colspan="3">
						<textarea name="review_text" rows="5" cols="40"><?php echo $mdreview["review_text"]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>

					<?php if ($_SESSION["drid"]) { ?>
						<td><input type="submit" value="Modify Detail Review">&nbsp;&nbsp;<input type="button" value="New Detail Review" onclick="javascript:location.href='admin_add_movie.php?newdetailreview=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Detailed Review"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cdreview) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
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
					<td><a href="admin_add_movie.php?drid=<?php echo $cdreview["id"]; ?>">edit</a><br /><a href="admin_add_movie.php?deletedreview=<?php echo $cdreview["id"]; ?>">delete</a></td>
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
		</div>
		<?php } else { ?>
			<center> <h3> No Review Text</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
