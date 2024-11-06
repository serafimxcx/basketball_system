<?php 
    include("../connect.php");

    $query="insert into tb_coach (last_name, first_name, middle_name, img_source, contactno)
    values('".mysqli_real_escape_string($conn, $_REQUEST["txt_lastname"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_firstname"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_middlename"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_imgsource"])."',
    '".mysqli_real_escape_string($conn, $_REQUEST["txt_contactno"])."'
    )";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>