<?php 
    include("../navbar.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Basketball System</title>
</head>
<body>
    <br><br><br>
    <div id="container">
        <form onload='return false;'>
        <div class="row">
            <div class="records_col">
            
            <h1 class="module_title">Manage Game Stats</h1>
                <table>
                    <tr>
                        <td>Game Schedules:</td>
                        <td><select name="slct_gamesched" class="form-control txt_name"  id="slct_gamesched"></select></td>
                    </tr>
                </table>
                


            </div>
        </div>

        <hr>

        <div id="transaction_container">
            <div class="row">
            <input type="hidden" name="txt_stats_id" id="txt_stats_id">
            <input type="hidden" name="txt_hometeam_id" id="txt_hometeam_id">
            <input type="hidden" name="txt_awayteam_id" id="txt_awayteam_id">
            
            
                <table width="100%">
                    <tr>
                        <td width="15%">Select Quarter: </td>
                        <td><select name="slct_quarter" class="form-control txt_name" id="slct_quarter">
                            <option value="1">1st Quarter</option>
                            <option value="2">2nd Quarter</option>
                            <option value="3">3rd Quarter</option>
                            <option value="4">4th Quarter</option>
                        </select></td>
                        <td colspan="2" style="padding-left: 30px;">
                        </td>
                    </tr>
            
                    <tr>
                        <td width="15%">Select Player: </td>
                        <td>
                            <div class="searchplayer_container">
                                <div id="searchplayer_div">
                                    <input type="text" class="form-control"  class="txt_name" name="search_player" id="search_player" autocomplete="off" placeholder="Search Player"> 
                                    <input type="hidden" name="txt_player_id" id="txt_player_id">
                                    <input type="hidden" name="txt_playerteam_id" id="txt_playerteam_id">
                                    <div id="searchplayer_result"></div>
                                </div>
                            </div>
                        </td>
                        <td width="20%" style="padding-left: 30px;">Action Taken: </td>
                        <td><select name="slct_action" class="form-control txt_name" id="slct_action">
                            <option value="">Select Action...</option>
                            <option value="field_goal_made">2pts - Made</option>
                            <option value="field_goal_missed">2pts - Missed</option>
                            <option value="three_pts_made">3pts - Made</option>
                            <option value="three_pts_missed">3pts - Missed</option>
                            <option value="free_throw_made">Free Throw - Made</option>
                            <option value="free_throw_missed">Free Throw - Missed</option>
                            <option value="assist">Assist</option>
                            <option value="block">Block</option>
                            <option value="steal">Steal</option>
                            <option value="foul">Foul</option>
                            <option value="o_rebound">Offensive Rebound</option>
                            <option value="d_rebound">Defensive Rebound</option>
                            <option value="turnover">Turnover</option>
                        </select></td>
                        
                    </tr>

                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn_coach btn-success" id="btn_save">Save</button>
                            <button type="button" class="btn btn_coach btn-warning" id="btn_cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
        </form>
            </div>
            <br>
            <div class="row">
                    
                <div class="stats_result">
                    <div class="stats_title">Activity Log</div><br>
                    <h1 style="text-align: center; font-weight: bold;" id="sched_game"></h1><br>
                    <button type="button" class="btn btn-warning" id="btn_editgame">Edit</button>
                    <button type="button" class="btn btn-success" id="btn_finishgame">Conclude the Game</button>
                    <hr>
                    <div  id="stats_result" >

                    </div>
                    <br>
                </div>

                    
            </div>
            <br><br>
        </div>
        

    </div>
    
</body>
    <script src="stat_script.js"></script>
</html>