<?php 
    include("../connect.php");

    $query = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam, tb_gamesched.hometeam_id, tb_gamesched.awayteam_id, tb_gamesched.isLocked
        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam
        where tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id
        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time ASC";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $optionsched = "";

    $optionsched = "<option value=''>Select Game Schedule...</option>";

    while($row = mysqli_fetch_assoc($result)){
        $optionsched .= "<option value='$row[gamesched_id]' hometeam_id='$row[hometeam_id]' awayteam_id='$row[awayteam_id]' sched_info='". stripslashes($row["hometeam"]). " VS ".stripslashes($row["awayteam"])."' isLocked='$row[isLocked]'>".date("m/d/Y",strtotime($row["date_schedule"])) ." - ". stripslashes($row["hometeam"]). " VS ".stripslashes($row["awayteam"])."</option>";
    }

    echo $optionsched;
?>