<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
//mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

if ($_POST || $_REQUEST)
{
	if ($_REQUEST["question_id"])
	{
		$question_id = $_REQUEST["question_id"];
	}	

	if ($_POST["question_id"])
	{
		$question_id = $_POST["question_id"];
		unset($_POST["question_id"]);
	}	
	if ($_POST["addquestion"]) 
	{	
		unset($_POST["addquestion"]);
		$_POST["question_entered_by"] = $_SESSION["userid"];
		$_POST["question_entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$question_id = add_record("knowledge_center", $_POST);
		$usermsg = "<font color='red'>New QA Added</font>";
	}

	if ($_POST["updatequestion"]) 
	{	
		unset($_POST["updatequestion"]);
		$_POST["question_entered_by"] = $_SESSION["userid"];
		$_POST["question_entered_date"] = date('Y-m-d H:i:s', strtotime("now"));
		$where = "id = ". $question_id;
		modify_record("knowledge_center", $_POST, $where);
		$usermsg = "<font color='red'>Customer Updated</font>";
	}
	
} 

if ($_REQUEST["unans"])
{
	$qry = "SELECT * FROM knowledge_center WHERE length(answer) = 0 "; 
	$qas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$qa = mysqli_fetch_assoc($qas);
}
else
{
	if ($_POST["searchqa"])
	{
		$qry = "SELECT * FROM knowledge_center WHERE question like '%". $_POST["searchterm"] ."%' OR answer like '%" . $_POST["searchterm"] ."%'"; 
		$qas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$qa = mysqli_fetch_assoc($qas);
	}
	else
	{
		$qry = "SELECT * FROM knowledge_center"; 
		$qas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
		$qa = mysqli_fetch_assoc($qas);
	}
}


if ($_REQUEST["editquestion"])
{
	$qry = "SELECT * FROM knowledge_center where id = ". $_REQUEST["question_id"]; 
	$x_qas = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$x_qa = mysqli_fetch_assoc($x_qas);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />

<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>

<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="lightyellow">
<center>
<h1>4000eyes - Knowledgebase</h1>
</center>

<table border=1>
<tr valign="top">
<td width="70%">
	<?php 
	$count = 1;
	do { 
		echo "<font size=4 color='green'><b>" . $count ."." .$qa["question"] ."?</font></b>&nbsp;"
		?>
		<a href="qa.php?editquestion=1&question_id=<?php echo $qa["id"]; ?>">edit</a><br>
		<?php echo $qa["answer"] ."<br><hr>"; ?>
	<?php  $count++;
		} while ($qa = mysqli_fetch_assoc($qas)); ?>
</td>

<td width="30%">

<table width="100%" border="0">
<form action="qa.php" enctype="multipart/form-data" method="post" name="searchqa">
		<input type="hidden" value="1" name="searchqa" />
	<tr>
		<td><strong>Search:</strong><hr></td>
		<td><input type="text" size="30" name="searchterm">&nbsp;&nbsp; 
			<input type="submit" value="Search QA" />
			<input type="button" value="Refresh Data" onClick="javascript:location.href='qa.php'" />
			<input type="button" value="Unanswered Questions" onClick="javascript:location.href='qa.php?unans=1'" />
		<hr></td>
	</tr>
</form>

<form action="qa.php" enctype="multipart/form-data" method="post" name="addcolum">
<?php if ($question_id) { ?>
	<input type="hidden" value="1" name="updatequestion" />
	<input type="hidden" value="<?php echo $question_id; ?>" name="question_id" />
<?php } else { ?>
	<input type="hidden" value="1" name="addquestion" />
<?php } ?>

	<tr>
		<td align="right"><strong>Question:</strong></td>
		<td colspan="3"><textarea cols="70" rows="3" name="question"><?php echo $x_qa["question"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right"><strong>Answer:</strong></td>
		<td colspan="3"><textarea cols="70" rows="6" name="answer"><?php echo $x_qa["answer"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="top">&nbsp;</td>
		<td colspan="5">
		<?php if ($question_id) { ?>
			<input type="submit" value="Update QA" />
			<input type="button" value="New QA" onClick="javascript:location.href='qa.php?new=1'" />
		<?php } else { ?>
			<input type="submit" value="Add QA" />
		<?php } ?></td>
</form>
</td>
</tr>
</table>

</body>
</html>
