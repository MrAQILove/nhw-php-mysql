<?php
require "config.php"; // Database Connection

session_start();
if(!isset($_SESSION['user_session'])) {
	header("Location: index.php");
}

$db = getDB();
$str = "SELECT * FROM CWADBMembers_tblUsers WHERE uid=:uid";
$stmt = $db->prepare($str);
$stmt->execute(array(":uid" => $_SESSION['user_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


// if the set flag is used, set it
if(isset($_POST['setid'])) {
	$_SESSION['userid'] = $_POST['userid'];
}

// if no flag is set, then this will just continue and echo the value currently set
$RecipientID = $_SESSION['userid'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Search for Members by Region/Division</title>
	<link href="css/style.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/Search.Edit.Delete.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
</head>

<body style="background-color: #f1f9f9;">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://www.cwaustral.com.au">Countrywide Austral</a>
		</div>
        
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="view-members.php">View All Members</a></li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;NHW MEMBERS&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="search-by-name.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Name</a></li>
						<li><a href="search-by-address.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Address</a></li>
						<li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Division</a></li>
						<li><a href="search-by-designation.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Position (Designation)</a></li>
						<li><a href="search-by-state.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By State</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;ADMIN SECTION&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Inactive Members</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View All Admin Users</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Add an Admin User</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Delete an Admin User</a></li>
					</ul>
				</li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $row['name']; ?>&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
    
<div class="body-container">
	<div class="container">
		<!--<div class='alert alert-success'>
			<button class='close' data-dismiss='alert'>&times;</button>
			You are here: Home > NHW Members > <strong>SEARCH NHW Members by Region/Division</strong>
		</div>-->

		<ol class="breadcrumb">
			<li><a href="home.php">Home</a></li>
			<li><a href="#">NHW Members</a></li>
			<li class="active">Search By Region/Division</li>
		</ol>
	</div>

	<div class="container">
		<table class="table">
			<tr>
			<td>
				<div class="search-container">
					<!-- header -->
					<div class="header">&nbsp;</div>
					<h1 class="main_title">Search for Members by Region/Division</h1>
					
					<div class="content">
						<form method="post" id="search-form">
						<input type="hidden" name="searchby" id="searchby" value="regdiv">
						<input type="hidden" name="page" id="page" value="1">
							
							<div class="form-group">
								<label class="col-md-1 control-label" for="members" style="width: 100px !important;">Members in:</label>
							</div>
							<div class="input_container">
								<div class="form-group">
									<select id="RegDiv_ID" class="selectpicker show-tick form-control" data-live-search="false" title="Please select a region/division ...">
									<?php
									$strSQL = "SELECT * FROM NHW_tblRegDiv";
									$stmt = $db->prepare($strSQL);
									$stmt->execute();
										
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										extract($row);
										echo '<option value="'.$RegDiv_ID.'">'.$RegDiv_Name.' ('.$RegDiv_Desc.')</option>';
									}
									?>
								  </select>
								</div>

								<div class="form-footer" style="margin-top:10px;">
									<div class="pull-right">
										<button class="btn btn-info" id="btn-search" type="submit">
										<span class="glyphicon glyphicon-search"></span> Search !
										</button>
									</div>
								</div>
							</div>
						</form>

						<div style="margin-top:120px;">
							<div id="loading"></div>
							<div id="container-body"></div>
						</div>
					</div>    
					<!-- content -->
					
					<!-- footer -->
					<div class="footer">&nbsp;</div>
				</div><!-- container -->
			</td>
			</tr>
		</table>
    </div>
</div>
</body>
</html>