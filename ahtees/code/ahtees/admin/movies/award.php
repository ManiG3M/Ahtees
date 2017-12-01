<?php 
date_default_timezone_set('Asia/Kolkata');

if ($_REQUEST["newaward"])
{
	unset($_SESSION["awardid"]);
}

if ($_REQUEST["awardid"])
{
	$_SESSION["awardid"] = $_REQUEST["awardid"];
}

if ($_POST["addcusaward"])
{
	$data["movie_id"] = $_SESSION["movieid"];
	$data["award_id"] = $_POST["award_id"];
	$data["received_date"] = date('Y-m-d H:i:s', strtotime($_POST["received_date"]));
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
	add_record("movie_award", $data);
}

if ($_POST["modifycusaward"])
{

	$data["award_id"] = $_POST["award_id"];
	$data["received_date"] = date('Y-m-d H:i:s', strtotime($_POST["received_date"]));
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
	$where = "id= ".$_SESSION["awardid"];
	modify_record("movie_award", $data, $where);
}

if ($_REQUEST["deleteaward"])
{
	delete_record_secondary("movie_award", $_REQUEST["deleteaward"], "id");
}

$qry = "SELECT * FROM award_master";
$awards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$award = mysqli_fetch_assoc($awards);
	
if ($_SESSION["movieid"]) 
{
		
	$qry = "SELECT movie_award.*, award_master.description FROM movie_award INNER JOIN award_master ON (movie_award.award_id = award_master.id) WHERE movie_id = ".$_SESSION["movieid"];
	$cawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$caward = mysqli_fetch_assoc($cawards);
	
	if ($_SESSION["awardid"])
	{
		$qry = "SELECT movie_award.* FROM movie_award WHERE movie_award.id = ".$_SESSION["awardid"];
		//echo $qry."<BR>";
		$mawards = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$maward = mysqli_fetch_assoc($mawards);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addaward" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["awardid"]) { ?>
				<input type="hidden" value="1" name="modifycusaward">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcusaward">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Award:</strong>&nbsp;</td>
					<td colspan="3">
						<select name="award_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $award["id"]; ?>" <?php if ($award["id"] == $maward["award_id"]) { ?>selected<?php } ?>><?php echo $award["description"]; ?>&nbsp;(<?php echo $award["initiated_by"]; ?>)</option>
							<?php } while ($award = mysqli_fetch_assoc($awards)); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><strong>Date:</strong>&nbsp;</td>
					<td><input id="received_date" name="received_date" class="text" type="text" size="10" value="<?php echo $maward["received_date"]; ?>"/>&nbsp;<img src="../images/cal.gif" width="18" align="absmiddle" id="f_trigger_rdate" style="cursor: pointer; " title="Date selector" onMouseOver="this.style.background='red';" 
onMouseOut="this.style.background=''"; /><br /></td>
				</tr>	
				<tr>
					<td align="right"><strong>Occasion:</strong>&nbsp;</td>
					<td colspan="3"><input type="text" name="received_occassion" size="41" value="<?php echo $maward["received_occassion"]; ?>"></td>
				</tr>
				<tr>
					<td align="right"><strong>Given By:</strong>&nbsp;</td>
					<td><input type="text" name="given_by" value="<?php echo $maward["given_by"]; ?>"></td>
					<td align="right"><strong>Money:</strong>&nbsp;</td>
					<td><input type="text" name="money_received" value="<?php echo $maward["money_received"]; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["awardid"]) { ?>
						<td colspan="4"><input type="submit" value="Modify Award">&nbsp;&nbsp;<input type="button" value="New Award" onclick="javascript:location.href='admin_add_movie.php?newaward=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Award"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($caward) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Award</strong></td>
					<td><strong>date</strong></td>
					<td><strong>Given By</strong></td>
					<td><strong>Money</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				$ary1 = explode(" ", $caward["received_date"]);
				$ary2 = explode("-", $ary1[0]);
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $caward["description"]; ?></td>
					<td><?php echo $ary2[1]."/".$ary2[2]."/".$ary2[0]; ?></td>
					<td><?php echo $caward["given_by"]; ?></td>
					<td><?php echo $caward["money_received"]; ?></td>
					<td><a href="admin_add_movie.php?awardid=<?php echo $caward["id"]; ?>">edit</a>&nbsp;<a href="admin_add_movie.php?deleteaward=<?php echo $caward["id"]; ?>">delete</a></td>
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
<script type="text/javascript">
	Calendar.setup({
	inputField     :    "received_date",     // id of the input field
	ifFormat       :    "%m/%d/%Y",      // format of the input field
	button         :    "f_trigger_rdate",  // trigger for the calendar (button ID)
	align          :    "Bl",           // alignment (defaults to "Bl")
	singleClick    :    true
	});
</script>
