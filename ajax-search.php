<?php
include("config.php");

$db = getDB();
$keyword = '%'.$_POST['keyword'].'%';

//$sql = "SELECT * FROM Members_tblState WHERE State LIKE (:keyword) ORDER BY StateID ASC LIMIT 0, 10";

$sql = "SELECT * FROM Members_tblState WHERE State LIKE (:keyword) ORDER BY StateID ASC LIMIT 0, 10";
$query = $db->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();

foreach ($list as $rs) 
{
	// put in bold the written text
	$State = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['State']);
	
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['State']).'\')">'.$State.'</li>';
}
?>