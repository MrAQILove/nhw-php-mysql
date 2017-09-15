<?php
include("../config.php");

//if (isset($_POST['action'])) {
//	if($_POST['action'] == 'call_this') {
//		export_excel_csv();
//	}
//}

//function export_excel_csv()
//{
	try 
	{
		$db = getDB();
		$result_users = $db->prepare("SELECT 
						R.RecipientID, R.Firstname, R.Other_Name, R.Address, R.Suburb, S.State, R.Postcode, R.Email, R.Phone, D.Designation, Reg.RegDiv_Name, R.NHWArea, R.DXAddress, R.Copies
						FROM NHW_tblRecipient R
						LEFT OUTER JOIN NHW_tblDesignation D ON R.DesignationID = D.DesignationID
						INNER JOIN Members_tblState S ON R.StateID = S.StateID
						LEFT OUTER JOIN NHW_tblRegDiv Reg ON R.RegDiv_ID = Reg.RegDiv_ID");

		$result_users->execute();
		   
		$filename = 'export-'.date('d.m.Y').'.csv';

		//$data = fopen($filename, 'w');

		// Create array
		$csv_fields = array();

		$csv_fields[] = 'RecipientID';
		$csv_fields[] = 'Firstname';
		$csv_fields[] = 'Other_Name';
		$csv_fields[] = 'Address';
		$csv_fields[] = 'Suburb';
		$csv_fields[] = 'State';
		$csv_fields[] = 'Postcode';
		$csv_fields[] = 'Email';
		$csv_fields[] = 'Phone';
		$csv_fields[] = 'Position';
		$csv_fields[] = 'Division';
		$csv_fields[] = 'NHWArea';
		$csv_fields[] = 'DXAddress';
		$csv_fields[] = 'Copies';

		//fputcsv($data, $csv_fields);

		//while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		//	fputcsv($data, $row);
		//}

		//header("Content-type: application/octet-stream");
		//header("Content-Disposition: attachment; filename=$filename");
		//header("Pragma: no-cache");
		//header("Expires: 0");
		//print "$header\\n$data";

		// Create array
        //$list = array ();

        // Append results to array
        //array_push($csv_fields, array("## START OF USER TABLE ##"));
        while ($row = $result_users->fetch(PDO::FETCH_ASSOC)) {
			array_push($csv_fields, array_values($row));
        }
        
		//array_push($csv_fields, array("## END OF USER TABLE ##"));

        // Output array into CSV file
        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        foreach ($csv_fields as $ferow) {
			fputcsv($fp, $ferow);
        }
	} 

	catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
//}
