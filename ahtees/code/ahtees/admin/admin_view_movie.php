<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
////mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

if (!$_SESSION["userid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }


if (isset($_REQUEST["disableid"]))
{
	$data["active"] = 0;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
	$data["updated_by"] = $_SESSION["userid"];
	$where = "id = ".$_REQUEST["disableid"];
	modify_record("movie_master", $data, $where);
}

if (isset($_REQUEST["enableid"]))
{
	$data["active"] = 1;
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
	$data["updated_by"] = $_SESSION["userid"];
	$where = "id = ".$_REQUEST["enableid"];
	modify_record("movie_master", $data, $where);
}

if (isset($_REQUEST["displaydisabled"]))
{
	$qry = "SELECT movie_master.*, language_master.description FROM movie_master, language_master WHERE movie_master.active = 0  AND movie_master.lang_id = language_master.id ORDER BY movie_master.name, language_master.description";
}
else
{
	$qry = "SELECT movie_master.*, language_master.description FROM movie_master, language_master ";
	if (isset($_POST["moviesearch"]))
	{
		$qry.= " WHERE movie_master.name LIKE '%".$_POST["moviesearch"]."%' AND movie_master.lang_id = language_master.id ORDER BY movie_master.name, language_master.description";
	} 
	else 
	{
		if (isset($_REQUEST["movie_id"]))
		{
			$qry.= " WHERE movie_master.id = " . $_REQUEST["movie_id"] ." AND movie_master.lang_id = language_master.id ORDER BY movie_master.name, language_master.description";
		}	
		else
		{	
			$qry.= " WHERE movie_master.lang_id = language_master.id ORDER BY movie_master.name, language_master.description LIMIT 10";
		}
	}
}

$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$movie = mysqli_fetch_assoc($movies);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>


</head>

<body bgcolor="#CACACA">
<p>&nbsp;</p>
<form action="admin_view_movie.php" method="post" enctype="multipart/form-data" name="searchmovie">
<?php if(isset($_POST["moviesearch"])) {?>
	<input type="text" name="moviesearch" size="30" value="<?php echo $_POST["moviesearch"]; ?>"/>&nbsp;&nbsp;
<?php } else {?>
	<input type="text" name="moviesearch" size="30" value=""/>&nbsp;&nbsp;
<?php }?>

<input type="submit" value="Find Movie" />
&nbsp;&nbsp;
<input type="button" value="Display Disabled Movies" onClick="javascript:location.href='admin_view_movie.php?displaydisabled=1';" />
</form>
<hr />
<a href="admin.php"><span style="font-size:14px;">Go Back to Home Page</a></span>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<a href="admin_add_movie.php"><span style="font-size:14px;">Add Movie</a></span>

<table width="100%">
	<tr bgcolor="#999999">
		<td>Name</td>
		<td>Language</td>
		<td>Release Date</td>
		<td>Action</td>
		<td>Songs</td>
		<td align="center"><B>Movie Cast Details</b></td>
		<td align="center"><B>Movie Details</b></td>
	</tr>
	<?php 
	$bgcolor = "WHITE";
	do { ?>
	<tr bgcolor="<?php echo $bgcolor; ?>">
		<td><?php echo $movie["name"]; ?></td>
		<td><?php echo $movie["description"]; ?></td>
		<td><?php echo $movie["release_date"]; ?></td>
		<?php if ($movie["active"]) { ?>
			<td><a href="admin_add_movie.php?movieid=<?php echo $movie["id"]; ?>">view/edit</a>&nbsp;&nbsp;
		<?php } else { ?>
			<td bgcolor="#F4944D"><a href="admin_add_movie.php?movieid=<?php echo $movie["id"]; ?>">view/edit</a>&nbsp;&nbsp;
		<?php } ?>
		<td><a href="admin_add_song_new.php?newsong=1&movie_id=<?php echo $movie["id"]; ?>">Songs</a></td>
	
		<td>
			<a href="movies/cast_new.php?movie_id=<?php echo $movie["id"]; ?>">Cast</a>
			&nbsp;&nbsp;
			<a href="movies/cast_highlight_new.php?movie_id=<?php echo $movie["id"]; ?>">Cast Hlght</a>
			&nbsp;&nbsp;
			<a href="movies/cast_punch_dialog_new.php?movie_id=<?php echo $movie["id"]; ?>">Cast Dialogs</a>
			&nbsp;&nbsp;
			<a href="movies/cast_rating_new.php?movie_id=<?php echo $movie["id"]; ?>">Cast Rtg</a>
			&nbsp;&nbsp;
		</td>

		<td>
			<a href="movies/language_info_new.php?movie_id=<?php echo $movie["id"]; ?>">Details</a>
			&nbsp;&nbsp;
			<a href="movies/text_content_new.php?movie_id=<?php echo $movie["id"]; ?>">Text Content</a>
			&nbsp;&nbsp;
			<a href="movie_digital_content.php?movie_id=<?php echo $movie["id"]; ?>">Digital</a>
			&nbsp;&nbsp;
			<a href="movies/award_new.php?movie_id=<?php echo $movie["id"]; ?>">Awards</a>
			&nbsp;&nbsp;
			<a href="movies/detail_review_new.php?movie_id=<?php echo $movie["id"]; ?>">Reviews</a>
			&nbsp;&nbsp;
			<a href="movies/company_new.php?movie_id=<?php echo $movie["id"]; ?>">Companies</a>
			&nbsp;&nbsp;
			<a href="movies/location_new.php?movie_id=<?php echo $movie["id"]; ?>">Locations</a>
			&nbsp;&nbsp;
			<a href="movies/studio_new.php?movie_id=<?php echo $movie["id"]; ?>">Studio</a>
			&nbsp;&nbsp;
			<a href="movies/studio_rating_new.php?movie_id=<?php echo $movie["id"]; ?>">Studio Rtg</a>
		</td>
		<td>
		<?php if ($movie["active"]) { ?>
			<a href="admin_view_movie.php?disableid=<?php echo $movie["id"]; ?>">disable</a></td>
		<?php } else { ?>
			<a href="admin_view_movie.php?enableid=<?php echo $movie["id"]; ?>">enable</a></td>
		<?php } ?>
		</td>
	</tr>
	<?php 
	if ($bgcolor == "WHITE")
	{
		$bgcolor = "#CCCCCC";
	} else {
		$bgcolor = "WHITE";
	}
	} while ($movie = mysqli_fetch_assoc($movies)); ?>
</table>

</body>
</html>
