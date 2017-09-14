<?php
include ("config.php");

/* Pagination */
if($_POST['page'])
{
	$SearchBy		= $_POST['searchby'];
	$Firstname		= $_POST['Firstname'];
	$Address		= $_POST['Address'];
	$RegDiv_ID		= $_POST['RegDiv_ID'];
	$DesignationID	= $_POST['DesignationID'];
	$StateID		= $_POST['StateID'];
	$page			= $_POST['page'];
	
	$cur_page = $page;
	$page -= 1;
	$per_page = 300; // Per page
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;

	/* Total Count */
	$db = getDB();

	switch ($SearchBy)
	{
		case "firstname" :
			$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient WHERE Firstname LIKE '%$Firstname%'";
			break;

		case "address" :
			$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient WHERE Address LIKE '%$Address%'";
			break;

		case "regdiv" :
			$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient WHERE RegDiv_ID = $RegDiv_ID";
			break;

		case "designation" :
			$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient WHERE DesignationID = $DesignationID";
			break;

		default:
			$strSQL = "SELECT COUNT(*) FROM NHW_tblRecipient WHERE StateID = $StateID";
	}

	$query_pag_num = $db->query($strSQL);
	$number_of_rows = $query_pag_num->fetchColumn(); 

	$query_pag_num->execute();
	$get_total_rows = $query_pag_num->fetch();

	//breaking total records into pages
	$no_of_paginations = ceil($get_total_rows[0] / $per_page);

	switch ($SearchBy)
	{
		case "firstname" :
			getResult($Firstname, $start, $per_page, $number_of_rows);
			break;

		case "address" :
			getResult($Address, $start, $per_page, $number_of_rows);
			break;

		case "regdiv" :
			getResult($RegDiv_ID, $start, $per_page, $number_of_rows);
			break;

		case "designation" :
			getResult($DesignationID, $start, $per_page, $number_of_rows);
			break;

		default:
			getResult($StateID, $start, $per_page, $number_of_rows);
	}
			
	/* ---------------Calculating the starting and ending values for the loop----------------------------------- */
	if ($cur_page >= 7) 
	{
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
			
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
		{
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} 
			
		else {
			$end_loop = $no_of_paginations;
		}
	} 
		
	else 
	{
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}

	/* ----------------------------------------------------------------------------------------------------------- */
	$finaldata .= "<nav aria-label=\"Page navigation\"><ul class=\"pagination\">";

	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $cur_page > 1) {
		$finaldata .= "<li p=\"1\" class=\"alive\"><a href=\"#\"><span aria-hidden=\"true\">&laquo;</span> First</a></li>";
	} 
		
	else if ($first_btn) {
		$finaldata .= "<li p=\"1\" class=\"previous disabled\"><a href=\"#\">First</a></li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) 
	{
		$pre = $cur_page - 1;
		$finaldata .= "<li p=\"$pre\" class=\"alive\"><a href=\"#\"><span aria-hidden=\"true\">&laquo;</span> Previous</a></li>";
	} 
		
	else if ($previous_btn) {
		$finaldata .= "<li class=\"disabled\"><a href=\"#\" aria-label=\"Previous\"><span aria-hidden=\"true\">Previous</span></a></li>";
	}
		
	for ($i = $start_loop; $i <= $end_loop; $i++) 
	{
		if ($cur_page == $i) {
			$finaldata .= "<li p=\"$i\" class=\"active alive\"><a href=\"#\">{$i} <span class=\"sr-only\">(current)</span></a></li>";
		}

		else {
			$finaldata .= "<li p=\"$i\" class=\"alive\"><a href=\"#\">{$i}</a></li>";

		}
	}

	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) 
	{
		$nex = $cur_page + 1;
		$finaldata .= "<li p=\"$nex\" class=\"alive\"><a href=\"#\">Next</a></li>";

	} 
		
	else if ($next_btn) {
		$finaldata .= "<li class=\"disabled\"><a href=\"#\" aria-label=\"Next\"><span aria-hidden=\"true\">Next</span></a></li>";
	}

	// TO ENABLE THE END BUTTON
	if ($last_btn && $cur_page < $no_of_paginations) {
		$finaldata .= "<li p=\"$no_of_paginations\" class=\"alive\"><a href=\"#\">Last <span aria-hidden=\"true\">&raquo;</span></a></li>";
	} 
		
	else if ($last_btn) {
		$finaldata .= "<li p=\"$no_of_paginations\" class=\"previous disabled\"><a href=\"#\">Last</a></li>";
	}
		
	$goto = "<div class=\"input-group\">
			<input type=\"text\" class=\"form-control jump_to\" style=\"width:150px !important;\" />
			<span class=\"input-group-btn\">
			<button class=\"btn btn-default\" type=\"button\" id=\"go_button\">Go <span class=\"glyphicon glyphicon-triangle-right\" aria-hidden=\"true\"></span></button>
			</span>
			</div>
			";
	
	if ( ($cur_page == 1) && ($per_page < $number_of_rows) ) {
		$showing_entries = "Showing <b>" . $cur_page . "</b> of <b>".$number_of_rows."</b> entries";
	}

	else if ( ($cur_page == 1) && ($per_page > $number_of_rows) ) {
		$showing_entries = "Showing <b>" . $number_of_rows . "</b> of <b>".$number_of_rows."</b> entries";
	}

	else {
		$showing_entries = "Showing <b>" . $cur_page * $per_page . "</b> of <b>".$number_of_rows."</b> entries";
	}
	
	$showing_pages = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>".$no_of_paginations."</b></span>";
	
	if ($number_of_rows < $per_page) 
	{
		$table_pagination = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							<tr>
								<td width=\"200\">&nbsp;</td>
								<td width=\"10\">&nbsp;</td>
								<td width=\"390\">".$showing_entries."</td>
								<td width=\"100\">".$showing_pages."</td>
							</tr>
							</table>";
	}
	else 
	{
		$table_pagination = "<table border='0' cellpadding='0' cellspacing='0' width='700'>
							<tr>
								<td width=\"200\">".$goto."</td>
								<td width=\"10\">&nbsp;</td>
								<td width=\"390\">".$showing_entries."</td>
								<td width=\"100\">".$showing_pages."</td>
							</tr>
							</table>";
	}
	
	$finaldata = $finaldata . "</ul></nav><div class=\"table\">" .$table_pagination. "</div><p>&nbsp;</p>";  // Content for pagination
	
	if ($number_of_rows > 0) {
		echo $finaldata;
	}
}

