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
        <div class="row">
            <div class="col-sm-6 input_col">
                <form onload="return false;">
                    <div id="coach_manage">
                        <input type="hidden" name="txt_sched_id" id="txt_sched_id">
                        <h1 class="module_title">Manage Schedules </h1>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td>Date: </td>
                                <td><input type="date" data_type="txt" name="txt_date" class="form-control txt_name" id="txt_date"></td>
                            </tr>
                            <tr>
                                <td>Start Time:</td>
                                <td><input type="time" data_type="txt" name="txt_starttime" class="form-control txt_name txt_time" id="txt_starttime"></td>
                            
                            </tr>
                            <tr>
                                <td>End Time:</td>
                                <td><input type="time" data_type="txt" name="txt_endtime" class="form-control txt_name txt_time" id="txt_endtime"></td>
                            </tr>
                            <tr>
                                <td>Venue:</td>
                                <td><select name="slct_venue" class="form-control txt_name"  id="slct_venue"></select></td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            <!-- <tr>
                                <td>Home Team:</td>
                                <td><select name="slct_hometeam" class="form-control txt_name"  id="slct_hometeam"></select>
                                    <div id="hometeam_result"></div></td>
                            </tr>
                            <tr>
                                <td>Away Team: </td>
                                <td><select name="slct_awayteam" class="form-control txt_name"  id="slct_awayteam"></select>
                                    <div id="awayteam_result"></div></td>
                            </tr> -->
                            <tr>
                                <td>Manage Teams:</td>
                                <td><button type="button" id="btn_manageteams" class="btn btn-primary"><span id="btnteams_txt">Choose Home Team and Away Team</span></button></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn_coach btn-success" id="btn_save">Save</button>
                                    <button type="button" class="btn btn_coach btn-warning" id="btn_cancel">Cancel</button>
                                </td>
                            </tr>

                        </table>
                    </div>

                    <div class="modal" id="team_modal">
                        <div id="team_container">
                            <table width="100%">
                                <tr><td><h1 class="module_title"><i class="bi bi-x" id="close_modal"></i> Manage Teams</h1></td>
                                
                                <td style="text-align: right;"><button type="button" class="btn btn-success" id="btn_saveteam"> Save Teams</button></td></tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                <select name="slct_hometeam" class="form-control txt_name"  id="slct_hometeam"></select><br>
                                    <div id="hometeam_result"></div>
                                </div>
                                <div class="col-sm-6">
                                <select name="slct_hometeam" class="form-control txt_name"  id="slct_awayteam"></select><br>
                                    <div id="awayteam_result"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="col-sm-6 records_col">
                <table>
                    <tr>
                        <td>Sort Through Date:</td>
                        <td><input type="date" name="sort_date" class="form-control txt_name"  id="sort_date"></td>
                    </tr>
                </table>
                <div id="sched_result" class="container_results">
                    
                </div>

            </div>
        </div>
        

    </div>
    
</body>
    <script src="sched_script.js"></script>
</html>