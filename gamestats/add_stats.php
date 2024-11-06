<?php 
include("../connect.php");

if($_POST["action"] == "field_goal_made"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, points, field_goal_made, field_goal_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '2', '1', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "field_goal_missed"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, field_goal_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "three_pts_made"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, points, field_goal_made, field_goal_attempt, three_pts_made, three_pts_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '3', '1', '1', '1', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "three_pts_missed"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, field_goal_attempt, three_pts_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "free_throw_made"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, points, field_goal_made, field_goal_attempt, free_throw_made, free_throw_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '1', '1', '1', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "free_throw_missed"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, field_goal_attempt, free_throw_attempt, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "assist"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, assists, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "block"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, blocks, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "steal"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, steals, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "foul"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, fouls, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "o_rebound"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, o_rebounds, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}
elseif($_POST["action"] == "d_rebound"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, d_rebounds, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}elseif($_POST["action"] == "turnover"){
    $query = "insert into tb_gamestats (gamesched_id, player_id, team_id, turnovers, quarter) values('".intval($_REQUEST["gamesched_id"])."', '".intval($_REQUEST["player_id"])."', '".intval($_REQUEST["playerteam_id"])."', '1', '$_REQUEST[quarter]')";
}  
  
mysqli_query($conn, $query);

echo "";

?>
