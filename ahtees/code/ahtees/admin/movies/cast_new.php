<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');
//print_r($_POST);
echo "<BR>";

if (isset($_REQUEST["movie_id"]))
{
	$movie_id = $_REQUEST["movie_id"];
}
elseif(isset($_POST["movie_id"]))
{
	$movie_id = $_POST["movie_id"];
}

if (isset($_POST["addcast"]))
{
	$data["movie_id"] = $movie_id;
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

if (isset($_POST["modifycast"]))
{
	$data["movie_id"] = $movie_id;
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
	$where = "id= ".$_REQUEST["mcastid"];
	modify_record("movie_cast", $data, $where);

}

if (isset($_REQUEST["deletecast"]))
{
	delete_record_secondary("movie_cast", $_REQUEST["deletecast"], "id");
}

if (isset($_POST["castsearch"]) || (isset($_REQUEST["mcastid"]))) 
{
	$qry = "SELECT customer_master.*, movie_industry_master.description, talent_master.description as talent_description FROM customer_master, movie_industry_master, talent_master WHERE customer_master.status = 1 AND (customer_master.first_name LIKE '%".$_POST["castsearch"]."%' OR customer_master.last_name LIKE '%".$_POST["castsearch"]."%' OR customer_master.star_name LIKE '%".$_POST["castsearch"]."%') AND customer_master.primary_industry_id = movie_industry_master.id AND customer_master.primary_skill_id = talent_master.id order by customer_master.star_name";
	//echo $qry;
	$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$customer = mysqli_fetch_assoc($customers);
}

$qry = "SELECT * FROM movie_role_type_master order by description";
$roletypes = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$roletype = mysqli_fetch_assoc($roletypes);
	
if ($movie_id) 
{
	$qry = "SELECT movie_cast.*, customer_master.first_name, customer_master.last_name, customer_master.star_name, movie_role_type_master.description FROM movie_cast, customer_master, movie_role_type_master WHERE movie_cast.movie_id = ".$movie_id ." AND movie_cast.customer_id = customer_master.customer_id AND movie_role_type_master.id = movie_cast.role_type_id order by customer_master.star_name";

	$ccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$ccast = mysqli_fetch_assoc($ccasts);
	
	if (isset($_REQUEST["mcastid"]))
	{
		$qry = "SELECT movie_cast.* FROM movie_cast WHERE movie_cast.id = ".$_REQUEST["mcastid"];
		$mccasts = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mccast = mysqli_fetch_assoc($mccasts);
	}
}






if (isset($_REQUEST["movie_id"]))
{
	$qry = "SELECT id, name FROM movie_master where id = ". $_REQUEST["movie_id"]; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
?>
	You're Editing: <b><?php echo $movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<a href="../admin_view_movie.php?movie_id=<?php echo $_REQUEST["movie_id"]; ?>">Go back to Movies</a>

<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<table cellpadding="0" cellspacing="1" border="0" width="100%">

				<form name="searchcastform" enctype="multipart/form-data" method="post" action="cast_new.php">
				<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
				<tr>
					<td align="right"><strong>Search Cast:</strong>&nbsp;</td>
					<?php if(isset($_POST["castsearch"])) { ?>
						<td ><input type="text" name="castsearch" value="<?php echo $_POST["castsearch"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Search" /></td>
					<?php } else { ?>
						<td ><input type="text" name="castsearch" value=""/>&nbsp;&nbsp;<input type="submit" value="Search" /></td>
					<?php } ?>
					
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
				</form>


				<form name="addaward" enctype="multipart/form-data" method="post">
				<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
				<?php if (isset($_REQUEST["mcastid"])) { ?>
					<input type="hidden" value="1" name="modifycast">
				<?php } else { ?>
					<input type="hidden" value="1" name="addcast">
				<?php } ?>
				<tr>
					<td align="right"><strong>Role Type:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="role_type_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo isset($roletype["id"]); ?>" 
								<?php if (isset($mccast["role_type_id"])&&($mccast["role_type_id"] == $roletype["id"])) {?>
								selected
								<?php } ?>>
								<?php echo $roletype["description"]; ?></option>
							<?php } while ($roletype = mysqli_fetch_assoc($roletypes)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Cast Name:</strong>&nbsp;</td>
					<td >
						<?php if (isset($customer)) { ?>
						<select name="customer_id">
							<option value="0">Select one...</option>
							<?php do { ?>
								<option value ="<?php echo $customer["customer_id"]; ?>" 
									<?php if (isset($mccast["customer_id"])&&($mccast["customer_id"] == $customer["customer_id"])) {?>
									selected
									<?php } ?>>
									<?php echo $customer["first_name"]." ".$customer["last_name"].", ".$customer["star_name"] . " (" . $customer["description"] . "," .$customer["talent_description"] .")"; ?></option>
							<?php } while ($customer = mysqli_fetch_assoc($customers)); ?>
						</select>
						<?php } else { ?>
						<font color="red"><strong>No Cast Found, Try A New Search</strong></font>
						<?php } ?>
					</td>
				</tr>	
				<tr>
					<td align="right"><strong>Name in Movie:</strong>&nbsp;</td>
					<td >
					<?php if(isset($mccast["name_in_movie"])) { ?>
						<input type="text" name="name_in_movie" size="80" value="<?php echo $mccast["name_in_movie"]; ?>"/>
					<?php } else {?>
						<input type="text" name="name_in_movie" size="80" value=""/>
					<?php }?>	
					</td>
				</tr>
				<tr>
					<td align="right"><strong># of Roles:</strong>&nbsp;</td>
					<td>
						<?php if(isset($mccast["no_of_roles"])) { ?>
							<input id="no_of_roles" name="no_of_roles" class="text" type="text" size="5" value="<?php echo $mccast["no_of_roles"]; ?>"/>
					<?php } else {?>
						<input id="no_of_roles" name="no_of_roles" class="text" type="text" size="5" value=""/>
					<?php }?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["mcastid"])) { ?>
						<td><input type="submit" value="Modify Cast">&nbsp;&nbsp;<input type="button" value="New Cast" onclick="javascript:location.href='cast_new.php?newcast=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Cast"></td>
					<?php } ?>
				</tr>		
			</form>
			</table>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($ccast) {?>
			<table>
				<tr bgcolor="#999999">
					<td><strong>Role Type</strong></td>
					<td><strong>Cast Name</strong></td>
					<td><strong>Star Name</strong></td>
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
					<td><?php echo $ccast["star_name"]; ?></td>
					<td><?php echo $ccast["name_in_movie"]; ?></td>
					<td><?php echo $ccast["no_of_roles"]; ?></td>
					<td><a href="cast_new.php?mcastid=<?php echo $ccast["id"]; ?>&movie_id=<?php echo 			$movie_id; ?>">edit</a>&nbsp;
						<a href="cast_new.php?deletecast=<?php echo $ccast["id"]; ?>&movie_id=<?php echo 		$movie_id; ?>">delete</a></td>
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
		<?php } else { ?>
			<center> <h3> No Cast </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
