<?php 


date_default_timezone_set('Asia/Kolkata');
if ($_REQUEST["newcast"])
{
	unset($_SESSION["mcastid"]);
}


if ($_REQUEST["mcastid"])
{
	$_SESSION["mcastid"] = $_REQUEST["mcastid"];
}

if ($_POST["addcastaward"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["customer_id"] = $_POST["customer_id"];
	if ($_POST["no_of_roles"])
	{
		$data["no_of_roles"] = $_POST["no_of_roles"];
	} else {
		$data["no_of_roles"] = 1;
	}
	$data["role_type_id"] = $_POST["role_type_id"];
	$data["name_in_movie"] = $_POST["name_in_movie"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_cast", $data);
}

if ($_POST["modifycastaward"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["customer_id"] = $_POST["customer_id"];
	if ($_POST["no_of_roles"])
	{
		$data["no_of_roles"] = $_POST["no_of_roles"];
	} else {
		$data["no_of_roles"] = 1;
	}
	$data["role_type_id"] = $_POST["role_type_id"];
	$data["name_in_movie"] = $_POST["name_in_movie"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["mcastid"];
	modify_record("movie_cast", $data, $where);
}

if ($_REQUEST["deletecast"])
{
	delete_record_secondary("movie_cast", $_REQUEST["deletecast"], "id");
}

if ($_POST["castsearch"]) 
{
	$qry = "SELECT * FROM customer_master WHERE status = 1 AND first_name LIKE '%".$_POST["castsearch"]."%' OR last_name LIKE '%".$_POST["castsearch"]."%' OR star_name LIKE '%".$_POST["castsearch"]."%'";
} else { 
	$qry = "SELECT * FROM customer_master WHERE status = 1";
}
//echo $qry;
$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$customer = mysqli_fetch_assoc($customers);

$qry = "SELECT * FROM movie_role_type_master";
$roletypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$roletype = mysqli_fetch_assoc($roletypes);
	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, customer_master.star_name, movie_role_type_master.description FROM movie_cast INNER JOIN customer_master ON (movie_cast.customer_id = customer_master.customer_id) INNER JOIN movie_role_type_master ON (movie_role_type_master.id = movie_cast.role_type_id) WHERE movie_id = ".$_SESSION["movieid"];
	$ccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccast = mysqli_fetch_assoc($ccasts);
	
	if ($_SESSION["mcastid"])
	{
		$qry = "SELECT movie_cast.* FROM movie_cast WHERE movie_cast.id = ".$_SESSION["mcastid"];
		$mccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mccast = mysqli_fetch_assoc($mccasts);
	}
	
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<table cellpadding="0" cellspacing="1" border="0" width="100%">
				<form name="searchcastform" enctype="multipart/form-data" method="post" action="admin_add_movie.php">
				<tr>
					<td align="right"><strong>Search Cast:</strong>&nbsp;</td>
					<td ><input type="text" name="castsearch" value="<?php echo $_POST["castsearch"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Search" /></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
				</form>
				<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["mcastid"]) { ?>
				<input type="hidden" value="1" name="modifycastaward">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcastaward">
			<?php } ?>
				<tr>
					<td align="right"><strong>Role Type:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="role_type_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $roletype["id"]; ?>" <?php if ($mccast["role_type_id"] == $roletype["id"]) {?>selected<?php } ?>><?php echo $roletype["description"]; ?></option>
							<?php } while ($roletype = mysqli_fetch_assoc($roletypes)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Cast Name:</strong>&nbsp;</td>
					<td >
						<?php if ($customer) { ?>
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $customer["customer_id"]; ?>" <?php if ($mccast["customer_id"] == $customer["customer_id"]) {?>selected<?php } ?>><?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["star_name"]; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
						<?php } else { ?>
						<font color="red"><strong>No Cast Found, Try A New Search</strong></font>
						<?php } ?>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Name in Movie:</strong>&nbsp;</td>
					<td ><input type="text" name="name_in_movie" size="30" value="<?php echo $mccast["name_in_movie"]; ?>"></td>
				</tr>
				<tr>
					<td align="right"><strong># of Roles:</strong>&nbsp;</td>
					<td><input id="no_of_roles" name="no_of_roles" class="text" type="text" size="5" value="<?php echo $mccast["no_of_roles"]; ?>"/></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["mcastid"]) { ?>
						<td><input type="submit" value="Modify Cast">&nbsp;&nbsp;<input type="button" value="New Cast" onclick="javascript:location.href='admin_add_movie.php?newcast=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast"></td>
					<?php } ?>
				</tr>		
			</form>
			</table>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccast) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table>
				<tr bgcolor="#999999">
					<td><strong>Role Type</strong></td>
					<td><strong>Cast</strong></td>
					<td><strong>Name in Movie</strong></td>
					<td><strong># Roles</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $ccast["description"]; ?></td>
					<td><?php echo $ccast["first_name"]." ".$ccast["last_name"]; ?></td>
					<td><?php echo $ccast["name_in_movie"]; ?></td>
					<td><?php echo $ccast["no_of_roles"]; ?></td>
					<td><a href="admin_add_movie.php?mcastid=<?php echo $ccast["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deletecast=<?php echo $ccast["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($ccast = mysqli_fetch_assoc($ccasts)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Cast </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
