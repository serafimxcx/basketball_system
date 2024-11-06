<?php

include("../connect.php");

$query = "update tb_venue set
			venue_name='".mysqli_real_escape_string($conn,$_REQUEST["txt_venue"])."'
			where venue_id=".intval($_REQUEST["venue_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
