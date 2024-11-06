<?php

include("../connect.php");

$query = "delete from tb_players
			where player_id=".intval($_REQUEST["player_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
