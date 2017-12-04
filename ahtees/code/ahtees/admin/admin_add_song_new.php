<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');


if (!$_SESSION["userid"]) { header("location: login.php"); }


//print_r($_POST);

if (isset($_REQUEST["movie_id"])) { $movie_id = $_REQUEST["movie_id"]; }
if (isset($_POST["movie_id"])) { $movie_id = $_POST["movie_id"]; }
if (isset($_REQUEST["song_id"])) { $song_id = $_REQUEST["song_id"]; }
if (isset($_POST["id"])) { $song_id = $_POST["id"]; }


//echo "movie_id = " . $movie_id . "\n";
//echo "song_id = " . $song_id . "\n";

if (isset($_REQUEST["editsong"]))
{
	
	$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        //$_POST["updated_by"] = $_SESSION["userid"];
}

if (isset($_REQUEST["deletesong"]))
{
	$qry = "SELECT link FROM song_master WHERE id =".$_REQUEST["deletesong"];
	$links = mysqli_query($connDB, $qry) or die('1 Query failed: ' . mysqli_error($connDB)); 
	$link = mysqli_fetch_assoc($links);
	
	if ($link["link"])
	{
		chmod($link["link"], 0777);
		unlink($link["link"]);
	}
	
	delete_record_secondary("song_master", $_REQUEST["deletesong"], "id");
	delete_record_secondary("song_master_extension", $_REQUEST["deletesong"], "song_id");
	delete_record_secondary("song_review", $_REQUEST["deletesong"], "song_id");
	delete_record_secondary("song_rating", $_REQUEST["deletesong"], "song_id");
}
function add_record2($table,$data){
$connDB=$GLOBALS['connDB'];
$field_string=NULL;
$value_string=NULL;
	// fix characters that MySQL doesn't like
	foreach(array_keys($data) as $field_name) {
		
		//$data[$field_name] = sc_mysql_escape($data[$field_name]);
		
		//id is auto increment field and cannot insert
		//echo "Field Name = " . $field_name .  "\n";
		if ($field_name != "id") { 
			if (!$field_string) {
				$field_string = "`$field_name`";
				$value_string = "'$data[$field_name]'";
			} else {
				$field_string .= ",`$field_name`";
				$value_string .= ",'$data[$field_name]'";
			}
		}
	}
	
	$query = "INSERT INTO $table ($field_string) VALUES ($value_string)";
	//echo "the queryinsertdata".$query;
	// if query is not successful, show error and return
	if (!mysqli_query($connDB,$query)) {
		echo "<b>Error:</b> ".mysqli_error($connDB)."<br /><br /><b>Query was:</b> ".$query;
		if (substr(mysqli_error($connDB),0,22) == "Error: Duplicate entry") {
			return (-1); }
	}
	
	// grab rn# that was just added
	$insert_id = mysqli_insert_id($connDB);
	
	// return record number of the record just added, in case we need it
	return $insert_id;
}

if (isset($_POST["addsonginfo"])) 
{
	unset($_POST["addsonginfo"]);
	$return_code = add_record2("song_master", $_POST);

	if ($return_code == -1 ) //song already exists.. 
	{
		echo "<font color='red'>Song Number already used, choose a new song number</font>";
	} else {
		$song_id = $return_code;

		$usermsg = "<font size=4 color='green'>New Song Added</font>";
		if (isset($_FILES['link']['name']))
		{
			$target_path = str_replace(" ","","songs/content/".$song_id."_".$_FILES['link']['name']);

			if(move_uploaded_file($_FILES['link']['tmp_name'], $target_path)) 
			{
				$data["link"] = $target_path;
				$where = "id = ".$return_code;

				modify_record("song_master", $data, $where);
				$usermsg .= ", <font color='green'>".$_FILES['link']['name']." Uploaded</font>";
			}
		}
	}
}

