<?php 
    include("../connect.php");


    $query = "select tb_teams.team_id, tb_teams.team_name, tb_teams.img_source, tb_coach.first_name, tb_coach.last_name from tb_teams, tb_coach where tb_teams.coach_id = tb_coach.coach_id order by tb_teams.team_name ASC";
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadteam = "<table class='table table-hover table_files'> ";
    $loadteam .= "<tr>
                    <th class='col-xs-1 text-center'>Team Logo</th>
                    <th class='col-xs-1 text-center'>Team Name</th>
                    <th class='col-xs-1 text-center'>Team Coach</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $loadteam .= "<tr style='cursor:pointer;' class='team_records' team_id='".$row["team_id"]."'>
                            <td><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImage($row[team_id])' class='img_team' id='img_team$row[team_id]'></td>
                            <td style='vertical-align: middle;'>".stripslashes($row["team_name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["last_name"]).", ".stripslashes($row["first_name"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-team btn-danger remove_item' team_id='".$row["team_id"]."'>X</button></td>
                        </tr>";
    }

    $loadteam .= "</table>";

echo $loadteam;
?>