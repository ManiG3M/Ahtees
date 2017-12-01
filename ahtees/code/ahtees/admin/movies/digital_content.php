<?php 
date_default_timezone_set('Asia/Kolkata');
if ($_POST["adddigitalcontent"])
{

	$target_path = "movies/content/".$_SESSION["movieid"]."_".$_POST["content_type_id"]."_".$_FILES['content_path']['name'];
	if(move_uploaded_file($_FILES['content_path']['tmp_name'], $target_path)) 
	{
		$data["movie_id"] = $_SESSION["movieid"];
		$data["content_type_id"] = $_POST["content_type_id"];
		$data["content_path"] = "movies/content/".$_SESSION["movieid"]."_".$_POST["content_type_id"]."_".$_FILES['content_path']['name'];
		$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        	$data["entered_by"] = $_SESSION["userid"];
		add_record("movie_digital_content", $data);
		chmod($target_path, 0777);
	} else {
		$digcontentmsg = "<font color='red'>There has been an error uploading the file.";
	}
	
	
}

if ($_REQUEST["deletedcontent"])
{
	delete_record_secondary("movie_digital_content", $_REQUEST["deletedcontent"], "id");
	unlink($_REQUEST["filename"]);
}

$qry = "SELECT * FROM content_type_master";
$ctypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$ctype = mysqli_fetch_assoc($ctypes);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_digital_content.*, content_type_master.description FROM movie_digital_content INNER JOIN content_type_master ON (movie_digital_content.content_type_id = content_type_master.id) WHERE movie_digital_content.movie_id = ".$_SESSION["movieid"];
	$cdigitalcontents = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdigitalcontent = mysqli_fetch_assoc($cdigitalcontents);
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post" action="admin_add_movie.php">
			<input type="hidden" value="1" name="adddigitalcontent">
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Type:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="content_type_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $ctype["id"]; ?>"><?php echo $ctype["description"]; ?></option>
							<?php } while ($ctype = mysqli_fetch_assoc($ctypes)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Select File:</strong>&nbsp;</td>
					<td colspan="3"><input type="file" name="content_path"/></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Add Digital Content"></td>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cdigitalcontent) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Content Type</strong></td>
					<td><strong>Digital Content</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdigitalcontent["description"]; ?></td>
					<td><a href="<?php echo $cdigitalcontent["content_path"]; ?>" target="_blank"><?php echo $cdigitalcontent["content_path"]; ?></a></td>
					<td><a href="admin_add_movie.php?deletedcontent=<?php echo $cdigitalcontent["id"]; ?>&filename=<?php echo $cdigitalcontent["content_path"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cdigitalcontent = mysqli_fetch_assoc($cdigitalcontents)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Digital Content</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