if (isset($_POST["editsonginfo"])) 
{
	unset($_POST["editsonginfo"]);
	$where = "id = ". $song_id;

	echo "editing a song here";
	
	if (isset($_FILES['link']['name']))
	{
		$qry = "SELECT * FROM song_master WHERE id =".$song_id;
		$songs = mysqli_query($connDB, $qry) or die('2 Query failed: ' . mysqli_error($connDB)); 
		$song = mysqli_fetch_assoc($songs);

		if (file_exists($song["link"])) {
			unlink($song["link"]);
		}

		$target_path = str_replace(" ","","songs/content/".$song_id."_".$_FILES['link']['name']);

		echo "Moving from [" . $_FILES['link']['name'] ."] to [" . $target_path ."]\n";

		if(move_uploaded_file($_FILES['link']['tmp_name'], $target_path)) 
		{
			$_POST["link"] = $target_path;
		}
	}

	modify_record("song_master", $_POST, $where);
	$usermsg = "<font color='green'>Song Updated [". $_FILES['link']['name'] ."]</font>";
}

if (!isset($_REQUEST["newsong"]) && isset($song_id))
{
	$qry = "SELECT * FROM song_master WHERE id =".$song_id;
	$songs = mysqli_query($connDB, $qry) or die('3 Query failed: ' . mysqli_error($connDB)); 
	$song = mysqli_fetch_assoc($songs);
	
	$qry = "SELECT * FROM song_master_extension WHERE song_id =".$song_id." AND system_lang_code_id = 4";
	
	$songlangs = mysqli_query($connDB, $qry) or die('4 Query failed: ' . mysqli_error($connDB)); 
	$songlang = mysqli_fetch_assoc($songlangs);
}

$qry = "SELECT * FROM raaga_master order by name";
$ragaas = mysqli_query($connDB, $qry) or die('5 Query failed: ' . mysqli_error($connDB)); 
$ragaa = mysqli_fetch_assoc($ragaas);

$qry = "SELECT * FROM song_type_master";
$stypes = mysqli_query($connDB, $qry) or die('6 Query failed: ' . mysqli_error($connDB)); 
$stype = mysqli_fetch_assoc($stypes);

$qry = "SELECT song_master.*, raaga_master.name as rname, song_type_master.name as stname, song_master_extension.name as songname, system_lang_code_master.name as lname FROM song_master INNER JOIN raaga_master ON (raaga_master.id = song_master.raaga_id) INNER JOIN song_type_master ON (song_type_master.id = song_master.type_id) LEFT JOIN song_master_extension ON (song_master_extension.song_id = song_master.id) LEFT JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE movie_id = ". $movie_id ." ORDER BY number";
$msongs = mysqli_query($connDB, $qry) or die('This stupid Query failed: [' . $qry . ']'. mysqli_error($connDB)); 
$msong = mysqli_fetch_assoc($msongs);

?>
<body bgcolor="#AACFF9">

