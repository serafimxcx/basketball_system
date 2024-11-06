<?php 
include("../connect.php");

$loadstanding = "";
$sort=$_POST["sort"];

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



$loadstanding .= "<table class='table table_standing'>
                    <tr>
                        <th class='sort_rank'>Rank</th>
                        <th></th>
                        <th class='sort_team'>Team</th>
                        <th>Total Win</th>
                        <th>Total Lose</th>
                        <th title='Winning Percentage'>PCT</th>
                        <th>HOME</th>
                        <th>AWAY</th>
                        <th title='Points For'>PF</th>
                        <th title='Points Against'>PA</th>
                        <th title='Point Differential'>DIFF</th>
                    </tr>";

while($row = mysqli_fetch_assoc($result)){
    $loadstanding .= "<tr>
                            <td>$row[rank]</td>   
                            <td style='text-align: center'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImage($row[team_id])' class='img_team img_team_standing' id='img_team$row[team_id]'></td>
                            <td>$row[team_name]</td>    
                            <td>$row[total_win]</td>    
                            <td>$row[total_lose]</td>    
                            <td>$row[PCT]</td>    
                            <td>$row[HOME]</td>    
                            <td>$row[AWAY]</td>    
                            <td>$row[points_for]</td>    
                            <td>$row[points_against]</td>  
                            <td>$row[DIFF]</td>  
                    </tr>";
}

$loadstanding .= "</table>";

echo $loadstanding;
?>