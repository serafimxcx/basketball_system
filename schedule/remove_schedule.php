<?php

include("../connect.php");

//delete players that will player for that specific schedule for specific schedule
$query1 = "delete from tb_gameplayers
			where gamesched_id=".intval($_REQUEST["sched_id"]);
mysqli_query($conn,$query1) or die(mysqli_error($conn)."<br>".$query);

//delete schedule
$query2 = "delete from tb_gamesched
			where gamesched_id=".intval($_REQUEST["sched_id"]);
mysqli_query($conn,$query2) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
