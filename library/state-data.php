<?php
require "../config.php"; // Database Connection

$dbo = getDB();
$sql = "Select StateID, State from Members_tblState";  
$row = $dbo->prepare($sql);
$row->execute();
$result = $row->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('data'=>$result));
?>

