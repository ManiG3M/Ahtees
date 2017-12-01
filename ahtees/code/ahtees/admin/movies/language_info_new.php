<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

if (isset($_REQUEST["movie_id"]))
{
	$movie_id = $_REQUEST["movie_id"];
}
else
{
	$movie_id = $_POST["movie_id"];
}

if (isset($_REQUEST["deletelmovie"]))
{
	delete_record_secondary("movie_master_extension", $_REQUEST["deletelmovie"], "id");
}

if (isset($_POST["addmovielinfo"])) 
{
	unset($_POST["addmovielinfo"]);
	$_POST["movie_id"] = $movie_id;
	$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $_POST["entered_by"] = $_SESSION["userid"];
	add_record("movie_master_extension", $_POST);
	$usermoviemsg = "<font color='green'>New Movie Info Added</font>";
}

if (isset($_POST["editmovielinfo"])) 
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

$qry = "SELECT movie_master_extension.*, system_lang_code_master.name as lname FROM movie_master_extension, system_lang_code_master WHERE movie_master_extension.movie_id = ".$movie_id ." AND  system_lang_code_master.id = movie_master_extension.system_lang_code_id";
$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$movie = mysqli_fetch_assoc($movies);

if (isset($_REQUEST["editlmovie"]))
{
	$qry = "SELECT movie_master_extension.*, system_lang_code_master.name as lname FROM movie_master_extension INNER JOIN system_lang_code_master ON (system_lang_code_master.id = movie_master_extension.system_lang_code_id) WHERE movie_master_extension.id = ".$_REQUEST["editlmovie"];
	//echo $qry."<BR>";
	$moviels = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$moviel = mysqli_fetch_assoc($moviels);
}

if ($movie_id)
{
	$qry = "SELECT id, name FROM movie_master where id = ". $movie_id; 
	$n_movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$n_movie = mysqli_fetch_assoc($n_movies);
?>
	You're Editing: <b><?php echo $n_movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<a href="../admin_view_movie.php?movie_id=<?php echo $movie_id; ?>">Go back to Movies</a>

<table width="100%">
	<tr>
		<td>
			<form name="add_movie_ext" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["editlmovie"])) {?>
				<input type="hidden" name="editmovielinfo" value="<?php echo $_REQUEST["editlmovie"]; ?>">
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
						<?php if ($_REQUEST["editlmovie"]) {?>
							<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $moviel["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
						<?php } else { ?>
							<option value="<?php echo $codemaster["id"]; ?>"><?php echo $codemaster["name"]; ?></option>
						<?php } ?>
						
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
					<?php if (isset($usermoviemsg)) { ?><?php echo "&nbsp;&nbsp;".$usermoviemsg; ?><?php } ?>
				  	</td>
				</tr>
				<tr>
		  			<td align="right"><strong>Message: </strong></td>
		  			<?php if(isset($moviel["message"])) { ?>
		  				 <td><input type="text" name="message" size="40" value="<?php echo $moviel["message"]; ?>"></td>
		  			<?php } else { ?>	
		  				 <td><input type="text" name="message" size="40" value=""></td>
		  			<?php } ?>
				   
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Description: </strong></td>
					<td>
						<?php if(isset($moviel["description"])) { ?>
						<textarea cols="32" rows="2" name="description"><?php echo $moviel["description"]; ?></textarea>
		  			<?php } else { ?>
		  			<textarea cols="32" rows="2" name="description"></textarea>	
		  			<?php } ?>	
					</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Subject Line: </strong></td>
					<td>
						<?php if(isset($moviel["subject_line"])) { ?>
							<textarea cols="32" rows="2" name="subject_line"><?php echo $moviel["subject_line"]; ?></textarea></td>
		  			<?php } else { ?>	
		  			<textarea cols="32" rows="2" name="subject_line"></textarea></td>
		  			<?php } ?>
					
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Alternate Title: </strong></td>
					<td>
						<?php if(isset($moviel["alternate_title"])) { ?>
						<input size="40" type="text" name="alternate_title" value="<?php echo $moviel["alternate_title"]; ?>" /></td>
		  			<?php } else { ?>	
		  			<input size="40" type="text" name="alternate_title" value="" /></td>
		  			<?php } ?>
					
				</tr>
				<tr>
					<td align="right" valign="top"><strong>From Book: </strong></td>
					<td>
						<?php if(isset($moviel["from_book"])) { ?>
						<input size="40" type="text" name="from_book" value="<?php echo $moviel["from_book"]; ?>" />
		  			<?php } else { ?>
		  				<input size="40" type="text" name="from_book" value="" />	
		  			<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<?php if (isset($_REQUEST["editlmovie"])) {?>
						<input type="submit" value="Update Movie Language Info">
						<input type="button" value="New Language" onclick="javascript:location.href='language_info_new.php?newmoviel=1&movie_id=<?php echo $movie_id; ?>';" />
					<?php } else { ?>
						<input type="submit" value="Add Movie Language Info">
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>
		</td>
		<td valign="top">
			<table>
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
					<td align="center" valign="top"><a href="language_info_new.php?editlmovie=<?php echo $movie["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;&nbsp;<a href="language_info_new.php?deletelmovie=<?php echo $movie["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
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
