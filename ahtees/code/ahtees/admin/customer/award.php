<?php 
//unset($_SESSION["cawardid"]);
if ($_REQUEST["newcaward"])
{
	unset($_SESSION["cawardid"]);
}

if ($_REQUEST["cawardid"])
{
	$_SESSION["cawardid"] = $_REQUEST["cawardid"];
}

//print_r($_POST);
if ($_POST["addcusaward"])
{
	$data["customer_id"] = $_SESSION["custid"];
	if ($_POST["movie_id"])
	{
		$data["movie_id"] = $_POST["movie_id"];
	}
	$data["award_id"] = $_POST["award_id"];

	$data["received_year"] = $_POST["received_year"];
	$data["received_month"] = $_POST["received_month"];
	$data["received_day"] = $_POST["received_day"];
	$data["received_occassion"] = $_POST["received_occassion"];
	$data["given_by"] = $_POST["given_by"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["entered_by"] = $_SESSION["userid"];
	if ($_POST["money_received"])
	{
		$data["money_received"] = $_POST["money_received"];
	} else {
		$data["money_received"] = 0;
	}
	add_record("customer_award", $data);
}

if ($_POST["modifycusaward"])
{

	if ($_POST["movie_id"])
	{
		$data["movie_id"] = $_POST["movie_id"];
	}
	$data["award_id"] = $_POST["award_id"];
	$data["received_year"] = $_POST["received_year"];
	$data["received_month"] = $_POST["received_month"];
	$data["received_day"] = $_POST["received_day"];
	$data["received_occassion"] = $_POST["received_occassion"];
	$data["given_by"] = $_POST["given_by"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
        $data["updated_by"] = $_SESSION["userid"];
	if ($_POST["money_received"])
	{
		$data["money_received"] = $_POST["money_received"];
	} else {
		$data["money_received"] = 0;
	}
	$where = "id= ".$_SESSION["cawardid"];
	modify_record("customer_award", $data, $where);
}


if ($_REQUEST["deleteaward"])
{
	delete_record_secondary("customer_award", $_REQUEST["deleteaward"], "id");
}


if ($_POST["moviesearch"])
{
	$qry = "SELECT * FROM movie_master";
	$qry.= " WHERE name LIKE '%".$_POST["moviesearch"]."%'";
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
}



//echo $qry;
//$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
//$customer = mysqli_fetch_assoc($customers);

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM award_master order by description";
	$awards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$award = mysqli_fetch_assoc($awards);
	
	$qry = "SELECT customer_award.*, award_master.description, movie_master.name FROM customer_award INNER JOIN award_master ON (customer_award.award_id = award_master.id) LEFT JOIN movie_master ON (customer_award.movie_id = movie_master.id) WHERE customer_id = ".$_SESSION["custid"];
	$cawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$caward = mysqli_fetch_assoc($cawards);
	
	if ($_SESSION["cawardid"])
	{
		$qry = "SELECT customer_award.* FROM customer_award WHERE customer_award.id = ".$_SESSION["cawardid"];
		//echo $qry."<BR>";
		$mawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$maward = mysqli_fetch_assoc($mawards);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="30%" valign="top">
			
			<table cellpadding="0" cellspacing="1" border="0">
			<form name="searchmovieform" enctype="multipart/form-data" method="post" action="admin_add_customer.php">
				<tr>
					<td align="right"><strong>Search Movie:</strong>&nbsp;</td>
					<td colspan="3"><input type="text" name="moviesearch" value="<?php echo $_POST["moviesearch"]; ?>"/>&nbsp;&nbsp;<input type="submit" value="Search" /></td>
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
			</form>

			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["cawardid"]) { ?>
				<input type="hidden" value="1" name="modifycusaward">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcusaward">
			<?php } ?>
				<tr>
					<td align="right"><strong>Award:</strong>&nbsp;</td>
					<td>
						<select name="award_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $award["id"]; ?>" <?php if ($maward["award_id"] == $award["id"]) {?>selected<?php } ?>><?php echo $award["description"] . " (" . $award["initiated_by"] . ")"; ?></option>
							<?php } while ($award = mysqli_fetch_assoc($awards)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Movie:</strong>&nbsp;</td>
					<td>
						<select name="movie_id">
							<option value="0">Select one...</option>
							<?php 
							if ($movie) {
							do { ?>
							<option value ="<?php echo $movie["id"]; ?>" <?php if ($maward["movie_id"] == $movie["id"]) {?>selected<?php } ?>><?php echo $movie["name"]; ?></option>
							<?php } while ($movie = mysqli_fetch_assoc($movies)); 
							}?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Occasion:</strong>&nbsp;</td>
					<td colspan="3"><input type="text" name="received_occassion" size="41" value="<?php echo $maward["received_occassion"]; ?>"></td>
				</tr>
				<tr>
					<td align="right"><strong>Given By:</strong>&nbsp;</td>
					<td><input type="text" name="given_by" value="<?php echo $maward["given_by"]; ?>"></td>
				</tr>

				<tr>
					<td align="right"><strong>Received Year:</strong>&nbsp;</td>
					<td><input type="text" name="received_year" value="<?php echo $maward["received_year"]; ?>"></td>
				</tr>

				<tr>
					<td align="right"><strong>Received Month:</strong>&nbsp;</td>
					<td><input type="text" name="received_month" value="<?php echo $maward["received_month"]; ?>"></td>
				</tr>

				<tr>
					<td align="right"><strong>Received Day:</strong>&nbsp;</td>
					<td><input type="text" name="received_day" value="<?php echo $maward["received_day"]; ?>"></td>
				</tr>

				<tr>
					<td align="right"><strong>Money:</strong>&nbsp;</td>
					<td><input type="text" name="money_received" value="<?php echo $maward["money_received"]; ?>"></td>
				</tr>

				<tr>
					<?php if ($_SESSION["cawardid"]) { ?>
						<td colspan="2"><input type="submit" value="Modify">&nbsp;&nbsp;<input type="button" value="New" onclick="javascript:location.href='admin_add_customer.php?newcaward=1';"/></td>				
					<?php } else { ?>
						<td colspan="2"><input type="submit" value="Add Award"></td>
					<?php } ?>
				</tr>	
				</form>	
			</table>
		</td>
		<td width="60%" align="left" valign="top">
		<?php if ($caward) {?>
		<div style="overflow:auto; height:240px; width:540px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Award</strong></td>
					<td><strong>Movie</strong></td>
					<td><strong>Received Year/Month</strong></td>
					<td><strong>Given By</strong></td>
					<td><strong>Money</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $caward["description"]; ?></td>
					<td><?php echo $caward["name"]; ?></td>
					<td><?php echo $caward["received_year"] . "/" . $caward["received_month"]; ?></td>
					<td><?php echo $caward["given_by"]; ?></td>
					<td><?php echo $caward["money_received"]; ?></td>
					<td><a href="admin_add_customer.php?cawardid=<?php echo $caward["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deleteaward=<?php echo $caward["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($caward = mysqli_fetch_assoc($cawards)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Awards </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
