<?php 

if ($_REQUEST["newdegree"])
{
	unset($_SESSION["degreeid"]);
}

if ($_REQUEST["degreeid"])
{
	$_SESSION["degreeid"] = $_REQUEST["degreeid"];
}

if ($_POST["adddegree"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["degree_id"] = $_POST["degree_id"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_degrees", $data);
}

if ($_POST["modifydegree"])
{

	$data["degree_id"] = $_POST["degree_id"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["degreeid"];
	modify_record("customer_degrees", $data, $where);
}

if ($_REQUEST["deletedegree"])
{
	delete_record_secondary("customer_degrees", $_REQUEST["deletedegree"], "id");
}

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM education_degree_master order by name";
	$degrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$degree = mysqli_fetch_assoc($degrees);
	
	$qry = "SELECT customer_degrees.*, education_degree_master.name FROM customer_degrees INNER JOIN education_degree_master ON (customer_degrees.degree_id = education_degree_master.id) WHERE customer_id = ".$_SESSION["custid"];
	$cdegrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cdegree = mysqli_fetch_assoc($cdegrees);
	
	if ($_SESSION["degreeid"])
	{
		$qry = "SELECT customer_degrees.* FROM customer_degrees WHERE customer_degrees.id = ".$_SESSION["degreeid"];
		//echo $qry."<BR>";
		$mdegrees = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mdegree = mysqli_fetch_assoc($mdegrees);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="adddegrees" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["degreeid"]) { ?>
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
							<option value ="<?php echo $degree["id"]; ?>" <?php if ($mdegree["degree_id"] == $degree["id"]) {?>selected<?php } ?>><?php echo $degree["name"]; ?></option>
							<?php } while ($degree = mysqli_fetch_assoc($degrees)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["degreeid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Degree"><br /><input type="button" value="New degree" onclick="javascript:location.href='admin_add_customer.php?newdegree=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Degree"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($cdegree) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
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
					<td><a href="admin_add_customer.php?degreeid=<?php echo $cdegree["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deletedegree=<?php echo $cdegree["id"]; ?>">delete</a></td>
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
		</div>
		<?php } else { ?>
			<center> <h3> No Degrees</h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
