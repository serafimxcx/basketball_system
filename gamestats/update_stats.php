<?php 
include("../connect.php");

if($_POST["action"] == "field_goal_made"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='2', field_goal_made='1', field_goal_attempt='1',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "field_goal_missed"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='1',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "three_pts_made"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='3', field_goal_made='0', field_goal_attempt='1',three_pts_made='1',three_pts_attempt='1',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "three_pts_missed"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='1',three_pts_made='0',three_pts_attempt='1',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "free_throw_made"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='1', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='1',free_throw_attempt='1',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "free_throw_missed"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='1',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "assist"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='1',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "block"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='1',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "steal"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='1',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "foul"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='1',o_rebounds='0',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "o_rebound"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='1',d_rebounds='0',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}
elseif($_POST["action"] == "d_rebound"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='1',turnovers='0',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}elseif($_POST["action"] == "turnover"){
    $query = "update tb_gamestats SET player_id='$_REQUEST[player_id]', team_id='$_REQUEST[playerteam_id]', points ='0', field_goal_made='0', field_goal_attempt='0',three_pts_made='0',three_pts_attempt='0',free_throw_made='0',free_throw_attempt='0',assists='0',blocks='0',steals='0',fouls='0',o_rebounds='0',d_rebounds='0',turnovers='1',quarter='$_REQUEST[quarter]' WHERE gamestats_id='$_REQUEST[gamestats_id]'";
}  
  
mysqli_query($conn, $query);

echo "";

?>
