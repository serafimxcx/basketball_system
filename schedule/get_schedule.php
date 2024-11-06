<?php

include("../connect.php");

$query = "select * from tb_gamesched where gamesched_id=".$_REQUEST["sched_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getcoach = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getcoach = '{';
	$getcoach .= '"gamesched_id":"'.$row["gamesched_id"].'",';
	$getcoach .= '"date":"'.$row["date_schedule"].'",';
	$getcoach .= '"starttime":"'.$row["start_time"].'",';
	$getcoach .= '"endtime":"'.$row["end_time"].'",';
	$getcoach .= '"venue":"'.$row["venue_id"].'",';
	$getcoach .= '"hometeam":"'.$row["hometeam_id"].'",';
	$getcoach .= '"awayteam":"'.$row["awayteam_id"].'"';
	$getcoach .= '}';
	
} 



echo $getcoach;

?>
