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


$loadstanding = '';

$sort=$_GET["sort"];

if($sort==""){
    $query = "select ROW_NUMBER() OVER(ORDER BY total_win DESC) as rank, tb_teams.team_id, tb_teams.team_name, tb_teams.img_source, SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) as total_win, SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose) as total_lose, FORMAT((SUM(tb_teamstanding.home_win + tb_teamstanding.away_win)/(SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) + SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose))* 100),2) as PCT, CONCAT(tb_teamstanding.home_win, ' - ', tb_teamstanding.home_lose) as HOME, CONCAT(tb_teamstanding.away_win, ' - ', tb_teamstanding.away_lose) as AWAY, tb_teamstanding.points_for, tb_teamstanding.points_against, ( tb_teamstanding.points_for - tb_teamstanding.points_against) as DIFF
    from tb_teams, tb_teamstanding
    where tb_teamstanding.team_id = tb_teams.team_id
    group by tb_teamstanding.team_id
    order by total_win DESC";
}else{
    $query = "select ROW_NUMBER() OVER(ORDER BY total_win DESC) as rank, tb_teams.team_id, tb_teams.team_name, tb_teams.img_source, SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) as total_win, SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose) as total_lose, FORMAT((SUM(tb_teamstanding.home_win + tb_teamstanding.away_win)/(SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) + SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose))* 100),2) as PCT, CONCAT(tb_teamstanding.home_win, ' - ', tb_teamstanding.home_lose) as HOME, CONCAT(tb_teamstanding.away_win, ' - ', tb_teamstanding.away_lose) as AWAY, tb_teamstanding.points_for, tb_teamstanding.points_against, ( tb_teamstanding.points_for - tb_teamstanding.points_against) as DIFF
    from tb_teams, tb_teamstanding
    where tb_teamstanding.team_id = tb_teams.team_id
    group by tb_teamstanding.team_id
    order by $sort";
}

$result = mysqli_query($conn, $query);

$loadstanding .= '<h1 style="text-align:center;">Team Standing <br><span class="txt_date">'.date("F j, Y h:i:s A").'</span></h1>';


$loadstanding .= '<style>
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

                    <table border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th>Rank</th>
                        <th>Team</th>
                        <th>Total Win</th>
                        <th>Total Lose</th>
                        <th>PCT</th>
                        <th>HOME</th>
                        <th>AWAY</th>
                        <th>PF</th>
                        <th>PA</th>
                        <th>DIFF</th>
                    </tr>';

while($row = mysqli_fetch_assoc($result)){
    $loadstanding .= '<tr>
                            <td>'.$row["rank"].'</td>   
                            <td>'.$row["team_name"].'</td>    
                            <td>'.$row["total_win"].'</td>    
                            <td>'.$row["total_lose"].'</td>    
                            <td>'.$row["PCT"].'</td>    
                            <td>'.$row["HOME"].'</td>    
                            <td>'.$row["AWAY"].'</td>    
                            <td>'.$row["points_for"].'</td>    
                            <td>'.$row["points_against"].'</td>  
                            <td>'.$row["DIFF"].'</td>  
                    </tr>';
}

$loadstanding .= '</table>';



$pdf->writeHTML($loadstanding);

$pdf->Output('result_teamstanding.pdf', 'I');


?>