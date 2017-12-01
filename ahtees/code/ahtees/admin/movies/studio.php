<?php 

date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newstudio"])
{
	unset($_SESSION["studioid"]);
}

if ($_REQUEST["studioid"])
{
	$_SESSION["studioid"] = $_REQUEST["studioid"];
}


if ($_POST["addstudio"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["studio_id"] = $_POST["studio_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_studio", $data);
}

if ($_POST["modifystudio"])
{
	$data["studio_id"] = $_POST["studio_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["studioid"];
	modify_record("movie_studio", $data, $where);
}

if ($_REQUEST["deletestudiol"])
{
	delete_record_secondary("movie_studio", $_REQUEST["deletestudiol"], "id");
}

$qry = "SELECT * FROM studio_master";
$studios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$studio = mysqli_fetch_assoc($studios);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_studio.*, studio_master.name, studio_master.city, studio_master.state, studio_master.country FROM movie_studio INNER JOIN studio_master ON (movie_studio.studio_id = studio_master.id) WHERE movie_studio.movie_id = ".$_SESSION["movieid"];
	$cmoviess = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cmovies = mysqli_fetch_assoc($cmoviess);
	
	if ($_SESSION["studioid"])
	{
		$qry = "SELECT movie_studio.* FROM movie_studio WHERE movie_studio.id = ".$_SESSION["studioid"];
		//echo $qry."<BR>";
		$mstudios = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mstudio = mysqli_fetch_assoc($mstudios);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addstudio" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["studioid"]) { ?>
				<input type="hidden" value="1" name="modifystudio">
			<?php } else { ?>
				<input type="hidden" value="1" name="addstudio">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Studio:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="studio_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $studio["id"]; ?>" <?php if ($studio["id"] == $mstudio["studio_id"]) { ?>selected<?php } ?>><?php echo $studio["name"]; ?></option>
							<?php } while ($studio = mysqli_fetch_assoc($studios)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["studioid"]) { ?>
						<td><input type="submit" value="Modify Studio">&nbsp;&nbsp;<input type="button" value="New Studio" onclick="javascript:location.href='admin_add_movie.php?newstudio=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Studio"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cmovies) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Studio</strong></td>
					<td><strong>City</strong></td>
					<td><strong>State</strong></td>
					<td><strong>Country</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cmovies["name"]; ?></td>
					<td><?php echo $cmovies["city"]; ?></td>
					<td><?php echo $cmovies["state"]; ?></td>
					<td><?php echo $cmovies["country"]; ?></td>
					<td><a href="admin_add_movie.php?studioid=<?php echo $cmovies["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletestudiol=<?php echo $cmovies["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cmovies = mysqli_fetch_assoc($cmoviess)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Studios</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
