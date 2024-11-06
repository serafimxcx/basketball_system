<?php

include("../connect.php");

$query = "select * from tb_coach where coach_id=".$_REQUEST["coach_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getcoach = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getcoach = '{';
	$getcoach .= '"lastname":"'.$row["last_name"].'",';
	$getcoach .= '"firstname":"'.$row["first_name"].'",';
	$getcoach .= '"middlename":"'.$row["middle_name"].'",';
	$getcoach .= '"imgsource":"'.$row["img_source"].'",';
	$getcoach .= '"contactno":"'.$row["contactno"].'"';
	$getcoach .= '}';
	
} 



echo $getcoach;

?>
