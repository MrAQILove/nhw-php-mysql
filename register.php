<?php
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
			<form method="post" role="form" id="register-form" autocomplete="off">
         
			<div class="form-header">
         		<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Sign Up</h3>
                      
				<div class="pull-right">
					<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
				</div>      
			</div>
                  
			<div class="form-body">
         		<!-- json response will be here -->
				<div id="errorDiv"></div>
					<!-- json response will be here -->
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input name="name" type="text" class="form-control" placeholder="Name">
						</div>
						<span class="help-block" id="error"></span>
					</div>
                        
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
							<input name="email" id="email" type="text" class="form-control" placeholder="Email">
						</div> 
						<span class="help-block" id="error"></span>                     
					</div>
                        
					<div class="row">    
						<div class="form-group col-lg-6">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								<input name="password" id="password" type="password" class="form-control" placeholder="Password">
							</div>  
							<span class="help-block" id="error"></span>                    
						</div>
                            
						<div class="form-group col-lg-6">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								<input name="cpassword" type="password" class="form-control" placeholder="Retype Password">
							</div>  
							<span class="help-block" id="error"></span>                    
						</div>              
					</div>       
				</div>
            
				<div class="form-footer">
					<button type="submit" class="btn btn-info" id="btn-signup">
					<span class="glyphicon glyphicon-log-in"></span> Sign Me Up !
					</button>
					
					<div class="pull-right">
						<button class="btn btn-info" id="btn-login">
						<span class="glyphicon glyphicon-log-in"></span> Log Me In !
						</button>
					</div>
				</div>
			</form>
		</div>
           
        <!--<div class="alert alert-info">
			<a href="http://www.codingcage.com/2016/05/ajax-bootstrap-signup-form-with-jquery.html" target="_blank">Go to Tutorial.</a>
		</div>-->
	</div>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
   
</body>
</html>
