<?php 
    include("../connect.php");

    $query = "select * from tb_teams order by team_name ASC";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $optionteam = "";

    $optionteam = "<option value=''>Select Team...</option>";

    while($row = mysqli_fetch_assoc($result)){
        $optionteam .= "<option value='$row[team_id]'>$row[team_name]</option>";
    }

    echo $optionteam;
?>