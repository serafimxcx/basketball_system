<?php

include("../connect.php");

//delete players that will player for that specific schedule for specific schedule
$query = "delete from tb_gamestats
			where gamestats_id=".intval($_REQUEST["gamestats_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);


echo "";

?>