function getResult($a, $b, $c, $d)
{
	$SearchBy		= $_POST['searchby'];
	$db = getDB();

	switch ($SearchBy)
	{
		case 'firstname' :
			$sql =	"SELECT * FROM NHW_tblRecipient R
					INNER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
					INNER JOIN Members_tblState S ON R.StateID = S.StateID
					INNER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
					WHERE R.Firstname LIKE '%$a%' LIMIT $b, $c";
			break;

		case 'address' :
			$sql =	"SELECT * FROM NHW_tblRecipient R
					INNER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
					INNER JOIN Members_tblState S ON R.StateID = S.StateID
					INNER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
					WHERE R.Address LIKE '%$a%' LIMIT $b, $c";
			break;

		case 'regdiv' :
			$sql =	"SELECT * FROM NHW_tblRecipient R
					LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
					INNER JOIN Members_tblState S ON R.StateID = S.StateID
					LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
					WHERE R.RegDiv_ID = $a LIMIT $b, $c";
			break;

		case 'designation' :
			$sql =	"SELECT * FROM NHW_tblRecipient R
					LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
					INNER JOIN Members_tblState S ON R.StateID = S.StateID
					LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
					WHERE R.DesignationID = $a LIMIT $b, $c";
			break;

		default:
			$sql =	"SELECT * FROM NHW_tblRecipient R
					LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
					INNER JOIN Members_tblState S ON R.StateID = S.StateID
					LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID
					WHERE R.StateID = $a LIMIT $b, $c";
	}
		
	$stmt = $db->prepare($sql);
	$stmt->execute();

	if ($d > 0) 
	{
		$finaldata = "";
		$tablehead="<tr class='bg_h'>
						<th>actions</th>
						<th>ID</th>
						<th>Name 1</th>
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
							<td><a href='#' class='delete' id='$id'> <span class=\"glyphicon glyphicon-trash\"></span> </a> &nbsp; <a href='#' class='edit' data-user-id='$id' data-render-view='edit-member.php'><span class=\"glyphicon glyphicon-pencil\"></span></a></td>
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

		echo $finaldata;
	}

	else 
	{
		switch ($SearchBy)
		{
			case 'firstname' :
				echo '<h3>There are no NHW Members in the searched NAME 1.</h3>';
				break;

			case 'address' :
				echo '<h3>There are no NHW Members in the searched ADDRESS.</h3>';
				break;
			
			case 'state' :
				echo '<h3>There are no NHW Members in the searched STATE.</h3>';
				break;
		}
	}
}
?>