<?php 
include("../connect.php");

$query = "select * from tb_gamestats where gamestats_id=".$_REQUEST["gamestats_id"];
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

$getstats = "";

while($row = mysqli_fetch_assoc($result)){
    $getstats = '{'; 
    $getstats .= '"player_id":"'.$row["player_id"].'",'; 
    $getstats .= '"playerteam_id":"'.$row["team_id"].'",'; 
    $getstats .= '"quarter":"'.$row["quarter"].'",'; 
    $getstats .= '"action":"';
                    if($row["points"] == 2 && $row["field_goal_attempt"] == 1){
                        $getstats .= 'field_goal_made';
                    }elseif($row["points"] == 0 && $row["field_goal_attempt"] == 1){
                        $getstats .= 'field_goal_missed';
                    }elseif($row["points"] == 3 && $row["three_pts_attempt"] == 1){
                        $getstats .= 'three_pts_made';
                    }elseif($row["points"] == 0 && $row["three_pts_attempt"] == 1){
                        $getstats .= 'three_pts_missed';
                    }elseif($row["points"] == 1 && $row["free_throw_attempt"] == 1){
                        $getstats .= 'free_throw_made';
                    }elseif($row["points"] == 0 && $row["free_throw_attempt"] == 1){
                        $getstats .= 'free_throw_missed';
                    }elseif($row["assists"] == 1){
                        $getstats .= 'assist';
                    }elseif($row["blocks"] == 1){
                        $getstats .= 'block';
                    }elseif($row["steals"] == 1){
                        $getstats .= 'steal';
                    }elseif($row["fouls"] == 1){
                        $getstats .= 'foul';
                    }elseif($row["o_rebounds"] == 1){
                        $getstats .= 'o_rebound';
                    }elseif($row["d_rebounds"] == 1){
                        $getstats .= 'd_rebound';
                    }elseif($row["turnovers"] == 1){
                        $getstats .= 'turnover';
                    }
    $getstats .= '"'; 
    $getstats .= '}'; 
}

echo $getstats;

?>