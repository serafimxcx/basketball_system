<?php

include("../connect.php");

$query = "delete from tb_venue
			where venue_id=".intval($_REQUEST["venue_id"]);
mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";

?>
