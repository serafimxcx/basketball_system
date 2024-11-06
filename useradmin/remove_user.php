<?php

include("../connect.php");

$query = "delete from tb_users
			where user_id=".intval($_REQUEST["user_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
