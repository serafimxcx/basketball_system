<?php
    include("../connect.php");

    $loadhometeam = "";
    $isLocked = "";

    $queryislocked = "select * from tb_gamesched where gamesched_id = '".intval($_REQUEST['sched_id'])."'";
    $resultislocked = mysqli_query($conn, $queryislocked);

    while($row = mysqli_fetch_assoc($resultislocked)){
        $isLocked = $row["isLocked"];
    }


    $queryhometeam = "select tb_teams.team_name, CONCAT(tb_coach.last_name, ', ', tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id
    from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams
    where tb_gamestats.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id
    LIMIT 1";

    $resulthometeam = mysqli_query($conn, $queryhometeam) or die(mysqli_error($conn));

    $loadhometeam .= "<table class='table_team_title'>";
    while($row = mysqli_fetch_assoc($resulthometeam)){
        $loadhometeam .= "
                            <tr>
                            <td rowspan='2' style='vertical-align: middle; padding-left: 20px; text-align: right;'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImageTeam($row[team_id])' class='img_team_stat' id='img_team$row[team_id]'></td>
                            <td><h3><b>$row[team_name]</b></h3></td>
                            
                            
                          </tr>
                          <tr>
                                <td><h5>Coach: $row[coachname]</h5></td>
                            </tr>
                          
        ";
    }
    $loadhometeam .= "</table><br><hr><br>";

    if($isLocked == 0){
        $loadhometeam .= "<div id=''>Game is not yet finished.</div>";
    }else{
        $query = "select CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_players.img_source,SUM( tb_gamestats.points) as totalpoints,  SUM(tb_gamestats.field_goal_made) as totalfgm, SUM(tb_gamestats.field_goal_attempt) as totalfga, COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made)/SUM(tb_gamestats.field_goal_attempt))*100),2), '0') as fgp, SUM( tb_gamestats.three_pts_made) as total3pm, SUM(tb_gamestats.three_pts_attempt) as total3pa, COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made)/SUM(tb_gamestats.three_pts_attempt))*100),2), '0') as tpp, SUM(tb_gamestats.free_throw_made) as totalftm, SUM(tb_gamestats.free_throw_attempt) totalfta, COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made)/SUM(tb_gamestats.free_throw_attempt))*100),2), '0') as ftp, SUM(tb_gamestats.o_rebounds) as totalorebounds, SUM(tb_gamestats.d_rebounds) as totaldrebounds, SUM(tb_gamestats.o_rebounds + tb_gamestats.d_rebounds) as totalrebounds, SUM(tb_gamestats.assists) as totalassists, SUM(tb_gamestats.blocks) as totalblocks, SUM(tb_gamestats.turnovers) as totalturnovers, SUM(tb_gamestats.steals) as totalsteals, SUM(tb_gamestats.fouls) as totalfouls, tb_teams.team_name, tb_teams.coach_id, tb_players.player_number, tb_players.player_id, tb_gamestats.gamestats_id, tb_gameplayers.position_id, tb_gameplayers.isFirstfive, tb_position.position_name
        from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams, tb_gameplayers, tb_position
        where tb_gamestats.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamestats.gamesched_id = tb_gameplayers.gamesched_id and tb_gamestats.player_id = tb_players.player_id and tb_gameplayers.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.hometeam_id and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id and tb_gameplayers.position_id = tb_position.position_id
        group by tb_gamestats.player_id
        order by tb_gameplayers.isFirstfive DESC, totalpoints DESC";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $loadhometeam .= "<table class='table table-striped table_playerstats'>
                            <tr>
                                <th>Name</th>
                                <th title='Points'>PTS</th>
                                <th title='Field Goal Made'>FGM</th>
                                <th title='Field Goal Attempt'>FGA</th>
                                <th title='Field Goal Percentage'>FG%</th>
                                <th title='Three Points Made'>3PM</th>
                                <th title='Three Points Attempt'>3PA</th>
                                <th title='Three Points Percentage'>3P%</th>
                                <th title='Free Throw Made'>FTM</th>
                                <th title='Free Throw Attempt'>FTA</th>
                                <th title='Free Throw Percentage'>FT%</th>
                                <th title='Offensive Rebounds'>OREB</th>
                                <th title='Defensive Rebounds'>DREB</th>
                                <th title='Rebounds'>REB</th>
                                <th title='Assists'>AST</th>
                                <th title='Steals'>STL</th>
                                <th title='Blocks'>BLK</th>
                                <th title='Turnovers'>TO</th>
                                <th title='Personal fouls'>PF</th>
                            </tr>"; 
        while($row = mysqli_fetch_assoc($result)){
            $pstn = explode(" ", stripslashes($row["position_name"]));

        $loadhometeam .= "<tr>
                            <td><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImagePlayer($row[player_id])' class='img_player_stat' id='img_player$row[player_id]'> $row[playername] -
                            ";
                            if($row["isFirstfive"] == 1){
                                foreach($pstn as $values){
                                    $lengthpstn = strlen($values);
                                    $loadhometeam .= "<b>".substr($values, 0, 1)."</b>";
                                }
                            }else{
                                $loadhometeam .= " ";
                            }
                            
                            "</td>";

            $loadhometeam .= "<td>$row[totalpoints]</td>";
            $loadhometeam .= "<td>$row[totalfgm]</td>";
            $loadhometeam .= "<td>$row[totalfga]</td>";
            $loadhometeam .= "<td>$row[fgp]</td>";
            $loadhometeam .= "<td>$row[total3pm]</td>";
            $loadhometeam .= "<td>$row[total3pa]</td>";
            $loadhometeam .= "<td>$row[tpp]</td>";
            $loadhometeam .= "<td>$row[totalftm]</td>";
            $loadhometeam .= "<td>$row[totalfta]</td>";
            $loadhometeam .= "<td>$row[ftp]</td>";
            $loadhometeam .= "<td>$row[totalorebounds]</td>";
            $loadhometeam .= "<td>$row[totaldrebounds]</td>";
            $loadhometeam .= "<td>$row[totalrebounds]</td>";
            $loadhometeam .= "<td>$row[totalassists]</td>";
            $loadhometeam .= "<td>$row[totalsteals]</td>";
            $loadhometeam .= "<td>$row[totalblocks]</td>";
            $loadhometeam .= "<td>$row[totalturnovers]</td>";
            $loadhometeam .= "<td>$row[totalfouls]</td>";
            $loadhometeam .= "</tr>";

        }
        $loadhometeam .= "</table>";

    }


    echo $loadhometeam;

?>