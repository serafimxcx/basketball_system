<?php

include("../connect.php");

$query = "select * from tb_position where position_id=".$_REQUEST["position_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getposition = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getposition = '{';
	$getposition .= '"position":"'.$row["position_name"].'"';
	$getposition .= '}';
	
} 



echo $getposition;

?>
