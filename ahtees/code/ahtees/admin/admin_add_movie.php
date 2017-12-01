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

if ($_POST || $_REQUEST)
{
	if (isset($_REQUEST["movieid"])) {
		$_SESSION["movieid"] = $_REQUEST["movieid"];
	} elseif (isset($_POST["movieid"])) {
		$_SESSION["movieid"] = $_POST["movieid"];
	}

	if (isset($_REQUEST["new"])) {	
		unset($_SESSION["movieid"]);
	}

	if (isset($_POST["addmovieinfo"])) 
	{	
		unset($_POST["addmovieinfo"]);
		$_POST["release_date"] = date('Y-m-d H:i:s', strtotime($_POST["release_date"]));
		$_POST["censored_date"] = date('Y-m-d H:i:s', strtotime($_POST["censored_date"]));
		$_POST["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$_POST["entered_by"] = $_SESSION["userid"];
		$_SESSION["movieid"] = add_record("movie_master", $_POST);
		$_SESSION["moviename"] = $_POST["name"];
		$usermsg = "<font color='red'>New Movie Added</font>";
	}

	if (isset($_POST["editmovieinfo"])) 
	{	
		unset($_POST["editmovieinfo"]);
		$_POST["release_date"] = date('Y-m-d H:i:s', strtotime($_POST["release_date"]));
		$_POST["censored_date"] = date('Y-m-d H:i:s', strtotime($_POST["censored_date"]));
		$_POST["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$_POST["updated_by"] = $_SESSION["userid"];
		$where = "id = ".$_SESSION["movieid"];
		modify_record("movie_master", $_POST, $where);
		$usermsg = "<font color='red'>Customer Updated</font>";
	}
} else {
	unset($_SESSION["movieid"]);
	unset($_SESSION["awardid"]);
	unset($_SESSION["mcastid"]);
	unset($_SESSION["mcasthid"]);
	unset($_SESSION["mcastpdid"]);
	unset($_SESSION["mcastcrid"]);
	unset($_SESSION["drid"]);
	unset($_SESSION["editlmovie"]);
	unset($_SESSION["locid"]);
	unset($_SESSION["pdid"]);
	unset($_SESSION["studioid"]);
	unset($_SESSION["mstudiorid"]);
}

if (isset($_SESSION["movieid"]))
{
	$qry = "SELECT * FROM movie_master WHERE id =".$_SESSION["movieid"];
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
	$_SESSION["moviename"] = $movie["name"];
}
else { 
	$movie = array(); 
	$movie["name"] = "";
	$movie["title_message"] = "";
	$movie["length"] = "";
	$movie["censor_number"] = "";
	$movie["censored_date"] = "";
	$movie["release_date"] = "";
	$movie["dubbed_from_movie"] = "";
	$movie["format_id"] = "";
	$movie["rating_id"] = "";
	$movie["lang_id"] = "";
	$movie["original_lang_id"] = "";
	$movie["parent_category_id"] = "";
	$movie["child_category_id"] = "";
	$movie["third_category_id"] = "";
	$movie["production_cost_id"] = "";
	$movie["aspect_ratio_id"] = "";
	$movie["run_time"] = "";
	$movie["no_of_days"] = "";
}





$qry = "SELECT * FROM format_master order by description";
$formats = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$format = mysqli_fetch_assoc($formats);

$qry = "SELECT * FROM category_master order by description";
$categories = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$category = mysqli_fetch_assoc($categories);

$countcat = 0;
do {
	$catid[] = $category["id"];
	$catdesc[] = $category["description"];
	$countcat++;
} while ($category = mysqli_fetch_assoc($categories)); 

$qry = "SELECT * FROM language_master ORDER BY description";
$languages = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$language = mysqli_fetch_assoc($languages);

$countlang = 0;
do {
	$langid[] = $language["id"];
	$langdesc[] = $language["description"];
	$countlang++;
} while ($language = mysqli_fetch_assoc($languages)); 

$qry = "SELECT * FROM rating_master";
$ratings = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rating = mysqli_fetch_assoc($ratings);

$qry = "SELECT * FROM production_cost_master";
$pcosts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$pcost = mysqli_fetch_assoc($pcosts);

$qry = "SELECT * FROM aspect_ratio_master";
$aratios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$aratio = mysqli_fetch_assoc($aratios);

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

<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>


<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CACACA">

<table width="100%">
	<tr>
		<td><span style="font-size:14px; color:#FF9900"><strong>You're Editing: <?php echo isset($_SESSION["moviename"]); ?></strong></span></td>
		<td><a href="admin.php"> <span style="font-size:14px;" > Go Back to Home Page</a></span></td>
		<td><a href="admin_view_movie.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"> <span style="font-size:14px;"> Go Back to Movies Page</a></span></td>
	</tr>
</table>
<?php if(isset($usermsg)) {
	echo $usermsg;
} ?>

<form action="admin_add_movie.php" enctype="multipart/form-data" method="post" name="addmovie">

<?php if (isset($_SESSION["movieid"])) { ?>
	<input type="hidden" value="1" name="editmovieinfo" />
<?php } else { ?>
	<input type="hidden" value="1" name="addmovieinfo" />
<?php } ?>
<table width="100%" border="0">
	<tr>
		<td align="right"><strong>Name:</strong></td>
		<?php if(isset($movie["name"])){ ?>
			<td colspan="3"><input type="text" name="name" size="65" value="<?php echo $movie["name"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="name" size="65" value="" /></td>
		<?php } ?>
		
	</tr><tr>
		<td align="right"><strong>Title Message:</strong></td>
		<?php if(isset($movie["title_message"])){ ?>
		<td colspan="3"><input type="text" name="title_message" size="65" value="<?php echo $movie["title_message"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="title_message" size="65" value="" /></td>
		<?php } ?>
	</tr><tr>
		<td align="right"><strong>Length:</strong></td>
		<?php if(isset($movie["length"])){ ?>
			<td colspan="3"><input type="text" name="length" size="6" value="<?php echo $movie["length"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="length" size="6" value="0" /></td>
		<?php } ?>
	</tr><tr>
		<td align="right"><strong>Censor Number:</strong></td>
		<?php if(isset($movie["censor_number"])){ ?>
		<td colspan="3"><input type="text" name="censor_number" size="15" value="<?php echo $movie["censor_number"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="censor_number" size="15" value="" /></td>
		<?php } ?>	
	</tr><tr>
		<td align="right"><strong>Censored Date:</strong></td>
		<?php if(isset($movie["censored_date"])){ ?>
			<td><input id="censored_date" name="censored_date" class="text" type="text" size="10" value="<?php echo $movie["censored_date"]; ?>"/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
		onMouseOut="this.style.background=''"; /><br /></td>
		<?php } else { ?>
			<td><input id="censored_date" name="censored_date" class="text" type="text" size="10" value=""/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
		onMouseOut="this.style.background=''"; /><br /></td>
		<?php } ?>	
	</tr><tr>
		<td align="right"><strong>Release Date:</strong></td>
		<?php if(isset($movie["release_date"])){ ?>
			<td><input id="release_date" name="release_date" class="text" type="text" size="10" value="<?php echo $movie["release_date"]; ?>"/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
			onMouseOut="this.style.background=''"; /><br /></td>
		<?php } else { ?>
			<td><input id="release_date" name="release_date" class="text" type="text" size="10" value=""/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_date" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
			onMouseOut="this.style.background=''"; /><br /></td>
		<?php } ?>	
	</tr>
	<tr>
		<td align="right"><strong>Dubbed From:</strong></td>
		<?php if(isset($movie["dubbed_from_movie"])){ ?>
			<td colspan="3"><input type="text" name="dubbed_from_movie" size="65" value="<?php echo $movie["dubbed_from_movie"]; ?>"/></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="dubbed_from_movie" size="65" value=""/></td>
		<?php } ?>	
	</tr>
	<tr>
		<td align="right"><strong>Format:</strong></td>
		<td>
		<select name="format_id">
			<option value="0">Select One...</option>
			<?php do{  ?>
				<option value="<?php echo $format["id"]; ?>"
				 <?php if (isset($movie["format_id"])&&($movie["format_id"] == $format["id"])) {?>
				 	selected
				 	<?php } ?>>
				 <?php echo $format["description"]; ?></option>
			<?php } while ($format = mysqli_fetch_assoc($formats)); ?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right"><strong>Rating:</strong></td>
		<td>
		<select name="rating_id">
			<option value="0">Select One...</option>
			<?php do {  ?>
				<option value="<?php echo $rating["id"]; ?>" 
				<?php if (isset($m["rating"])&&($movie["rating_id"] == $rating["id"])) {?>
					selected
				<?php } ?> >
				<?php echo $rating["description"]; ?></option>
			<?php } while ($rating = mysqli_fetch_assoc($ratings));?>
		</select>
		</td>
	</tr><tr>
		<td align="right"><strong>Language:</strong></td>
		<td>
		<select name="lang_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x < $countlang; $x++) {  ?>
				<option value="<?php echo $langid[$x]; ?>" 
				<?php if (isset($movie["lang_id"])&&($movie["lang_id"] == $langid[$x])) {?>
				selected
				<?php } ?> >
				<?php echo $langdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
	</tr><tr>
		<td align="right"><strong>Original Language:</strong></td>
		<td>
		<select name="original_lang_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x < $countlang; $x++) {  ?>
				<option value="<?php echo $langid[$x]; ?>" 
				<?php if (isset($movie["original_lang_id"])&&($movie["original_lang_id"] == $langid[$x])) {?>
				selected
				<?php } ?>>
				<?php echo $langdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td align="right"><strong>Parent Category:</strong></td>
		<td>
		<select name="parent_category_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x<$countcat; $x++) {  ?>
				<option value="<?php echo $catid[$x]; ?>" 
				<?php if (isset($movie["parent_category_id"])&&($movie["parent_category_id"] == $catid[$x])) {?>
				selected
				<?php } ?>><?php echo $catdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
	</tr><tr>
		<td align="right"><strong>Child Category:</strong></td>
		<td>
		<select name="child_category_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x<$countcat; $x++) {  ?>
				<option value="<?php echo $catid[$x]; ?>" 
				<?php if (isset($movie["child_category_id"])&&($movie["child_category_id"] == $catid[$x])) {
					?>
					selected
				<?php } ?>>
				<?php echo $catdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
	</tr><tr>
		<td align="right"><strong>Third Category:</strong></td>
		<td>
		<select name="third_category_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x<$countcat; $x++) {  ?>
				<option value="<?php echo $catid[$x]; ?>" 
				<?php if (isset($movie["third_category_id"])&&($movie["third_category_id"] == $catid[$x])) {
					?>
					selected
				<?php } ?>>
				<?php echo $catdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
		
	</tr>
	<tr>
		<td align="right"><strong>Production Cost:</strong></td>
		<td>
		<select name="production_cost_id">
			<option value="0">Select One...</option>
			<?php do {  ?>
				<option value="<?php echo $pcost["id"]; ?>"
				 <?php if (isset($movie["production_cost_id"])&&($movie["production_cost_id"] == $pcost["id"])) {?>
				 selected
				 <?php } ?>>
				 <?php echo $pcost["cost"]; ?></option>
			<?php } while ($pcost = mysqli_fetch_assoc($pcosts));?>
		</select>
		</td>
	</tr><tr>
		<td align="right"><strong>Aspect Ratio:</strong></td>
		<td>
		<select name="aspect_ratio_id">
			<option value="0">Select One...</option>
			<?php do {  ?>
				<option value="<?php echo $aratio["id"]; ?>" 
				<?php if (isset($movie["aspect_ratio_id"])&&($movie["aspect_ratio_id"] == $aratio["id"])) {?>
				selected
				<?php } ?>>
				<?php echo $aratio["description"]; ?></option>
			<?php } while ($aratio = mysqli_fetch_assoc($aratios));?>
		</select>
		</td>
	</tr>
	</tr><tr>
		<td align="right"><strong>Run Time:</strong></td>
		<?php if (isset($movie["run_time"])) { ?>
			<td colspan="3"><input type="text" name="run_time" size="10" value="<?php echo $movie["run_time"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="run_time" size="10" value="" /></td>
		<?php }	?>
	</tr>
	</tr><tr>
		<td align="right"><strong>Number of Days Ran:</strong></td>
		<?php if (isset($movie["no_of_days"])) { ?>
			<td colspan="3"><input type="text" name="no_of_days" size="4" value="<?php  echo $movie["no_of_days"]; ?>" /></td>
		<?php } else { ?>
			<td colspan="3"><input type="text" name="no_of_days" size="4" value="0" /></td>
		<?php }	?>
	</tr>
	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
		 	<?php if (isset($_SESSION["movieid"])) { ?>
		 		<input type="submit" value="Update Movie" />
		 		<input type="button" value="New Movie" onClick="javascript:location.href='admin_add_movie.php?new=1'" />
		 	<?php } else { ?>
		 		<input type="submit" value="Add Movie" /><?php } ?>
		 </td>
	</tr>
</table>
</form>


<?php 



if (isset($_SESSION["movieid"]))
{
?>
<table>
	<tr>
		<td>
			<a href="movies/cast_new.php?movie_id=<?php echo  $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Cast</a></span>
			&nbsp;&nbsp;
			<a href="movies/cast_highlight_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Cast Hlght</a></span>
			&nbsp;&nbsp;
			<a href="movies/cast_punch_dialog_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Cast Dialogs</a></span>
			&nbsp;&nbsp;
			<a href="movies/cast_rating_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Cast Rating</a></span>
			&nbsp;&nbsp;
		</td>

		<td>
			<a href="movies/language_info_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Details</a></span>
			&nbsp;&nbsp;
			<a href="movies/text_content_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Text Content</a></span>
			&nbsp;&nbsp;
			<a href="movie_digital_content.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Digital</a></span>
			&nbsp;&nbsp;
			<a href="movies/detail_review_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Reviews</a></span>
			&nbsp;&nbsp;
			<a href="movies/punch_dialog_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Dialog</a></span>
			&nbsp;&nbsp;
			<a href="movies/location_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Locations</a></span>
			&nbsp;&nbsp;
			<a href="movies/studio_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Studio</a></span>
			&nbsp;&nbsp;
			<a href="movies/studio_rating_new.php?movie_id=<?php echo $_SESSION["movieid"]; ?>"><span style="font-size:14px;">Studio Rating</a></span>
		</td>
	</tr>
</table>
<?php } ?>
</body>
</html>
<script type="text/javascript">
	Calendar.setup({
	inputField     :    "release_date",     // id of the input field
	ifFormat       :    "%m/%d/%Y",      // format of the input field
	button         :    "f_trigger_date",  // trigger for the calendar (button ID)
	align          :    "Bl",           // alignment (defaults to "Bl")
	singleClick    :    true
	});
</script>
