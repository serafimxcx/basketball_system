<?php 
    include("../connect.php");

    $query = "select * from tb_coach order by last_name";
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadcoach = "<table class='table table-hover table_files'> ";
    $loadcoach .= "<tr>
                    <th class='col-xs-1 text-center'>Profile Picture</th>
                    <th class='col-xs-1 text-center'>Last Name</th>
                    <th class='col-xs-1 text-center'>First Name</th>
                    <th class='col-xs-1 text-center'>Middle Name</th>
                    <th class='col-xs-1 text-center'>Contact No.</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $loadcoach .= "<tr style='cursor:pointer;' class='coach_records' coach_id='".$row["coach_id"]."'>
                            <td><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImage($row[coach_id])' class='img_coach' id='img_coach$row[coach_id]'></td>
                            <td style='vertical-align: middle;'>".stripslashes($row["last_name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["first_name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["middle_name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["contactno"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-coach btn-danger remove_item' coach_id='".$row["coach_id"]."'>X</button></td>
                        </tr>";
    }

    $loadcoach .= "</table>";

echo $loadcoach;
?>