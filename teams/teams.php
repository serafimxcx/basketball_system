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
                        <input type="hidden" name="txt_team_id" id="txt_team_id">
                        <h1 class="module_title">Manage Teams </h1>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td>Team Logo: <i class="bi bi-info-circle profile_tip" title="How to find URL ID: &#013;1. Make sure the photo has a public access. &#013;2. Copy the link. &#013;3. Get the URL ID in the link. &#013;&#013;Sample link: https://drive.google.com/file/d/1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa/view?usp=sharing &#013;URL ID: 1_Kg8wL1aztfoexPJmU9-3T_0uaHAqqoa"></i></td>
                                <td><input type="text" data_type="txt" name="txt_imgsource" class="form-control txt_name" id="txt_imgsource" placeholder="Paste URL ID of the image from Google Drive"></td>
                            </tr>
                            <tr>
                                <td>Team Name:</td>
                                <td><input type="text" data_type="txt" name="txt_lastname" class="form-control txt_name" id="txt_teamname" ></td>
                            </tr>
                            <tr>
                                <td>Select Coach: </td>
                                <td><select name="slct_coach" class="form-control txt_name" id="slct_coach"></select></td>
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
                <div id="team_result" class="container_results">
                    
                </div>

            </div>
        </div>
        

    </div>
    
</body>
    <script src="team_script.js"></script>
</html>