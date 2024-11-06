<?php

include("../connect.php");

$query = "update tb_teams set
			team_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_teamname"])."', coach_id='".intval($_REQUEST["slct_coach"])."', img_source='".mysqli_real_escape_string($conn,$_REQUEST["txt_imgsource"])."'
			where team_id=".intval($_REQUEST["team_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
