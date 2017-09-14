<?php
require "config.php"; // Database Connection

session_start();
if(!isset($_SESSION['user_session'])) {
	header("Location: index.php");
}

$db = getDB();
$stmt = $db->prepare("SELECT * FROM CWADBMembers_tblUsers WHERE uid = :uid");
$stmt->execute(array(":uid" => $_SESSION['user_session']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


// if the set flag is used, set it
if(isset($_POST['setid'])) {
	$_SESSION['userid'] = $_POST['userid'];
}

// if no flag is set, then this will just continue and echo the value currently set
$RecipientID = $_SESSION['userid'];

//echo '<h1>user profile page</h1>';
//echo $userIdExchanged;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit NHW Member</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
	<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".edit_tr").click(function()
		{
			var ID=$(this).attr('id');
			$("#first_"+ID).hide();
			$("#second_"+ID).hide();
			$("#third_"+ID).hide();
			$("#fourth_"+ID).hide();
			$("#fifth_"+ID).hide();
			$("#sixth_"+ID).hide();
			$("#seventh_"+ID).hide();
			$("#eighth_"+ID).hide();
			$("#ninth_"+ID).hide();
			$("#tenth_"+ID).hide();
			$("#eleventh_"+ID).hide();
			$("#twelfth_"+ID).hide();
			$("#thirteenth_"+ID).hide();
			
			$("#first_input_"+ID).show();
			$("#second_input_"+ID).show();
			$("#third_input_"+ID).show();
			$("#fourth_input_"+ID).show();
			$("#fifth_input_"+ID).show();
			$("#sixth_input_"+ID).show();
			$("#seventh_input_"+ID).show();
			$("#eighth_input_"+ID).show();
			$("#ninth_input_"+ID).show();
			$("#tenth_input_"+ID).show();
			$("#eleventh_input_"+ID).show();
			$("#twelfth_input_"+ID).show();
			$("#thirteenth_input_"+ID).show();

		}).change(function()
		{	
			var ID			= $(this).attr('id');
			var first		= $("#first_input_"+ID).val();
			var second		= $("#second_input_"+ID).val();
			var third		= $("#third_input_"+ID).val();
			var fourth		= $("#fourth_input_"+ID).val();
			var fifth		= $("#fifth_input_"+ID).val();
			var sixth		= $("#sixth_input_"+ID).val();
			var seventh		= $("#seventh_input_"+ID).val();
			var eigth		= $("#eighth_input_"+ID).val();
			var ninth		= $("#ninth_input_"+ID).val();
			var tenth		= $("#tenth_input_"+ID).val();
			var eleventh	= $("#eleventh_input_"+ID).val();
			var twelfth		= $("#twelfth_input_"+ID).val();
			var thirteenth	= $("#thirteenth_input_"+ID).val();
			
			var dataString = 'id='+ ID +'&Firstname='+first+'&Other_Name='+second+'&Address='+third+'&Suburb='+fourth+'&StateID='+fifth+'&Postcode='+sixth+'&Email='+seventh+'&Phone='+eighth+'&DesignationID='+ninth+'&RegDiv_ID='+tenth+'&NHWArea='+eleventh+'&DXAddress='+twelfth+'&Copies='+thirteenth;
			$("#first_"+ID).html('<img src="load.gif" />');
		
			if(first.length && second.length > 0 && third.length > 0 && fourth.length > 0 && fifth.length > 0 && sixth.length > 0 && seventh.length > 0 && eighth.length > 0 && ninth.length > 0 && tenth.length > 0 && eleventh.length > 0 && twelfth.length > 0 && thirteenth.length > 0)
			{
				$.ajax({
					type: "POST",
					url: "edit_member_ajax.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#first_"+ID).html(first);
						$("#second_"+ID).html(second);
						$("#third_"+ID).html(third);
						$("#fourth_"+ID).html(fourth);
						$("#fifth_"+ID).html(fifth);
						$("#sixth_"+ID).html(sixth);
						$("#seventh_"+ID).html(seventh);
						$("#eighth_"+ID).html(eighth);
						$("#ninth_"+ID).html(ninth);
						$("#tenth_"+ID).html(tenth);
						$("#eleventh_"+ID).html(eleventh);
						$("#twelfth_"+ID).html(twelfth);
						$("#thirteenth_"+ID).html(thirteenth);
					}
				});
			}
		
			else {
				alert('Enter something.');
			}
		});

		$(".editbox").mouseup(function() {
			return false
		});

		$(document).mouseup(function()
		{
			$(".editbox").hide();
			$(".text").show();
		});
	});
	</script>
	<style type="text/css">
	body {
		/* font-family:Arial, Helvetica, sans-serif;
		font-size:14px; */
		background-color: #f1f9f9;
	}
	select {
		width:270px;
		padding:4px;
		border-radius:3px;
	}
	td { padding:7px; }
	th {
		font-weight:bold;
		text-align:left;
		padding:4px;
	}
	.body-container { margin-top:110px; }
	.edit-container {
		margin:0 auto; 
		padding:10px; 
		background-color:#fff; 
		height:100%;
	}
	.head {
		background-color:#333;
		color:#ffffff
	}
	.editbox { display:none }
	.editbox {
		border-radius:3px;
		font-size:14px;
		width:270px;
		background-color:#ffffcc;
		border:solid 1px #000;
		padding:4px;
	}
	.edit_tr:hover {
		background:url(edit.png) top right no-repeat #80c8e5;
		cursor:pointer;
	}
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
			<a class="navbar-brand" href="http://www.cwaustral.com.au">Countrywide Austral</a>
		</div>
        
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="viewMembers.php">View All Members</a></li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-user"></span>&nbsp;NHW MEMBERS&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="search-by-name.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Name</a></li>
						<li><a href="search-by-address.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Address</a></li>
						<li><a href="search-by-division.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Search By Division</a></li>
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
			<strong>Hello <?php echo $row['name']; ?></strong>  Welcome to the members page.
		</div>-->

		<ol class="breadcrumb">
			<li><a href="home.php">Home</a></li>
			<li><a href="#">NHW Members</a></li>
			<li class="active">Edit Member</li>
		</ol>
	</div>

	<div class="container">
		<table class="table">
			<tr>
			<td>
				<div class="edit-container">
					<?php
					$db = getDB();
					$sql = "SELECT * FROM NHW_tblRecipient R
							LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
							INNER JOIN Members_tblState S ON R.StateID = S.StateID
							LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
							WHERE RecipientID = :RecipientID";
					
					$stmt = $db->prepare($sql);
					$stmt->bindParam(':RecipientID', $RecipientID, PDO::PARAM_INT); 
					$stmt->execute();
					$obj = $stmt->fetchObject();
					
					$id			= $obj->RecipientID;
					$firstname	= $obj->Firstname;
					$lastname	= $obj->Other_Name;
					$address	= $obj->Address;
					$suburb		= $obj->Suburb;
					$state		= $obj->State;
					$stateid	= $obj->StateID;
					$postcode	= $obj->Postcode;
					$email		= $obj->Email;
					$phone		= $obj->Phone;
					$position	= $obj->Designation;
					$positionid	= $obj->DesignationID;
					$division	= $obj->RegDiv_Name;
					$divisionid	= $obj->RegDiv_ID;
					$nhwarea	= $obj->NHWArea;
					$dxaddress	= $obj->DXAddress;
					$copies		= $obj->Copies;

					if ($phone == 0) {
						$phone = "";
					}
					else {
						$phone = '0'.$phone;
					}
					?>

					<h1>Edit NHW Member - <?php echo $firstname; ?></h1>
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr class="head">
						<th>&nbsp;</th>
					</tr>
					
					<tr id="<?php echo $id; ?>" class="edit_tr">
					<td>
						<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td>Name 1:</td>
							<td>
								<span id="first_<?php echo $id; ?>" class="text"><?php echo $firstname; ?></span>
								<input type="text" value="<?php echo $firstname; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
							</td>
						</tr>

						<tr>
							<td>Name 2:</td>
							<td>
								<?php
								if ($lastname == "") {
									echo '<span id="second_'.$id.'" class="text"><strong>No Name 2 provided</strong></span>';
									echo '<input type="text" value="'.$lastname.'" class="editbox" id="second_input_'.$id.'" />';
								}
								else {
									echo '<span id="second_'.$id.'" class="text">'.$lastname.'</span>';
									echo '<input type="text" value="'.$lastname.'" class="editbox" id="second_input_'.$id.'" />';
								}
								?>
							</td>
						</tr>

						<tr>
							<td>Address:</td>
							<td>
								<span id="third_<?php echo $id; ?>" class="text"><?php echo $address; ?></span>
								<input type="text" value="<?php echo $address; ?>" class="editbox" id="third_input_<?php echo $id; ?>" />
							</td>
						</tr>

						<tr>
							<td>Suburb:</td>
							<td>
								<span id="fourth_<?php echo $id; ?>" class="text"><?php echo $suburb; ?></span>
								<input type="text" value="<?php echo $suburb; ?>" class="editbox" id="fourth_input_<?php echo $id; ?>" />
							</td>
						</tr>

						<tr>
							<td>State:</td>
							<td>
								<span id="fifth_<?php echo $id; ?>" class="text"><?php echo $state; ?></span>
								<select class="editbox" id="fifth_input_<?php echo $id; ?>">
									<option value="showAll">State</option>
									<?php
									$stmt = $db->prepare('SELECT * FROM Members_tblState');
									$stmt->execute();
									
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										extract($row);
										if ($stateid == $StateID) {
											echo '<option value="'.$StateID.'" selected="selected">'.$State.'</option>';
										}
										else {
											echo '<option value="'.$StateID.'">'.$State.'</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td>Postcode:</td>
							<td>
								<span id="sixth_<?php echo $id; ?>" class="text"><?php echo $postcode; ?></span>
								<input type="text" value="<?php echo $postcode; ?>" class="editbox" id="sixth_input_<?php echo $id; ?>" />
							</td>
						</tr>

						<tr>
							<td>Email:</td>
							<td>
								<?php
								if ($email == "") {
									echo '<span id="seventh_'.$id.'" class="text"><strong>No Email provided</strong></span>';
									echo '<input type="text" value="'.$email.'" class="editbox" id="seventh_input_'.$id.'" />';
								}
								else {
									echo '<span id="seventh_'.$id.'" class="text">'.$email.'</span>';
									echo '<input type="text" value="'.$email.'" class="editbox" id="seventh_input_'.$id.'" />';
								}
								?>
							</td>
						</tr>

						<tr>
							<td>Phone:</td>
							<td>
								<?php
								if ($phone == 0) {
									echo '<span id="eighth_'.$id.'" class="text"><strong>No Phone provided</strong></span>';
									echo '<input type="text" value="'.$phone.'" class="editbox" id="eighth_input_'.$id.'" />';
								}
								else {
									echo '<span id="eighth_'.$id.'" class="text">'.$phone.'</span>';
									echo '<input type="text" value="'.$phone.'" class="editbox" id="eighth_input_'.$id.'" />';
								}
								?>
							</td>
						</tr>

						<tr>
							<td>Position/Designation:</td>
							<td>
								<span id="ninth_<?php echo $id; ?>" class="text"><?php echo $position; ?></span>
								<select class="editbox" id="ninth_input_<?php echo $id; ?>">
									<option value="showAll">Position/Designation</option>
									<?php
									$stmt_1 = $db->prepare('SELECT * FROM NHW_tblDesignation');
									$stmt_1->execute();
									
									while($row_1 = $stmt_1->fetch(PDO::FETCH_ASSOC))
									{
										extract($row_1);
										if ($positionid == $DesignationID) {
											echo '<option value="'.$DesignationID.'" selected="selected">'.$Designation.'</option>';
										}
										else {
											echo '<option value="'.$DesignationID.'">'.$Designation.'</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td>Region/Division:</td>
							<td>
								<span id="tenth_<?php echo $id; ?>" class="text"><?php echo $division; ?></span>
								<select class="editbox" id="tenth_input_<?php echo $id; ?>">
									<option value="showAll">Region/Division</option>
									<?php
									$stmt_2 = $db->prepare('SELECT * FROM NHW_tblRegDiv');
									$stmt_2->execute();
									
									while($row_2 = $stmt_2->fetch(PDO::FETCH_ASSOC))
									{
										extract($row_2);
										if ($divisionid == $RegDiv_ID) {
											echo '<option value="'.$RegDiv_ID.'" selected="selected">'.$RegDiv_Name.' ('.$RegDiv_Desc.')</option>';
										}
										else {
											echo '<option value="'.$RegDiv_ID.'">'.$RegDiv_Name.' ('.$RegDiv_Desc.')</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td>NHW Area:</td>
							<td>
								<?php
								if ($nhwarea == "") {
									echo '<span id="eleventh_'.$id.'" class="text"><strong>No NHW Area provided</strong></span>';
									echo '<input type="text" value="'.$nhwarea.'" class="editbox" id="eleventh_input_'.$id.'" />';
								}
								else {
									echo '<span id="eleventh_'.$id.'" class="text">'.$nhwarea.'</span>';
									echo '<input type="text" value="'.$nhwarea.'" class="editbox" id="eleventh_input_'.$id.'" />';
								}
								?>
							</td>
						</tr>

						<tr>
							<td>DX Address:</td>
							<td>
								<?php
								if ($dxaddress == "") {
									echo '<span id="twelfth_'.$id.'" class="text"><strong>No DX Address provided</strong></span>';
									echo '<input type="text" value="'.$dxaddress.'" class="editbox" id="twelfth_input_'.$id.'" />';
								}
								else {
									echo '<span id="twelfth_'.$id.'" class="text">'.$dxaddress.'</span>';
									echo '<input type="text" value="'.$dxaddress.'" class="editbox" id="twelfth_input_'.$id.'" />';
								}
								?>
							</td>
						</tr>

						<tr>
							<td>Sentinel Copies:</td>
							<td>
								<span id="thirteenth_<?php echo $id; ?>" class="text"><?php echo $copies; ?></span>
								<input type="text" value="<?php echo $copies; ?>" class="editbox" id="thirteenth_input_<?php echo $id; ?>" />
							</td>
						</tr>
						</table>
					</td>
					</tr>
					</table>
				</div>
			</td>
		</tr>
		</table>
    </div>
</div>
</body>
</html>
