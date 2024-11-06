<?php

include("../connect.php");

$query = "delete from tb_teams
			where team_id=".intval($_REQUEST["team_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
