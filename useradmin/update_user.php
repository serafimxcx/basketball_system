<?php

include("../connect.php");

$query = "update tb_users set
			name='".mysqli_real_escape_string($conn,$_REQUEST["txt_name"])."', username='".mysqli_real_escape_string($conn,$_REQUEST["txt_username"])."', pass='".mysqli_real_escape_string($conn,$_REQUEST["txt_password"])."'
			where user_id=".intval($_REQUEST["user_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
