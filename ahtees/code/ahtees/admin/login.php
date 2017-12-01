<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
////mysql_select_db($database_DB, $connDB);
session_start();

$errormsg="";
date_default_timezone_set('Asia/Kolkata');
if ($_POST)
{
	$qry = "SELECT * FROM user_master WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."'";
	$passwords = mysqli_query($connDB, $qry) or die('Query failed: ' . mysqli_error($connDB)); 
	$password = mysqli_fetch_assoc($passwords);
	
	if (!$password)
	{
		$errormsg = "<font color='red'>Wrong username/password</font>";
	} else {
		$_SESSION["userid"] = $password["id"];
		$_SESSION["level"] = $password["level"];
		header("location: admin.php");
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Language People - Content Management System</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table width="800" border="0" cellpadding="0" cellspacing="0" id="cmsborder">
  <!--DWLayoutTable-->
	<tr>
    	<td height="54" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      			<tr>
        		
		            <td width="680" valign="top">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						 <tr>
				<td><img src="images/logo.jpg"></td>
			</tr>
            <!--DWLayoutTable-->
            				<tr>
					  			<td width="678" height="23" valign="top" id="head1_sp1"><!--DWLayoutEmptyCell-->&nbsp;</td>
              				</tr>
            				<tr>
              					<td height="27" valign="top" id="topright_sp1" align="left"><span class="header1_text">CONTENT MANAGEMENT SYSTEM LOGIN</span><br /></td>
            				</tr>
							<tr>
			  					<td class="text" align="center"><br>
<br>

			   						<table border="1" frame="border" width="60%" bgcolor="#E9E9E9">
										<tr>
				  							<td>
												<form name="loginform" enctype="multipart/form-data" action="login.php" method="post">
				  								<table align="center" width="100%" border="0" frame="border">
													<?php if ($errormsg) { ?>
													<tr>
														<td colspan="2" align="center"><?php echo $errormsg; ?></td>
													</tr>
													<?php } else {?>
													<tr>
														<td colspan="2">&nbsp;</td>
													</tr>
													<?php } ?>
													<tr class="header">
	                      								<td align="right"><strong>User Name:</strong></td>
														<td align="left"><input type="text" name="username" size="30"/></td>
													</tr>
													<tr class="header">
														<td align="right"><strong>Password:</strong></td>
														<td align="left"><input type="password" name="password" size="30"/></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td align="left"><input type="submit" value="Log into CMS" /></td>
													</tr>
												</table>
												</form>
				  							</td>
				 						</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</div>
</body>
</html>
