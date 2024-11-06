<?php

include("../connect.php");

$query = "select * from tb_users where user_id=".$_REQUEST["user_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getuser = "";

if ( $row = mysqli_fetch_assoc($result) ) {
	
	$getuser = '{';
	$getuser .= '"name":"'.$row["name"].'",';
	$getuser .= '"username":"'.$row["username"].'",';
	$getuser .= '"password":"'.$row["pass"].'"';
	$getuser .= '}';
	
} 



echo $getuser;

?>
