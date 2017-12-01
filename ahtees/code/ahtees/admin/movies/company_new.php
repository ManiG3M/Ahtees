<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

//print_r($_POST);
//echo "<BR>";

if ($_REQUEST["movie_id"])
{
	$movie_id = $_REQUEST["movie_id"];
}
else
{
	$movie_id = $_POST["movie_id"];
}

if (isset($_POST["addcompany"]))
{
	$data["movie_id"] = $movie_id;
	$data["company_id"] = $_POST["company_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	add_record("movie_company", $data);
}

if (isset($_POST["modifycompany"]))
{
	$data["company_id"] = $_POST["company_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_REQUEST["companyid"];
	modify_record("movie_company", $data, $where);
}

if (isset($_REQUEST["deletecompany"]))
{
	delete_record_secondary("movie_company", $_REQUEST["deletecompany"], "id");
}

$qry = "SELECT * FROM movie_company_master ORDER BY name";
$companies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$company = mysqli_fetch_assoc($companies);

	
if ($movie_id) 
{
		
	$qry = "SELECT movie_company.*, movie_company_master.name, movie_company_master.city FROM movie_company INNER JOIN movie_company_master ON (movie_company.company_id = movie_company_master.id) WHERE movie_company.movie_id = ".$movie_id . " ORDER BY movie_company_master.name ";
	$cmoviess = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cmovies = mysqli_fetch_assoc($cmoviess);
	
	if (isset($_REQUEST["companyid"]))
	{
		$qry = "SELECT movie_company.* FROM movie_company WHERE movie_company.id = ".$_REQUEST["companyid"];
		//echo $qry."<BR>";
		$mcompanies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mcompany = mysqli_fetch_assoc($mcompanies);
	}
}
if ($movie_id)
{
	$qry = "SELECT id, name FROM movie_master where id = ". $movie_id; 
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
?>
	You're Editing: <b><?php echo $movie["name"]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<a href="../admin_view_movie.php?movie_id=<?php echo $movie_id; ?>">Go back to Movies</a>

<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addcompany" enctype="multipart/form-data" method="post">
			<input type=hidden name="movie_id" value="<?php echo $movie_id; ?>">
			<?php if (isset($_REQUEST["companyid"])) { ?>
				<input type="hidden" value="1" name="modifycompany">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcompany">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Company:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="company_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $company["id"]; ?>"
							 <?php if (isset($mcompany["company_id"])&&($company["id"] == $mcompany["company_id"])) { ?>
							 selected
							 <?php } ?>>
							 <?php echo $company["name"]; ?></option>
							<?php } while ($company = mysqli_fetch_assoc($companies)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["companyid"])) { ?>
						<td><input type="submit" value="Modify Company">&nbsp;&nbsp;<input type="button" value="New Company" onclick="javascript:location.href='company_new.php?newcompany=1&movie_id=<?php echo $movie_id; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Company"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cmovies) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Company</strong></td>
					<td><strong>City</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cmovies["name"]; ?></td>
					<td><?php echo $cmovies["city"]; ?></td>
					<td><a href="company_new.php?companyid=<?php echo $cmovies["id"]; ?>&movie_id=<?php echo $movie_id; ?>">edit</a>&nbsp;<a href="company_new.php?deletecompany=<?php echo $cmovies["id"]; ?>&movie_id=<?php echo $movie_id; ?>">delete</a></td>
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
		<?php } else { ?>
			<center> <h3> No Companies</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
