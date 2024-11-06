<?php 
include("../connect.php");

if(isset($_POST['query'])){
    $query = "select CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_players.player_number, tb_players.player_id, tb_players.team_id, tb_teams.team_name from tb_players, tb_teams, tb_gameplayers where tb_gameplayers.gamesched_id = '$_POST[gamesched_id]' and tb_gameplayers.player_id = tb_players.player_id and tb_players.team_id = tb_teams.team_id and tb_gameplayers.isInjured = '0' and (tb_players.last_name like '$_POST[query]%' or tb_players.player_number like '$_POST[query]%' or tb_teams.team_name like '$_POST[query]%') order by tb_gameplayers.isFirstfive DESC, tb_players.last_name ASC";

    $result = mysqli_query($conn, $query);

    echo "<br>";
    if(mysqli_num_rows($result) > 0) {
            
        while ($row = mysqli_fetch_array($result)) {
        echo "<div class='player_result' player_id='$row[player_id]' playerteam_id='$row[team_id]' player_info='($row[team_name]) #$row[player_number] - $row[playername]'>($row[team_name]) #$row[player_number] - $row[playername]</div>";
        }
        
    } 

 
    
    if(mysqli_num_rows($result) == 0 ) {
        echo "
        <div class='text-center'>
            Couldn't find any results.
        </div>
        ";
    }
    echo "<br>";
}


?>