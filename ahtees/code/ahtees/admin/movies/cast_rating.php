<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newcastcr"])
{
	unset($_SESSION["mcastcrid"]);
}

if ($_REQUEST["mcastcrid"])
{
	$_SESSION["mcastcrid"] = $_REQUEST["mcastcrid"];
}


if ($_POST["addcastrating"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["customer_id"] = $_POST["customer_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast_rating", $data);
}

if ($_POST["modifycastrating"])
{

	$data["customer_id"] = $_POST["customer_id"];
	$data["rating_id"] = $_POST["rating_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["mcastcrid"];
	modify_record("movie_cast_rating", $data, $where);
}

if ($_REQUEST["deletecastrating"])
{
	delete_record_secondary("movie_cast_rating", $_REQUEST["deletecastrating"], "id");
}

//$qry = "SELECT distinct customer_master.* FROM customer_master RIGHT JOIN movie_cast ON (customer_master.customer_id = movie_cast.customer_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, movie_role_type_master.description FROM movie_cast INNER JOIN customer_master ON (customer_master.customer_id = movie_cast.customer_id) INNER JOIN movie_role_type_master ON (movie_role_type_master.id = movie_cast.role_type_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_cast_rating.*, customer_master.first_name, customer_master.last_name, customer_rating_master.description FROM movie_cast_rating INNER JOIN customer_master ON (movie_cast_rating.customer_id = customer_master.customer_id) INNER JOIN customer_rating_master ON (customer_rating_master.id = movie_cast_rating.rating_id) WHERE movie_cast_rating.movie_id = ".$_SESSION["movieid"];
	$ccastrates = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccastrate = mysqli_fetch_assoc($ccastrates);
	
	if ($_SESSION["mcastcrid"])
	{
		$qry = "SELECT movie_cast_rating.* FROM movie_cast_rating WHERE movie_cast_rating.id = ".$_SESSION["mcastcrid"];
		//echo $qry."<BR>";
		$mcrcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mcrcast = mysqli_fetch_assoc($mcrcasts);
	}
}

$qry = "SELECT * FROM customer_rating_master";
$ratings = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rating = mysqli_fetch_assoc($ratings);

?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mcastcrid"]) { ?>
				<input type="hidden" value="1" name="modifycastrating">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastrating">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Cast:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" <?php if ($mcrcast["customer_id"] == $customer["customer_id"]) { ?>selected<?php } ?>><?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["description"]; ?></option>
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
				<option value="<?php echo $rating["id"]; ?>" <?php if ($mcrcast["rating_id"] == $rating["id"]) {?>selected<?php } ?>><?php echo $rating["description"]; ?></option>
			<?php } while ($rating = mysqli_fetch_assoc($ratings));?>
		</select>
		</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["mcastcrid"]) { ?>
						<td><input type="submit" value="Modify Cast Rating">&nbsp;&nbsp;<input type="button" value="New Cast Rating" onclick="javascript:location.href='admin_add_movie.php?newcastcr=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast Rating"></td>
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
					<td><strong>Cast</strong></td>
					<td><strong>Rating</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccastrate["first_name"]." ".$ccastrate["last_name"]; ?></td>
					<td><?php echo $ccastrate["description"]; ?></td>
					<td><a href="admin_add_movie.php?mcastcrid=<?php echo $ccastrate["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletecastrating=<?php echo $ccastrate["id"]; ?>">delete</a></td>
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
			<center> <h3> No Cast Rating</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
