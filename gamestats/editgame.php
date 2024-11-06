<?php 

include("../connect.php");

$query = "delete from tb_teamstanding where gamesched_id='$_POST[gamesched_id]'";

mysqli_query($conn, $query);

$querylocksched = "update tb_gamesched set isLocked = '0' where gamesched_id='$_POST[gamesched_id]'";
mysqli_query($conn, $querylocksched);

echo "";
?>