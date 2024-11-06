<?php 
include("../connect.php");
require_once('../pdf/config/tcpdf_config.php');
require_once('../pdf/tcpdf.php');

$multiplier = 72/2.54-2.90;
$width = 8.5; // inches
$length = 15;  // inches
$w = round($multiplier*$width);
$l = round($multiplier*$length)-2;
$page_orientation = "P";

include("../pdfreport.php");

$pdf->setPageOrientation('L');
$pdf->AddPage();
$pdf->SetFont("helvetica", "", 12);

$loadhometeam = '';
   //hometeam
    $queryhometeam = 'select tb_teams.team_name, CONCAT(tb_coach.last_name, ", ", tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id, tb_gamesched.date_schedule, tb_gamesched.start_time, tb_gamesched.end_time
    from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams
    where tb_gamestats.gamesched_id = '.$_GET["sched_id"].'  and tb_gamesched.gamesched_id = '.$_GET["sched_id"].'  and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id
    LIMIT 1';

    $resulthometeam = mysqli_query($conn, $queryhometeam) or die(mysqli_error($conn));

    $loadhometeam .= '<style>
                    table th{ 
                        text-align: center; font-weight:bold; background-color: #000361; color: white; border: 1px solid black;
                    }table td{
                        border: 1px solid black;
                        text-align: center;
                    }
                    .txt_date{
                        font-size: 12px;
                        line-height: 1.6;
                        font-weight: 100;
                    }

                </style>

                <h1  style="text-align:center;">Player Stats (Per Game) <br><span class="txt_date">'.date("F j, Y h:i:s A").'</span></h1>
                    
                    <div>';
    while($row = mysqli_fetch_assoc($resulthometeam)){
        $loadhometeam .= '<b>Hometeam:</b> '.$row["team_name"].' 
                            <br><b>Coach:</b> ' .$row["coachname"].' 
                            <br><b>Date Schedule:</b> '.date_format(date_create($row["date_schedule"]),"F j, Y ").'
                            <b>Time: </b>'.$row["start_time"].' - '.$row["end_time"];
    }
    $loadhometeam .= '</div><br>';

    
        $query = 'select CONCAT(tb_players.last_name, ", ", tb_players.first_name) as playername, tb_players.img_source,SUM( tb_gamestats.points) as totalpoints,  SUM(tb_gamestats.field_goal_made) as totalfgm, SUM(tb_gamestats.field_goal_attempt) as totalfga, COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made)/SUM(tb_gamestats.field_goal_attempt))*100),2), "0") as fgp, SUM( tb_gamestats.three_pts_made) as total3pm, SUM(tb_gamestats.three_pts_attempt) as total3pa, COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made)/SUM(tb_gamestats.three_pts_attempt))*100),2), "0") as tpp, SUM(tb_gamestats.free_throw_made) as totalftm, SUM(tb_gamestats.free_throw_attempt) totalfta, COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made)/SUM(tb_gamestats.free_throw_attempt))*100),2), "0") as ftp, SUM(tb_gamestats.o_rebounds) as totalorebounds, SUM(tb_gamestats.d_rebounds) as totaldrebounds, SUM(tb_gamestats.o_rebounds + tb_gamestats.d_rebounds) as totalrebounds, SUM(tb_gamestats.assists) as totalassists, SUM(tb_gamestats.blocks) as totalblocks, SUM(tb_gamestats.turnovers) as totalturnovers, SUM(tb_gamestats.steals) as totalsteals, SUM(tb_gamestats.fouls) as totalfouls, tb_teams.team_name, tb_teams.coach_id, tb_players.player_number, tb_players.player_id, tb_gamestats.gamestats_id, tb_gameplayers.position_id, tb_gameplayers.isFirstfive, tb_position.position_name
        from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams, tb_gameplayers, tb_position
        where tb_gamestats.gamesched_id = '.$_GET["sched_id"].' and tb_gamesched.gamesched_id = '.$_GET["sched_id"].' and tb_gamestats.gamesched_id = tb_gameplayers.gamesched_id and tb_gamestats.player_id = tb_players.player_id and tb_gameplayers.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.hometeam_id and tb_gamesched.hometeam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id and tb_gameplayers.position_id = tb_position.position_id
        group by tb_gamestats.player_id
        order by tb_gameplayers.isFirstfive DESC, totalpoints DESC';

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $loadhometeam .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <th width="10%">Name</th>
                                <th width="5%" title="Points">PTS</th>
                                <th width="5%" title="Field Goal Made">FGM</th>
                                <th width="5%" title="Field Goal Attempt">FGA</th>
                                <th width="5%" title="Field Goal Percentage">FG%</th>
                                <th width="5%" title="Three Points Made">3PM</th>
                                <th width="5%" title="Three Points Attempt">3PA</th>
                                <th width="5%" title="Three Points Percentage">3P%</th>
                                <th width="5%" title="Free Throw Made">FTM</th>
                                <th width="5%" title="Free Throw Attempt">FTA</th>
                                <th width="5%" title="Free Throw Percentage">FT%</th>
                                <th width="5%" title="Offensive Rebounds">OREB</th>
                                <th width="5%" title="Defensive Rebounds">DREB</th>
                                <th width="5%" title="Rebounds">REB</th>
                                <th width="5%" title="Assists">AST</th>
                                <th width="5%" title="Steals">STL</th>
                                <th width="5%" title="Blocks">BLK</th>
                                <th width="5%" title="Turnovers">TO</th>
                                <th width="5%" title="Personal fouls">PF</th>
                            </tr>'; 
        while($row = mysqli_fetch_assoc($result)){

            $loadhometeam .= '<tr><td>'.$row["playername"].'</td>';
            $loadhometeam .= '<td>'.$row["totalpoints"].'</td>';
            $loadhometeam .= '<td>'.$row["totalfgm"].'</td>';
            $loadhometeam .= '<td>'.$row["totalfga"].'</td>';
            $loadhometeam .= '<td>'.$row["fgp"].'</td>';
            $loadhometeam .= '<td>'.$row["total3pm"].'</td>';
            $loadhometeam .= '<td>'.$row["total3pa"].'</td>';
            $loadhometeam .= '<td>'.$row["tpp"].'</td>';
            $loadhometeam .= '<td>'.$row["totalftm"].'</td>';
            $loadhometeam .= '<td>'.$row["totalfta"].'</td>';
            $loadhometeam .= '<td>'.$row["ftp"].'</td>';
            $loadhometeam .= '<td>'.$row["totalorebounds"].'</td>';
            $loadhometeam .= '<td>'.$row["totaldrebounds"].'</td>';
            $loadhometeam .= '<td>'.$row["totalrebounds"].'</td>';
            $loadhometeam .= '<td>'.$row["totalassists"].'</td>';
            $loadhometeam .= '<td>'.$row["totalsteals"].'</td>';
            $loadhometeam .= '<td>'.$row["totalblocks"].'</td>';
            $loadhometeam .= '<td>'.$row["totalturnovers"].'</td>';
            $loadhometeam .= '<td>'.$row["totalfouls"].'</td>';
            $loadhometeam .= '</tr>';

        }
        $loadhometeam .= '</table>';

    

