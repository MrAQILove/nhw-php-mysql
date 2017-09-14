<?php

require_once 'config.php';

if (isset( $_POST['email'] ) && !empty($_POST['email'])) 
{
	$email = $_POST['email'];
	
	$db = getDB();
	$query = " SELECT email FROM CWADBMembers_tblUsers WHERE email = :email ";
	$stmt = $db->prepare($query);
	$stmt->execute(array(':email'=>$email));
	
	if ($stmt->rowCount() == 1) {
		echo 'false'; // email already taken
	} 
	
	else {
		echo 'true'; 
	}
}