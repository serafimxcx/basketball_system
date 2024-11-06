<?php

include("../connect.php");

$query = "select * from tb_venue where venue_id=".$_REQUEST["venue_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getvenue = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getvenue = '{';
	$getvenue .= '"venue":"'.$row["venue_name"].'"';
	$getvenue .= '}';
	
} 



echo $getvenue;

?>
