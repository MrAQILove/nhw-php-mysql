<?php
$db = getDB();

$sql =	"SELECT * FROM NHW_tblRecipient R
		LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
		INNER JOIN Members_tblState S ON R.StateID = S.StateID
		LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
		LIMIT $start, $per_page";

$stmt = $db->prepare($sql);
$stmt->execute();

$finaldata = "";
$tablehead="<tr class='bg_h'>
				<th>actions</th>
				<th>ID</th>
				<th>Name</th>
				<th>Name 2</th>
				<th>Address</th>
				<th>Suburb</th>
				<th>State</th>
				<th>Postcode</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Position</th>
				<th>Division</th>
				<th>NHW Area</th>
				<th>DX Address</th>
				<th>Copies</th>
			</tr>";

$bg = 'bg_1';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	$id			= $row['RecipientID'];
	$firstname	= htmlentities($row['Firstname']);
	$lastname	= htmlentities($row['Other_Name']);
	$address	= htmlentities($row['Address']);
	$suburb		= htmlentities($row['Suburb']);
	$state		= htmlentities($row['State']);
	$stateid	= htmlentities($row['StateID']);
	$postcode	= htmlentities($row['Postcode']);
	$email		= htmlentities($row['Email']);
	$phone		= htmlentities($row['Phone']);
	$position	= htmlentities($row['Designation']);
	$positionid	= htmlentities($row['DesignationID']);
	$division	= htmlentities($row['RegDiv_Name']);
	$divisionid	= htmlentities($row['RegDiv_ID']);
	$nhwarea	= htmlentities($row['NHWArea']);
	$dxaddress	= htmlentities($row['DXAddress']);
	$copies		= htmlentities($row['Copies']);

	if ($phone == 0) {
		$phone = "";
	}
	else {
		$phone = '0'.$phone;
	}

	$tabledata.="<tr class='$bg'>
					<td><a href='#' class='delete' id='$id'> X </a> &nbsp; <a href='#' class='edit' data-user-id='$id' data-render-view='edit-member.php'><img src='images/new.png'></a></td>
					<td>$id</td>
					<td>$firstname</td>
					<td>$lastname</td>
					<td>$address</td>
					<td>$suburb</td>
					<td>$state</td>
					<td>$postcode</td>
					<td>$email</td>
					<td>$phone</td>
					<td>$position</td>
					<td>$division</td>
					<td>$nhwarea</td>
					<td>$dxaddress</td>
					<td>$copies</td>
					</tr>";
	
	if ($bg == 'bg_1') {
		$bg = 'bg_2';
	} 

	else {
		$bg = 'bg_1';
	}
}

/* Content for Data */
$finaldata = "<table class='table_list' cellspacing='2' cellpadding=0'>". $tablehead . $tabledata . "</table>";

/* Total Count */
$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient";
$query_pag_num = $db->query($strSQL);

//$row_count = $query_pag_num->rowCount();
//$no_of_paginations = ceil($row_count / $per_page);

$query_pag_num->execute();
$get_total_rows = $query_pag_num->fetch();

//breaking total records into pages
$no_of_paginations = ceil($get_total_rows[0] / $per_page);
?>