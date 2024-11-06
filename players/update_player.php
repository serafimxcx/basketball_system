<?php

include("../connect.php");

$query = "update tb_players set
			last_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_lastname"])."', first_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_firstname"])."', middle_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_middlename"])."', img_source='".mysqli_real_escape_string($conn,$_REQUEST["txt_imgsource"])."', height='".mysqli_real_escape_string($conn,$_REQUEST["txt_height"])."', weight='".mysqli_real_escape_string($conn,$_REQUEST["txt_weight"])."', birth_date='".date("Y/m/d",strtotime($_REQUEST["txt_birthdate"]))."', player_number='".mysqli_real_escape_string($conn,$_REQUEST["txt_playernum"])."'
			where player_id=".intval($_REQUEST["player_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
