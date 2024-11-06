<?php
    include("../connect.php");

    $loadhometeam = "";

    $queryhometeam = "select tb_teams.team_name, CONCAT(tb_coach.last_name, ', ', tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id
    from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams
    where tb_gamestats.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id
    LIMIT 1";

    $resulthometeam = mysqli_query($conn, $queryhometeam) or die(mysqli_error($conn));

    $loadhometeam .= "<table width='100%'>";
    while($row = mysqli_fetch_assoc($resulthometeam)){
        $loadhometeam .= "
                            <tr>
                            <td><h3><b>$row[team_name]</b></h3></td>
                            <td rowspan='2' style='vertical-align: middle; padding-left: 20px; text-align: right;'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImageTeam($row[team_id])' class='img_team_stat' id='img_team$row[team_id]'></td>
                            
                          </tr>
                          <tr>
                                <td><h5>Coach: $row[coachname]</h5></td>
                            </tr>
                          
        ";
    }
    $loadhometeam .= "</table><br><hr><br>";

    $query = "select CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_players.img_source, tb_gamestats.points, tb_gamestats.o_rebounds, tb_gamestats.d_rebounds, tb_gamestats.assists, tb_gamestats.blocks, tb_gamestats.steals, tb_gamestats.fouls, tb_gamestats.field_goal_made, tb_gamestats.field_goal_attempt, tb_gamestats.three_pts_made, tb_gamestats.three_pts_attempt, tb_gamestats.free_throw_made, free_throw_attempt, tb_teams.team_name, tb_teams.coach_id, tb_players.player_number, tb_players.player_id, tb_gamestats.gamestats_id
    from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams
    where tb_gamestats.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamesched.gamesched_id = '".intval($_REQUEST['sched_id'])."' and tb_gamestats.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.hometeam_id and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id
    order by tb_players.last_name ASC";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)){
        $loadhometeam .="<table width='100%' class='table table-bordered'>
                            <tr>
                                <td rowspan='4' style='vertical-align: middle; text-align: center;'>
                                <img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImagePlayer($row[player_id])' class='img_player_stat' id='img_player$row[player_id]'>
                                </td>

                                <td colspan='4'><b>#$row[player_number] - $row[playername]</b></td>
                            </tr>
                            <tr>
                               
                                <td class='td_stats' style='vertical-align: bottom'>Points
                                <input type='text' class='form-control txt_stats txt_points' previousScore='$row[points]' value='$row[points]' placeholder='$row[points]' playerstats_id='$row[gamestats_id]'>
                                </td>
                                <td class='td_stats' style='vertical-align: bottom'>Three Points 
                                <input type='text' class='form-control txt_stats txt_threepoints' previousScore='$row[three_pts]' value='$row[three_pts]' placeholder='$row[three_pts]' playerstats_id='$row[gamestats_id]'>
                                </td>
                                <td class='td_stats' style='vertical-align: bottom'>Free Throw
                                <input type='text' class='form-control txt_stats txt_freethrow' previousScore='$row[free_throw]' value='$row[free_throw]' placeholder='$row[free_throw]' playerstats_id='$row[gamestats_id]'></td>
                                <td class='td_stats' style='vertical-align: bottom'>Assists
                                <input type='text' class='form-control  txt_stats txt_assists' previousScore='$row[assists]' value='$row[assists]' placeholder='$row[assists]' playerstats_id='$row[gamestats_id]'></td>
                                
                            </tr>
                            <tr>
                                <td class='td_stats' style='vertical-align: bottom'>Rebounds
                                <input type='text' class='form-control  txt_stats txt_rebounds' previousScore='$row[rebounds]' value='$row[assists]' placeholder='$row[rebounds]' playerstats_id='$row[gamestats_id]'></td>
                                <td class='td_stats' style='vertical-align: bottom'>Steals
                                <input type='text' class='form-control  txt_stats txt_steals' previousScore='$row[steals]' value='$row[steals]' placeholder='$row[steals]' playerstats_id='$row[gamestats_id]'></td>
                                <td class='td_stats' style='vertical-align: bottom'>Blocks
                                <input type='text' class='form-control  txt_stats txt_blocks' previousScore='$row[blocks]' value='$row[blocks]' placeholder='$row[blocks]' playerstats_id='$row[gamestats_id]'></td>
                                <td class='td_stats' style='vertical-align: bottom'>Fouls
                                <input type='text' class='form-control  txt_stats txt_fouls' previousScore='$row[fouls]' value='$row[fouls]' placeholder='$row[fouls]' playerstats_id='$row[gamestats_id]'></td>
                                

                            </tr>
        
                        </table>";

    }

    echo $loadhometeam;

?>