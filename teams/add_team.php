<?php 
    include("../connect.php");

    $query="insert into tb_teams (team_name, coach_id, img_source)
    values('".mysqli_real_escape_string($conn, $_REQUEST["txt_teamname"])."',
    '".intval($_REQUEST["slct_coach"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_imgsource"])."'
    )";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>