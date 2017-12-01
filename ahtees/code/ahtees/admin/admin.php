<?php 
require_once('../connections/DB.php');
include('../connections/tablefuncs.php');
////mysql_select_db($database_DB, $connDB);
session_start();
date_default_timezone_set('Asia/Kolkata');

if (!$_SESSION["userid"])
{
	header("location: login.php");
}

?>
<?php include("../scripts/collapse.js"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ahtees India - Content Management System</title>
<link href="../includes/cms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>


<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<table width="800" border="0" cellpadding="0" cellspacing="0" id="cmsborder" align="center">
  <!--DWLayoutTable-->
  <tr>
    <td height="54" valign="top" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
      <!--DWLayoutTable-->
      <tr>

          <td width="680" valign="top" align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <!--DWLayoutTable-->
            <tr>
				<td><img src="images/logo.jpg"></td>
			</tr>
			<tr>
              <td width="100%" height="23" valign="top" id="head1_sp1"><!--DWLayoutEmptyCell-->&nbsp;</td>
              </tr>
            <tr>
              <td height="27" valign="top" id="topright_sp1"><span class="header1_text">CONTENT MANAGEMENT SYSTEM</span><br /></td>
            </tr>
			<tr>
			  <td class="text" align="center"><br />
			    Click on each section header or +/- to toggle the selection for updating.
			      <br />
			      <br />
			      <br />
			      <table border="1" frame="border" width="60%" bgcolor="#E9E9E9">
					<tr>
				  		<td align="center">
				  			<table align="center" valign width="100%" border="0" frame="border">
								<tr class="header">
	                    			<td width="61%"><a name="testexpand" onclick="expandcontent('users')" style="cursor:hand; cursor:pointer">User Administration</a></td>
                      				<td width="39%" align="right"><a name="testexpand" onclick="expandcontent('users')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="users" class="switchcontent">
                          				<table>
                         					<tr>
												<td><a href="admin_add_user.php" title="Add New User">add user</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_user.php" title="View Users" rel="gb_page_center[600, 500]">view/edit/delete users</a></td>
											</tr>
                          				</table>
                      					</div>
									</td>
								</tr>
								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('movies')" style="cursor:hand; cursor:pointer">Manage Movies</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('movies')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="movies" class="switchcontent">
                          				<table>
                         					<tr>
												<td><a href="admin_add_movie.php" title="Add Movie" >Add New Movies</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_movie.php" title="Search Movies">Search, View, Update, and Disable Movies</a></td>
											</tr>
        			<tr>
											<td><a href="admin_add_customer.php" title="Add Cast">Add Cast (Actors)</a></td>
											</tr>

											<tr>
												<td><a href="admin_view_customer_new.php" title="View Cast"> Search, View, and Update Cast (Actors) NEW VERSION!</a></td>
											</tr>

											<tr>
												<td width="35%"><hr /></td>
											</tr>

											<tr class="header">
												<td><font color="green"><strong>Supporting Movie Masters</strong></font></td>
											</tr>

											<tr>
												<td><a href="masters/customer_status_master.php" title="Cast Status Master" rel="gb_page_center[310, 250]">Cast(Actor) Status Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/award_master.php" title="Award Master" rel="gb_page_center[500, 400]">Awards Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/language_master.php" title="Language Master" rel="gb_page_center[310, 250]">Languages Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/sports_master.php" title="Sports Master" rel="gb_page_center[310, 250]">Sports Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/talent_master.php" title="Talent Master" rel="gb_page_center[310, 250]">Talent Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/movie_status_master.php" title="Movie Status Master" rel="gb_page_center[310, 250]">Movie Status Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/system_lang_code_master.php" title="System Lang Code Master" rel="gb_page_center[310, 250]">Manage Ahtees Supported Languages </a></td>
											</tr>

											<tr>
												<td><a href="masters/theme_master.php" title="Theme Master" rel="gb_page_center[310, 250]">Theme Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/country_master.php" title="Country Master" rel="gb_page_center[450, 350]">Countries Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/state_master.php" title="State Master" rel="gb_page_center[410, 350]">States Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/movie_company_master.php" title="Movie Company Master">Movie Companies Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/aspect_ratio_master.php" title="Aspect Ratio Master" rel="gb_page_center[310, 250]">Aspect Ratio Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/production_cost_master.php" title="Production Cost Master" rel="gb_page_center[310, 250]">Production Cost Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/format_master.php" title="Format Master" rel="gb_page_center[310, 250]">Format Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/category_master.php" title="Category Master" rel="gb_page_center[310, 250]">Category Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/language_master.php" title="Language Master" rel="gb_page_center[310, 250]">Language Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/rating_master.php" title="Rating Master" rel="gb_page_center[310, 250]">Ratings Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/location_master.php" title="Location Master">Location Management</a></td>
											</tr>
											<tr>
												<td><a href="masters/location_type_master.php" title="Location Type Master" rel="gb_page_center[350, 280]">Location Type Maangement</a></td>
											</tr>
											<tr>
												<td><a href="masters/award_master.php" title="Award Master" rel="gb_page_center[500, 400]">Award Management</a></td>
											</tr>

											<tr>
												<td><a href="masters/content_type_master.php" title="Content Type Master" rel="gb_page_center[310, 250]">content type master</a></td>
											</tr>

											<tr>
												<td><a href="masters/text_type_master.php" title="Text Type Master" rel="gb_page_center[310, 250]">Text type master</a></td>
											</tr>


											<tr>
												<td><a href="masters/content_type_file_extensions.php" title="Content Type File Extensions" rel="gb_page_center[410, 350]">content type file extensions</a></td>
											</tr>
											<tr>
												<td><a href="masters/movie_role_type_master.php" title="Movie Role Type Master" rel="gb_page_center[310, 250]">Movie Role Types</a></td>
											</tr>
											<tr>
												<td><a href="masters/raaga_master.php" title="Ragaa Master" rel="gb_page_center[550, 480]">Ragaas</a></td>
											</tr>
											<tr>
												<td><a href="masters/song_type_master.php" title="Song Type Master" rel="gb_page_center[350, 280]">Song Types</a></td>
											</tr>
											<tr>
												<td><a href="masters/education_degree_master.php" title="Education Degree Master" rel="gb_page_center[350, 280]">Education Degrees</a></td>
											</tr>
											<tr>
												<td><a href="masters/total_worth_master.php" title="Total Worth Value " rel="gb_page_center[350, 280]">Total Worth Value</a></td>
											</tr>

											<tr>
												<td><a href="masters/relation_master.php" title="Relations" rel="gb_page_center[350, 280]">Relations Master</a></td>
											</tr>

											<tr>
												<td><a href="masters/favorite_master.php" title="Favorites" rel="gb_page_center[350, 280]">Favorites Master</a></td>
											</tr>

											<tr>
												<td><a href="masters/attributes_master.php" title="Attributes" rel="gb_page_center[350, 280]">Attributes Master</a></td>
											</tr>
                          				</table>
                      					</div>
									</td>
								</tr>
								</tr>
								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr class="header">
	                    			<td><a name="testexpand" onclick="expandcontent('studio')" style="cursor:hand; cursor:pointer">Studio Master</a></td>
                      				<td align="right"><a name="testexpand" onclick="expandcontent('studio')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="studio" class="switchcontent">
                          				<table>
                         					<tr>
												<td><a href="admin_add_studio.php" title="Add New Studio" >add Studio</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_studio.php" title="View Studios" >view/edit/delete Studios</a></td>
											</tr>
											<tr>
												<td><a href="admin_view_movie_special.php" title="Search Movies">Find Missing Movies</a></td>
											</tr>
                          				</table>
                      					</div>
									</td>
								</tr>


								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr class="header">
                   			<td><a name="testexpand" onclick="expandcontent('reports')" style="cursor:hand; cursor:pointer">Reports</a></td>
                  				<td align="right"><a name="testexpand" onclick="expandcontent('reports')" style="cursor:hand; cursor:pointer">+|- more</a></td>
                    			</tr>
								<tr>
                      				<td>
										<div id="reports" class="switchcontent">
                          				<table>
                         					<tr>
												<td><a href="../reports/daily_reports.php" target="_blank">Daily Reports</a></td>
											</tr>
											<tr>
												<td><a href="../reports/weekly_reports.php" target="_blank">Weekly Reports</a></td>
											</tr>
                          				</table>
                      					</div>
									</td>
								</tr>

	         				</table>
						</td>
					</tr>
		 		 </table>
			</td>
			</tr>
            
          </table></td>
        </tr>
      
      
      
    </table></td>
  </tr>
</table>
</div>
</body>
</html>
