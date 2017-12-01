<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if (isset($_POST["addfavorite"]))
{
	$data["customer_id"] = $_REQUEST["custid"];
	$data["favorite_id"] = $_POST["favorite_id"];
	$data["what_they_like"] = $_POST["what_they_like"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_REQUEST["userid"];
	add_record("customer_favorites", $data);
}

if (isset($_POST["modifyfavorite"]))
{
	$data["favorite_id"] = $_POST["favorite_id"];
	$data["what_they_like"] = $_POST["what_they_like"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_REQUEST["userid"];
	$where = "id= ".$_REQUEST["favoriteid"];
	modify_record("customer_favorites", $data, $where);
}

if (isset($_REQUEST["deletefavorite"]))
{
	delete_record_secondary("customer_favorites", $_REQUEST["deletefavorite"], "id");
}

if ($_REQUEST["custid"]) 
{
	$qry = "SELECT * FROM favorite_master order by description";
	$favorites = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$favorite = mysqli_fetch_assoc($favorites);
	
	$qry = "SELECT customer_favorites.*, favorite_master.description FROM customer_favorites INNER JOIN favorite_master ON (customer_favorites.favorite_id = favorite_master.id) WHERE customer_id = ".$_REQUEST["custid"] ." order by favorite_master.description";
	$cfavorites = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$cfavorite = mysqli_fetch_assoc($cfavorites);
	
	if (isset($_REQUEST["favoriteid"]))
	{
		$qry = "SELECT customer_favorites.* FROM customer_favorites WHERE customer_favorites.id = ".$_REQUEST["favoriteid"];
		//echo $qry."<BR>";
		$mfavorites = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mfavorite = mysqli_fetch_assoc($mfavorites);
	}
}
?>
<h1>Editing Favorites of <?php echo $_REQUEST["display_name"]; ?> </h1>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addfavorites" enctype="multipart/form-data" method="post">
			<input type="hidden" value="<?php echo $_REQUEST["custid"]; ?>" name="custid">
			<input type="hidden" value="<?php echo $_REQUEST["userid"]; ?>" name="userid">
			<input type="hidden" value="<?php echo $_REQUEST["display_name"]; ?>" name="display_name">
			<?php if (isset($_REQUEST["favoriteid"])) { ?>
				<input type="hidden" value="1" name="modifyfavorite">
			<?php } else { ?>
				<input type="hidden" value="1" name="addfavorite">
			<?php } ?>
			<table cellpadding="0" cellspacing="1">
				<tr>
					<td align="right"><strong>Favorites</strong>&nbsp;</td>
					<td>
						<select name="favorite_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $favorite["id"]; ?>" 
							<?php if (isset($mfavorite["favorite_id"])&& ($mfavorite["favorite_id"]== $favorite["id"])) {?> selected
							<?php } ?>>
							<?php echo $favorite["description"]; ?></option>
							<?php } while ($favorite = mysqli_fetch_assoc($favorites)); ?>
						</select>
					</td>
				</tr>

				<tr>
					<td align="right"><strong>What/Who</strong>&nbsp;</td>
					<td>
					<?php if(isset($mfavorite["what_they_like"])) { ?>
						<input type="text" name="what_they_like" size="50" value="<?php echo $mfavorite["what_they_like"]; ?>"/>
					<?php } else { ?>
						<input type="text" name="what_they_like" size="50" value=""/>	
					<?php } ?>
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<?php if (isset($_REQUEST["favoriteid"])) { ?>
						<td colspan="3"><input type="submit" value="Modify Favorites"><br />
						<input type="button" value="New favorite" onclick="javascript:location.href='favorite_new.php?newfavorite=1&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Favorites"></td>
					<?php } ?>

				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if (isset($cfavorite)) {?>
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Favorite</strong></td>
					<td><strong>Description</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $cfavorite["description"]; ?></td>
					<td><?php echo $cfavorite["what_they_like"]; ?></td>
					<td><a href="favorite_new.php?favoriteid=<?php echo $cfavorite["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">edit</a>&nbsp;<a href="favorite_new.php?deletefavorite=<?php echo $cfavorite["id"]; ?>&custid=<?php echo $_REQUEST["custid"]; ?>&userid=<?php echo $_REQUEST["userid"]; ?>&display_name=<?php echo $_REQUEST["display_name"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($cfavorite = mysqli_fetch_assoc($cfavorites)); ?>
			</table>
		<?php } else { ?>
			<center> <h3> No Favorites</h3> </center>
		<?php } ?>
		</td>
	</tr>
		<a href="../admin_view_customer_new.php?custid=<?php echo $_REQUEST["custid"]; ?>">Back to View Cast</a>
</table>
