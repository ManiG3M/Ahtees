<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

date_default_timezone_set('Asia/Kolkata');
if (!$_SESSION["userid"])
{
	header("location: login.php");
}

//print_r($_POST);

if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
}

if ($_POST["movie_id"])
{
	$movie_id = $_POST["movie_id"];
}

if ($_POST["number_of_songs"])
{
	$qry = "SELECT max(number) as starting_number FROM song_master where movie_id = ". $movie_id; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);

	$starting_number = $movie["starting_number"] + 1; //7
	$ending_number = $starting_number + $_POST["number_of_songs"]; //7+5 = 12 

	for ($i= $starting_number; $i < $ending_number; $i++)
	{
		$data["movie_id"] = $movie_id;
		$data["raaga_id"] = 218;
		$data["type_id"] = 11;
		$data["number"] = $i;
		add_record ("song_master", $data);
	}
}

?>
<body bgcolor="#AACFF9">

<br />


<?php
if ($_POST["number_of_songs"])
{
	echo "Added ". $_POST["number_of_songs"] ." Songs...<p>";
}

if ($movie_id)
{
	$qry = "SELECT id, name FROM movie_master where id = ". $movie_id; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
?>
You're Editing: <b><?php echo $movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>

<a href="admin_view_movie.php?movie_id=<?php echo $movie_id; ?>"><span style="font-size:14px;">Go back to Movies</span></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="admin_add_song_new.php?movie_id=<?php echo $movie_id; ?>"><span style="font-size:14px;">Go back to Songs</span></a>

<table width="98%" frame="box" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<form action="admin_add_lots_songs.php" enctype="multipart/form-data" method="post" name="addsong">
		<input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>" />
		<table>
			<tr>
				<td align="right"><strong>Add Multiple Songs: </strong></td>
				<td><input type="text" size="5" name="number_of_songs" value="0"/></td>
			</tr>
			<tr>
			<td align="right">&nbsp;</td>
				<td> <input type="submit" value="Add Songs">&nbsp;&nbsp; </td>
			</tr>
		</table>
		</form>
	</tr>
</table>
</body>
</html>
