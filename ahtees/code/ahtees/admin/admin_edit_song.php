<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');
//if (!$_SESSION["userid"])
//{
	//header("location: login.php");
//}

$qry = "SELECT song_master.*, song_master_extension.name, song_master_extension.description, raaga_master.name as rname, song_type_master.name as stname, movie_master.name as mname FROM song_master INNER JOIN song_master_extension ON (song_master_extension.song_id = song_master.id)  INNER JOIN raaga_master ON (raaga_master.id = song_master.raaga_id) INNER JOIN song_type_master ON (song_type_master.id = song_master.type_id) INNER JOIN movie_master ON (movie_master.id = song_master.movie_id) WHERE song_master_extension.system_lang_code_id = 4 ORDER BY song_master.number";
$songs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$song = mysqli_fetch_assoc($songs);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#AACFF9">
<p>&nbsp;</p>
<p><h3>Choose Song</h3></p>
<table width="98%" cellpadding="1" cellspacing="1">
	<tr bgcolor="#000099">
		<td align="center"><strong><font style="color:#FFFFFF">Movie</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Song Number</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Raaga</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Song Type</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Song Name (english)</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Song Desc (english)</font></strong></td>
		<td align="center"><strong><font style="color:#FFFFFF">Action</font></strong></td>
	</tr>
	<?php 
	$bgcolor = "#33FFFF";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $song["mname"]; ?></td>
		<td><?php echo $song["number"]; ?></td>
		<td><?php echo $song["rname"]; ?></td>
		<td><?php echo $song["stname"]; ?></td>
		<td><?php echo $song["name"]; ?></td>
		<td><?php echo $song["description"]; ?></td>
		<td align="center"><a href="admin_add_song.php?songid=<?php echo $song["id"]; ?>">edit</a>&nbsp;&nbsp;<a href="">delete</a></td>
	</tr>
	<?php 
	if ($bgcolor == "#33FFFF")
	{
		$bgcolor = "WHITE";
	} else {
		$bgcolor = "#33FFFF";
	}
	} while ($song = mysqli_fetch_assoc($songs)) ;?>
</table>
</body>
</html>
