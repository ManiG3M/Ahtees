<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

//print_r($_POST);

if (isset($_POST["addcusaward"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
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
        $data["entered_by"] = $_REQUEST["userid"];
	if ($_POST["money_received"])
	{
		$data["money_received"] = $_POST["money_received"];
	} else {
		$data["money_received"] = 0;
	}
	add_record("customer_award", $data);
}

if (isset($_POST["modifycusaward"]))
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
        $data["updated_by"] = $_REQUEST["userid"];
	if ($_POST["money_received"])
	{
		$data["money_received"] = $_POST["money_received"];
	} else {
		$data["money_received"] = 0;
	}
	$where = "id= ".$_REQUEST["cawardid"];
	modify_record("customer_award", $data, $where);
}

if (isset($_REQUEST["deleteaward"]))
{
	delete_record_secondary("customer_award", $_REQUEST["deleteaward"], "id");
}

if (isset($_REQUEST["movie_id"]) || isset($_POST["moviesearch"]))
{
	$qry = "SELECT movie_master.*, language_master.description FROM movie_master, language_master ";
	$qry.= " WHERE movie_master.active = 1 and (movie_master.name LIKE '%".$_POST["moviesearch"]."%') AND language_master.id = movie_master.lang_id ORDER BY movie_master.name";
	$movies = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$movie = mysqli_fetch_assoc($movies);
}

//echo $qry;
//$customers = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
//$customer = mysqli_fetch_assoc($customers);

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM award_master order by description";
	$awards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$award = mysqli_fetch_assoc($awards);
	
	$qry = "SELECT customer_award.*, award_master.description, award_master.initiated_by, movie_master.name FROM customer_award INNER JOIN award_master ON (customer_award.award_id = award_master.id) LEFT JOIN movie_master ON (customer_award.movie_id = movie_master.id) WHERE customer_id = ".$_REQUEST["custid"];
	$cawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$caward = mysqli_fetch_assoc($cawards);
	
	if (isset($_REQUEST["cawardid"]))
	{
		$qry = "SELECT customer_award.* FROM customer_award WHERE customer_award.id = ".$_REQUEST["cawardid"];
		//echo $qry."<BR>";
		$mawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$maward = mysqli_fetch_assoc($mawards);
	}
}
?>
<h1>Editing Awards of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td valign="top">
			<table cellpadding="0" cellspacing="1" border="0">
			<form name="searchmovieform" enctype="multipart/form-data" method="post" action="awards_new.php">
				<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
				<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
				<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			
				<tr>
					<td align="right"><strong>Search Movie:</strong>&nbsp;</td>
					
					<td colspan="3"><input type="text" name="moviesearch" value=""/>&nbsp;&nbsp;
					<input type="submit" value="Search" /></td>
				
				</tr>
				<tr>
					<td colspan="2"><hr /></td>
				</tr>				
			</form>

			<form name="addaward" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["cawardid"])) { ?>
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
							<option value ="<?php echo $award["id"]; ?>" 
							<?php if (isset($maward["award_id"])&&($maward["award_id"] == $award["id"])) { ?>
								selected
								<?php } ?>>
								<?php echo $award["description"] . " (" . $award["initiated_by"] . ")"; ?></option>
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
							<option value ="<?php echo $movie["id"]; ?>" 
							<?php if (isset($maward["movie_id"])&&($maward["movie_id"] == $movie["id"])) { ?>
							selected
							<?php } ?>>
							<?php echo $movie["name"] ." (" . $movie["description"] .")"; ?></option>
							<?php } while ($movie = mysqli_fetch_assoc($movies)); 
							}?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Occasion:</strong>&nbsp;</td>
					<?php if(isset($maward["received_occassion"])) { ?>
						<td colspan="3"><input type="text" name="received_occassion" size="41" value="<?php echo $maward["received_occassion"]; ?>"></td>
					<?php } else { ?>
						<td colspan="3"><input type="text" name="received_occassion" size="41" value=""></td>	
					<?php } ?>
					
				</tr>
				<tr>
					<td align="right"><strong>Given By:</strong>&nbsp;</td>
					<?php if(isset($maward["given_by"])) { ?>
						<td><input type="text" name="given_by" value="<?php echo $maward["given_by"]; ?>"></td>
					<?php } else { ?>
						<td><input type="text" name="given_by" value=""></td>	
					<?php } ?>
					
				</tr>

				<tr>
					<td align="right"><strong>Received Year:</strong>&nbsp;</td>
					<?php if(isset($maward["received_year"])) { ?>
						<td><input type="text" name="received_year" value="<?php echo $maward["received_year"]; ?>"></td>
					<?php } else { ?>
						<td><input type="text" name="received_year" value=""></td>	
					<?php } ?>
					
				</tr>
				<tr>
					<td align="right"><strong>Received Month:</strong>&nbsp;</td>
					<?php if(isset($maward["received_month"])) { ?>
						<td><input type="text" name="received_month" value="<?php echo $maward["received_month"]; ?>"></td>
					<?php } else { ?>
						<td><input type="text" name="received_month" value=""></td>	
					<?php } ?>
					
				</tr>
				<tr>
					<td align="right"><strong>Received Day:</strong>&nbsp;</td>
					<?php if(isset($maward["received_day"])) { ?>
						<td><input type="text" name="received_day" value="<?php echo $maward["received_day"]; ?>"></td>
					<?php } else { ?>
						<td><input type="text" name="received_day" value=""></td>	
					<?php } ?>
					
				</tr>

				<tr>
					<td align="right"><strong>Money:</strong>&nbsp;</td>
					<?php if(isset($maward["money_received"])) { ?>
						<td><input type="text" name="money_received" value="<?php echo $maward["money_received"]; ?>"></td>
					<?php } else { ?>
						<td><input type="text" name="money_received" value=""></td>	
					<?php } ?>
					
				</tr>

				<tr>
					<?php if (isset($_REQUEST["cawardid"])) { ?>
						<td colspan="2"><input type="submit" value="Modify">&nbsp;&nbsp;
						<input type="button" value="New" onclick="javascript:location.href='awards_new.php?newcaward=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td colspan="2"><input type="submit" value="Add Award"></td>
					<?php } ?>
				</tr>	
				</form>	
			</table>
		</td>
		</tr>
		<tr>
		<td align="left" valign="top">
		<?php if (isset($caward)) {?>
			<table width="50%">
				<tr bgcolor="#999999">
					<td><strong>Award</strong></td>
					<td><strong>Initiated</strong></td>
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
					<td><?php echo $caward["initiated_by"]; ?></td>
					<td><?php echo $caward["name"]; ?></td>
					<td><?php echo $caward["received_year"] . "/" . $caward["received_month"]; ?></td>
					<td><?php echo $caward["given_by"]; ?></td>
					<td><?php echo $caward["money_received"]; ?></td>
					<td><a href="awards_new.php?cawardid=<?php echo $caward["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>&movie_id=<?php echo $caward["movie_id"]; ?>">edit</a>&nbsp;<a href="awards_new.php?deleteaward=<?php echo $caward["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>&movie_id=<?php echo $caward["movie_id"]; ?>">delete</a></td>
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
		<?php } else { ?>
			<center> <h3> No Awards </h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