$pdf->writeHTML($loadhometeam);

//awayteam
$pdf->AddPage();

$loadawayteam = '';
$queryawayteam = 'select tb_teams.team_name, CONCAT(tb_coach.last_name, ", ", tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id, tb_gamesched.date_schedule, tb_gamesched.start_time, tb_gamesched.end_time
    from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams
    where tb_gamestats.gamesched_id = '.$_GET["sched_id"].'  and tb_gamesched.gamesched_id = '.$_GET["sched_id"].'  and tb_gamesched.awayteam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id
    LIMIT 1';

    $resultawayteam = mysqli_query($conn, $queryawayteam) or die(mysqli_error($conn));

    $loadawayteam .= '<style>
                    table th{ 
                        text-align: center; font-weight:bold; background-color: #000361; color: white; border: 1px solid black;
                    }table td{
                        border: 1px solid black;
                        text-align: center;
                    }
                    .txt_date{
                        font-size: 12px;
                        line-height: 1.6;
                        font-weight: 100;
                    }

                </style>

                <h1  style="text-align:center;">Player Stats (Per Game) <br><span class="txt_date">'.date("F j, Y h:i:s A").'</span></h1>
                    
                    <div>';
    while($row = mysqli_fetch_assoc($resultawayteam)){
        $loadawayteam .= '<b>Awayteam:</b> '.$row["team_name"].' 
                        <br><b>Coach:</b> ' .$row["coachname"].' 
                        <br><b>Date Schedule:</b> '.date_format(date_create($row["date_schedule"]),"F j, Y ").'
                        <b>Time: </b>'.$row["start_time"].' - '.$row["end_time"];
    }
    $loadawayteam .= '</div><br>';

    
        $query = 'select CONCAT(tb_players.last_name, ", ", tb_players.first_name) as playername, tb_players.img_source,SUM( tb_gamestats.points) as totalpoints,  SUM(tb_gamestats.field_goal_made) as totalfgm, SUM(tb_gamestats.field_goal_attempt) as totalfga, COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made)/SUM(tb_gamestats.field_goal_attempt))*100),2), "0") as fgp, SUM( tb_gamestats.three_pts_made) as total3pm, SUM(tb_gamestats.three_pts_attempt) as total3pa, COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made)/SUM(tb_gamestats.three_pts_attempt))*100),2), "0") as tpp, SUM(tb_gamestats.free_throw_made) as totalftm, SUM(tb_gamestats.free_throw_attempt) totalfta, COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made)/SUM(tb_gamestats.free_throw_attempt))*100),2), "0") as ftp, SUM(tb_gamestats.o_rebounds) as totalorebounds, SUM(tb_gamestats.d_rebounds) as totaldrebounds, SUM(tb_gamestats.o_rebounds + tb_gamestats.d_rebounds) as totalrebounds, SUM(tb_gamestats.assists) as totalassists, SUM(tb_gamestats.blocks) as totalblocks, SUM(tb_gamestats.turnovers) as totalturnovers, SUM(tb_gamestats.steals) as totalsteals, SUM(tb_gamestats.fouls) as totalfouls, tb_teams.team_name, tb_teams.coach_id, tb_players.player_number, tb_players.player_id, tb_gamestats.gamestats_id, tb_gameplayers.position_id, tb_gameplayers.isFirstfive, tb_position.position_name
        from tb_players, tb_gamesched, tb_gamestats, tb_coach, tb_teams, tb_gameplayers, tb_position
        where tb_gamestats.gamesched_id = '.$_GET["sched_id"].' and tb_gamesched.gamesched_id = '.$_GET["sched_id"].' and tb_gamestats.gamesched_id = tb_gameplayers.gamesched_id and tb_gamestats.player_id = tb_players.player_id and tb_gameplayers.player_id = tb_players.player_id and tb_players.team_id = tb_gamesched.awayteam_id and tb_gamesched.awayteam_id = tb_teams.team_id and tb_teams.coach_id = tb_coach.coach_id and tb_gameplayers.position_id = tb_position.position_id
        group by tb_gamestats.player_id
        order by tb_gameplayers.isFirstfive DESC, totalpoints DESC';

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $loadawayteam .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <th width="10%">Name</th>
                                <th width="5%" title="Points">PTS</th>
                                <th width="5%" title="Field Goal Made">FGM</th>
                                <th width="5%" title="Field Goal Attempt">FGA</th>
                                <th width="5%" title="Field Goal Percentage">FG%</th>
                                <th width="5%" title="Three Points Made">3PM</th>
                                <th width="5%" title="Three Points Attempt">3PA</th>
                                <th width="5%" title="Three Points Percentage">3P%</th>
                                <th width="5%" title="Free Throw Made">FTM</th>
                                <th width="5%" title="Free Throw Attempt">FTA</th>
                                <th width="5%" title="Free Throw Percentage">FT%</th>
                                <th width="5%" title="Offensive Rebounds">OREB</th>
                                <th width="5%" title="Defensive Rebounds">DREB</th>
                                <th width="5%" title="Rebounds">REB</th>
                                <th width="5%" title="Assists">AST</th>
                                <th width="5%" title="Steals">STL</th>
                                <th width="5%" title="Blocks">BLK</th>
                                <th width="5%" title="Turnovers">TO</th>
                                <th width="5%" title="Personal fouls">PF</th>
                            </tr>'; 
        while($row = mysqli_fetch_assoc($result)){

            $loadawayteam .= '<tr><td>'.$row["playername"].'</td>';
            $loadawayteam .= '<td>'.$row["totalpoints"].'</td>';
            $loadawayteam .= '<td>'.$row["totalfgm"].'</td>';
            $loadawayteam .= '<td>'.$row["totalfga"].'</td>';
            $loadawayteam .= '<td>'.$row["fgp"].'</td>';
            $loadawayteam .= '<td>'.$row["total3pm"].'</td>';
            $loadawayteam .= '<td>'.$row["total3pa"].'</td>';
            $loadawayteam .= '<td>'.$row["tpp"].'</td>';
            $loadawayteam .= '<td>'.$row["totalftm"].'</td>';
            $loadawayteam .= '<td>'.$row["totalfta"].'</td>';
            $loadawayteam .= '<td>'.$row["ftp"].'</td>';
            $loadawayteam .= '<td>'.$row["totalorebounds"].'</td>';
            $loadawayteam .= '<td>'.$row["totaldrebounds"].'</td>';
            $loadawayteam .= '<td>'.$row["totalrebounds"].'</td>';
            $loadawayteam .= '<td>'.$row["totalassists"].'</td>';
            $loadawayteam .= '<td>'.$row["totalsteals"].'</td>';
            $loadawayteam .= '<td>'.$row["totalblocks"].'</td>';
            $loadawayteam .= '<td>'.$row["totalturnovers"].'</td>';
            $loadawayteam .= '<td>'.$row["totalfouls"].'</td>';
            $loadawayteam .= '</tr>';

        }
        $loadawayteam .= '</table>';

        $pdf->writeHTML($loadawayteam);


$pdf->Output('result_statspergame.pdf', 'I');
?>