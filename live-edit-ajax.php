<?php
include("config.php");
if($_POST['id'])
{
	$id				= mysql_escape_String($_POST['id']);
	$firstname		= mysql_escape_String($_POST['firstname']);
	$lastname		= mysql_escape_String($_POST['lastname']);
	$address		= mysql_escape_String($_POST['address']);
	$suburb			= mysql_escape_String($_POST['suburb']);
	$stateid		= mysql_escape_String($_POST['stateid']);
	$postcode		= mysql_escape_String($_POST['postcode']);
	$email			= mysql_escape_String($_POST['email']);
	$phone			= mysql_escape_String($_POST['phone']);
	$positionid		= mysql_escape_String($_POST['designationID']);
	$divisionid		= mysql_escape_String($_POST['division_ID']);
	$nhwarea		= mysql_escape_String($_POST['nhwarea']);
	$dxaddress		= mysql_escape_String($_POST['dxaddress']);
	$copies			= mysql_escape_String($_POST['copies']);
	
	//$sql = "update products set name='$name',category='$category',price='$price',discount='$discount' where pid='$id'";
	//mysql_query($sql);

	$sql = "UPDATE NHW_tblRecipient SET Firstname = :firstname, 
            Other_Name = :lastname, 
            Address = :address,  
            Suburb = :suburb,  
            StateID = :stateid,
			Postcode = :postcode,
			Email = :email,
			Phone = :phone,
			DesignationID = :positionid,
			RegDiv_ID = :divisionid,
			NHWArea = :nhwarea,
			DXAddress = :dxaddress,
			Copies = :copies,
            WHERE RecipintID = :id";

			$stmt = $pdo->prepare($sql);                                  
			$stmt->bindParam(':Firstname', $firstname, PDO::PARAM_STR);       
			$stmt->bindParam(':Other_Name', $lastname, PDO::PARAM_STR);    
			$stmt->bindParam(':Address', $address, PDO::PARAM_STR);
			$stmt->bindParam(':Suburb', $suburb, PDO::PARAM_STR);
			$stmt->bindParam(':StateID', $stateid, PDO::PARAM_INT);
			$stmt->bindParam(':Postcode', $postcode, PDO::PARAM_INT);
			$stmt->bindParam(':Email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':Phone', $email, PDO::PARAM_STR);
			$stmt->bindParam(':DesignationID', $positionid, PDO::PARAM_INT);
			$stmt->bindParam(':RegDiv_ID', $positionid, PDO::PARAM_INT);
			$stmt->bindParam(':NHWArea', $nhwarea, PDO::PARAM_STR);
			$stmt->bindParam(':DXAdddress', $email, PDO::PARAM_STR);
			$stmt->bindParam(':Copies', $copies, PDO::PARAM_INT);
			$stmt->execute(); 
}
?>