<?php 

if ($_REQUEST["newlang"])
{
	unset($_SESSION["clangid"]);
}

if ($_REQUEST["clangid"])
{
	$_SESSION["clangid"] = $_REQUEST["clangid"];
}

if ($_POST["addcuslanguage"])
{
	$data["customer_id"] = $_SESSION["custid"];
	$data["lang_id"] = $_POST["lang_id"];
	$data["fluency_level"] = $_POST["fluency_level"];
	$data["entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["entered_by"] = $_SESSION["userid"];
	add_record("customer_language", $data);
}

if ($_POST["modifycuslanguage"])
{

	$data["lang_id"] = $_POST["lang_id"];
	$data["fluency_level"] = $_POST["fluency_level"];
	$data["updated_date"] = date('Y-m-d H:i:s', strtotime("now"));
       	$data["updated_by"] = $_SESSION["userid"];
	$where = "id= ".$_SESSION["clangid"];
	modify_record("customer_language", $data, $where);
}

if ($_REQUEST["deletelang"])
{
	delete_record_secondary("customer_language", $_REQUEST["deletelang"], "id");
}

if ($_SESSION["custid"]) 
{
	$qry = "SELECT * FROM language_master order by description";
	$langs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$lang = mysqli_fetch_assoc($langs);
	
	$qry = "SELECT customer_language.*, language_master.description FROM customer_language INNER JOIN language_master ON (customer_language.lang_id = language_master.id) WHERE customer_id = ".$_SESSION["custid"];
	$clangs = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$clang = mysqli_fetch_assoc($clangs);
	
	if ($_SESSION["clangid"])
	{
		$qry = "SELECT customer_language.* FROM customer_language WHERE customer_language.id = ".$_SESSION["clangid"];
		//echo $qry."<BR>";
		$mlanguages = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$mlanguage = mysqli_fetch_assoc($mlanguages);
	}
}
?>
<table width ="100%" cellpadding="0" cellspacing="0" border="1">
	<tr>
		<td width="50%" valign="top">
			<form name="addlanguage" enctype="multipart/form-data" method="post">
			<?php if ($_SESSION["clangid"]) { ?>
				<input type="hidden" value="1" name="modifycuslanguage">
			<?php } else { ?>
				<input type="hidden" value="1" name="addcuslanguage">
			<?php } ?>
			<table cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td align="right"><strong>Language:</strong>&nbsp;</td>
					<td>
						<select name="lang_id">
							<option value="0">Select one...</option>
							<?php do { ?>
							<option value ="<?php echo $lang["id"]; ?>" <?php if ($mlanguage["lang_id"] == $lang["id"]) {?>selected<?php } ?>><?php echo $lang["description"]; ?></option>
							<?php } while ($lang = mysqli_fetch_assoc($langs)); ?>
						</select>
					</td>
					<td align="right"><strong>Fluency Level:</strong>&nbsp;</td>
					<td><select name="fluency_level">
							<option value="0">Select one...</option>
							<option value="1" <?php if ($mlanguage["fluency_level"] == 1) {?>selected<?php } ?>>One</option>
							<option value="2" <?php if ($mlanguage["fluency_level"] == 2) {?>selected<?php } ?>>Two</option>
							<option value="3" <?php if ($mlanguage["fluency_level"] == 3) {?>selected<?php } ?>>Three</option>
							<option value="4" <?php if ($mlanguage["fluency_level"] == 4) {?>selected<?php } ?>>Four</option>
							<option value="5" <?php if ($mlanguage["fluency_level"] == 5) {?>selected<?php } ?>>Five</option>
						</select></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<?php if ($_SESSION["clangid"]) { ?>
						<td colspan="3"><input type="submit" value="Modify Language">&nbsp;&nbsp;<input type="button" value="New Language" onclick="javascript:location.href='admin_add_customer.php?newlang=1';"/></td>				
					<?php } else { ?>
						<td><input type="submit" value="Add Language"></td>
					<?php } ?>
				</tr>		
			</table>
			</form>
		</td>
		<td width="50%" align="center" valign="top">
		<?php if ($clang) {?>
		<div style="overflow:auto; height:140px; width:360px"> 
			<table width="100%">
				<tr bgcolor="#999999">
					<td><strong>Language</strong></td>
					<td><strong>Fluency Level</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				$bgcolor = "WHITE";
				do { 
				?>
				<tr bgcolor="<?php echo $bgcolor; ?>">
					<td><?php echo $clang["description"]; ?></td>
					<td><?php echo $clang["fluency_level"]; ?></td>
					<td><a href="admin_add_customer.php?clangid=<?php echo $clang["id"]; ?>">edit</a>&nbsp;<a href="admin_add_customer.php?deletelang=<?php echo $clang["id"]; ?>">delete</a></td>
				</tr>
				<?php 
				if ($bgcolor == "WHITE")
				{
					$bgcolor = "#DADADA";
				} else {
					$bgcolor = "WHITE";
				}
				} while ($clang = mysqli_fetch_assoc($clangs)); ?>
			</table>
		</div>
		<?php } else { ?>
			<center> <h3> No Languages </h3> </center>
		<?php } ?>
		</td>
	</tr>
</table>
