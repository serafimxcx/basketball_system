<?php

include("../connect.php");

$query = "select * from tb_teams where team_id=".$_REQUEST["team_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getteam = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getteam = '{';
	$getteam .= '"imgsource":"'.$row["img_source"].'",';
	$getteam .= '"teamname":"'.$row["team_name"].'",';
	$getteam .= '"optncoach":"'.$row["coach_id"].'"';
	$getteam .= '}';
	
} 



echo $getteam;

?>
