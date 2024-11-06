<?php 
    include("../connect.php");

    $query="insert into tb_players(team_id, position_id, last_name, first_name, middle_name, img_source, height, weight, birth_date, player_number)
    values('".intval($_REQUEST["slct_team"])."',
    '".intval($_REQUEST["slct_position"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_lastname"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_firstname"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_middlename"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_imgsource"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_height"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_weight"])."',
    '".date("Y/m/d",strtotime($_REQUEST["txt_birthdate"]))."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_playernum"])."'
    )";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>