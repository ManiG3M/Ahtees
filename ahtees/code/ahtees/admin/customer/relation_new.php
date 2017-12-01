<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_POST["addrelation"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["relation_id"] = $_POST["relation_id"];
	$data["relation_name"] = $_POST["relation_name"];
	$data["relation_number"] = $_POST["relation_number"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_relations", $data);
}

if (isset($_POST["modifyrelation"]))
{
	$data["relation_id"] = $_POST["relation_id"];
	$data["relation_name"] = $_POST["relation_name"];
	$data["relation_number"] = $_POST["relation_number"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["relationid"];
	modify_record("customer_relations", $data, $where);
}

if (isset($_REQUEST["deleterelation"]))
{
	delete_record_secondary("customer_relations", $_REQUEST["deleterelation"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM relation_master order by description";
	$relations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$relation = mysqli_fetch_assoc($relations);
	
	$qry = "SELECT customer_relations.*, relation_master.description FROM customer_relations INNER JOIN relation_master ON (customer_relations.relation_id = relation_master.id) WHERE customer_id = ".$_REQUEST["custid"] . " order by relation_master.description";
	$crelations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$crelation = mysqli_fetch_assoc($crelations);
	
	if (isset($_REQUEST["relationid"]))
	{
		$qry = "SELECT customer_relations.* FROM customer_relations WHERE customer_relations.id = ".$_REQUEST["relationid"];
		//echo $qry."<BR>";
		$mrelations = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mrelation = mysqli_fetch_assoc($mrelations);
	}
}
?>
<h1>Editing Relations of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top" align="left">
			<form name="addrelations" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["relationid"])) { ?>
				<input type="hidden" value="1" name="modifyrelation">
			<?php } else { ?>
				<input type="hidden" value="1" name="addrelation">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Relations</strong>&nbsp;</td>
					<td>
						<select name="relation_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $relation["id"]; ?>"
							 <?php if (isset($mrelation["relation_id"])&&($mrelation["relation_id"] == $relation["id"])) {?>
							 selected
							 <?php } ?>>
							 <?php echo $relation["description"]; ?></option>
							<?php } while ($relation = mysqli_fetch_assoc($relations)); ?>
						</select>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>Name</strong>&nbsp;</td>
					<td>
					<?php if(isset($mrelation["relation_name"])) { ?>
						<input type="text" name="relation_name" size="50" value="<?php echo $mrelation["relation_name"]; ?>"/>
					<?php } else { ?>
						<input type="text" name="relation_name" size="50" value=""/>
					<?php } ?>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>Number</strong>&nbsp;</td>
					<td>
					<?php if(isset($mrelation["relation_number"])) { ?>
						<input type="text" name="relation_number" size="2" value="<?php echo $mrelation["relation_number"]; ?>"/>
					<?php } else { ?>
						<input type="text" name="relation_number" size="2" value=""/>
					<?php } ?>	
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["relationid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Relations"><br />
						<input type="button" value="New relation" onclick="javascript:location.href='relation_new.php?newrelation=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Relations"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="left" valign="top">
		<?php if (isset($crelation)) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Relation</strong></td>
					<td><strong>Name</strong></td>
					<td><strong>Number</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $crelation["description"]; ?></td>
					<td><?php echo $crelation["relation_name"]; ?></td>
					<td><?php echo $crelation["relation_number"]; ?></td>
					<td><a href="relation_new.php?relationid=<?php echo $crelation["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="relation_new.php?deleterelation=<?php echo $crelation["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($crelation = mysqli_fetch_assoc($crelations)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Relations</h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
