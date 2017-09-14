<?php
session_start();

if(!isset($_SESSION['user_session'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View All Members</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/EditDeletePage.js"></script> 
</head>

<body>
    <div class="container">
        <div class="header"><!--/* Logo put here */--></div>
		<!-- header -->
        <h1 class="main_title">NHW Database</h1>
        <div class="content">
            <fieldset class="field_container align_right">
                <legend> <img src="images/arrow.gif"> Operations</legend>
                <span class="import" onclick="show_popup('popup_upload')">Import CSV to MySQL</span>
                <a href="export.php" class="export">Export from MySQL to CSV</a>
            </fieldset>
            <fieldset class="field_container">
                <legend> <img src="images/arrow.gif"> Members list </legend>
                <div id="list_container">
                    <div id="loading"></div>
					<div id="container-body"></div>
                </div><!-- list_container -->
            </fieldset>
			<fieldset class="field_container align_right">
                <legend> <img src="images/arrow.gif"> Operations</legend>
                <span class="import" onclick="show_popup('popup_upload')">Import CSV to MySQL</span>
                <a href="export.php" class="export">Export from MySQL to CSV</a>
				<a href="logout.php" class="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </fieldset>
        </div><!-- content -->
        <div class="footer">
            Copyright &copy 2016 <a href="http://www.cwaustral.com.au">Countrywide Austral Pty Ltd</a>
        </div><!-- footer -->
    </div><!-- container -->

    <!-- The popup for upload a csv file -->
    <div id="popup_upload">
        <div class="form_upload">
            <span class="close" onclick="close_popup('popup_upload')">x</span>
            <h2>Upload CSV file</h2>
            <form action="import.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" id="csv_file" class="file_input">
                <input type="submit" value="Upload file" id="upload_btn">
            </form>
        </div>
    </div>
</body>
</html>
