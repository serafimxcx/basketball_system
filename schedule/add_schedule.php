<?php 
    include("../connect.php");

    //add schedule
    $query="insert into tb_gamesched (date_schedule, hometeam_id, awayteam_id, venue_id, start_time, end_time)
    values( '".date("Y/m/d",strtotime($_REQUEST["txt_date"]))."',
    '".intval($_REQUEST["slct_hometeam"])."',
    '".intval($_REQUEST["slct_awayteam"])."',
    '".intval($_REQUEST["slct_venue"])."',
    '".date("H:i:s",strtotime($_REQUEST["txt_starttime"]))."',
    '".date("H:i:s",strtotime($_REQUEST["txt_endtime"]))."'
    )";

    mysqli_query($conn, $query) or die(mysqli_error($conn));


    echo "";
?>