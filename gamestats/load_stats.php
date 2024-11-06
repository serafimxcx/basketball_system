<?php 
include("../connect.php");

$loadstats = "";

$queryislocked = "select * from tb_gamesched where gamesched_id = $_REQUEST[gamesched_id]";
$resultislocked = mysqli_query($conn, $queryislocked);

while($row = mysqli_fetch_assoc($resultislocked)){
    $loadstats .= "<input type='hidden' name='txt_isLocked' id='txt_isLocked' value='$row[isLocked]'>";
}

$loadstats .= "<div class='statstotalscore_div'>";
$loadstats .= "<table width='100%' class='table table-bordered'>
                <tr>
                    <th>Home</th><th>Away</th>
                </tr>
                <tr>";

$queryHomeTotalScore = "select SUM(tb_gamestats.points) as home_total_score from tb_gamestats, tb_gamesched, tb_players 
where tb_gamestats.gamesched_id = '$_REQUEST[gamesched_id]' and tb_gamestats.gamesched_id = tb_gamesched.gamesched_id and tb_gamestats.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.hometeam_id";

$resultHomeTotalScore = mysqli_query($conn, $queryHomeTotalScore);

$loadstats .= "<td><span id='txt_hometotalscore'>";
while($row = mysqli_fetch_assoc($resultHomeTotalScore)){
   
    if($row["home_total_score"] == ""){
        $loadstats .= "0";
    }else{
        $loadstats .= "$row[home_total_score]";
    }
    
}
$loadstats .= "</span></td>";


$queryAwayTotalScore = "select SUM(tb_gamestats.points) as away_total_score from tb_gamestats, tb_gamesched, tb_players where tb_gamestats.gamesched_id = '$_REQUEST[gamesched_id]' and tb_gamestats.gamesched_id = tb_gamesched.gamesched_id and tb_gamestats.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.awayteam_id";

$resultAwayTotalScore = mysqli_query($conn, $queryAwayTotalScore);

$loadstats .= "<td><span id='txt_awaytotalscore'>";
while($row = mysqli_fetch_assoc($resultAwayTotalScore)){
    
    if($row["away_total_score"] == ""){
        $loadstats .= "0";
    }else{
        $loadstats .= "$row[away_total_score]";
    }
    
}
$loadstats .= "</span></td>";

$loadstats .= "</tr>
                </table>
                </div><br><br>";


$query = "select CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_players.player_number, tb_teams.team_name, tb_gamestats.play_time, tb_gamestats.gamestats_id, tb_gamestats.gamesched_id, tb_gamestats.points, tb_gamestats.field_goal_made, tb_gamestats.field_goal_attempt, tb_gamestats.three_pts_made, tb_gamestats.three_pts_attempt, tb_gamestats.free_throw_made, tb_gamestats.free_throw_attempt, tb_gamestats.assists, tb_gamestats.blocks, tb_gamestats.steals, tb_gamestats.fouls, tb_gamestats.o_rebounds, tb_gamestats.d_rebounds, tb_gamestats.turnovers, tb_gamestats.play_time, tb_gamestats.quarter 
from tb_players, tb_gamestats, tb_teams
where tb_gamestats.player_id = tb_players.player_id and tb_players.team_id = tb_teams.team_id and tb_gamestats.gamesched_id = '$_REQUEST[gamesched_id]' order by tb_gamestats.gamestats_id DESC";

$result = mysqli_query($conn, $query);

$loadstats .= "<table class='table table-bordered' width='100%'>
                <tr>
                    <th>Timestamp</th>
                    <th>Quarter</th>
                    <th>Activity</th>
                    <th></th>
                </tr>";
 
while($row = mysqli_fetch_assoc($result)){
    $loadstats .= "<tr class='stats_records' gamestats_id='".$row["gamestats_id"]."'>
                        <td>$row[play_time]</td>
                        <td>$row[quarter]</td>
                        <td>($row[team_name]) #$row[player_number] - $row[playername] ";
                        if($row["points"] == 2 && $row["field_goal_attempt"] == 1){
                            $loadstats .= "made 2 points.";
                        }elseif($row["points"] == 0 && $row["field_goal_attempt"] == 1){
                            $loadstats .= "missed 2 points.";
                        }elseif($row["points"] == 3 && $row["three_pts_attempt"] == 1){
                            $loadstats .= "made a three point shot.";
                        }elseif($row["points"] == 0 && $row["three_pts_attempt"] == 1){
                            $loadstats .= "missed a three point shot.";
                        }elseif($row["points"] == 1 && $row["free_throw_attempt"] == 1){
                            $loadstats .= "made a free throw.";
                        }elseif($row["points"] == 0 && $row["free_throw_attempt"] == 1){
                            $loadstats .= "missed a free throw.";
                        }elseif($row["assists"] == 1){
                            $loadstats .= "assisted a teammate to score.";
                        }elseif($row["blocks"] == 1){
                            $loadstats .= "blocked the opponent's attempt to score.";
                        }elseif($row["steals"] == 1){
                            $loadstats .= "successfully stole the ball from an opponent.";
                        }elseif($row["fouls"] == 1){
                            $loadstats .= "committed a personal foul.";
                        }elseif($row["o_rebounds"] == 1){
                            $loadstats .= "secured an offensive rebound.";
                        }elseif($row["d_rebounds"] == 1){
                            $loadstats .= "secured a defensive rebound.";
                        }elseif($row["turnovers"] == 1){
                            $loadstats .= "loses the ball to the opponent.";
                        }
    $loadstats .=       "</td>
                        <td style='vertical-align: middle; text-align: center;'><button type='button' class='remove-stats btn-danger remove_item' gamestats_id='".$row["gamestats_id"]."'>X</button></td>
                </tr>";
}

$loadstats .= "</table>";


echo $loadstats;
?>