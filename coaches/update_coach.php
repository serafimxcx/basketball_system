<?php

include("../connect.php");

$query = "update tb_coach set
			last_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_lastname"])."', first_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_firstname"])."', middle_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_middlename"])."', img_source='".mysqli_real_escape_string($conn,$_REQUEST["txt_imgsource"])."', contactno='".mysqli_real_escape_string($conn,$_REQUEST["txt_contactno"])."'
			where coach_id=".intval($_REQUEST["coach_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
