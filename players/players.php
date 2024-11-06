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
    <br><br><br><br>
    <div id="container">
        <div class="row">
            <div class="col-sm-6 input_col">
                <form onload="return false;">
                    <div id="coach_manage">
                        <input type="hidden" name="txt_player_id" id="txt_player_id">
                        <h1 class="module_title">Manage Players </h1>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td colspan="2">
                                    <table width="100%">
                                        <tr>
                                            <td width="10%">Team: </td>
                                            <td width="30%" style="padding-right: 20px;"><select name="slct_team" class="form-control txt_name"  id="slct_team"></select></td>       
                                            <td width="10%">Position: </td>
                                            <td width="20%" style="padding-right: 20px;"><select name="slct_position" class="form-control txt_name"  id="slct_position"></select></td>
                                            <td width="15%">Player Number: </td>
                                            <td width="15%"><input type="number" maxlength="2" data_type="txt" name="txt_playernum" class="form-control txt_name" id="txt_playernum" ></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr >
                                <td colspan="2"><hr></td>

                            </tr>
                            <tr>
                                <td>Profile Picture: <i class="bi bi-info-circle profile_tip" title="How to find URL ID: &#013;1. Make sure the photo has a public access. &#013;2. Copy the link. &#013;3. Get the URL ID in the link. &#013;&#013;Sample link: https://drive.google.com/file/d/1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa/view?usp=sharing &#013;URL ID: 1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa"></i></td>
                                <td><input type="text" data_type="txt" name="txt_imgsource" class="form-control txt_name" id="txt_imgsource" placeholder="Paste URL ID of the image from Google Drive"></td>
                            </tr>
                
                            <tr>
                                <td>Last Name:</td>
                                <td><input type="text" data_type="txt" name="txt_lastname" class="form-control txt_name" id="txt_lastname" ></td>
                            </tr>
                            <tr>
                                <td>First Name: </td>
                                <td><input type="text" data_type="txt" name="txt_firstname" class="form-control txt_name" id="txt_firstname" ></td>
                            </tr>
                            <tr>
                                <td>Middle Name: </td>
                                <td><input type="text" data_type="txt" name="txt_middlename" class="form-control txt_name" id="txt_middlename" ></td>
                            </tr>
                            <tr>
                                <td>Height: </td>
                                <td><input type="text" data_type="txt" maxlength="11" name="txt_height" class="form-control txt_name" id="txt_height" ></td>
                            </tr>
                            <tr>
                                <td>Weight: </td>
                                <td><input type="text" data_type="txt" maxlength="11" name="txt_weight" class="form-control txt_name" id="txt_weight" ></td>
                            </tr>
                            <tr>
                                <td>Birth Date: </td>
                                <td><input type="date" data_type="txt" name="txt_birthdate" class="form-control txt_name" id="txt_birthdate" ></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn_coach btn-success" id="btn_save">Save</button>
                                    <button type="button" class="btn btn_coach btn-warning" id="btn_cancel">Cancel</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>

            </div>
            <div class="col-sm-6 records_col">
                <table>
                    <tr>
                        <td>Sort Through Team:</td>
                        <td><select name="sort_player" class="form-control txt_name"  id="sort_player"></select></td>
                    </tr>
                </table>
                <div id="player_result" class="container_results">
                    
                </div>

            </div>
        </div>
        

    </div>
    
</body>
    <script src="player_script.js"></script>
</html>