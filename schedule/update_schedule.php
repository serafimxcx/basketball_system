<?php

include("../connect.php");

$query = "update tb_gamesched set
			date_schedule='".date("Y/m/d",strtotime($_REQUEST["txt_date"]))."', hometeam_id='".intval($_REQUEST["slct_hometeam"])."', awayteam_id='".intval($_REQUEST["slct_awayteam"])."', venue_id='".intval($_REQUEST["slct_venue"])."', start_time='".date("H:i:s",strtotime($_REQUEST["txt_starttime"]))."', end_time='".date("H:i:s",strtotime($_REQUEST["txt_endtime"]))."'
			where gamesched_id=".intval($_REQUEST["sched_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

//delete players in tb_gameplayers to replace a new one
$query1 = "delete from tb_gameplayers
			where gamesched_id=".intval($_REQUEST["sched_id"]);
mysqli_query($conn,$query1) or die(mysqli_error($conn)."<br>".$query);

echo "";
?>