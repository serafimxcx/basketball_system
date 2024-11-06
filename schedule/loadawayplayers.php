<?php 
    include("../connect.php");

    $loadawayteam = "";
    $checkInjured = "";
    $checkFirstFive = "";
    $selectCurrentposition = "";
    

    $queryawayteam = "select tb_teams.team_name, CONCAT(tb_coach.last_name, ', ', tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id
    from tb_coach, tb_teams
    where tb_teams.team_id = '".intval($_REQUEST['awayTeam_id'])."' and tb_teams.coach_id = tb_coach.coach_id
    LIMIT 1";

    $resultawayteam = mysqli_query($conn, $queryawayteam) or die(mysqli_error($conn));

    $loadawayteam .= "<table width='100%'>";
    while($row = mysqli_fetch_assoc($resultawayteam)){
        $loadawayteam .= "
                            <tr>
                            <td><h3><b>$row[team_name]</b></h3></td>
                            <td rowspan='2' style='vertical-align: middle; padding-left: 20px; text-align: right;'><img src='https://drive.google.com/uc?export=view&id=".stripslashes($row["img_source"])."' onerror='ErrorImageTeam($row[team_id])' class='img_team_stat' id='img_team$row[team_id]'></td>
                            
                          </tr>
                          <tr>
                                <td><h5>Coach: $row[coachname]</h5></td>
                            </tr>
                          
        ";
    }
    $loadawayteam .= "</table><br><hr><br>";

    $query = "select * from tb_players where team_id = '".intval($_REQUEST['awayTeam_id'])."'";

    $result = mysqli_query($conn, $query);

    $loadawayteam .="<table width='100%' class='table table-bordered'>
                        <tr>
                            <th>Player Number</th><th>Name</th><th>Injured</th><th>First Five</th><th>Position</th>
                        </tr>";

    while($row = mysqli_fetch_assoc($result)){
        if(!empty($_POST["gamesched_id"])){
            $gamesched_id = $_POST["gamesched_id"];

            $querygameplayers = "select * from tb_gameplayers where gamesched_id = '$gamesched_id' AND player_id = '$row[player_id]'";
            $resultgameplayers = mysqli_query($conn, $querygameplayers);
    
            $gameplayerData = mysqli_fetch_assoc($resultgameplayers);

            $checkInjured = $gameplayerData ? ($gameplayerData['isInjured'] ? 'checked' : '') : '';
            $checkFirstFive = $gameplayerData ? ($gameplayerData['isFirstfive'] ? 'checked' : '') : '';
            $selectCurrentposition = $gameplayerData ? $gameplayerData['position_id'] : $row['position_id'];
        }

        $loadawayteam .= "<tr>
                            <td>$row[player_number] <input type='hidden' class='txt_awayteam_id' id='txt_awayteam_id$row[player_id]' value='".intval($_REQUEST['awayTeam_id'])."'></td>
                            <td>$row[last_name], $row[first_name]</td>
                            <td><input type='checkbox' name='c_isInjuredaway[]' class='c_isInjuredaway' player_id='$row[player_id]' value='1' $checkInjured></td>
                            <td><input type='checkbox' name='c_firstfiveaway[]' class='c_firstfiveaway' id='c_firstfiveaway$row[player_id]' player_id='$row[player_id]' value='1' $checkFirstFive></td>
                            <td><select name='slct_position[]' class='form-control slct_newpositionaway' id='slct_newpositionaway$row[player_id]'>";
                           

                            $queryposition = "select * from tb_position";
                            $resultposition = mysqli_query($conn, $queryposition);
                            
                            if(!empty($_POST["gamesched_id"])){
                                while($row_p = mysqli_fetch_assoc($resultposition)){
                                    $loadawayteam .= "<option value='$row_p[position_id]'";
                                        if($selectCurrentposition == $row_p["position_id"]){
                                            $loadawayteam .= "selected";
                                        }
                                    $loadawayteam .= ">$row_p[position_name]</option>";
                                }
                            }else{
                                while($row_p = mysqli_fetch_assoc($resultposition)){
                                    $loadawayteam .= "<option value='$row_p[position_id]'";
                                        if($row["position_id"] == $row_p["position_id"]){
                                            $loadawayteam .= "selected";
                                        }
                                    $loadawayteam .= ">$row_p[position_name]</option>";
                                }
                            }



                            

        $loadawayteam .=  "</select></td>
                        </tr>
                        
                        <script>
                        var maxCheckboxes = 5;

                        $('.c_firstfiveaway').change(function() {
                            
                            var checkedCheckboxes = $('.c_firstfiveaway:checked').length;
                    
                            if (checkedCheckboxes > maxCheckboxes) {
                            $(this).prop('checked', false);
                            alert('You can only select up to ' + maxCheckboxes + ' checkboxes.');
                            }
                        });

                        



                        </script>";
    }

    echo $loadawayteam
?>