<?php 
include("../connect.php");

$loadteamstats = "";

$sort = $_POST["sort"];


if($sort == ""){
    $query = "select 
    ROW_NUMBER() OVER (ORDER BY SUM(tb_gamestats.points) / COUNT(DISTINCT tb_gamestats.gamesched_id) DESC) as rank,
    tb_teams.team_name, tb_teams.img_source, tb_gamestats.team_id,
    COUNT(DISTINCT tb_gamestats.gamesched_id) as gamesplayed,
    COALESCE(FORMAT((SUM(tb_gamestats.points) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as ppg,
    COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made) / SUM(tb_gamestats.field_goal_attempt)) * 100), 2), '0') as fgp,
    COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made) / SUM(tb_gamestats.three_pts_attempt)) * 100), 2), '0') as tpp,
    COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made) / SUM(tb_gamestats.free_throw_attempt)) * 100), 2), '0') as ftp,
    COALESCE(FORMAT((SUM(tb_gamestats.o_rebounds) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as off,
    COALESCE(FORMAT((SUM(tb_gamestats.d_rebounds) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as def,
    COALESCE(FORMAT(((SUM(tb_gamestats.o_rebounds) + SUM(tb_gamestats.d_rebounds)) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as rpg,
    COALESCE(FORMAT((SUM(tb_gamestats.assists) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as apg,
    COALESCE(FORMAT((SUM(tb_gamestats.steals) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as spg,
    COALESCE(FORMAT((SUM(tb_gamestats.blocks) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as bpg,
    COALESCE(FORMAT((SUM(tb_gamestats.turnovers) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as tpg,
    COALESCE(FORMAT((SUM(tb_gamestats.fouls) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as fpg
    from 
    tb_gamestats, tb_teams, tb_gamesched
    where tb_gamestats.gamesched_id = tb_gamesched.gamesched_id and tb_gamestats.team_id = tb_teams.team_id
    group by tb_gamestats.team_id
    order by rank
    
    ";
}else{
    $query = "select 
    ROW_NUMBER() OVER (ORDER BY SUM(tb_gamestats.points) / COUNT(DISTINCT tb_gamestats.gamesched_id) DESC) as rank,
    tb_teams.team_name, tb_teams.img_source, tb_gamestats.team_id,
    COUNT(DISTINCT tb_gamestats.gamesched_id) as gamesplayed,
    COALESCE(FORMAT((SUM(tb_gamestats.points) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as ppg,
    COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made) / SUM(tb_gamestats.field_goal_attempt)) * 100), 2), '0') as fgp,
    COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made) / SUM(tb_gamestats.three_pts_attempt)) * 100), 2), '0') as tpp,
    COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made) / SUM(tb_gamestats.free_throw_attempt)) * 100), 2), '0') as ftp,
    COALESCE(FORMAT((SUM(tb_gamestats.o_rebounds) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as off,
    COALESCE(FORMAT((SUM(tb_gamestats.d_rebounds) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as def,
    COALESCE(FORMAT(((SUM(tb_gamestats.o_rebounds) + SUM(tb_gamestats.d_rebounds)) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as rpg,
    COALESCE(FORMAT((SUM(tb_gamestats.assists) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as apg,
    COALESCE(FORMAT((SUM(tb_gamestats.steals) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as spg,
    COALESCE(FORMAT((SUM(tb_gamestats.blocks) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as bpg,
    COALESCE(FORMAT((SUM(tb_gamestats.turnovers) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as tpg,
    COALESCE(FORMAT((SUM(tb_gamestats.fouls) / COUNT(DISTINCT tb_gamestats.gamesched_id)), 2), '0') as fpg
    from 
    tb_gamestats, tb_teams, tb_gamesched
    where tb_gamestats.gamesched_id = tb_gamesched.gamesched_id and tb_gamestats.team_id = tb_teams.team_id
    group by tb_gamestats.team_id
    order by $sort

";
}


$result = mysqli_query($conn, $query);

$loadteamstats .= "<table class='table table table_standing'>
                    <tr>
                        <th class='sort_rank'>Rank</th>
                        <th></th>
                        <th class='sort_team'>Team</th>
                        <th title='Games'>G</th>
                        <th title='Points Per Game'>PPG</th>
                        <th title='Field Goal Percentage'>FG%</th>
                        <th title='Three Points Percentage'>3P%</th>
                        <th title='Free Throw Percentage'>FT%</th>
                        <th title='Offensive Rebounds'>OFF</th>
                        <th title='Defensive Rebounds'>DEF</th>
                        <th title='Rebounds Per Game'>RPG</th>
                        <th title='Assists Per Game'>APG</th>
                        <th title='Steals Per Game'>SPG</th>
                        <th title='Blocks Per Game'>BPG</th>
                        <th title='Turnovers'>TO</th>
                        <th title='Personal Fouls'>PF</th>
                    </tr>";

while($row = mysqli_fetch_assoc($result)){
    $loadteamstats .= "<tr>
                        <td>$row[rank]</td>
                        <td style='text-align:center;'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImage($row[team_id])' class='img_team img_team_standing' id='img_team$row[team_id]'></td>
                        <td>$row[team_name]</td>    
                        <td>$row[gamesplayed]</td>
                        <td>$row[ppg]</td>
                        <td>$row[fgp]</td>
                        <td>$row[tpp]</td>
                        <td>$row[ftp]</td>
                        <td>$row[off]</td>
                        <td>$row[def]</td>
                        <td>$row[rpg]</td>
                        <td>$row[apg]</td>
                        <td>$row[spg]</td>
                        <td>$row[bpg]</td>
                        <td>$row[tpg]</td>
                        <td>$row[fpg]</td>
                    </tr>";
}



$loadteamstats .= "</table>";

echo $loadteamstats;


?>