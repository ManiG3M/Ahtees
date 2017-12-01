<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newstudior"])
{
	unset($_SESSION["mstudiorid"]);
}

if ($_REQUEST["mstudiorid"])
{
	$_SESSION["mstudiorid"] = $_REQUEST["mstudiorid"];
}


if ($_POST["addstudiorating"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["studio_id"] = $_POST["studio_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_studio_rating", $data);
}

if ($_POST["modifystudiorating"])
{

	$data["studio_id"] = $_POST["studio_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["mstudiorid"];
	modify_record("movie_studio_rating", $data, $where);
}

if ($_REQUEST["deletestudiorating"])
{
	delete_record_secondary("movie_studio_rating", $_REQUEST["deletestudiorating"], "id");
}

//$qry = "SELECT distinct customer_master.* FROM customer_master RIGHT JOIN movie_cast ON (customer_master.customer_id = movie_cast.customer_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$qry = "SELECT movie_studio.*, studio_master.name FROM movie_studio INNER JOIN studio_master ON (studio_master.id = movie_studio.studio_id) WHERE movie_studio.movie_id = ".$_SESSION["movieid"];
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_studio_rating.*, studio_master.name, studio_ratings.rating FROM movie_studio_rating INNER JOIN studio_master ON (movie_studio_rating.studio_id = studio_master.id) INNER JOIN studio_ratings ON (studio_ratings.id = movie_studio_rating.rating_id) WHERE movie_studio_rating.movie_id = ".$_SESSION["movieid"];
	$ccastrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccastrate = mysqli_fetch_assoc($ccastrates);
	
	if ($_SESSION["mstudiorid"])
	{
		$qry = "SELECT movie_studio_rating.* FROM movie_studio_rating WHERE movie_studio_rating.id = ".$_SESSION["mstudiorid"];
		//echo $qry."<BR>";
		$mcrcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mcrcast = mysqli_fetch_assoc($mcrcasts);
	}
}

$qry = "SELECT * FROM studio_ratings";
$ratings = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rating = mysqli_fetch_assoc($ratings);

?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addstudio" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mstudiorid"]) { ?>
				<input type="hidden" value="1" name="modifystudiorating">
			<?php } else { ?>
				<input type="hidden" value="1" name="addstudiorating">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Studio:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="studio_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["studio_id"]; ?>" <?php if ($mcrcast["studio_id"] == $customer["studio_id"]) { ?>selected<?php } ?>><?php echo $customer["name"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Rating:</strong></td>
		<td>
		<select name="rating_id">
			<option value="0">Select One...</option>
			<?php do {  ?>
				<option value="<?php echo $rating["id"]; ?>" <?php if ($mcrcast["rating_id"] == $rating["id"]) {?>selected<?php } ?>><?php echo $rating["rating"]; ?></option>
			<?php } while ($rating = mysqli_fetch_assoc($ratings));?>
		</select>
		</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["mstudiorid"]) { ?>
						<td><input type="submit" value="Modify Studio Rating">&nbsp;&nbsp;<input type="button" value="New Studio Rating" onclick="javascript:location.href='admin_add_movie.php?newstudior=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Studio Rating"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccastrate) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Studio</strong></td>
					<td><strong>Rating</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccastrate["name"]; ?></td>
					<td><?php echo $ccastrate["rating"]; ?></td>
					<td><a href="admin_add_movie.php?mstudiorid=<?php echo $ccastrate["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletestudiorating=<?php echo $ccastrate["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccastrate = mysqli_fetch_assoc($ccastrates)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Studio Rating</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
