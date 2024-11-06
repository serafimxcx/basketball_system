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
                        <input type="hidden" name="txt_position_id" id="txt_position_id">
                        <h1 class="module_title">Manage Positions </h1>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td>Position: </td>
                                <td><input type="text" data_type="txt" name="txt_position" class="form-control txt_name" id="txt_position"></td>
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
                <div id="position_result" class="container_results">
                    
                </div>

            </div>
        </div>
        

    </div>
    
</body>
    <script src="position_script.js"></script>
</html>