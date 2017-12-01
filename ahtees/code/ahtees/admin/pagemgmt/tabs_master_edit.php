<?php 
require_once('../../connections/DB.php');
include('../../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();

if ($_REQUEST["id"])
{
	$id = $_REQUEST["id"];
} else if ($_POST["id"]) {
	$id = $_POST["id"];
}

if ($_POST)
{
	$data["name"] = $_POST["name"];
	$data["status"] = $_POST["status"];
	$data["lang_id"] = $_POST["lang_id"];
	$where = "id = ".$_POST["id"];
	modify_record("tabs_master", $data, $where);
	$modmsg = "<font color='red'>Tabs Updated, Close Window and refresh Tabs Master</font>";
	header("location: tabs_master.php");
	}

$qry = "SELECT tabs_master.*, home_page_status_master.description  FROM tabs_master, home_page_status_master WHERE tabs_master.id = ".$id ." AND tabs_master.status = home_page_status_master.id" ;
$raagas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$rag = mysqli_fetch_assoc($raagas);

$qry = "SELECT * FROM home_page_status_master order by description";
$statuses = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$status = mysqli_fetch_assoc($statuses);

$qry = "SELECT * FROM language_master ORDER BY description";
$languages = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
$language = mysqli_fetch_assoc($languages);

$countlang = 0;
do {
	$langid[] = $language["id"];
	$langdesc[] = $language["description"];
	$countlang++;
} while ($language = mysqli_fetch_assoc($languages)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tabs Master Edit</title>
<link href="../../includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "../../greybox/";
</script>


<script type="text/javascript" src="../../greybox/AJS.js"></script>
<script type="text/javascript" src="../../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../greybox/gb_scripts.js"></script>
<link href="../../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#CCCCCC">
<?php if ($modmsg) { echo $modmsg; } ?>
<form name="editloc" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table align="left">
	<tr>
		<td><strong>Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $rag["name"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Status:</strong></td>
		<td>
			<select name="status">
				<option value="0">Select One...</option>
				<?php do { ?>
				<option value="<?php echo $status["id"]; ?>"
				<?php
				if ( $status["id"] == $rag["status"] ) {
					echo " selected>"; }
				else {
					echo ">"; }
				?>
				<?php echo $status["description"]; ?></option>
				<?php } while ($status = mysqli_fetch_assoc($statuses)); ?>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right"><strong>Language:</strong></td>
		<td>
		<select name="lang_id">
			<option value="0">Select One...</option>
			<?php for ($x=0; $x < $countlang; $x++) {  ?>
				<option value="<?php echo $langid[$x]; ?>" <?php if ($rag["lang_id"] == $langid[$x]) {?>selected<?php } ?>><?php echo $langdesc[$x]; ?></option>
			<?php } ?>
		</select>
		</td>
	</tr>
	<tr>
	<input type="submit" value="Update" /></td>
	</tr>
</table>
</form>

</body>
</html>
