<?php 
    include("../connect.php");

    if(empty($_REQUEST["sortPlayer"])){
        $query = "select tb_teams.team_name, tb_position.position_name, tb_players.player_id, tb_players.last_name, tb_players.first_name, tb_players.middle_name, tb_players.height, tb_players.weight, tb_players.img_source, FLOOR(DATEDIFF(CURDATE(), tb_players.birth_date )/ 365.25) as player_age, tb_players.player_number
        from tb_players, tb_teams, tb_position 
        where tb_players.team_id = tb_teams.team_id and tb_players.position_id = tb_position.position_id order by tb_teams.team_name, tb_players.last_name";    
        
    }elseif(!empty($_REQUEST["sortPlayer"])){
        $query = "select tb_teams.team_name, tb_position.position_name, tb_players.player_id, tb_players.last_name, tb_players.first_name, tb_players.middle_name, tb_players.height, tb_players.weight, tb_players.img_source, FLOOR(DATEDIFF(CURDATE(), tb_players.birth_date )/ 365.25) as player_age, tb_players.player_number
        from tb_players, tb_teams, tb_position 
        where tb_players.team_id = tb_teams.team_id and tb_players.position_id = tb_position.position_id and tb_players.team_id = '$_REQUEST[sortPlayer]' order by tb_players.last_name";    
    }

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadplayer = "<table class='table table-hover table_files'> ";
    $loadplayer .= "<tr>
                    <th class='col-xs-1 text-center'>Profile Picture</th>
                    <th class='col-xs-1 text-center'>Name</th>
                    <th class='col-xs-1 text-center'>Team</th>
                    <th class='col-xs-1 text-center'>Player Number</th>
                    <th class='col-xs-1 text-center'>Position</th>
                    <th class='col-xs-1 text-center'>Height</th>
                    <th class='col-xs-1 text-center'>Weight</th>
                    <th class='col-xs-1 text-center'>Age</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $pstn = explode(" ", stripslashes($row["position_name"]));

        $loadplayer .= "<tr style='cursor:pointer;' class='player_records' player_id='".$row["player_id"]."'>
                            <td></td>
                            <td style='vertical-align: middle;'>".stripslashes($row["last_name"]).", ".stripslashes($row["first_name"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["team_name"])."</td><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImage($row[player_id])' class='img_player' id='img_player$row[player_id]'>
                            <td style='vertical-align: middle;'>".stripslashes($row["player_number"])."</td>
                            <td style='vertical-align: middle;'>";
                            
                            foreach($pstn as $values){
                                $lengthpstn = strlen($values);
                                $loadplayer .= "<span title='".stripslashes($row["position_name"])."'>".substr($values, 0, 1)."</span>";
                            }

        $loadplayer .=      "</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["height"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["weight"])."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["player_age"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-player btn-danger remove_item' player_id='".$row["player_id"]."'>X</button></td>
                        </tr>";
    }

    $loadplayer .= "</table>";

echo $loadplayer;
?>