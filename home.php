<?php
session_start();

if(!isset($_SESSION['user_session'])) {
	header("Location: index.php");
}

include_once 'config.php';

$db = getDB();
$stmt = $db->prepare("SELECT * FROM CWADBMembers_tblUsers WHERE uid=:uid");
$stmt->execute(array(":uid" => $_SESSION['user_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$strSQL = "SELECT * FROM NHW_tblRecipient";
$query_pag_num = $db->query($strSQL);
$number_of_members = $query_pag_num->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Countrywide Austral : Member's Database : NHW</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/styles.css" rel="stylesheet">

	<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<!--Icons-->
	<script src="bootstrap/js/lumino.glyphs.js"></script>

	<style type="text/css">
	body { background:#f1f9f9; }
	.body-container { margin-top:110px; }
	</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!--<a class="navbar-brand" href="http://www.cwaustral.com.au">Countrywide Austral</a>-->
		</div>
        
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="view-members.php">View All Members</a></li>
				<li><a href="add-member.php">Add NEW Member</a></li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Search Members&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="search-by-name.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Name</a></li>
						<li><a href="search-by-address.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Address</a></li>
						<li><a href="search-by-division.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Division</a></li>
						<li><a href="search-by-designation.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Position (Designation)</a></li>
						<li><a href="search-by-state.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By State</a></li>
					</ul>
				</li>
				<li><a href="delete-member.php">Delete Member</a></li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;ADMIN SECTION&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Inactive Members</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View All Admin Users</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Add an Admin User</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> <span class="glyphicon glyphicon-remove-sign"></span>&nbsp;Delete an Admin User</a></li>
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
		<div class="alert bg-primary" role="alert">
			<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg> <strong>Hello <?php echo $row['name']; ?></strong>. Welcome to the NHW Admin dashboard <a href="#" class="pull-right close" data-dismiss="alert"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
	</div>

	<div class="container">
		<!--<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">-->			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
					<li class="active">Dashboard</li>
				</ol>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Dashboard</h1>
				</div>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-teal panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-4 widget-left">
								<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-8 widget-right">
								<div class="large"><?php echo $number_of_members; ?></div>
								<div class="text-muted">NHW Members</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-4 widget-left">
								<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-8 widget-right">
								<div class="large">120</div>
								<div class="text-muted">Admininistration User</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-gray panel-widget">
						<div class="row no-padding">
							<a href="view-profile.php">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">VIEW</div>
									<div class="text-muted">Profile</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				
			</div><!--/.row-->

			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<a href="view-members.php">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">VIEW</div>
									<div class="text-muted">All Members</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<a href="add-member.php">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">ADD</div>
									<div class="text-muted">NEW Members</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-green panel-widget">
						<div class="row no-padding">
							<a href="#">
								<div class="col-sm-3 col-lg-4 widget-left">
									<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg></span>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">SEARCH</div>
									<div class="text-muted">Members By</div>
								</div>
							</a>
							<div class="sidebar1">
								<ul class="children collapse" id="sub-item-1">
									<li>
										<a class="" href="search-by-name.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Name
										</a>
									</li>
									<li>
										<a class="" href="search-by-address.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Address
										</a>
									</li>
									<li>
										<a class="" href="search-by-division.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Division (Region/Division)
										</a>
									</li>
									<li>
										<a class="" href="search-by-designation.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Position (Designation)
										</a>
									</li>
									<li>
										<a class="" href="search-by-state.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> State
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-red panel-widget">
						<div class="row no-padding">
							<a href="delete-member.php">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">DELETE</div>
									<div class="text-muted">Members</div>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-brown panel-widget">
						<div class="row no-padding">
							<a href="#">
								<div class="col-sm-3 col-lg-4 widget-left">
									<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg></span>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">ADMIN</div>
									<div class="text-muted">Section</div>
								</div>
							</a>
							<div class="sidebar1">
								<ul class="children collapse" id="sub-item-2">
									<li>
										<a class="" href="search-by-name.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> View Inactive
										</a>
									</li>
									<li>
										<a class="" href="search-by-address.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> View All
										</a>
									</li>
									<li>
										<a class="" href="search-by-division.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add an Admin User
										</a>
									</li>
									<li>
										<a class="" href="search-by-designation.php">
											<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Delete an Admin User
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-6 col-lg-4">
					<div class="panel panel-purple panel-widget">
						<div class="row no-padding">
							<a href="import-members.php">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked download"><use xlink:href="#stroked-download"></use></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">IMPORT</div>
									<div class="text-muted">Members</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div><!--/.row-->
			
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="panel panel-yellow panel-widget">
							<div class="row no-padding">
								<a href="export-members.php">
									<div class="col-sm-3 col-lg-4 widget-left">
										<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"></use></svg>
									</div>
									<div class="col-sm-9 col-lg-8 widget-right">
										<div class="large">EXPORT</div>
										<div class="text-muted">Members</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="panel panel-pink panel-widget">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked gear"><use xlink:href="#stroked-gear"/></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">VIEW</div>
									<div class="text-muted">Settings</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="panel panel-pink panel-widget">
							<div class="row no-padding">
								<div class="col-sm-3 col-lg-4 widget-left">
									<svg class="glyph stroked gear"><use xlink:href="#stroked-gear"/></svg>
								</div>
								<div class="col-sm-9 col-lg-8 widget-right">
									<div class="large">VIEW</div>
									<div class="text-muted">Settings</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--/.row-->

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">&nbsp;</div>
							<div class="panel-body">
								<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
									<thead>
									<tr>
										<th data-field="position" data-sortable="true">Position (Designation)</th>
										<th data-field="total_no_of_members" data-sortable="true">Total No. of Members</th>
										<th data-field="total_no_of_copies" data-sortable="true">Total No. of Copies</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div><!--/.row-->
		<!--</div>-->
    </div>
</div>

<script src="bootstrap/js/bootstrap-table.js"></script>
</body>
</html>