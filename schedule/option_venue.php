<?php 
    include("../connect.php");

    $query = "select * from tb_venue order by venue_name ASC";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $optionvenue = "";

    $optionvenue = "<option value=''>Select Venue...</option>";

    while($row = mysqli_fetch_assoc($result)){
        $optionvenue .= "<option value='$row[venue_id]'>$row[venue_name]</option>";
    }

    echo $optionvenue;
?>