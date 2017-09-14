<?php
//Ajax-Signup.Php

header('Content-type: application/json');

require_once 'config.php';
 
$response = array();

if ($_POST) 
{
	$username	= $_POST['username'];
	$email		= $_POST['email'];
	$password	= $_POST['cpassword'];
	$name		= $_POST['name'];

	// sha256 password hashing
	$password = hash('sha256', $password);
  
	$db = getDB(); 
	$stmt = $db->prepare('INSERT INTO CWADBMembers_tblUsers (username,email,password,name) VALUES(:username, :email, :password, :name)');
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password );
	$stmt->bindParam(':name', $name );
	$stmt->execute();
  
	// check for successfull registration
    if ($stmt->rowCount() == 1) 
	{
		$response['status'] = 'success';
		$response['message'] = '<span class="glyphicon glyphicon-ok"></span> &nbsp; registered sucessfully, you may login now';
	} 
	
	else 
	{
		$response['status'] = 'error'; // could not register
		$response['message'] = '<span class="glyphicon glyphicon-info-sign"></span> &nbsp; could not register, try again later';
	} 
 }
 
 echo json_encode($response);
?>