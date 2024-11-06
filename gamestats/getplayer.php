<?php 
include("../connect.php");


    $query = "select CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_players.player_number, tb_players.player_id, tb_players.team_id, tb_teams.team_name from tb_players, tb_teams, tb_gamestats where tb_gamestats.player_id = '$_POST[player_id]' and tb_gamestats.player_id = tb_players.player_id and tb_players.team_id = tb_teams.team_id LIMIT 1";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
            
        while ($row = mysqli_fetch_array($result)) {
        echo "($row[team_name]) #$row[player_number] - $row[playername]";
        }
        
    } 

?>