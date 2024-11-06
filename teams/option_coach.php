<?php 
    include("../connect.php");

    $query = "select * from tb_coach order by last_name ASC";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $optionCoach = "";

    $optionCoach = "<option value=''>Select Coach...</option>";

    while($row = mysqli_fetch_assoc($result)){
        $optionCoach .= "<option value='$row[coach_id]'>$row[last_name], $row[first_name]</option>";
    }

    echo $optionCoach;
?>