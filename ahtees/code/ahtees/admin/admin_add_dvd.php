<?php 
//require_once('../connections/DB.php');
//include('../connections/tablefuncs.php');
////mysql_select_db($database_DB, $connDB);
//session_start();
//if (!$_SESSION["userid"])
//{
	//header("location: login.php");
//}
date_default_timezone_set('Asia/Kolkata');

if ($_REQUEST["editsong"])
{
	$_SESSION["songid"] = $_REQUEST["editsong"];
	unset($_SESSION["editlsong"]);
	unset($_SESSION["editrsong"]);
	unset($_SESSION["editratesong"]);
}
if ($_REQUEST["deletesong"])
{
	unset($_SESSION["songid"]);
	unset($_SESSION["editlsong"]);
	unset($_SESSION["editrsong"]);
	unset($_SESSION["editratesong"]);
	
	$qry = "SELECT link FROM song_master WHERE id =".$_REQUEST["deletesong"];
	$links = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
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

if ($_REQUEST["songid"])
{
	$_SESSION["songid"] = $_REQUEST["songid"];
}

if ($_REQUEST["newsong"])
{
	unset($_SESSION["songid"]);
	unset($_SESSION["editlsong"]);
	unset($_SESSION["editrsong"]);
	unset($_SESSION["editratesong"]);
}

function add_record2($table,$data){

	// fix characters that MySQL doesn't like
	foreach(array_keys($data) as $field_name) {

		$data[$field_name] = sc_mysql_escape($data[$field_name]);
		
		if (!$field_string) {
			$field_string = "`$field_name`";
			$value_string = "'$data[$field_name]'";
		} else {
			$field_string .= ",`$field_name`";
			$value_string .= ",'$data[$field_name]'";
		}
	}
	
	$query = "INSERT INTO $table ($field_string) VALUES ($value_string)";
	// if query is not successful, show error and return
	if (!mysqli_query($connDB,$query)) {
		echo "<b>Error:</b> ".mysqli_error($connDB)."<br /><br /><b>Query was:</b> ".$query;
		if (substr(mysqli_error($connDB),0,22) == "Error: Duplicate entry");
			$errormsg = "<font color='red'>Song Number already used, choose a new song number</font>";
		return $errormsg;
	}
	
	// grab rn# that was just added
	$insert_id = mysql_insert_id();
	
	// return record number of the record just added, in case we need it
	return $insert_id;
}

if ($_POST["addsonginfo"]) 
{
	unset($_POST["addsonginfo"]);
	$songid = add_record2("song_master", $_POST);

	if ($_SESSION["songid"] == "<font color='red'>Song Number already used, choose a new song number</font>")
	{
		$errmsg = $_SESSION["songid"];
		$_SESSION["songid"] = 0;
	} else {
	
		$usermsg = "<font size=4 color='green'>New Song Added</font>";
		if ($_FILES['link']['name'])
		{
			$target_path = "songs/content/".$songid."_".$_FILES['link']['name'];
			if(move_uploaded_file($_FILES['link']['tmp_name'], $target_path)) 
			{
				$data["link"] = $target_path;
				$where = "id = ".$songid;
				modify_record("song_master", $data, $where);
				$usermsg .= ", <font color='green'>".$_FILES['link']['name']." Uploaded</font>";
			}
		}
	}
}

if ($_POST["editsonginfo"]) 
{
	unset($_POST["editsonginfo"]);
	$where = "id = ".$_SESSION["songid"];
	
		if ($_FILES['link']['name'])
		{
			$qry = "SELECT * FROM song_master WHERE id =".$_SESSION["songid"];
			$songs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
			$song = mysqli_fetch_assoc($songs);
			unlink($song["link"]);
			$target_path = "songs/content/".$_SESSION["songid"]."_".$_FILES['link']['name'];
			if(move_uploaded_file($_FILES['link']['tmp_name'], $target_path)) 
			{
				$_POST["link"] = $target_path;
			}
		}
	modify_record("song_master", $_POST, $where);
	$usermsg = "<font color='green'>Song Updated [". $_FILES['link']['name'] ."</font>";
}

if ($_SESSION["songid"]) 
{
	$qry = "SELECT * FROM song_master WHERE id =".$_SESSION["songid"];
	$songs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$song = mysqli_fetch_assoc($songs);
	
	$_SESSION["songnumber"] = $song["number"];

	$qry = "SELECT * FROM song_master_extension WHERE song_id =".$_SESSION["songid"]." AND system_lang_code_id = 4";
	$songlangs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$songlang = mysqli_fetch_assoc($songlangs);
	
	if ($songlang)
	{
		$_SESSION["songname"] = $songlang["name"];
	} else {
		unset($_SESSION["songname"]);
	}
}

$qry = "SELECT * FROM raaga_master";
$ragaas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$ragaa = mysqli_fetch_assoc($ragaas);

$qry = "SELECT * FROM song_type_master";
$stypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$stype = mysqli_fetch_assoc($stypes);

$qry = "SELECT id, name FROM movie_master";
$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$movie = mysqli_fetch_assoc($movies);

$qry = "SELECT song_master.*, raaga_master.name as rname, song_type_master.name as stname, song_master_extension.name as songname, system_lang_code_master.name as lname FROM song_master INNER JOIN raaga_master ON (raaga_master.id = song_master.raaga_id) INNER JOIN song_type_master ON (song_type_master.id = song_master.type_id) LEFT JOIN song_master_extension ON (song_master_extension.song_id = song_master.id) LEFT JOIN system_lang_code_master ON (system_lang_code_master.id = song_master_extension.system_lang_code_id) WHERE movie_id =".$_SESSION["movieid"]." ORDER BY number";
$msongs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$msong = mysqli_fetch_assoc($msongs);

?>



<body bgcolor="#AACFF9">

<br />

<ul id="songtabs" class="shadetabs">
<li><a href="#" rel="song1" class="selected">Song List</a></li>
<li><a href="#" rel="songex1" class="selected">Song Details</a></li>
<li><a href="#" rel="songex2" class="selected">Song Review</a></li>
<li><a href="#" rel="songex3" class="selected">Song Rating</a></li>
<li><a href="#" rel="songex4" class="selected">Singers</a></li>
</ul>

<div style="overflow:auto; width:799px; height: 250px;">

<div id="song1" class="tabcontent">
<table width="98%" frame="box" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top"><strong>Add Song Number, Raaga, Type,<br />then add language information on next tab.</strong><br /><?php if ($usermsg) {
				echo $usermsg."";
			} else if ($errmsg) {
				echo $errmsg."";
			}
			?>
		<form action="admin_add_movie.php" enctype="multipart/form-data" method="post" name="addsong">
			<?php if ($_SESSION["songid"] ) { ?>
				<input type="hidden" name="editsonginfo" value="1">
			<?php } else { ?>
				<input type="hidden" name="addsonginfo" value="1">
			<?php } ?>
				<input type="hidden" name="movie_id" value="<?php echo $_SESSION["movieid"]; ?>" />
			<table>
				<tr>
					<td align="right"><strong>Song Number: </strong></td>
					<td><input type="text" size="5" name="number" value="<?php echo $song["number"]; ?>"/></td>
				</tr>
				<tr>
					<td align="right"><strong>Raaga: </strong></td>
					<td>
					<select name="raaga_id">
					<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $ragaa["id"]; ?>" <?php if ($ragaa["id"] == $song["raaga_id"]) {?>selected<?php } ?>><?php echo $ragaa["name"]; ?> </option>
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
						<option value="<?php echo $stype["id"]; ?>" <?php if ($stype["id"] == $song["type_id"]) {?>selected<?php } ?>><?php echo $stype["name"]; ?></option>
					<?php } while ($stype = mysqli_fetch_assoc($stypes)); ?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Song File: </strong></td>
					<td><input type="file" name="link" /></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td>
					<?php if ($_SESSION["songid"] ) { ?>
						<input type="submit" value="Update Song Info">&nbsp;&nbsp;<input type="button" value="Start New Song" onClick="javascript:location.href='admin_add_movie.php?newsong=1';"/>
					<?php } else { ?>
						<input type="submit" value="Add Song Info" />
					<?php } ?>
					</td>
				</tr>
			</table>
			</form>
		</td>
		<td width="50%" valign="top">
		<div style="overflow:auto; width:430px; height:200px; margin-bottom: 1em;">
			<table>
				<tr bgcolor="#C0C0C0">
					<td align="center" width="10%"><strong>Song Number</strong></td>
					<td align="center" width="10%"><strong>Language</strong></td>
					<td align="center" width="20%"><strong>Raaga</strong></td>
					<td align="center" width="15%"><strong>Song Type</strong></td>
					<td align="center" width="45%"><strong>Song Name</strong></td>
					<td align="center" width="45%"><strong>Link</strong></td>
					<td align="center" width = "10%"><strong>Action</strong></td>
				</tr>
				<?php 
				$bgcolor = "WHITE";
				do {
				$songname = split('/', $msong["link"]);
				 ?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $msong["number"]; ?></td>
					<td><?php echo $msong["lname"]; ?></td>
					<td><?php echo $msong["rname"]; ?></td>
					<td><?php echo $msong["stname"]; ?></td>
					<td><?php echo $msong["songname"]; ?></td>
					<td><a href="<?php echo $msong["link"]; ?>" target="_blank"><?php echo $msong["link"]; ?></a></td>
					<td align="center"><a href="admin_add_movie.php?editsong=<?php echo $msong["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletesong=<?php echo $msong["id"]; ?>">delete</a></td>
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
		</div>
		</td>
	</tr>
</table>
</div>

<div id="songex1" class="tabcontent">
<?php if ($_SESSION["songid"]) { ?>
	<?php include("songs/songex1.php"); ?>
<?php } else { ?>
	<h5>Add/Select Song First</h5>
<?php } ?>
</div>

<div id="songex2" class="tabcontent">
<?php if ($_SESSION["songid"]) { ?>
	<?php include("songs/songex2.php"); ?>
<?php } else { ?>
	<h5>Add/Select Song First</h5>
<?php } ?>
</div>

<div id="songex3" class="tabcontent">
<?php if ($_SESSION["songid"]) { ?>
	<?php include("songs/songex3.php"); ?>
<?php } else { ?>
	<h5>Add/Select Song First</h5>
<?php } ?>
</div>

<div id="songex4" class="tabcontent">
<?php if ($_SESSION["songid"]) { ?>
	<?php include("songs/songex4.php"); ?>
<?php } else { ?>
	<h5>Add/Select Song First</h5>
<?php } ?>
</div>

</div>
</body>
</html>
<script type="text/javascript">

var customers=new ddtabcontent("songtabs")
customers.setpersist(true)
customers.setselectedClassTarget("link") //"link" or "linkparent"
customers.init()

var customers=new ddtabcontent("songextendedtabs")
customers.setpersist(true)
customers.setselectedClassTarget("link") //"link" or "linkparent"
customers.init()

</script>
