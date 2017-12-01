<?php if ($_SESSION["movieid"]) { 

//require_once('../../connections/DB.php');
//include('../../connections/tablefuncs.php');
////mysql_select_db($database_DB, $connDB);
//session_start();
date_default_timezone_set('Asia/Kolkata');

if ($_REQUEST["newmoviel"])
{
	unset($_SESSION["editlmovie"]);
}

if ($_REQUEST["editlmovie"])
{
	$_SESSION["editlmovie"] = $_REQUEST["editlmovie"];
}

if ($_REQUEST["deletelmovie"])
{
	delete_record_secondary("movie_master_extension", $_REQUEST["deletelmovie"], "id");
}

if ($_POST["addmovielinfo"]) 
{
	unset($_POST["addmovielinfo"]);
	$_POST["movie_id"] = $_SESSION["movieid"];
	$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $_POST["entered_by"] = $_SESSION["userid"];
	add_record("movie_master_extension", $_POST);
	$usermoviemsg = "<font color='green'>New Movie Info Added</font>";
}

if ($_POST["editmovielinfo"]) 
{
	$id = $_POST["editmovielinfo"];
	unset($_POST["editmovielinfo"]);
	$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $_POST["updated_by"] = $_SESSION["userid"];
	$where = "id = ".$id;
	modify_record("movie_master_extension", $_POST, $where);
	$usermoviemsg = "<font color='green'>Movie Updated</font>";
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

$qry = "SELECT movie_master_extension.*, system_lang_code_master.name as lname FROM movie_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = movie_master_extension.system_lang_code_id) WHERE movie_id = ".$_SESSION["movieid"];
$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$movie = mysqli_fetch_assoc($movies);

if ($_SESSION["editlmovie"])
{
	$qry = "SELECT movie_master_extension.*, system_lang_code_master.name as lname FROM movie_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = movie_master_extension.system_lang_code_id) WHERE movie_master_extension.id = ".$_SESSION["editlmovie"];
	//echo $qry."<BR>";
	$moviels = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$moviel = mysqli_fetch_assoc($moviels);
}


?>
<table width="98%">
	<tr>
		<td>
			<form name="add_movie_ext" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["editlmovie"]) {?>
				<input type="hidden" name="editmovielinfo" value="<?php echo $_SESSION["editlmovie"]; ?>">
			<?php } else { ?>
				<input type="hidden" name="addmovielinfo" value="1">
			<?php } ?>
			<table>
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td>
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<?php if ($_SESSION["editlmovie"]) {?>
							<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $moviel["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemaster["id"]; ?>"><?php echo $codemaster["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
					<?php if ($usermoviemsg) { ?><?php echo "&nbsp;&nbsp;".$usermoviemsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
		  			<td align="right"><strong>Message: </strong></td>
				    <td><input type="text" name="message" size="40" value="<?php echo $moviel["message"]; ?>"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Description: </strong></td>
					<td><textarea cols="32" rows="2" name="description"><?php echo $moviel["description"]; ?></textarea></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Subject Line: </strong></td>
					<td><textarea cols="32" rows="2" name="subject_line"><?php echo $moviel["subject_line"]; ?></textarea></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Alternate Title: </strong></td>
					<td><input size="40" type="text" name="alternate_title" value="<?php echo $moviel["alternate_title"]; ?>" /></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>From Book: </strong></td>
					<td><input size="40" type="text" name="from_book" value="<?php echo $moviel["from_book"]; ?>" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if ($_SESSION["editlmovie"]) {?>
						<input type="submit" value="Update Movie Language Info"><input type="button" value="New Language" onclick="javascript:location.href='admin_add_movie.php?newmoviel=1';" />
					<?php } else { ?>
						<input type="submit" value="Add Movie Language Info">
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>
		</td>
		<td valign="top">
			
			<table width="98%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#000099">
					<td align="center"><strong><font style="color:#FFFFFF">Language</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Message</font></strong></td>
					<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
				</tr>
				<?php 
				$bgcolor = "#33FFFF";
				do { ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td valign="top"><?php echo $movie["lname"]; ?></td>
					<td valign="top"><?php echo $movie["message"]; ?></td>
					<td align="center" valign="top"><a href="admin_add_movie.php?editlmovie=<?php echo $movie["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="admin_add_movie.php?deletelmovie=<?php echo $movie["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "#33FFFF")
				{
					$bgcolor = "WHITE";
				} else {
					$bgcolor = "#33FFFF";
				}
				} while ($movie = mysqli_fetch_assoc($movies)) ;?>
			</table>
		</td>
	</tr>
</table>
<?php } else { ?>
<table>
	<tr>
		<td><h3>Add or Choose Movie First</h3></td>
	</tr>
</table>
<?php } ?>
