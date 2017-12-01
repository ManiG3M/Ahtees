<?php 
date_default_timezone_set('Asia/Kolkata');

if ($_REQUEST["newcasthigh"])
{
	unset($_SESSION["mcasthid"]);
}

if ($_POST["addcasthighlight"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["customer_id"] = $_POST["customer_id"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["highlight"] = $_POST["highlight"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast_highlights", $data);
}

if ($_POST["modifycasthighlight"])
{
	$data["customer_id"] = $_POST["customer_id"];
	$data["highlight"] = $_POST["highlight"];
	$data["system_lang_code_id"] = $_POST["system_lang_code_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["mcasthid"];
	modify_record("movie_cast_highlights", $data, $where);
}

if ($_REQUEST["mcasthid"])
{
	$_SESSION["mcasthid"] = $_REQUEST["mcasthid"];
}


if ($_REQUEST["deletecasth"])
{
	delete_record_secondary("movie_cast_highlights", $_REQUEST["deletecasth"], "id");
}

//$qry = "SELECT distinct customer_master.* FROM customer_master RIGHT JOIN movie_cast ON (customer_master.customer_id = movie_cast.customer_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, movie_role_type_master.description FROM movie_cast INNER JOIN customer_master ON (customer_master.customer_id = movie_cast.customer_id) INNER JOIN movie_role_type_master ON (movie_role_type_master.id = movie_cast.role_type_id) WHERE movie_cast.movie_id = ".$_SESSION["movieid"];
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_cast_highlights.*, customer_master.first_name, customer_master.last_name, system_lang_code_master.name as langname FROM movie_cast_highlights INNER JOIN customer_master ON (movie_cast_highlights.customer_id = customer_master.customer_id) LEFT JOIN system_lang_code_master ON (movie_cast_highlights.system_lang_code_id = system_lang_code_master.id) WHERE movie_cast_highlights.movie_id = ".$_SESSION["movieid"];
	$ccasths = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccasth = mysqli_fetch_assoc($ccasths);
	
	if ($_SESSION["mcasthid"])
	{
		$qry = "SELECT movie_cast_highlights.* FROM movie_cast_highlights WHERE movie_cast_highlights.id = ".$_SESSION["mcasthid"];
		$mchcasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mchcast = mysqli_fetch_assoc($mchcasts);
	}
}

$qry = "SELECT * FROM system_lang_code_master";
$codemasters = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$codemaster = mysqli_fetch_assoc($codemasters);

?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mcasthid"]) { ?>
				<input type="hidden" value="1" name="modifycasthighlight">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcasthighlight">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Cast:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" <?php if ($mchcast["customer_id"] == $customer["customer_id"]) { ?>selected<?php } ?>><?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["description"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Language: </strong></td>
					<td colspan="3">
					<select name="system_lang_code_id">
						<option value="0">Select...</option>
					<?php do { ?>
						<option value="<?php echo $codemaster["id"]; ?>" <?php if ($codemaster["id"] == $mchcast["system_lang_code_id"]) { ?>selected<?php } ?>><?php echo $codemaster["name"]; ?></option>
					<?php } while ($codemaster = mysqli_fetch_assoc($codemasters)); ?>
					</select>
				  	</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Highlight:</strong>&nbsp;</td>
					<td colspan="3"><textarea name="highlight" cols="40" rows="4"><?php echo $mchcast["highlight"]; ?></textarea></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					
					<?php if ($_SESSION["mcasthid"]) { ?>
						<td><input type="submit" value="Modify Cast Highlight">&nbsp;&nbsp;<input type="button" value="New Cast Highlight" onclick="javascript:location.href='admin_add_movie.php?newcasthigh=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast Highlight"></td>
					<?php } ?></td>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccasth) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Cast</strong></td>
					<td><strong>Language</strong></td>
					<td><strong>Highlight</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccasth["first_name"]." ".$ccasth["last_name"]; ?></td>
					<td><?php echo $ccasth["langname"]; ?></td>
					<td><?php echo $ccasth["highlight"]; ?></td>
					<td><a href="admin_add_movie.php?mcasthid=<?php echo $ccasth["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletecasth=<?php echo $ccasth["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccasth = mysqli_fetch_assoc($ccasths)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Cast Highlights</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
