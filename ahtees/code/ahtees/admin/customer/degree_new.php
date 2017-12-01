<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_POST["adddegree"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["degree_id"] = $_POST["degree_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_degrees", $data);
}

if (isset($_POST["modifydegree"]))
{

	$data["degree_id"] = $_POST["degree_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["degreeid"];
	modify_record("customer_degrees", $data, $where);
}

if (isset($_REQUEST["deletedegree"]))
{
	delete_record_secondary("customer_degrees", $_REQUEST["deletedegree"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM education_degree_master order by name";
	$degrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$degree = mysqli_fetch_assoc($degrees);
	
	$qry = "SELECT customer_degrees.*, education_degree_master.name FROM customer_degrees INNER JOIN education_degree_master ON (customer_degrees.degree_id = education_degree_master.id) WHERE customer_id = ".$_REQUEST["custid"];
	$cdegrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdegree = mysqli_fetch_assoc($cdegrees);
	
	if (isset($_REQUEST["degreeid"]))
	{
		$qry = "SELECT customer_degrees.* FROM customer_degrees WHERE customer_degrees.id = ".$_REQUEST["degreeid"];
		//echo $qry."<BR>";
		$mdegrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdegree = mysqli_fetch_assoc($mdegrees);
	}
}
?>
<h1>Editing Degrees of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="adddegrees" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["degreeid"])) { ?>
				<input type="hidden" value="1" name="modifydegree">
			<?php } else { ?>
				<input type="hidden" value="1" name="adddegree">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Degrees</strong>&nbsp;</td>
					<td>
						<select name="degree_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $degree["id"]; ?>" 
							<?php if (isset($mdegree["degree_id"])&&($mdegree["degree_id"] == $degree["id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $degree["name"]; ?></option>
							<?php } while ($degree = mysqli_fetch_assoc($degrees)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["degreeid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Degree"><br />
						<input type="button" value="New degree" onclick="javascript:location.href='degree_new.php?newdegree=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Degree"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($cdegree)) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Degree</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cdegree["name"]; ?></td>
					<td><a href="degree_new.php?degreeid=<?php echo $cdegree["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="degree_new.php?deletedegree=<?php echo $cdegree["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cdegree = mysqli_fetch_assoc($cdegrees)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Degrees</h3> </center>
		<?php } ?>
		</td>
	</tr>
	<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
