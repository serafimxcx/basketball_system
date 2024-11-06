<?php 
    include("../connect.php");

    if(empty($_REQUEST["sortSched"])){
        $query = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_gamesched.start_time, tb_gamesched.end_time, tb_venue.venue_name, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam
        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam, tb_venue
        where tb_gamesched.venue_id = tb_venue.venue_id and tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id
        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time ASC";  
    }else if (!empty($_REQUEST["sortSched"])){
        $query = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_gamesched.start_time, tb_gamesched.end_time, tb_venue.venue_name, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam
        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam, tb_venue
        where tb_gamesched.venue_id = tb_venue.venue_id and tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id and tb_gamesched.date_schedule = '".date("Y/m/d",strtotime($_REQUEST["sortSched"]))."'
        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time ASC";  
    }


    
    

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $loadsched = "<table class='table table-hover table_files'> ";
    $loadsched .= "<tr>
                    <th class='col-xs-1 text-center'>Date</th>
                    <th class='col-xs-1 text-center'>Game</th>
                    <th class='col-xs-1 text-center'>Start Time</th>
                    <th class='col-xs-1 text-center'>End Time</th>
                    <th class='col-xs-1 text-center'>Venue</th>
                    <th class='col-xs-1'></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){

        $loadsched .= "<tr style='cursor:pointer;' class='sched_records' sched_id='".$row["gamesched_id"]."'>
                            <td style='vertical-align: middle;'>".date("m/d/Y",strtotime($row["date_schedule"]))."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["hometeam"]). "<br>VS<br>".stripslashes($row["awayteam"])."</td>
                            <td style='vertical-align: middle;'>".date("H:i:s",strtotime($row["start_time"]))."</td>
                            <td style='vertical-align: middle;'>".date("H:i:s",strtotime($row["end_time"]))."</td>
                            <td style='vertical-align: middle;'>".stripslashes($row["venue_name"])."</td>
                            <td style='vertical-align: middle;'><button type='button' class='remove-sched btn-danger remove_item' sched_id='".$row["gamesched_id"]."'>X</button></td>
                        </tr>";
    }

    $loadsched .= "</table>";

echo $loadsched;
?>