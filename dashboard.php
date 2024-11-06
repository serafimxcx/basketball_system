<?php
    include("connect.php");
    include("navbar.php");

    $no_of_admins=0;
    $no_of_teams=0;
    $no_of_coach=0;
    $no_of_players=0;
    $no_of_venue=0;
    $numcurrent = 0;
    $numupcoming = 0;
    $numrecent = 0;

    include("num_results.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Basketball System</title>
</head>
<body>
    <div id="container">
        <br><br><br>
        <div class="row">
            <!--left column-->
            <div class="col-sm-6 dashboard_col">
                <div class="row">
                    <div class="stats_div">
                        <h5 class="statstxt">GAMES FOR TODAY</h5>
                        <hr>
                        <?php 
                        
                        $querycurrent = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam, tb_gamesched.hometeam_id, tb_gamesched.awayteam_id, tb_gamesched.isLocked, tb_gamesched.start_time, tb_gamesched.end_time
                        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam
                        where tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id and tb_gamesched.date_schedule = CURDATE()
                        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time ASC";
                        
                        $resultcurrent = mysqli_query($conn, $querycurrent);

                        $numcurrent = mysqli_num_rows($resultcurrent);

                        if($numcurrent > 0 ){
                            echo "<table width='100%'>";
                            while($row = mysqli_fetch_assoc($resultcurrent)){
                                echo "<tr>
                                        <td>".date_format(date_create($row["start_time"]),"h:i A")."</td>
                                        <td>". stripslashes($row["hometeam"]). " VS ".stripslashes($row["awayteam"])."</td>
                                    </tr>";
                            }
                            echo "</table>";
                        }else{
                            echo "<h5>No games for today.</h5>";
                        }


                        

                        ?>
                    </div>
                    <div class="stats_div">
                        <h5 class="statstxt">UPCOMING GAMES</h5>
                        <hr>
                        <?php 
                        
                        $queryupcoming = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam, tb_gamesched.hometeam_id, tb_gamesched.awayteam_id, tb_gamesched.isLocked, tb_gamesched.start_time, tb_gamesched.end_time
                        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam
                        where tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id and tb_gamesched.date_schedule > CURDATE()
                        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time ASC";
                        
                        $resultupcoming = mysqli_query($conn, $queryupcoming);

                        $numupcoming = mysqli_num_rows($resultupcoming);

                        if($numupcoming > 0 ){
                            echo "<table width='100%'>";
                            while($row = mysqli_fetch_assoc($resultupcoming)){
                                echo "<tr>
                                        <td>".date_format(date_create($row["date_schedule"]),"F j, Y")."</td>
                                        <td>". stripslashes($row["hometeam"]). " VS ".stripslashes($row["awayteam"])."</td>
                                        <td>".date_format(date_create($row["start_time"]),"h:i A")."</td>
                                    </tr> ";
                            }

                           


                            echo "</table>";
                        }else{
                            echo "<h5>No upcoming games.</h5>";
                        }

                        ?>
                        
                    </div>

                    <div class="stats_div">
                        <h5 class="statstxt">RECENT GAME</h5>
                        <hr>
                        <?php 
                        
                        $queryrecent = "select tb_gamesched.gamesched_id, tb_gamesched.date_schedule, tb_hometeam.team_name as hometeam, tb_awayteam.team_name as awayteam, tb_gamesched.hometeam_id, tb_gamesched.awayteam_id, tb_gamesched.isLocked, tb_gamesched.start_time, tb_gamesched.end_time
                        from tb_gamesched, tb_teams as tb_hometeam, tb_teams as tb_awayteam
                        where tb_hometeam.team_id = tb_gamesched.hometeam_id and tb_awayteam.team_id = tb_gamesched.awayteam_id and tb_gamesched.date_schedule < CURDATE() and tb_gamesched.isLocked = 1
                        order by tb_gamesched.date_schedule ASC, tb_gamesched.start_time DESC LIMIT 1";
                        
                        $resultrecent = mysqli_query($conn, $queryrecent);

                        $numrecent = mysqli_num_rows($resultrecent);

                        if($numrecent > 0 ){
                            $gamesched_id = "";
                            echo "<table width='500px'>";
                            while($row = mysqli_fetch_assoc($resultrecent)){
                                $gamesched_id = $row["gamesched_id"];
                                echo "<tr>
                                        <td>".date_format(date_create($row["date_schedule"]),"F j, Y")."<br><br></td>
                                        <td>". stripslashes($row["hometeam"]). " VS ".stripslashes($row["awayteam"])."<br><br></td>
                                    </tr>";
                            }

                            $querystanding = "select ROW_NUMBER() OVER(ORDER BY total_win DESC) as rank, tb_teams.team_id, tb_teams.team_name, tb_teams.img_source,tb_teamstanding.home_win, tb_teamstanding.home_lose, tb_teamstanding.away_lose, tb_teamstanding.away_win, SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) as total_win, SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose) as total_lose, FORMAT((SUM(tb_teamstanding.home_win + tb_teamstanding.away_win)/(SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) + SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose))* 100),2) as PCT, CONCAT(tb_teamstanding.home_win, ' - ', tb_teamstanding.home_lose) as HOME, CONCAT(tb_teamstanding.away_win, ' - ', tb_teamstanding.away_lose) as AWAY, tb_teamstanding.points_for, tb_teamstanding.points_against, ( tb_teamstanding.points_for - tb_teamstanding.points_against) as DIFF
                            from tb_teams, tb_teamstanding
                            where tb_teamstanding.team_id = tb_teams.team_id and tb_teamstanding.gamesched_id = '$gamesched_id'
                            group by tb_teamstanding.team_id
                            order by total_win DESC";

                            $resultstanding = mysqli_query($conn, $querystanding);

                            while($rowstanding = mysqli_fetch_assoc($resultstanding)){
                                echo "<tr>
                                        ";
                                        if($rowstanding["home_win"] == 1 || $rowstanding["away_win"] == 1){
                                            echo "<td colspan='2'><span class='wintxt'>$rowstanding[team_name] win</span> with a score of <span class='wintxt'>$rowstanding[points_for]</span> - $rowstanding[points_against].</td>";
                                        }else if($rowstanding["home_win"] == 0 || $rowstanding["away_win"] == 0){
                                            echo "<td colspan='2'><span class='losetxt'>$rowstanding[team_name] lose</span> with a score of <span class='losetxt'>$rowstanding[points_for]</span> - $rowstanding[points_against].</td>";
                                        }

                                echo "</tr>";
                            }

                            echo "</table>";
                        }else{
                            echo "<h5>No recent game.</h5>";
                        }

                        ?>
                        
                    </div>
                </div>
                
            </div>

            <!--right column-->
            <div class="col-sm-6 dashboard_col">
                <div class="row">
                    
                    <div class="stats_div" id="teamstanding_div">
                        <h5 class="statstxt">RANK 1 TEAM</h5>
                        <hr>
                        <?php 

                            $queryteam = "select ROW_NUMBER() OVER(ORDER BY total_win DESC) as rank, tb_teams.team_id, tb_teams.team_name, tb_teams.img_source, SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) as total_win, SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose) as total_lose, FORMAT((SUM(tb_teamstanding.home_win + tb_teamstanding.away_win)/(SUM(tb_teamstanding.home_win + tb_teamstanding.away_win) + SUM(tb_teamstanding.home_lose + tb_teamstanding.away_lose))* 100),2) as PCT, CONCAT(tb_teamstanding.home_win, ' - ', tb_teamstanding.home_lose) as HOME, CONCAT(tb_teamstanding.away_win, ' - ', tb_teamstanding.away_lose) as AWAY, tb_teamstanding.points_for, tb_teamstanding.points_against, ( tb_teamstanding.points_for - tb_teamstanding.points_against) as DIFF
                            from tb_teams, tb_teamstanding
                            where tb_teamstanding.team_id = tb_teams.team_id
                            group by tb_teamstanding.team_id
                            order by total_win DESC LIMIT 1";

                            $resultteam  = mysqli_query($conn, $queryteam);

                            echo "<table width='500px'>";
                            while($rowteam = mysqli_fetch_assoc($resultteam)){
                                echo "<tr>
                                        <td rowspan='2' style='text-align: center; width:40%'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($rowteam["img_source"])."' onerror='ErrorImageTeam($rowteam[team_id])' class='img_teamrankone' id='img_team$rowteam[team_id]'></td>
                                        <td colspan='2' width='60%'><h5 class='statstxt'>$rowteam[team_name]</h5></td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td><b>Total Win:</b> </td>
                                                    <td>$rowteam[total_win]</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Winning Percentage:</b>&nbsp;&nbsp;&nbsp;</td>
                                                    <td>$rowteam[PCT]</td>
                                                </tr>
                                            </table>
                                        </td>
                                        
                                    </tr>";
                            }
                            echo "</table>"



                        ?>
                    </div>

                    <div class="stats_div" id="playerstats_div">
                        <h5 class="statstxt">RANK 1 PLAYER</h5>
                        <hr>

                        <?php 
                            $queryplayer = "select ROW_NUMBER() OVER(ORDER BY SUM(tb_gamestats.points)/gameplayers.gamesplayed DESC) as rank, gameplayers.player_id, gameplayers.gamesplayed, gameplayers.gamestarter, tb_players.img_source, CONCAT(tb_players.last_name, ', ', tb_players.first_name) as playername, tb_teams.team_name,
                            COALESCE(FORMAT((SUM(tb_gamestats.points)/gameplayers.gamesplayed), 2), '0') as ppg,
                            COALESCE(FORMAT(((SUM(tb_gamestats.field_goal_made)/SUM(tb_gamestats.field_goal_attempt))*100), 2), '0') as fgp,
                            COALESCE(FORMAT(((SUM(tb_gamestats.three_pts_made)/SUM(tb_gamestats.three_pts_attempt))*100), 2), '0') as tpp,
                            COALESCE(FORMAT(((SUM(tb_gamestats.free_throw_made)/SUM(tb_gamestats.free_throw_attempt))*100), 2), '0') as ftp,
                            COALESCE(FORMAT((SUM(tb_gamestats.o_rebounds)/gameplayers.gamesplayed), 2), '0') as off,
                            COALESCE(FORMAT((SUM(tb_gamestats.d_rebounds)/gameplayers.gamesplayed), 2), '0') as def,
                            COALESCE(FORMAT((SUM(tb_gamestats.o_rebounds + tb_gamestats.d_rebounds)/gameplayers.gamesplayed), 2), '0') as rpg,
                            COALESCE(FORMAT((SUM(tb_gamestats.assists)/gameplayers.gamesplayed), 2), '0') as apg,
                            COALESCE(FORMAT((SUM(tb_gamestats.steals)/gameplayers.gamesplayed), 2), '0') as spg,
                            COALESCE(FORMAT((SUM(tb_gamestats.blocks)/gameplayers.gamesplayed), 2), '0') as bpg,
                            COALESCE(FORMAT((SUM(tb_gamestats.turnovers)/gameplayers.gamesplayed), 2), '0') as tpg,
                            COALESCE(FORMAT((SUM(tb_gamestats.fouls)/gameplayers.gamesplayed), 2), '0') as fpg
                            FROM 
                            (
                                SELECT 
                                    player_id,
                                    COUNT(player_id) as gamesplayed,
                                    SUM(isFirstfive) as gamestarter
                                FROM tb_gameplayers
                                WHERE isInjured = 0
                                GROUP BY player_id
                            ) as gameplayers
                            JOIN 
                            tb_players ON gameplayers.player_id = tb_players.player_id
                            JOIN 
                            tb_teams ON tb_players.team_id = tb_teams.team_id
                            LEFT JOIN 
                            tb_gamestats ON gameplayers.player_id = tb_gamestats.player_id
                            GROUP BY 
                            gameplayers.player_id, gameplayers.gamesplayed, tb_players.img_source, playername, tb_teams.team_name
                            order by rank LIMIT 1
                            ";

                            $resultplayer = mysqli_query($conn, $queryplayer);

                            echo "<table width='100%'>";
                            while($rowplayer = mysqli_fetch_assoc($resultplayer)){
                                echo "<tr>
                                        <td rowspan='2' style='text-align: center; width: 40%'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($rowplayer["img_source"])."' onerror='ErrorImagePlayer($rowplayer[player_id])' class='img_player img_playerrankone' id='img_player$rowplayer[player_id]'></td>
                                        <td colspan='2' width='60%'>
                                        <h5 class='statstxt'>$rowplayer[playername]</h5>
                                        <h5>$rowplayer[team_name]</h5>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><table width='400px'>
                                            <tr>
                                                <td><b>PPG:</b> </td>
                                                <td>$rowplayer[ppg]</td>
                                                <td><b>FG%:</b> </td>
                                                <td>$rowplayer[fgp]</td>
                                            </tr>
                                            <tr>
                                                <td><b>3P%:</b> </td>
                                                <td>$rowplayer[tpp]</td>
                                                <td><b>FT%:</b> </td>
                                                <td>$rowplayer[ftp]</td>
                                            </tr>
                                            </table></td>
                                        
                                    </tr>";
                            }
                            echo "</table>"
                        ?>
                    </div>

                </div>

                <div class="row">
                    <div class="no_user_admin_div " id="admin_div">
                        <table width="100%">
                            <tr>
                                <td><h5 class="txt">USERS</h5></td>
                                <td style="text-align:right;"><div class="num_useradmin"><span><?php echo $no_of_admins; ?></span></div></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <table width="100%">
                        <tr>
                            <td width="50%">
                            <div class=" admin_col" id="coach_div">
                                <span class="num_contents"><?php echo $no_of_coach ;?></span>
                                <h5 class="admin_txt">Coach</h5>
                            </div>
                            </td>
                            <td width="50%">
                            <div class="admin_col" id="teams_div">
                                <span class="num_contents"><?php echo $no_of_teams ;?></span>
                                <h5 class="admin_txt">Teams</h5>
                            </div>
                            </td>
                        </tr>
                    </table>
                    
                </div>

                <div class="row">
                    <table width="100%">
                        <tr>
                            <td width="50%">
                            <div class=" admin_col" id="players_div">
                                <span class="num_contents"><?php echo $no_of_players ;?></span>
                                <h5 class="admin_txt">Players</h5>
                            </div>
                            </td>
                            <td width="50%">
                            <div class="admin_col" id="venue_div">
                                <span class="num_contents"><?php echo $no_of_venue ;?></span>
                                <h5 class="admin_txt">Venues</h5>
                            </div>
                            </td>
                        </tr>
                    </table>
                    
                    
                </div>

                
               


            </div>

        </div>

    </div>
</body>

<script>
    $(function(){
        $("#admin_div").click(function(){
            window.location.href="/basketball_system/useradmin/useradmin.php";
        });

        $("#coach_div").click(function(){
            window.location.href="/basketball_system/coaches/coaches.php";
        });

        $("#teams_div").click(function(){
            window.location.href="/basketball_system/teams/teams.php";
        });

        $("#players_div").click(function(){
            window.location.href="/basketball_system/players/players.php";
        });

        $("#venue_div").click(function(){
            window.location.href="/basketball_system/venue/venue.php";
        });

        $("#playerstats_div").click(function(){
            window.location.href="/basketball_system/playerstatsallgames/playerstatsallgames.php";
        });

        $("#teamstanding_div").click(function(){
            window.location.href="/basketball_system/teamstanding/teamstanding.php";
        });
    });

    function ErrorImageTeam(team_id){
    $("#img_team"+team_id).attr("src", "https://drive.google.com/uc?export=view&id=1ZonLFhchjIk0sosa1k01dTZnym4bDoC1")
    }

    function ErrorImagePlayer(player_id){
    $("#img_player"+player_id).attr("src", "https://drive.google.com/uc?export=view&id=1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa")
    }

</script>
</html>