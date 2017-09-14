<?php

session_start();
require_once 'config.php';

if(isset($_POST['btn-login']))
{
	//$user_name = $_POST['user_name'];
	$email		= trim($_POST['email']);
	$password	= trim($_POST['password']);
		
	$password	= md5($password);
		
	try
	{	
		
		$db = getDB();
		$stmt = $db->prepare("SELECT * FROM CWADBMembers_tblUsers WHERE email=:email");
		$stmt->execute(array(":email"=>$email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
			
		if($row['password'] == $password)
		{		
			echo "ok"; // log in
			$_SESSION['user_session'] = $row['uid'];
		}
		
		else {
			echo "Your Email or Password does not exist."; // wrong details 
		}
				
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
?>