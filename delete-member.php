<?php
include("config.php");
if($_POST['id'])
{
	$db = getDB();
	$id = mysql_escape_String($_POST['id']);
	$sql = "DELETE FROM NHW_tblRecipient WHERE RecipientID =  :id";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':RecipientID', $id, PDO::PARAM_INT);   
	$stmt->execute();
}
?>