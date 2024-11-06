<?php

include("../connect.php");

$query = "update tb_position set
			position_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_position"])."'
			where position_id=".intval($_REQUEST["position_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
