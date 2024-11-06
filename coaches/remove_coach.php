<?php

include("../connect.php");

$query = "delete from tb_coach
			where coach_id=".intval($_REQUEST["coach_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
