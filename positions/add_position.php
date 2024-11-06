<?php 
    include("../connect.php");

    $query="insert into tb_position (position_name)
    values('".mysqli_real_escape_string($conn, $_REQUEST["txt_position"])."'
    )";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>