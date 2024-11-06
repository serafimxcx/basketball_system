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


$loadteamstats = '';

$sort = $_GET["sort"];


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

$loadteamstats .='<style>
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

                        <h1 style="text-align:center;">Team Stats <br><span class="txt_date">'.date("F j, Y h:i:s A").'</span></h1>

                    <table width="100%" border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th title="Games">G</th>
                        <th title="Points Per Game">PPG</th>
                        <th title="Field Goal Percentage">FG%</th>
                        <th title="Three Points Percentage">3P%</th>
                        <th title="Free Throw Percentage">FT%</th>
                        <th title="Offensive Rebounds">OFF</th>
                        <th title="Defensive Rebounds">DEF</th>
                        <th title="Rebounds Per Game">RPG</th>
                        <th title="Assists Per Game">APG</th>
                        <th title="Steals Per Game">SPG</th>
                        <th title="Blocks Per Game">BPG</th>
                        <th title="Turnovers">TO</th>
                        <th title="Personal Fouls">PF</th>
                    </tr>';

while($row = mysqli_fetch_assoc($result)){
    $loadteamstats .= '<tr>
                        <td>'.$row["rank"].'</td>
                        <td>'.$row["team_name"].'</td>    
                        <td>'.$row["gamesplayed"].'</td>
                        <td>'.$row["ppg"].'</td>
                        <td>'.$row["fgp"].'</td>
                        <td>'.$row["tpp"].'</td>
                        <td>'.$row["ftp"].'</td>
                        <td>'.$row["off"].'</td>
                        <td>'.$row["def"].'</td>
                        <td>'.$row["rpg"].'</td>
                        <td>'.$row["apg"].'</td>
                        <td>'.$row["spg"].'</td>
                        <td>'.$row["bpg"].'</td>
                        <td>'.$row["tpg"].'</td>
                        <td>'.$row["fpg"].'</td>
                    </tr>';
}

$loadteamstats .= '</table>';



$pdf->writeHTML($loadteamstats);

$pdf->Output('result_teamstats.pdf', 'I');

?>