<?php 
    include("../connect.php");


    $query = "select * from tb_venue ORDER BY venue_name ASC";
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadvenue = "<table class='table table-hover table_files'> ";
    $loadvenue .= "<tr>
                    <th class='col-xs-1 text-center'>Venue</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $pstn = explode(" ", stripslashes($row["venue_name"]));

        $loadvenue .= "<tr style='cursor:pointer;' class='venue_records' venue_id='".$row["venue_id"]."'>
                            <td style='vertical-align: middle;'>".stripslashes($row["venue_name"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-venue btn-danger remove_item' venue_id='".$row["venue_id"]."'>X</button></td>
                        </tr>";
    }

    $loadvenue .= "</table>";

echo $loadvenue;
?>