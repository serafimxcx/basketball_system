<?php 
    include("../connect.php");

    $loadhometeam = "";
    $checkInjured = "";
    $checkFirstFive = "";
    $selectCurrentposition = "";
    

    $queryhometeam = "select tb_teams.team_name, CONCAT(tb_coach.last_name, ', ', tb_coach.first_name) as coachname, tb_teams.img_source, tb_teams.team_id
    from tb_coach, tb_teams
    where tb_teams.team_id = '".intval($_REQUEST['homeTeam_id'])."' and tb_teams.coach_id = tb_coach.coach_id
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

    $query = "select * from tb_players where team_id = '".intval($_REQUEST['homeTeam_id'])."'";

    $result = mysqli_query($conn, $query);

    $loadhometeam .="<table width='100%' class='table table-bordered'>
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

        $loadhometeam .= "<tr>
                            <td>$row[player_number] <input type='hidden' class='txt_hometeam_id' id='txt_hometeam_id$row[player_id]' value='".intval($_REQUEST['homeTeam_id'])."'></td>
                            <td>$row[last_name], $row[first_name]</td>
                            <td><input type='checkbox' name='c_isInjuredhome[]' class='c_isInjuredhome' player_id='$row[player_id]' value='1' $checkInjured></td>
                            <td><input type='checkbox' name='c_firstfivehome[]' class='c_firstfivehome' id='c_firstfivehome$row[player_id]' player_id='$row[player_id]' value='1' $checkFirstFive></td>
                            <td><select name='slct_position[]' class='form-control slct_newpositionhome' id='slct_newpositionhome$row[player_id]'>";
                           

                            $queryposition = "select * from tb_position";
                            $resultposition = mysqli_query($conn, $queryposition);
                            
                            if(!empty($_POST["gamesched_id"])){
                                while($row_p = mysqli_fetch_assoc($resultposition)){
                                    $loadhometeam .= "<option value='$row_p[position_id]'";
                                        if($selectCurrentposition == $row_p["position_id"]){
                                            $loadhometeam .= "selected";
                                        }
                                    $loadhometeam .= ">$row_p[position_name]</option>";
                                }
                            }else{
                                while($row_p = mysqli_fetch_assoc($resultposition)){
                                    $loadhometeam .= "<option value='$row_p[position_id]'";
                                        if($row["position_id"] == $row_p["position_id"]){
                                            $loadhometeam .= "selected";
                                        }
                                    $loadhometeam .= ">$row_p[position_name]</option>";
                                }
                            }



                            

        $loadhometeam .=  "</select></td>
                        </tr>
                        
                        <script>
                        var maxCheckboxes = 5;

                        $('.c_firstfivehome').change(function() {
                            
                            var checkedCheckboxes = $('.c_firstfivehome:checked').length;
                    
                            if (checkedCheckboxes > maxCheckboxes) {
                            $(this).prop('checked', false);
                            alert('You can only select up to ' + maxCheckboxes + ' checkboxes.');
                            }
                        });

                        



                        </script>";
    }

    echo $loadhometeam
?>