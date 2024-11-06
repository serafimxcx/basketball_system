<?php

include("../connect.php");

$query = "select * from tb_players where player_id=".$_REQUEST["player_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getplayer = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getplayer = '{';
	$getplayer .= '"team":"'.$row["team_id"].'",';
	$getplayer .= '"position":"'.$row["position_id"].'",';
	$getplayer .= '"lastname":"'.$row["last_name"].'",';
	$getplayer .= '"firstname":"'.$row["first_name"].'",';
	$getplayer .= '"middlename":"'.$row["middle_name"].'",';
	$getplayer .= '"imgsource":"'.$row["img_source"].'",';
	$getplayer .= '"height":"'.$row["height"].'",';
	$getplayer .= '"weight":"'.$row["weight"].'",';
	$getplayer .= '"birthdate":"'.$row["birth_date"].'",';
	$getplayer .= '"playernum":"'.$row["player_number"].'"';
	$getplayer .= '}';
	
} 



echo $getplayer;

?>
