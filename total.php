<?php
include_once 'config.php';

$db = getDB();

$sql =	"SELECT * FROM NHW_tblRecipient R
		INNER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID";

$stmt = $db->prepare($sql);
$stmt->execute();

$data = array();

$numActiveND	= 0;
$numActiveNC	= 0;
$numActiveZPS	= 0;
$numActiveZL	= 0;
$numActiveZMP	= 0;
$numActiveZIP	= 0;
$numActiveZV	= 0;
$numActiveZC	= 0;
$numActiveZPP	= 0;
$numActiveAMC	= 0;
$numActiveAEO	= 0;
$numActiveP		= 0;
$numActiveSP	= 0;
$numActiveA		= 0;

$numCopies0		= 0;
$numCopies1		= 0;
$numCopies2		= 0;
$numCopies3		= 0;
$numCopies4		= 0;
$numCopies5		= 0;
$numCopies6		= 0;
$numCopies7		= 0;
$numCopies8		= 0;
$numCopies9		= 0;
$numCopies10	= 0;
$numCopies11	= 0;
$numCopies12	= 0;
$numCopies13	= 0;

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	$id				= $row['RecipientID'];
	$position		= htmlentities($row['Designation']);
	$positionid		= $row['DesignationID'];
	$copies			= $row['Copies'];

	
	switch ($positionid) 
	{
		case 1:
			$numActiveNC++;
			$numCopies1 += $copies;
			break;

		case 2:
			$numActiveZPS++;
			$numCopies2 += $copies;
			break;

		case 3:
			$numActiveZL++;
			$numCopies3 += $copies;
			break;

		case 4:
			$numActiveZMP++;
			$numCopies4 += $copies;
			break;

		case 5:
			$numActiveZIP++;
			$numCopies5 += $copies;
			break;

		 case 6:
			$numActiveZV++;
			$numCopies6+=$copies; 
			break;

		case 7:
			$numActiveZC++;
			$numCopies7 += $copies;
			break;

		case 8:
			$numActiveZPP++;
			$numCopies8 += $copies;
			break;

		case 9:
			$numActiveAMC++;
			$numCopies9 += $copies; 
			break;

		case 10:
			$numActiveAEO++;
			$numCopies10 += $copies; 
			break;

		case 11:
			$numActiveP++;
			$numCopies11 += $copies; 
			break;

		case 12:
			$numActiveSP++;
			$numCopies12 += $copies; 
			break;

		case 13:
			$numActiveA++;
			$numCopies13 += $copies; 
			break;

		case 14: 
			$numActiveND++;
			$numCopies0 += $copies;
			break;		
    }
    
	$numTotalMembers = $numActiveND + $numActiveNC + $numActiveZPS + $numActiveZL + $numActiveZMP + $numActiveZIP + $numActiveZV + $numActiveZC + $numActiveZPP + $numActiveAMC + $numActiveAEO + $numActiveP + $numActiveSP + $numActiveA;
    $numTotalCopies = $numCopies0 + $numCopies1 + $numCopies2 + $numCopies3 + $numCopies4 + $numCopies5 + $numCopies6 + $numCopies7 + $numCopies8 + $numCopies9 + $numCopies10 + $numCopies11 + $numCopies12 + $numCopies13;

	$data = array('position' => 'No Designation', 'total_no_of_members' => $numActiveND, 'total_no_of_copies' => $numCopies0);
	$data1 = array('position' => 'NHW Co-ordinator', 'total_no_of_members' => $numActiveNC, 'total_no_of_copies' => $numCopies1);
	$data2 = array('position' => 'Police Station (ZPS)', 'total_no_of_members' => $numActiveZPS, 'total_no_of_copies' => $numCopies2);
	$data3 = array('position' => 'Library (ZL)', 'total_no_of_members' => $numActiveZL, 'total_no_of_copies' => $numCopies3);
	$data4 = array('position' => 'Member of Parliament (ZMP)', 'total_no_of_members' => $numActiveZMP, 'total_no_of_copies' => $numCopies4);
	$data5 = array('position' => 'Interested Party (ZIP)', 'total_no_of_members' => $numActiveZIP, 'total_no_of_copies' => $numCopies5);
	$data6 = array('position' => 'Volunteer (ZV)', 'total_no_of_members' => $numActiveZV, 'total_no_of_copies' => $numCopies6);
	$data7 = array('position' => 'Council (ZC)', 'total_no_of_members' => $numActiveZC, 'total_no_of_copies' => $numCopies7);
	$data8 = array('position' => 'Police Personnel (ZPP)', 'total_no_of_members' => $numActiveZPP, 'total_no_of_copies' => $numCopies8);
	$data9 = array('position' => 'Area Manager/Co-ordinator', 'total_no_of_members' => $numActiveAMC, 'total_no_of_copies' => $numCopies9);
	$data10 = array('position' => 'Area Editor/Other', 'total_no_of_members' => $numActiveAEO, 'total_no_of_copies' => $numCopies10);
	$data11 = array('position' => 'Patron', 'total_no_of_members' => $numActiveP, 'total_no_of_copies' => $numCopies11);
	$data12 = array('position' => 'State President', 'total_no_of_members' => $numActiveSP, 'total_no_of_copies' => $numCopies12);
	$data13 = array('position' => 'Ambassador', 'total_no_of_members' => $numActiveA, 'total_no_of_copies' => $numCopies13);
	$data14 = array('position' => 'Total', 'total_no_of_members' => $numTotalMembers, 'total_no_of_copies' => $numTotalCopies);

}

?>
<!--<table width="0">
<tr height="20" class="listTableText">
						<td>Total:</td>
						<td>Total No. of Members: <?php echo $numTotalMembers; ?></td>
						<td>Total No. of Copies: <?php echo $numTotalCopies; ?></td>
					</tr>
</table>-->
<?php
$json_data = '['. json_encode($data) .',';
$json_data .= json_encode($data1) .',';
$json_data .= json_encode($data2) .',';
$json_data .= json_encode($data3) .',';
$json_data .= json_encode($data4) .',';
$json_data .= json_encode($data5) .',';
$json_data .= json_encode($data6) .',';
$json_data .= json_encode($data7) .',';
$json_data .= json_encode($data8) .',';
$json_data .= json_encode($data9) .',';
$json_data .= json_encode($data10) .',';
$json_data .= json_encode($data11) .',';
$json_data .= json_encode($data12) .',';
$json_data .= json_encode($data13) .',';
$json_data .= json_encode($data14) . ']';

echo "<pre>".json_encode($data4)."</pre>";

file_put_contents('tables/data1.json', $json_data);
?>