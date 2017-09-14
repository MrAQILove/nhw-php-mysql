<?php
session_start();

if(isset($_SESSION['user_session'])!="") {
	header("Location: home.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>NWH Members User Sign-up</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
</head>

<body>
	<div class="container">
		<div class="signup-form-container">
			<!-- form start -->
			<form method="post" role="form" id="login-form" autocomplete="off">
         
			<div class="form-header">
         		<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Log In</h3>
                      
				<div class="pull-right">
					<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
				</div>      
			</div>
                  
			<div class="form-body">
         		<!-- json response will be here -->
				<div id="error"></div>
					<!-- json response will be here -->
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input name="email" id="email" type="text" class="form-control" placeholder="Email Address">
						</div>
						<span class="help-block" id="error"></span>
					</div>
                        
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
							<input name="password" id="password" type="password" class="form-control" placeholder="Password">
						</div> 
						<span class="help-block" id="error"></span>                     
					</div>
				</div>
            
				<div class="form-footer">
					<button type="submit" class="btn btn-info" name="btn-login" id="btn-login">
					<span class="glyphicon glyphicon-log-in"></span> Log Me In !
					</button>
					
					<div class="pull-right">
						<button class="btn btn-info" id="btn-signup">
						<span class="glyphicon glyphicon-log-in"></span> Sign Me Up !
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/validation.min.js"></script>
	<script src="assets/script.js"></script>
   
</body>
</html>
