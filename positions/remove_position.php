<?php

include("../connect.php");

$query = "delete from tb_position
			where position_id=".intval($_REQUEST["position_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
