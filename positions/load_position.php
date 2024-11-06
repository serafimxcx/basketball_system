<?php 
    include("../connect.php");


    $query = "select * from tb_position";
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadposition = "<table class='table table-hover table_files'> ";
    $loadposition .= "<tr>
                    <th class='col-xs-1 text-center'>Abbreviation</th>
                    <th class='col-xs-1 text-center'>Position Name</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $pstn = explode(" ", stripslashes($row["position_name"]));

        $loadposition .= "<tr style='cursor:pointer;' class='position_records' position_id='".$row["position_id"]."'>
                            <td style='vertical-align: middle;'>";
                            
                            foreach($pstn as $values){
                                $lengthpstn = strlen($values);
                                $loadposition .= substr($values, 0, 1);
                            }
                            
        $loadposition .=   "</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["position_name"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-position btn-danger remove_item' position_id='".$row["position_id"]."'>X</button></td>
                        </tr>";
    }

    $loadposition .= "</table>";

echo $loadposition;
?>