<br />
<?php
if ($movie_id)
{
	$qry = "SELECT id, name FROM movie_master where id = ". $movie_id; 
	$movies = mysqli_query($connDB, $qry) or die('7 Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
?>
	You're Editing: <b><?php echo $movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>

<a href="admin_view_movie.php?movie_id=<?php echo $movie_id; ?>"><span style="font-size:14px;">Go back to Movies</span></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--<a href="admin_add_lots_songs.php?movie_id=<?php echo $movie_id; ?>"><span style="font-size:14px;">Add # of Songs</span></a>-->

<table width="98%" frame="box" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top"><strong>Add Song Number, Raaga, Type,<br />then add language information on next tab.</strong><br /><?php if (isset($usermsg)) {
				echo $usermsg."";
			} else if (isset($errmsg)) {
				echo $errmsg."";
			}
			?>

		<form action="admin_add_song_new.php" enctype="multipart/form-data" method="post" name="addsong">

			<?php if (isset($song_id)) { ?>
				<input type="hidden" name="editsonginfo" value="1" />
			<?php } else { ?>
				<input type="hidden" name="addsonginfo" value="1" />
			<?php } ?>

			<input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>" />
			<input type="hidden" name="id" value="<?php echo $song_id; ?>" />

			<table>
				<tr>
					<td align="right"><strong>Song Number: </strong></td>
					<?php if (isset($song["number"])) {   ?>
						<td><input type="text" size="5" name="number" value="<?php echo $song["number"]; ?>"/></td>
					<?php } else { ?>
						<td><input type="text" size="5" name="number" value=""/></td>
					<?php } ?>
				</tr>

				<tr>
					<td align="right"><strong>Raaga: </strong></td>
					<td>
					<select name="raaga_id">
					<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $ragaa["id"]; ?>" 
						<?php 
							if ( (isset($song["raaga_id"])) && $ragaa["id"] == $song["raaga_id"]) {?> 
								selected
						<?php } ?>> 
						<?php echo $ragaa["name"]; ?> </option>
					<?php } while ($ragaa = mysqli_fetch_assoc($ragaas)); ?>
					</select>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>Song Type: </strong></td>
					<td>
					<select name="type_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $stype["id"]; ?>" 
						<?php if ( (isset($song["type_id"])) && $stype["id"] == $song["type_id"]) { ?> 
							selected
						<?php } ?> > 
						<?php echo $stype["name"]; ?></option>
					<?php } while ($stype = mysqli_fetch_assoc($stypes)); ?>
					</select>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>Run Time: </strong></td>
					<?php if (isset($song["run_time"])) {   ?>
						<td><input type="text" size="10" name="run_time" value="<?php echo $song["run_time"]; ?>" /></td>
					<?php } else { ?>
						<td><input type="text" size="10" name="run_time" value="" /></td>

					<?php } ?>
					
				</tr>

				<tr>
					<td align="right"><strong>Song File: </strong></td>
					<td><input type="file" name="link" /></td>
				</tr>

				<tr>
					<td align="right">&nbsp;</td>
					<td>
					<?php if (isset($song_id)) { ?>
						<input type="submit" value="Update Song Info">&nbsp;&nbsp;
						<input type="button" value="Start New Song" onClick="javascript:location.href='admin_add_song_new.php?newsong=1&movie_id=<?php echo $movie_id; ?>';"/>
					<?php } else { ?>
						<input type="submit" value="Add Song Info" />
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>

		</td>
		<td width="50%" valign="top">
			<table>
				<tr bgcolor="#C0C0C0">
					<td align="center" width="10%"><strong>Song Number</strong></td>
					<td align="center" width="10%"><strong>Language</strong></td>
					<td align="center" width="20%"><strong>Raaga</strong></td>
					<td align="center" width="15%"><strong>Song Type</strong></td>
					<td align="center" width="45%"><strong>Song Name</strong></td>
					<td align="center" width="45%"><strong>Link</strong></td>
					<td align="center" width = "10%"><strong>Action</strong></td>
					<td align="center" width = "10%"><strong>Details</strong></td>
					<td align="center" width = "10%"><strong>Reviews</strong></td>
					<td align="center" width = "10%"><strong>Rating</strong></td>
					<td align="center" width = "10%"><strong>Singers</strong></td>
					<td align="center" width = "10%"><strong>Lyricist</strong></td>
				</tr>
				<?php 
				$bgcolor = "WHITE";
				do {
				$songname = explode('/', $msong["link"]);
				 ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $msong["number"]; ?></td>
					<td><?php echo $msong["lname"]; ?></td>
					<td><?php echo $msong["rname"]; ?></td>
					<td><?php echo $msong["stname"]; ?></td>
					<td><?php echo $msong["songname"]; ?></td>
					<td><a href="<?php echo $msong["link"]; ?>" target="_blank"><?php echo $msong["link"]; ?></a></td>
					<td align="center"><a href="admin_add_song_new.php?editsong=<?php echo $msong["id"]; ?>&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $msong["id"]; ?>">edit</a>&nbsp;<a href="admin_add_song_new.php?deletesong=<?php echo $msong["id"]; ?>&movie_id=<?php echo $movie_id; ?>&song_id=<?php echo $msong["id"]; ?>">delete</a></td>
					<td><a href="songs/songex1_new.php?song_id=<?php echo $msong["id"];?>&movie_id=<?php echo $movie_id;?>">Details </a> </td>
					<td><a href="songs/songex2_new.php?song_id=<?php echo $msong["id"];?>&movie_id=<?php echo $movie_id;?>">Review </a> </td>
					<td><a href="songs/songex3_new.php?song_id=<?php echo $msong["id"];?>&movie_id=<?php echo $movie_id;?>">Rating </a> </td>
					<td><a href="songs/songex4_new.php?song_id=<?php echo $msong["id"];?>&movie_id=<?php echo $movie_id;?>">Singers</a> </td>
					<td><a href="songs/songex5_new.php?song_id=<?php echo $msong["id"];?>&movie_id=<?php echo $movie_id;?>">Lyricist</a> </td>
				</tr>
				<?php
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				 } while ($msong = mysqli_fetch_assoc($msongs)); ?>
			</table>
		</td>
	</tr>
</table>


</body>
</html>
