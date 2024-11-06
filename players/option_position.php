<?php 
    include("../connect.php");

    $query = "select * from tb_position";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $optionposition = "";

    $optionposition = "<option value=''>Select Position...</option>";

    while($row = mysqli_fetch_assoc($result)){
        $optionposition .= "<option value='$row[position_id]'>$row[position_name]</option>";
    }

    echo $optionposition;
?>